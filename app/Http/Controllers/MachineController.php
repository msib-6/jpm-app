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

            Audits::create([
                'users_id' => $userId,
                'machineoperation_id' => null,
                'event' => 'add',
                'changes' => json_encode([
                    'original_state' => '',
                    'new_state' => $request->all(),
                ])
            ]);

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
            $machineOrigin = Machine::where('machine_name', $request->input('machineName'))->first();

            if (!$machineOrigin) {
                return response()->json(['message' => 'Machine does not exist!'], 404);
            }

            $today = now();

            if($request->input('month')){
                $monthNumber = $request->input('month');
            }
            else{
                $monthNumber = $today->month;
            }

            if($request->input('week')){
                $weekNumber = $request->input('week');
            }
            else{
                $weekNumber = ceil(($today->day + $today->dayOfWeek) / 7);
            }

            $existingMachineData = MachineData::where('machine_name', $request->input('machineName'))
                ->where('month', $monthNumber)
                ->where('week', $weekNumber)
                ->first();

            if ($existingMachineData) {
                return response()->json(['message' => 'Machine already added for the current week'], 400);
            }

            $newMachineData = new MachineData();
            $newMachineData->machine_id = $machineOrigin->id; // Assign the id of the machine from main database
            $newMachineData->machine_name = $request->input('machineName');
            $newMachineData->month = $monthNumber; // Add month number to the new machine data entry
            $newMachineData->week = $weekNumber; // Add week number to the new machine data entry
            $newMachineData->save();

            Audits::create([
                'users_id' => $userId,
                'machineoperation_id' => null,
                'event' => 'add',
                'changes' => json_encode([
                    'original_state' => '',
                    'new_state' => $request->all(),
                ])
            ]);

            return response()->json(['message' => 'Machine added successfully'], 201);
        } catch (\Exception $e) {
            \Log::error('Error adding weekly machine: ' . $e->getMessage());
            return response()->json(['message' => 'Error adding weekly machine. Please try again later.'], 500);
        }
    }

    //Add Machine Operation, input to machineOperation database
    public function addMachineOperation(Request $request, $line, $machineID) {
        $userId = auth()->id();

        try {
            $day = $request->input('day');
            $code = $request->input('code');
            $time = $request->input('time');
            $status = $request->input('status');
            $notes = $request->input('notes');

            $machineData = MachineData::find($machineID);
            if (!$machineData) {
                throw new \Exception("Machine data not found for ID: $machineID");
            }

            $machine = $machineData->machine;
            if (!$machine) {
                throw new \Exception("Machine not found for machine data ID: $machineID");
            }

            $lines = $machine->line;

            if (!is_array($lines) || !in_array($line, $lines)) {
                throw new \Exception("Line: $line is not associated with Machine ID: $machineID");
            }

            $user = User::find($userId);
            $username = $user ? $user->name : 'Unknown'; // If user not found, use 'Unknown'

            $machineOperation = new MachineOperation([
                'machine_id' => $machineID, // Set the machine_id attribute
                'year' => $machineData->year,
                'month' => $machineData->month,
                'week' => $machineData->week,
                'day' => $day,
                'code' => $code,
                'time' => $time,
                'status' => $status,
                'notes' => $notes,
                'current_line' => $line,
                'changed_by' => $username,
            ]);

            $machineOperation->save();

            $weekOperations = MachineOperation::where('week', $machineOperation->week)
            ->where('month', $machineOperation->month)
            ->where('year', $machineOperation->year)
            ->where('current_line', $machineOperation->current_line)
            ->get();

            foreach ($weekOperations as $operation) {
                $operation->update([
                    'is_changed' => true,
                    'is_approved' => false,
                ]);
            }

            $machineOperation->save();

            Audits::create([
                'users_id' => $userId,
                'machineoperation_id' => null,
                'event' => 'add',
                'changes' => json_encode([
                    'original_state' => '',
                    'new_state' => $request->all(),
                ])
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
                'year' => 'required|integer',
                'month' => 'required|integer',
                'week' => 'required|integer',
            ]);

            $line = $request->input('line');

            // Check if the global description already exists
            $existingGlobalDescription = GlobalDescription::where('description', $request->input('description'))
                ->where('year', $request->input('year'))
                ->where('month', $request->input('month'))
                ->where('week', $request->input('week'))
                ->first();

            if ($existingGlobalDescription) {
                return response()->json(['message' => 'Global description already exists'], 409);
            }

            // Create a new global description instance
            $globalDescription = new GlobalDescription();
            $globalDescription->description = $validatedData['description'];
            $globalDescription->year = $validatedData['year'];
            $globalDescription->month = $validatedData['month'];
            $globalDescription->week = $validatedData['week'];
            $globalDescription->line = $line;
            $globalDescription->save();

            // Create audit entry
            Audits::create([
                'users_id' => $userId,
                'machineoperation_id' => null,
                'event' => 'add',
                'changes' => json_encode([
                    'original_state' => '',
                    'new_state' => $request->all(),
                ])
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
        $userId = auth()->id();
        $validatedData = $request->validate([
            'day' => 'required',
            'code' => 'required',
            'time' => 'required',
        ]);
    
        try {
            $machineOperation = MachineOperation::find($machineOperationID);
    
            $operationExist = MachineOperation::where('day', $validatedData['day'])
                ->where('time', $validatedData['time'])
                ->where('id', '!=', $machineOperationID)
                ->first();
    
            if ($operationExist) {
                return response()->json(['message' => 'Another machine operation is already scheduled at this time!'], 409);
            }
    
            if (!$machineOperation) {
                return response()->json(['message' => 'Machine operation not found!'], 404);
            }
    
            $user = User::find($userId);
            $username = $user ? $user->name : '';
    
            $originalState = [
                'day' => $machineOperation->day,
                'code' => $machineOperation->code,
                'time' => $machineOperation->time,
                'status' => $machineOperation->status,
                'notes' => $machineOperation->notes,
            ];
    
            $status = $request->input('status') ?? $machineOperation->status;
    
            $machineOperation->update([
                'day' => $validatedData['day'],
                'code' => $validatedData['code'],
                'time' => $validatedData['time'],
                'status' => $status,
                'notes' => $request->input('notes'),
                'changedBy' => $username,
            ]);
    
            $weekOperations = MachineOperation::where('week', $machineOperation->week)
                ->where('month', $machineOperation->month)
                ->where('year', $machineOperation->year)
                ->where('current_line', $machineOperation->current_line)
                ->get();
    
            foreach ($weekOperations as $operation) {
                $operation->update([
                    'is_changed' => true,
                    'is_approved' => false,
                ]);
            }
    
            $newState = [
                'day' => $machineOperation->day,
                'code' => $machineOperation->code,
                'time' => $machineOperation->time,
                'status' => $machineOperation->status,
                'notes' => $machineOperation->notes,
            ];
    
            Audits::create([
                'users_id' => $userId,
                'machineoperation_id' => $machineOperationID,
                'event' => 'edit',
                'changes' => json_encode([
                    'original_state' => $originalState,
                    'new_state' => $newState,
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
        $userId = auth()->id();

        try {
            $machineData = MachineData::find($machineID);

            if (!$machineData) {
                return response()->json(['message' => 'Machine data not found!'], 404);
            }

            $originalState = [
                'machine_id' => $machineData->machine_id,
                'machine_name' => $machineData->machine_name,
                'week' => $machineData->week,
            ];

            $machineData->delete();

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
        $userId = auth()->id();

        try {
            $machineOperation = MachineOperation::find($machineOperationID);

            if (!$machineOperation) {
                return response()->json(['message' => 'Machine operation not found!'], 404);
            }

            $originalState = [
                'day' => $machineOperation->day,
                'code' => $machineOperation->code,
                'time' => $machineOperation->time,
                'description' => $machineOperation->description,
                'is_changed' => $machineOperation->is_changed,
                'is_approved' => $machineOperation->is_approved,
                'changedBy' => $machineOperation->changedBy,
            ];

            $machineOperation->delete();

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

            $originalState = [
                'description' => $globalDescription->description,
                'year' => $globalDescription->year,
                'month' => $globalDescription->month,
                'week' => $globalDescription->week,
            ];

            $globalDescription->delete();

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
    public function showAllWeeklyMachine(Request $request){
        // $request->validate([
        //     'year' => 'required|string',
        //     'month' => 'required|string',
        //     'week' => 'required|string',
        //     'line' => 'required|string',
        // ]);

        $line = $request->input('line');
        $year = $request->input('year');
        $month = $request->input('month');
        $week = $request->input('week');

        $machineData = MachineData::where('year', $year)
            ->where('month', $month)
            ->where('week', $week)
            ->whereHas('machine', function($query) use ($line) {
                $query->whereJsonContains('line', $line);
            })
            ->get();

        return response()->json($machineData);
    }

    // Function Show All Code Machine Operations For Guest
    public function showAllMachineOperationGuest(){
        $operations = MachineOperation::select(
            'machine_operations.*',
            'machines.id as machine_id',
            'machines.machine_name',
            'machines.line'
        )
            ->join('machine_data', 'machine_operations.machine_id', '=', 'machine_data.id')
            ->join('machines', 'machine_data.machine_id', '=', 'machines.id')
            ->where('is_approved', 'true')
            ->get();

        return response()->json([
            'operations' -> $operations
        ]);

    }

    // Function Show All Code Machine Operations For PJL
    public function showAllMachineOperationPjl() {
        $operations = MachineOperation::select(
            'machine_operations.*',
            'machines.id as machineAll_id',
            'machines.machine_name',
            'machines.category',
            'machines.line'
        )
            ->join('machine_data', 'machine_operations.machine_id', '=', 'machine_data.id')
            ->join('machines', 'machine_data.machine_id', '=', 'machines.id')
            ->get();

        return response()->json([
            'operations' => $operations
        ]);
    }

    //Function show all machine operation
    public function showMachineOperation(Request $request){
        $request->validate([
            'year' => 'required|string',
            'month' => 'required|string',
            'week' => 'required|string',
            'line' => 'required|string',
        ]);

        $line = $request->input('line');
        $year = $request->input('year');
        $month = $request->input('month');
        $week = $request->input('week');

        $operations = MachineOperation::select('id', 'machine_id', 'year', 'month', 'week', 'day', 'code', 'time', 'status', 'notes', 'current_line', 'is_changed', 'changed_by', 'change_date', 'is_approved', 'approved_by', 'is_rejected', 'rejected_by', 'created_at', 'updated_at')
            ->where('year', $year)
            ->where('month', $month)
            ->where('week', $week)
            ->whereHas('machineData', function($query) use ($line) {
                $query->whereHas('machine', function($query) use ($line) {
                    $query->whereJsonContains('line', $line);
                });
            })
            ->get();

        return response()->json([
            'operations' => $operations
        ]);
    }

    // Function show all machine operation that has true 'is_approved' value
    public function showApprovedMachineOperation(Request $request){
        $request->validate([
            'year' => 'required|string',
            'month' => 'required|string',
            'week' => 'required|string',
            'line' => 'required|string',
        ]);

        $line = $request->input('line');
        $year = $request->input('year');
        $month = $request->input('month');
        $week = $request->input('week');

        $operations = MachineOperation::select('id', 'machine_id', 'year', 'month', 'week', 'day', 'code', 'time', 'status', 'notes', 'current_line', 'is_changed', 'changed_by', 'change_date', 'is_approved', 'approved_by', 'is_rejected', 'rejected_by', 'is_sent', 'created_at', 'updated_at')
            ->where('year', $year)
            ->where('month', $month)
            ->where('week', $week)
            ->whereHas('machineData', function($query) use ($line) {
                $query->whereHas('machine', function($query) use ($line) {
                    $query->whereJsonContains('line', $line);
                });
            })
            ->where('is_approved', true)
            ->get();

        return response()->json([
            'operations' => $operations
        ]);
    }

    //function to show all global description
    public function showAllGlobalDescription() {
        $globalDescription = GlobalDescription::all();
        return response()->json($globalDescription);
        //return view('globalDescriptions', ['globalDescriptions' => $globalDescriptions]);
    }

    //Show all code AND line to the table, take data from both machine and machineoperation database using relationship.
    public function showCodeLine() {
        $machineOperations = MachineOperation::with('machine')->get();

        $data = $machineOperations->map(function ($operation) {
            return [
                'code' => $operation->code,
                'line' => $operation->machine->line
            ];
        });

        return response()->json($data);
    }

    //Function to show all PM
    public function showPM(Request $request){
        $request->validate([
            'year' => 'required|string',
            'month' => 'required|string',
            'line' => 'required|string',
        ]);

        $line = $request->input('line');
        $year = $request->input('year');
        $month = $request->input('month');

        $operations = MachineOperation::select('id', 'machine_id', 'year', 'month', 'week', 'day', 'code', 'time', 'status', 'notes', 'current_line', 'is_changed', 'changed_by', 'change_date', 'is_approved', 'approved_by', 'is_rejected', 'rejected_by', 'created_at', 'updated_at')
            ->where('year', $year)
            ->where('month', $month)
            ->whereHas('machineData', function($query) use ($line) {
                $query->whereHas('machine', function($query) use ($line) {
                    $query->whereJsonContains('line', $line);
                });
            })
            ->where('status', 'PM')
            ->get();

        return response()->json([
            'operations' => $operations
        ]);
    }

    //Function to show all PM to guest
    public function showPMGuest(Request $request){
        $request->validate([
            'year' => 'required|string',
            'month' => 'required|string',
            'week' => 'required|string',
            'line' => 'required|string',
        ]);

        $line = $request->input('line');
        $year = $request->input('year');
        $month = $request->input('month');
        $week = $request->input('week');

        $operations = MachineOperation::select('id', 'machine_id', 'year', 'month', 'week', 'day', 'code', 'time', 'status', 'notes', 'current_line', 'is_changed', 'changed_by', 'change_date', 'is_approved', 'approved_by', 'is_rejected', 'rejected_by', 'created_at', 'updated_at')
            ->where('year', $year)
            ->where('month', $month)
            ->where('week', $week)
            ->whereHas('machineData', function($query) use ($line) {
                $query->whereHas('machine', function($query) use ($line) {
                    $query->whereJsonContains('line', $line);
                });
            })
            ->where('status', 'PM')
            ->where('is_approved', true)
            ->get();

        return response()->json([
            'operations' => $operations
        ]);
    }

    //----------------------------------------------------------------------------------------

    public function sendRevision(Request $request) {
        $userId = auth()->id();
    
        $validatedData = $request->validate([
            'year' => 'required|string',
            'month' => 'required|string',
            'week' => 'required|string',
            'line' => 'required|string',
        ]);
    
        $line = $request->input('line');
        $year = $validatedData['year'];
        $month = $validatedData['month'];
        $week = $validatedData['week'];
    
        try {
            $operations = MachineOperation::where('year', $year)
                ->where('month', $month)
                ->where('week', $week)
                ->whereHas('machineData', function($query) use ($line) {
                    $query->whereHas('machine', function($query) use ($line) {
                        $query->whereJsonContains('line', $line);
                    });
                })
                ->get();
    
            if ($operations->isEmpty()) {
                return response()->json(['message' => 'No machine operations found for the specified criteria'], 404);
            }
    
            $originalStates = $operations->map(function ($operation) {
                return [
                    'id' => $operation->id,
                    'is_sent' => $operation->is_sent,
                ];
            });
    
            foreach ($operations as $operation) {
                $operation->update(['is_sent' => true]);
            }
    
            Audits::create([
                'users_id' => $userId,
                'machineoperation_id' => null,
                'event' => 'send_revision',
                'changes' => json_encode([
                    'original_state' => $originalStates,
                    'new_state' => $operations->map(function ($operation) {
                        return [
                            'id' => $operation->id,
                            'is_sent' => true,
                        ];
                    }),
                ]),
            ]);
    
            return response()->json(['message' => 'Machine operations marked as sent successfully'], 200);
        } catch (\Exception $e) {
            \Log::error('Error sending revision: ' . $e->getMessage());
            return response()->json(['message' => 'Error sending revision. Please try again later.'], 500);
        }
    }
    

}
