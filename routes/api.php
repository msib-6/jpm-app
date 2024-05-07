<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Machine;
use App\Http\Controllers\MachineController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/getallmachineoperation', function () {
//     return $request->user();
// });

//Add Machine Route
Route::post('/addmachine', [MachineController::class, 'addMachine']);
Route::post('/addweeklymachine', [MachineController::class, 'addWeeklyMachine']);
Route::post('/addmachineoperation/{machineID}', [MachineController::class, 'addMachineOperation']);
Route::post('/addglobaldescription', [MachineController::class, 'addGlobalDescription']);

//Edit Machine Route
Route::put('/editmachineoperation/{machineOperationID}', [MachineController::class, 'editMachineOperation']);


//Delete Machine Route
Route::delete('/deleteweeklymachine/{machineID}', [MachineController::class, 'deleteWeeklyMachine']);
Route::delete('/deletemachineoperation/{machineOperationID}', [MachineController::class, 'deleteMachineOperation']);
Route::delete('deleteglobaldescription/{globaldDescriptionID}', [MachineController::class, 'deleteGlobalDescription']);

//Show Machine Route
Route::get('/showmachine',[MachineController::class, 'showAllMachines']);
Route::get('/showweeklymachine',[MachineController::class, 'showAllWeeklyMachine']);
Route::get('/showmachineoperation', [MachineController::class, 'showAllMachineOperation']);
Route::get('/showglobaldescription', [MachineController::class, 'showAllGlobalDescription']);