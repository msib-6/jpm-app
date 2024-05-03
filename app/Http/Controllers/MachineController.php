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

    public function showAllMachineOperation()
{
    $machineOperations = MachineOperation::all();
    return view('machineOperations', ['machineOperations' => $machineOperations]);
}

}
