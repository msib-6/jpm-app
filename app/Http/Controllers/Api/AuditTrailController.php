<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Audits;
use App\Models\MachineOperation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuditTrailController extends Controller
{
    function index()
    {
        $data = Audits::query()
            ->with('user')
            ->latest()
            ->get();

        $list = [];

        foreach ($data as $item) {
            # code...
            if ($item->machineoperation_id == null) {
                # code...
                $adding = 'NA';
            } else {
                # code...
                $mesin = MachineOperation::find($item->machineoperation_id);
                if (empty($mesin)) {
                    # code...
                    $adding = 'NA';
                } else {
                    # code...
                    $adding = [
                        'time' => $mesin->time,
                        'status' => $mesin->status,
                        'notes' => $mesin->notes
                    ];
                }
            }

            $list[] = [
                'id' => $item->id,
                'fullname' => $item->user == null ? 'NA' : $item->user->name,
                'event' => $item->event,
                'mesin' => $adding,
                'timestamp' => Carbon::parse($item->created_at)->format('d M Y H:i:s'),
            ];
        }

        dd($list);

        return response()->json([
            'success' => true,
            'message' => 'Succesfully Gets All Audit',
            'data' => $data
        ]);
    }
}
