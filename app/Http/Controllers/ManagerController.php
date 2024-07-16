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
use Illuminate\Support\Facades\Log;

class ManagerController extends Controller
{

    //Show waiting approval in card
    public function showWaitingApprovalCard(){
        $waitingApproval = MachineOperation::where('is_approved', false)
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

    //Show return in card
    public function showReturnCard(){
        $returnApproval = MachineOperation::where('is_rejected', true)
            ->get();

        $returnApproval = $returnApproval->groupBy('week')->map(function ($weekGroup) {
            return $weekGroup->first();
        });

        // Transform the collection to hide certain fields
        $returnApprovalFiltered = $returnApproval->map(function($machine) {
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
        return response()->json(['RejectedApproval' => $returnApprovalFiltered], 200);
    }

    //    SHOW MANAGER REVISION
    public function showRevision() {
        $revision = Manager::all();
        return response()->json($revision);
        //return view('globalDescriptions', ['globalDescriptions' => $globalDescriptions]);
    }


    //Show waiting Approved in card
    public function showApprovedCard(){
        $ApprovedJPM = MachineOperation::where('is_approved', true)
                                            ->where('is_sent', false)
                                            ->get();

        $ApprovedPerWeek = $ApprovedJPM->groupBy('week')->map(function ($weekGroup) {
            return $weekGroup->first();
        });

        // Transform the collection to hide certain fields
        $ApprovedFiltered = $ApprovedPerWeek->map(function($machine) {
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
        return response()->json(['ApprovedCard' => $ApprovedFiltered], 200);
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
        $userId = $request->input('userId');
        $line = $request->input('line');
        $year = $request->input('year');
        $month = $request->input('month');
        $week = $request->input('week');
        $approvedBy = $userId;


        $machineOperations = MachineOperation::where('current_line', $line)
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

//        if ($machineOperations->contains('is_changed', false)) {
//            return response()->json(['message' => 'No changes to approve'], 404);
//        }

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
            'changes' => json_encode([
                    'status' => 'Approve changes',
                    'week' => $week,
                    'year' => $year,
                    'month' => $month,
                    'line' => $line,
                    'approved_by' => $approvedBy,
                ]),
        ]);

        return response()->json(['message' => 'Approval successful'], 200);
    }




    public function return(Request $request) {
        $userId = $request->input('userId');
        $line = $request->input('line');
        $year = $request->input('year');
        $month = $request->input('month');
        $week = $request->input('week');
        $rejectedBy = $userId;
        $returnNotes = $request->input('return_notes');

        $machineOperations = MachineOperation::where('current_line', $line)
            ->where('year', $year)
            ->where('month', $month)
            ->where('week', $week)
            ->get();

        if ($machineOperations->isEmpty()) {
            return response()->json(['message' => 'No MachineOperations found'], 404);
        }

        if (is_null($rejectedBy)) {
            $rejectedBy = '';
        }

        foreach ($machineOperations as $machineOperation) {
            $machineOperation->is_changed = false;
            $machineOperation->is_sent = false;
            $machineOperation->changed_by = '';
            $machineOperation->is_approved = false;
            $machineOperation->is_rejected = true;
            $machineOperation->rejected_by = $rejectedBy;
            $machineOperation->save();  // Use save() instead of update() to ensure proper field updates
        }

        foreach ($machineOperations as $machineOperation) {
            Audits::create([
                'users_id' => $userId,
                'machineoperation_id' => $machineOperation->id,
                'event' => 'return',
                'changes' => json_encode([
                    'status' => 'Return changes',
                    'week' => $week,
                    'year' => $year,
                    'month' => $month,
                    'line' => $line,
                    'rejected_by' => $rejectedBy,
                    'return_notes' => $returnNotes,
                ]),
            ]);
        }
        $manager = Manager::where('line', $line)
            ->where('year', $year)
            ->where('month', $month)
            ->where('week', $week)
            ->first();

        if ($manager) {
            $manager->update([
                // 'revision_number' => $manager->revision_number + 1, // ini revisi number jalan jika return kangsung tanpa approved dahulu
                'return_notes' => $returnNotes,
            ]);
        } else {
            Manager::create([
                'line' => $line,
                'year' => $year,
                'month' => $month,
                'week' => $week,
                // 'revision_number' => 1, // Starting revision number if creating new
                'return_notes' => $returnNotes,
            ]);
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
            Log::error('Error sending email: ' . $e->getMessage());
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
            Log::error('Error sending email: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send email: ' . $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Notifications sent successfully to all recipients.']);
    }


}
