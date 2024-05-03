<?php

namespace App\Http\Controllers;
use App\Models\Machine;
use App\Models\GlobalDescription;
use App\Models\MachineData;
use App\Models\MachineOperation;

use Illuminate\Http\Request;

class MachineController extends Controller
{
    public function showAllMachines()
    {
        $machines = Machine::all();
        return view('machines', ['machines' => $machines]);
    }

    public function showAllMachineData()
    {
        $machineData = MachineData::all();
        return view('machineData', ['machineData' => $machineData]);

    }

//    public function showAllMachineOperation()
//    {
//        $machineOperations = MachineOperation::all();
//        return view('machineOperations', ['machineOperations' => $machineOperations]);
//    }

//  Coba function year and button
    public function showAllMachineOperation(Request $request)
    {
        $lines = MachineData::distinct()->select('machine_id', 'machine_name')->get();
        $selectedLine = null;
        $selectedYear = null;
        $selectedMonth = null;

        if ($request->has('line')) {
            $selectedLine = MachineData::find($request->line);
        }

        if ($selectedLine && $request->has('year')) {
            $selectedYear = MachineData::where('machine_id', $selectedLine->machine_id)
                ->where('year', $request->year)
                ->distinct()
                ->select('year')
                ->get();
        }

        if ($selectedYear && $request->has('month')) {
            $selectedMonth = MachineData::where('machine_id', $selectedLine->machine_id)
                ->where('year', $selectedYear->year)
                ->where('month', $request->month)
                ->distinct()
                ->select('month')
                ->get();
        }

        return view('guest.dashboardGuest', [
            'lines' => $lines,
            'selectedLine' => $selectedLine,
            'selectedYear' => $selectedYear,
            'selectedMonth' => $selectedMonth,
        ]);
    }



}
