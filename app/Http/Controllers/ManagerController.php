<?php

namespace App\Http\Controllers;
use App\Models\Machine;
use App\Models\GlobalDescription;
use App\Models\MachineData;
use App\Models\MachineOperation;
use App\Models\User;
use App\Models\Audits;
use App\Models\Manager;
use App\Mail\NotificationEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class ManagerController extends Controller
{

    //Show waiting approval in card
    public function showWaitingApprovalCard(){
        // Retrieve all MachineOperation records where is_approved is false and is_changed is true
        $waitingApproval = MachineOperation::where('is_approved', false)
                                           ->where('is_changed', true)
                                           ->get();
    
        // Group by week and select the first entry of each group
        $waitingApprovalPerWeek = $waitingApproval->groupBy('week')->map(function ($weekGroup) {
            return $weekGroup->first();
        });
    
        // Transform the collection to hide certain fields
        $waitingApprovalFiltered = $waitingApprovalPerWeek->map(function($machine) {
            return collect($machine)->except([
                'id',
                'machine_id',
                'day',
                'code',
                'description',
                'time',
                'status',
                'is_changed', 
                'changed_by', 
                'change_date', 
                'is_approved', 
                'approved_by', 
                'created_at', 
                'is_rejected',
                'rejected_by',
                'updated_at',
                'notes',
                'current_line',
            ]);
        })->values(); // Convert back to a collection with sequential integer keys
        
        // Return the transformed collection as a JSON response
        return response()->json(['WaitingApproval' => $waitingApprovalFiltered], 200);
    }

    //Show waiting approval in detail (clicked card)
    public function showWaitingApproval(Request $request){
        // Validate the year, month, week parameter
        // $request->validate([
        //     'year' => 'required|string',
        //     'month' => 'required|string',
        //     'week' => 'required|string'
        // ]);
    
        // Retrieve the week from the request
        $year = $request->input('year');
        $month = $request->input('month');
        $week = $request->input('week');
    
        // Retrieve all MachineOperation records where is_approved is false, is_changed is true, and week matches the parameter
        $waitingApproval = MachineOperation::where('is_approved', false)
                                            ->where('is_changed', true)
                                            ->where('year', $year)
                                            ->where('month', $month)
                                            ->where('week', $week)
                                            ->get();
    
        // Transform the collection to hide certain fields
        $waitingApprovalFiltered = $waitingApproval->map(function($machine) {
            return collect($machine)->except([
                'id',
                'machine_id',
                'is_changed', 
                'changed_by', 
                'change_date', 
                'is_approved', 
                'approved_by', 
                'created_at', 
                'updated_at',
                'is_rejected',
                'rejected_by',
            ]);
        });
        
        // Return the transformed collection as a JSON response
        return response()->json(['WaitingApproval' => $waitingApprovalFiltered], 200);
    }
    
    public function approve(Request $request) {
        // Retrieve the inputs from the request
        $year = $request->input('year');
        $month = $request->input('month');
        $week = $request->input('week');
        $approvedBy = 'test'; // Replace with the authenticated user's name

        // Get user ID
        $userId = auth()->id();

        // Search for all MachineOperation records that match the given year, month, and week
        $machineOperations = MachineOperation::where('year', $year)
            ->where('month', $month)
            ->where('week', $week)
            ->get();

        if ($machineOperations->isEmpty()) {
            // Handle the case where no MachineOperation records are found (optional)
            return response()->json(['message' => 'No MachineOperations found'], 404);
        }

        if ($machineOperations->contains('is_changed', true)) {
            foreach ($machineOperations as $machineOperation) {


                // Update the machine operation
                $machineOperation->update([
                    'is_changed' => false,
                    'changed_by' => '',
                    'is_approved' => true,
                    'approved_by' => $approvedBy,
                ]);

                // Log the audit entry for each updated machine operation
                Audits::create([
                    'users_id' => $userId,
                    'machineoperation_id' => $machineOperation->id,
                    'event' => 'approve',
                    'changes' => 'Approve changes'
                ]);
            }

            // Retrieve the Manager record by year, month, and week
            $manager = Manager::where('year', $year)
                ->where('month', $month)
                ->where('week', $week)
                ->first();

            if ($manager) {
                // Update the Manager record with the new data
                $manager->update([
                    'revision_number' => $manager->revision_number + 1,
                ]);
            } else {
                // If no manager exists for the given year, month, and week, create a new record
                Manager::create([
                    'year' => $year,
                    'month' => $month,
                    'week' => $week,
                    'revision_number' => 1, // Starting revision number if creating new
                ]);
            }
        } else {
            // Handle the case where no MachineOperation records are changed (optional)
            return response()->json(['message' => 'No changes to approve'], 404);
        }

        // Return a successful response (optional)
        return response()->json(['message' => 'Approval successful'], 200);
    }


    public function return(Request $request) {
                // Validate the incoming request
        // $request->validate([
        //     'year' => 'required|integer',
        //     'month' => 'required|integer',
        //     'week' => 'required|integer',
        // ]);
    
        // Retrieve the inputs from the request
        $year = $request->input('year');
        $month = $request->input('month');
        $week = $request->input('week');
        $rejectedBy = 'test'; // Replace with the authenticated user's name
    
        // Search for all MachineOperation records that match the given year, month, and week
        $machineOperations = MachineOperation::where('year', $year)
            ->where('month', $month)
            ->where('week', $week)
            ->get();
    
        if ($machineOperations->isEmpty()) {
            // Handle the case where no MachineOperation records are found (optional)
            return response()->json(['message' => 'No MachineOperations found'], 404);
        }
        if ($machineOperations->contains('is_changed', true)) {
            // Update each MachineOperation record
            foreach ($machineOperations as $machineOperation) {

                // Update the machine operation
                $machineOperation->update([
                    'is_changed' => false,
                    'changed_by' => '',
                    'is_approved' => false,
                    'is_rejected' => true,
                    'rejected_by' => $rejectedBy,
                ]);

                // Log the audit entry for each updated machine operation
                Audits::create([
                    'users_id' => $userId,
                    'machineoperation_id' => $machineOperation->id,
                    'event' => 'returned',
                    'changes' => 'Return changes'
                ]);
                
            }
        
        }
        else {
            // Handle the case where no MachineOperation records are changed (optional)
            return response()->json(['message' => 'No changes to return'], 404);
        }
        
    
        // Return a successful response (optional)
        return response()->json(['message' => 'Return successful'], 200);
    }
    
    public function notify(Request $request) {
        $validatedData = $request->validate([
            'line' => 'required|string'
        ]);

        // Retrieve users with matching email roles
        $users = User::whereJsonContains('email_role', $validatedData['line'])->get();

        // Check if there are users with the specified email role
        if ($users->isEmpty()) {
            return response()->json(['error' => 'No users found with the specified email role.'], 404);
        }

        // Gather email addresses of all users
        $recipients = $users->pluck('email')->toArray();

        try {
            // Send a single email to all recipients
            Mail::to($recipients)->send(new NotificationEmail());
        } catch (\Exception $e) {
            \Log::error('Error sending email: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send email: ' . $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Notifications sent successfully to all recipients.']);
    }

    public function notifyRejection(Request $request) {
        $validatedData = $request->validate([
            'line' => 'required|string'
        ]);

        // Retrieve users with matching email roles
        $users = User::whereJsonContains('email_role', $validatedData['line'])->get();

        // Check if there are users with the specified email role
        if ($users->isEmpty()) {
            return response()->json(['error' => 'No users found with the specified email role.'], 404);
        }

        // Gather email addresses of all users
        $recipients = $users->pluck('email')->toArray();

        try {
            // Send a single email to all recipients
            Mail::to($recipients)->send(new NotificationEmail());
        } catch (\Exception $e) {
            \Log::error('Error sending email: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send email: ' . $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Notifications sent successfully to all recipients.']);
    }

    
}
