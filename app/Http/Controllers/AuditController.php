<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audits;


class AuditController extends Controller
{
    public function showAudit() {
        // Retrieve all audit entries
        $audits = Audits::all();
    
        // Process each audit entry
        $auditDetails = $audits->map(function ($audit) {
            $changes = json_decode($audit->changes, true);
    
            if (json_last_error() === JSON_ERROR_NONE) {
                return [
                    'audit_id' => $audit->id,
                    'machineoperation_id' => $audit->machineoperation_id,
                    'event' => $audit->event,
                    'changes' => [
                        'original_state' => $changes['original_state'],
                        'new_state' => $changes['new_state'],
                    ],
                ];
            }
    
            return [
                'audit_id' => $audit->id,
                'machineoperation_id' => $audit->machineoperation_id,
                'event' => $audit->event,
                'error' => 'Failed to decode changes field',
            ];
        });
    
        return response()->json($auditDetails);
    }
    
}
