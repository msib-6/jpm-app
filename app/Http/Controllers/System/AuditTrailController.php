<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\Audits;
use App\Models\MachineOperation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuditTrailController extends Controller
{
    function index()
    {
        // Number of items per page
        $perPage = 20;

        // Retrieve paginated data
        $data = Audits::query()
            ->with('user')
            ->latest()
            ->paginate($perPage);

        $list = [];

        foreach ($data as $item) {
            if ($item->machineoperation_id == null) {
                $adding = 'NA';
            } else {
                $mesin = MachineOperation::find($item->machineoperation_id);
                if (empty($mesin)) {
                    $adding = 'NA';
                } else {
                    $adding = [
                        'week' => $mesin->week,
                        'ruah' => $mesin->code,
                        'status' => $mesin->status,
                        'noted' => $mesin->notes
                    ];
                }
            }

            $list[] = [
                'id' => $item->id,
                'fullname' => $item->user == null ? 'NA' : $item->user->name,
                'event' => $item->event,
                'mesin' => $adding,
                'week' => $adding,
                'timestamp' => Carbon::parse($item->created_at)->format('d M Y H:i:s'),
                'return' => $item->changes,
                'line' => $item->user == null ? 'NA' : $item->user->role,
                'changes' => json_decode($item->changes, true),
            ];
        }


        // dd($list);
        return view('history.auditlog', [
            'list' => $list,
            'data' => $data // Pass the paginated data to the view
        ]);
    }
}
