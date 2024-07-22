<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\Audits;
use App\Models\MachineOperation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ViewGuestController extends Controller
{
    public function index(Request $request)
    {
        $line = $request->query('line');  // Access 'line' parameter
        $year = $request->query('year');  // Access 'year' parameter
        $month = $request->query('month'); // Access 'month' parameter
        $week = $request->query('week');
        // dd($line);

        $data = Audits::with('user', 'machineOperation')
            ->latest()
            ->get();

        // dd($data);

        $list = [];
        $adding = '';

        foreach ($data as $item) {
            # code...
            if ($item->machineOperation) {
                # code...
                if ($item->user != null && $item->user->role == $line) {
                    # code...
                    if ($item->machineOperation->current_line == $line) {
                        # code...
                        if ($item->machineoperation_id == null) {
                            # code...
                            $adding = 'NA';
                        } else {
                            # code...
                            $mesin = MachineOperation::whereId($item->machineoperation_id)->where([
                                'year' => $year,
                                'month' => $month,
                                'week' => $week
                            ])->first();
    
                            if (empty($mesin)) {
                                # code...
                                $adding = 'NA';
                            } else {
                                # code...
                                $adding = [
                                    'time' => $mesin->time,
                                    'status' => $mesin->status,
                                    'notes' => $mesin->notes,
                                    'week' => $mesin->week
                                ];
                            }
                        }
                    }else {
                        $adding = 'NA';
                    }

                    $list[] = [
                        'id' => $item->id,
                        'fullname' => $item->user == null ? 'NA' : $item->user->name,
                        'event' => $item->event,
                        'mesin' => $adding,
                        'timestamp' => Carbon::parse($item->created_at)->format('d M Y H:i:s'),
                        'return' => $item->changes,
                        'line' => $item->machineOperation == null ? 'NA' : $item->machineOperation->current_line,
                        'changes' => json_decode($item->changes, true),
                        'week' => $adding == 'NA' ? 'NA' : $adding['week']
                    ];
                }
    
            }
        }

        // dd($list);

        return view('guest.viewGuest', compact('line', 'year', 'month', 'list'));
    }
}
