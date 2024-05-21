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
                'updated_at'
            ]);
        })->values(); // Convert back to a collection with sequential integer keys
        
        // Return the transformed collection as a JSON response
        return response()->json(['WaitingApproval' => $waitingApprovalFiltered], 200);
    }

    //Show waiting approval in detail (clicked card)
    public function showWaitingApproval(Request $request){
        // Validate the week parameter
        $request->validate([
            'week' => 'required|string'
        ]);
    
        // Retrieve the week from the request
        $week = $request->input('week');
    
        // Retrieve all MachineOperation records where is_approved is false, is_changed is true, and week matches the parameter
        $waitingApproval = MachineOperation::where('is_approved', false)
                                           ->where('is_changed', true)
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
                'updated_at'
            ]);
        });
        
        // Return the transformed collection as a JSON response
        return response()->json(['WaitingApproval' => $waitingApprovalFiltered], 200);
    }
    
    public function approve(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'id' => 'required|integer',
    ]);

    // Retrieve the id from the request
    $id = $request->input('id');
    $approvedBy = 'test'; // Replace with the authenticated user's name

    // Retrieve the MachineOperation record by id
    $machineOperation = MachineOperation::find($id);

    // Check if the MachineOperation record exists
    if (!$machineOperation) {
        return response()->json(['message' => 'Machine operation not found'], 404);
    }

    // Update the record with the approved_by field and set is_approved to true
    $machineOperation->update([
        'is_changed' => false,
        'changed_by' => '',
        'is_approved' => true,
        'approved_by' => $approvedBy,
    ]);

    // Ensure machine_id is not null
    $machineId = $machineOperation->machine_id;
    if (is_null($machineId)) {
        return response()->json(['message' => 'Machine operation has no machine_id'], 400);
    }

    // Retrieve the Manager record by machine_id
    $manager = Manager::where('machine_id', $machineId)->first();

    // Check if the Manager record exists
    if (!$manager) {
        // If no Manager record exists, create one with the machine_id from machineOperation
        $manager = Manager::create([
            'machine_id' => $machineId,
            'revision_number' => 0, // Assuming default revision number is 1
        ]);
    } else {
        // Increment the revision number
        $manager->increment('revision_number');
    }

    // Return a success message
    return response()->json(['message' => 'Operation approved successfully'], 200);
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
    
}
