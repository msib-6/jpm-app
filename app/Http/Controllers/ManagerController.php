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
use App\Mail\RejectionEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class ManagerController extends Controller
{

    //Show waiting approval in card
    public function showWaitingApprovalCard(){
        $waitingApproval = MachineOperation::where('is_approved', false)
                                           ->where('is_changed', true)
                                           ->where('is_sent', true)
                                           ->get();

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
                'time',
                'status',
                'notes',
                'is_changed',
                'changed_by',
                'change_date',
                'is_approved',
                'approved_by',
                'created_at',
                'is_rejected',
                'rejected_by',
                'updated_at',
            ]);
        })->values();

        // Return the transformed collection as a JSON response
        return response()->json(['WaitingApproval' => $waitingApprovalFiltered], 200);
    }

    //Show waiting approval in detail (clicked card)
    public function showWaitingApproval(Request $request){
        $request->validate([
            'year' => 'required|string',
            'month' => 'required|string',
            'week' => 'required|string'
        ]);

        $year = $request->input('year');
        $month = $request->input('month');
        $week = $request->input('week');

        $waitingApproval = MachineOperation::where('is_approved', false)
                                            ->where('is_changed', true)
                                            ->where('is_sent',true)
                                            ->where('year', $year)
                                            ->where('month', $month)
                                            ->where('week', $week)
                                            ->get();

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

        return response()->json(['WaitingApproval' => $waitingApprovalFiltered], 200);
    }

    public function approve(Request $request) {
        $userId = auth()->id();
        $line = $request->input('line');
        $year = $request->input('year');
        $month = $request->input('month');
        $week = $request->input('week');
        $approvedBy = $userId;


        $machineOperations = MachineOperation::where('line', $line)
            ->where('year', $year)
            ->where('month', $month)
            ->where('week', $week)
            ->get();

        if ($machineOperations->isEmpty()) {
            return response()->json(['message' => 'No MachineOperations found'], 404);
        }

        if (is_null($approvedBy)) {
            $approvedBy = '';
        }

        if ($machineOperations->contains('is_changed', false)) {
            return response()->json(['message' => 'No changes to approve'], 404);
        }

        foreach ($machineOperations as $machineOperation) {

            $machineOperation->update([
                'is_changed' => false,
                'changed_by' => '',
                'is_approved' => true,
                'approved_by' => $approvedBy,
                'is_sent' => false,
            ]);

        }

        $manager = Manager::where('line', $line)
            ->where('year', $year)
            ->where('month', $month)
            ->where('week', $week)
            ->first();

        if ($manager) {
            $manager->update([
                'revision_number' => $manager->revision_number + 1,
            ]);
        } else {
            Manager::create([
                'line' => $line,
                'year' => $year,
                'month' => $month,
                'week' => $week,
                'revision_number' => 1, // Starting revision number if creating new
            ]);
        }

        Audits::create([
            'users_id' => $userId,
            'machineoperation_id' => $machineOperation->id,
            'event' => 'approve',
            'changes' => 'Approve changes',
        ]);
        
        return response()->json(['message' => 'Approval successful'], 200);
    }

    public function return(Request $request) {
        $userId = auth()->id();
        $request->validate([
            'year' => 'required|integer',
            'month' => 'required|integer',
            'week' => 'required|integer',
        ]);

        $year = $request->input('year');
        $month = $request->input('month');
        $week = $request->input('week');
        $rejectedBy = $userId;

        $machineOperations = MachineOperation::where('year', $year)
            ->where('month', $month)
            ->where('week', $week)
            ->get();

        if ($machineOperations->isEmpty()) {
            return response()->json(['message' => 'No MachineOperations found'], 404);
        }

        if ($machineOperations->contains('is_changed', true)) {
            foreach ($machineOperations as $machineOperation) {

                $machineOperation->update([
                    'is_changed' => false,
                    'changed_by' => '',
                    'is_approved' => false,
                    'is_rejected' => true,
                    'rejected_by' => $rejectedBy,
                ]);
            }
        Audits::create([
            'users_id' => $userId,
            'machineoperation_id' => $machineOperation->id,
            'event' => 'returned',
            'changes' => 'Return changes'
        ]);

        }
        else {
            return response()->json(['message' => 'No changes to return'], 404);
        }
        return response()->json(['message' => 'Return successful'], 200);
    }

    public function notify(Request $request) {
        $validatedData = $request->validate([
            'line' => 'required|string'
        ]);

        $users = User::whereJsonContains('email_role', $validatedData['line'])->get();

        if ($users->isEmpty()) {
            return response()->json(['error' => 'No users found with the specified email role.'], 404);
        }

        $recipients = $users->pluck('email')->toArray();

        try {
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

        $users = User::whereJsonContains('email_role', $validatedData['line'])->get();

        if ($users->isEmpty()) {
            return response()->json(['error' => 'No users found with the specified email role.'], 404);
        }

        $recipients = $users->pluck('email')->toArray();

        try {
            Mail::to($recipients)->send(new RejectionEmail());
        } catch (\Exception $e) {
            \Log::error('Error sending email: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send email: ' . $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Notifications sent successfully to all recipients.']);
    }


}
