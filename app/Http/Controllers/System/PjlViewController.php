<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\Audits;
use App\Models\MachineOperation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PjlViewController extends Controller
{
    public function index(Request $request)
    {
        $line = $request->query('line');  // Access 'line' parameter
        $year = $request->query('year');  // Access 'year' parameter
        $month = $request->query('month'); // Access 'month' parameter
        $week = $request->query('week');
        // dd($line);

        $line = 'Line1'; // Replace 'desired_role' with the actual role value
        $data = Audits::with('user')
            ->whereNotNull('users_id') // Ensure users_id is not null
            ->latest()
            // ->limit(5)
            ->get();

        $list = [];
        $adding = '';

        foreach ($data as $item) {
            # code...
            if ($item->user != null) {
                # code...
                if ($item->user->role == $line) {
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
                                'notes' => $mesin->notes
                            ];
                        }
                    }
                }
            }

            $list[] = [
                'id' => $item->id,
                'fullname' => $item->user == null ? 'NA' : $item->user->name,
                'event' => $item->event,
                'mesin' => $adding,
                'timestamp' => Carbon::parse($item->created_at)->format('d M Y H:i:s'),
                'return' => $item->changes,
                'line' => $item->user == null ? 'NA' : $item->user->role,
                'changes' => json_decode($item->changes, true),
            ];
        }

        // dd($list);

        return view('pjl.view', compact('line', 'year', 'month', 'list'));
    }
}
