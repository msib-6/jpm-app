<?php

namespace App\Http\Controllers;
use App\Models\Machine;
use App\Models\GlobalDescription;
use App\Models\MachineData;
use App\Models\MachineOperation;
use App\Models\User;
use App\Models\Audit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MachineController extends Controller
{
    //Function to add general machine
    public function addMachine(Request $request) {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'machine_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'line' => 'required|string|max:255',
        ]);

        // Create a new machine instance
        $machine = new Machine();
        $machine->machine_name = $validatedData['machine_name'];
        $machine->category = $validatedData['category'];
        $machine->line = $validatedData['line'];
        $machine->save();

        // Return a success response
        return response()->json(['message' => 'Machine added successfully'], 200);
    }

    //Add weekly Machine (ERROR)
    public function addWeeklyMachine(Request $request) {
        $userId = auth()->id();

        try {
            // Check if the machine exists in the main database
            $machineOrigin = Machine::where('machine_name', $request->input('machineName'))->first();

            if (!$machineOrigin) {
                return response()->json(['message' => 'Machine does not exist in the main database!'], 404);
            }

            // Get today's week
            $today = now();
            $weekNumber = ceil(($today->day + $today->dayOfWeek) / 7);

            // Compare current week with existing week. If the same machine and week were found, return error
            $existingMachineDataQuery = MachineData::where('machine_name', $request->input('machineName'))
                ->where('week', $weekNumber)
                ->toSql();

            logger()->info('Existing Machine Data Query: ' . $existingMachineDataQuery);

            $existingMachineData = MachineData::where('machine_name', $request->input('machineName'))
                ->where('week', $weekNumber)
                ->first();

            // Create new machine
            $newMachineData = new MachineData();
            $newMachineData->machine_id = $machineOrigin->id; // Assign the id of the machine from main database
            $newMachineData->machine_name = $request->input('machineName');
            $newMachineData->week = $weekNumber; // Add week number to the new machine data entry
            $newMachineData->save();

            Audit::create([
                'user_id' => $userId,
                'action' => 'add',
                'machine_operation_id' => null,
                'changes' => json_encode($request->all()),
            ]);

            return response()->json(['message' => 'Machine added successfully'], 201);
        } catch (\Exception $e) {
            \Log::error('Error adding weekly machine: ' . $e->getMessage());
            return response()->json(['message' => 'Error adding weekly machine. Please try again later.'], 500);
        }
    }

    //Add Machine Operation (Waiting for weeklymachine to be fixed)
    public function addMachineOperation(Request $request, $machineID) {
        // Get user ID
        $userId = auth()->id();

        // Validation
        $validatedData = $request->validate([
            'day' => 'required',
            'code' => 'required',
            'time' => 'required',
        ]);

        try {
            // Retrieve machine data
            $machineData = MachineData::find($machineID);
            if (!$machineData) {
                throw new \Exception("Machine not found");
            }

            // Check if machine operation already exists for the given day and time
            $machineOperationTime = MachineOperation::where('time', $validatedData['time'])->first();
            $machineOperationDay = MachineOperation::where('day', $validatedData['day'])->first();

            if ($machineOperationTime && $machineOperationDay) {
                throw new \Exception("Operation already exists");
            }

            // Fetch the user's name using their ID
            $user = User::find($userId);
            $username = $user ? $user->name : 'Unknown'; // If user not found, use 'Unknown'

            // Create a new machine operation inheriting machine data values
            $machineOperation = new MachineOperation([
                'machineID' => $machineID,
                'year' => $machineData->year,
                'month' => $machineData->month,
                'week' => $machineData->week,
                'day' => $validatedData['day'],
                'code' => $validatedData['code'],
                'time' => $validatedData['time'],
                'description' => $request->input('description'),
                'isChanged' => true,
                'changedBy' => $username,
            ]);

            $machineOperation->save();

            // Create audit log
            Audit::create([
                'user_id' => $userId,
                'action' => 'add',
                'machine_operation_id' => $machineOperation->id,
                'changes' => $request->all(), // Log all fields provided in the request body
            ]);

            return response()->json($machineOperation, 201);
        } catch (\Exception $error) {
            \Log::error('Error adding machine operation: ' . $error->getMessage());
            return response()->json(['message' => $error->getMessage()], 400);
        }
    }
    //Function to show all machines and its information
    public function showAllMachines(){
        // Show all machine
        $machines = Machine::all();
        return view('machines', ['machines' => $machines]);
    }

    //Function to show all machine data that contains all of its date and name
    public function showAllMachineData(){
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


    //Function to show all machine operation
    public function showAllMachineOperation() {
        $machineOperations = MachineOperation::all();
        return view('machineOperations', ['machineOperations' => $machineOperations]);
    }

}
