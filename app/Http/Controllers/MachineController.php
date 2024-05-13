<?php

namespace App\Http\Controllers;
use App\Models\Machine;
use App\Models\GlobalDescription;
use App\Models\MachineData;
use App\Models\MachineOperation;
use App\Models\User;
use App\Models\Audits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MachineController extends Controller
{

    // -------------------------------- ADD MACHINE FUNCTIONS --------------------------------
    //Add Machine. input to machine database
    public function addMachine(Request $request) {
        $userId = auth()->id();

        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'machine_name' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'line' => 'required|string|max:255',
            ]);

            // Check if the machine already exists
            $existingMachineData = Machine::where('machine_name', $request->input('machineName'))->first();

            if ($existingMachineData) {
                return response()->json(['message' => 'Machine already exists'], 409);
            }

            // Create a new machine instance
            $machine = new Machine();
            $machine->machine_name = $validatedData['machine_name'];
            $machine->category = $validatedData['category'];
            $machine->line = $validatedData['line'];
            $machine->save();

            // Create audit entry
            Audits::create([
                'users_id' => $userId,
                'machineoperation_id' => null,
                'event' => 'add',
                'changes' => json_encode($request->all()),
            ]);

            // Return a success response
            return response()->json(['message' => 'Machine added successfully'], 200);
        } catch (\Exception $e) {
            \Log::error('Error adding machine: ' . $e->getMessage());
            return response()->json(['message' => 'Error adding machine. Please try again later.'], 500);
        }
    }

    // Add weekly Machine, input to machineData database
    public function addWeeklyMachine(Request $request) {
        $userId = auth()->id();

        try {
            // Check if the machine exists in the main database
            $machineOrigin = Machine::where('machine_name', $request->input('machineName'))->first();

            if (!$machineOrigin) {
                return response()->json(['message' => 'Machine does not exist!'], 404);
            }

            // Get today's week
            $today = now();

            //Check if user input week value, otherwise use current week.
            if($request->input('week')){
                $weekNumber = $request->input('week');
            }
            else{
                $weekNumber = ceil(($today->day + $today->dayOfWeek) / 7);
            }

            // Check if the machine data already exists for the current week
            $existingMachineData = MachineData::where('machine_name', $request->input('machineName'))
                ->where('week', $weekNumber)
                ->first();

            if ($existingMachineData) {
                return response()->json(['message' => 'Machine already added for the current week'], 400);
            }

            // Create new machine data entry
            $newMachineData = new MachineData();
            $newMachineData->machine_id = $machineOrigin->id; // Assign the id of the machine from main database
            $newMachineData->machine_name = $request->input('machineName');
            $newMachineData->week = $weekNumber; // Add week number to the new machine data entry
            $newMachineData->save();

            // Create audit entry
            Audits::create([
                'users_id' => $userId,
                'machineoperation_id' => null,
                'event' => 'add',
                'changes' => json_encode($request->all()),
            ]);

            return response()->json(['message' => 'Machine added successfully'], 201);
        } catch (\Exception $e) {
            \Log::error('Error adding weekly machine: ' . $e->getMessage());
            return response()->json(['message' => 'Error adding weekly machine. Please try again later.'], 500);
        }
    }

    //Add Machine Operation, input to machineOperation database
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

            // Fetch the user's name using their ID
            $user = User::find($userId);
            $username = $user ? $user->name : 'Unknown'; // If user not found, use 'Unknown'

            // Create a new machine operation inheriting machine data values
            $machineOperation = new MachineOperation([
                'machine_id' => $machineID, // Set the machine_id attribute
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
            Audits::create([
                'users_id' => $userId,
                'machineoperation_id' => $machineOperation->id,
                'event' => 'add',
                'changes' => json_encode($request->all()), // Serialize input data to JSON
            ]);

            return response()->json($machineOperation, 201);
        } catch (\Exception $error) {
            \Log::error('Error adding machine operation: ' . $error->getMessage());
            return response()->json(['message' => $error->getMessage()], 400);
        }
    }

    //Add Global Description below tables, input to globalDescription database
    public function addGlobalDescription(Request $request) {
        $userId = auth()->id();

        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'description' => 'required|string|max:255',
            ]);

            // Check if the global description already exists
            $existingGlobalDescription = GlobalDescription::where('description', $request->input('description'))->first();

            if ($existingGlobalDescription) {
                return response()->json(['message' => 'Global description already exists'], 409);
            }

            // Create a new global description instance
            $globalDescription = new GlobalDescription();
            $globalDescription->description = $validatedData['description'];
            $globalDescription->year = Carbon::now()->year; // Save current year
            $globalDescription->month = Carbon::now()->month; // Save current month
            $globalDescription->week = Carbon::now()->weekOfMonth; // Save current week of month
            $globalDescription->save();

            // Create audit entry
            Audits::create([
                'users_id' => $userId,
                'machineoperation_id' => null,
                'event' => 'add',
                'changes' => json_encode($request->all()),
            ]);

            // Return a success response
            return response()->json(['message' => 'Global description added successfully'], 200);
        } catch (\Exception $e) {
            \Log::error('Error adding global description: ' . $e->getMessage());
            return response()->json(['message' => 'Error adding global description. Please try again later.'], 500);
        }
    }
    // ----------------------------------------------------------------------------------------



    // -------------------------------- EDIT MACHINE FUNCTIONS --------------------------------
    //Edit Machine, edit machine data
    public function editMachineOperation(Request $request, $machineOperationID) {
        // Get user ID
        $userId = auth()->id();

        // Validation
        $validatedData = $request->validate([
            'day' => 'required',
            'code' => 'required',
            'time' => 'required',
        ]);

        try {
            // Find the machine operation by its ID
            $machineOperation = MachineOperation::find($machineOperationID);

            if (!$machineOperation) {
                return response()->json(['message' => 'Machine operation not found!'], 404);
            }

            // Fetch the user's name using their ID
            $user = User::find($userId);
            $username = $user ? $user->name : 'Unknown'; // If user not found, use 'Unknown'

            // Capture the original state for comparison
            $originalState = [
                'day' => $machineOperation->day,
                'code' => $machineOperation->code,
                'time' => $machineOperation->time,
                'description' => $machineOperation->description,
                'isChanged' => $machineOperation->isChanged,
                'isApproved' => $machineOperation->isApproved,
                'changedBy' => $machineOperation->changedBy,
            ];

            // Capture the old values before updating the machine operation
            $oldValues = [
                'day' => $machineOperation->day,
                'code' => $machineOperation->code,
                'time' => $machineOperation->time,
                'description' => $machineOperation->description,
            ];

            // Update the machine operation with the provided data
            $machineOperation->update([
                'day' => $validatedData['day'],
                'code' => $validatedData['code'],
                'time' => $validatedData['time'],
                'description' => $request->input('description'),
                'isChanged' => true,
                'isApproved' => false,
                'changedBy' => $username,
            ]);

            // Capture the new values after updating the machine operation
            $newValues = [
                'day' => $machineOperation->day,
                'code' => $machineOperation->code,
                'time' => $machineOperation->time,
                'description' => $machineOperation->description,
            ];

            // Log the audit entry for machine operation edit along with the original and updated states
            Audits::create([
                'users_id' => $userId,
                'machineoperation_id' => $machineOperationID,
                'event' => 'edit',
                'changes' => json_encode([
                    'original_state' => $originalState,
                    'new_values' => $newValues,
                    'old_values' => $oldValues,
                ]),
            ]);

            return response()->json($machineOperation, 200);
        } catch (\Exception $error) {
            \Log::error('Error editing machine operation: ' . $error->getMessage());
            return response()->json(['message' => $error->getMessage()], 400);
        }
    }
    // ----------------------------------------------------------------------------------------



    // ------------------------------- DELETE MACHINE FUNCTIONS -------------------------------
    //Delete Weekly Machine, delete machine data from database and all related Machine operation
    public function deleteWeeklyMachine(Request $request, $machineID) {
        // Get user ID
        $userId = auth()->id();

        try {
            // Find the machine data by its ID
            $machineData = MachineData::find($machineID);

            if (!$machineData) {
                return response()->json(['message' => 'Machine data not found!'], 404);
            }

            // Capture the original state for comparison
            $originalState = [
                'machine_id' => $machineData->machine_id,
                'machine_name' => $machineData->machine_name,
                'week' => $machineData->week,
            ];

            // Delete the machine data
            $machineData->delete();

            // Log the audit entry for machine data deletion
            Audits::create([
                'users_id' => $userId,
                'machineoperation_id' => null,
                'event' => 'delete',
                'changes' => json_encode([
                    'original_state' => $originalState,
                ]),
            ]);

            return response()->json(['message' => 'Machine data deleted successfully'], 200);
        } catch (\Exception $error) {
            \Log::error('Error deleting machine data: ' . $error->getMessage());
            return response()->json(['message' => $error->getMessage()], 400);
        }
    }

    //Delete Machine operation, delete machine operation from the database
    public function deleteMachineOperation(Request $request, $machineOperationID) {
        // Get user ID
        $userId = auth()->id();

        try {
            // Find the machine operation by its ID
            $machineOperation = MachineOperation::find($machineOperationID);

            if (!$machineOperation) {
                return response()->json(['message' => 'Machine operation not found!'], 404);
            }

            // Capture the original state for comparison
            $originalState = [
                'day' => $machineOperation->day,
                'code' => $machineOperation->code,
                'time' => $machineOperation->time,
                'description' => $machineOperation->description,
                'isChanged' => $machineOperation->isChanged,
                'isApproved' => $machineOperation->isApproved,
                'changedBy' => $machineOperation->changedBy,
            ];

            // Delete the machine operation
            $machineOperation->delete();

            // Log the audit entry for machine operation deletion
            Audits::create([
                'users_id' => $userId,
                'machineoperation_id' => $machineOperationID,
                'event' => 'delete',
                'changes' => json_encode([
                    'original_state' => $originalState,
                ]),
            ]);

            return response()->json(['message' => 'Machine operation deleted successfully'], 200);
        } catch (\Exception $error) {
            \Log::error('Error deleting machine operation: ' . $error->getMessage());
            return response()->json(['message' => $error->getMessage()], 400);
        }
    }

    //Delete Global description, delete global description from the database
    public function deleteGlobalDescription(Request $request, $globalDescriptionID) {
        $userId = auth()->id();

        try {
            $globalDescription = GlobalDescription::find($globalDescriptionID);

            // Capture the original state for comparison
            $originalState = [
                'description' => $globalDescription->description,
                'year' => $globalDescription->year,
                'month' => $globalDescription->month,
                'week' => $globalDescription->week,
            ];

            // Delete the global description
            $globalDescription->delete();

            // Log the audit entry for global description deletion
            Audits::create([
                'users_id' => $userId,
                'machineoperation_id' => null,
                'event' => 'delete',
                'changes' => json_encode([
                    'original_state' => $originalState,
                ]),
            ]);

            return response()->json(['message' => 'Global description deleted successfully'], 200);
        } catch (\Exception $e) {
            \Log::error('Error deleting global description: ' . $e->getMessage());
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
    // ----------------------------------------------------------------------------------------



    // -------------------------------- SHOW MACHINE FUNCTIONS --------------------------------
    //Function to show all machines and its information
    public function showAllMachines(){
        $machines = Machine::all();
        return response()->json($machines);
        //return view('machines', ['machines' => $machines]);
    }

    //Function to show all weekly machine that contains all of its date and name
    public function showAllWeeklyMachine(){
        $machineData = MachineData::all();
        return response()->json($machineData);
        //return view('machineData', ['machineData' => $machineData]);
    }

    //Function to show all machine operation
//    public function showAllMachineOperation() {
//        $machineOperations = MachineOperation::all();
//        return view('machineOperations', ['machineOperations' => $machineOperations]);
//    }

//  Coba function year and button
    public function showAllMachineOperation(Request $request)
    {
        $machines = Machine::select('id', 'machine_name', 'line')->get();
        $selectedLine = null;
        $selectedYear = null;
        $selectedMonth = null;
        $selectedLineYears = [];

        if ($request->has('line')) {
            $selectedLine = $request->line;

            // Ambil id machine berdasarkan line yang dipilih
            $machineId = Machine::where('id', $selectedLine)->value('id');

            // Cari tahun-tahun terkait dengan machine yang dipilih
            $selectedLineYears = MachineOperation::where('machine_id', $machineId)
                ->distinct()
                ->pluck('year')
                ->toArray();

            // Set default selected year ke tahun pertama yang tersedia
            $selectedYear = count($selectedLineYears) > 0 ? $selectedLineYears[0] : null;
        }

        if ($request->has('year')) {
            $selectedYear = $request->year;
        }

        if ($request->is('guest/dashboard')) {
            return view('guest.dashboardGuest', [
                'machines' => $machines,
                'selectedLine' => $selectedLine,
                'selectedYear' => $selectedYear,
                'selectedMonth' => $selectedMonth,
                'selectedLineYears' => $selectedLineYears,
            ]);
        }

        return response()->json([
            'machines' => $machines,
            'selectedLine' => $selectedLine,
            'selectedYear' => $selectedYear,
            'selectedMonth' => $selectedMonth,
        ]);
    }

    public function showCodeLine2()
    {
        $machines = Machine::select('machines.id', 'machines.machine_name', 'machines.line', 'machine_operations.year', 'machine_operations.month', 'machine_operations.week', 'machine_operations.day', 'machine_operations.code', 'machine_operations.time', 'machine_operations.description', 'machine_operations.is_changed', 'machine_operations.changed_by', 'machine_operations.change_date', 'machine_operations.is_approved', 'machine_operations.approved_by')
            ->join('machine_data', 'machines.id', '=', 'machine_data.machine_id')
            ->join('machine_operations', function ($join) {
                $join->on('machine_data.id', '=', 'machine_operations.machine_id')
                    ->on('machine_data.year', '=', 'machine_operations.year')
                    ->on('machine_data.month', '=', 'machine_operations.month')
                    ->on('machine_data.week', '=', 'machine_operations.week');
            })
            ->get();

        return response()->json([
            'machines' => $machines
        ]);
    }



    public function showAllGlobalDescription() {
        $globalDescription = GlobalDescription::all();
        return response()->json($globalDescription);
        //return view('globalDescriptions', ['globalDescriptions' => $globalDescriptions]);
    }

    public function showCodeLine() {
        // Retrieve all machine operations with the related machine's line
        $machineOperations = MachineOperation::with('machine')->get();

        // Extract code from machine operations and line from related machines
        $data = $machineOperations->map(function ($operation) {
            return [
                'code' => $operation->code,
                'line' => $operation->machine->line
            ];
        });

        return response()->json($data);
    }
    //----------------------------------------------------------------------------------------

}
