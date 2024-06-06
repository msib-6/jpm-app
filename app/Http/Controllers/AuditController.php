<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audits;


class AuditController extends Controller
{
    public function showAudit() {
        $audits = Audits::all();
    
        $auditDetails = $audits->map(function ($audit) {
            $changes = json_decode($audit->changes, true);

            $machineoperationId = $audit->machineoperation_id ?? 'Unknown'; // Set default value if null
    
            if (json_last_error() === JSON_ERROR_NONE && is_array($changes)) {
                return [
                    'audit_id' => $audit->id,
                    'machineoperation_id' => $machineoperationId,
                    'event' => $audit->event,
                    'changes' => [
                        'original_state' => $changes['original_state'] ?? '',
                        'new_state' => $changes['new_state'] ?? '',
                    ],
                ];
            }
    
            return [
                'audit_id' => $audit->id,
                'machineoperation_id' => $machineoperationId,
                'event' => $audit->event,
                'error' => 'Failed to decode changes field',
            ];
        });
    
        return response()->json($auditDetails);
    }
}

