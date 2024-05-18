<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Machine;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\ManagerController;

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

//----------------------------------------------------------------------------------------------------------------------------------------------------------------

//PJL Route

//Add Machine Route
Route::post('/addmachine', [MachineController::class, 'addMachine'])->name('add.machine');;
Route::post('/addweeklymachine', [MachineController::class, 'addWeeklyMachine'])->name('add.weekly.machine');
Route::post('/addmachineoperation/{machineID}', [MachineController::class, 'addMachineOperation'])->name('add.machine.operation');
Route::post('/addglobaldescription', [MachineController::class, 'addGlobalDescription'])->name('add.global.description');

//Edit Machine Route
Route::put('/editmachineoperation/{machineOperationID}', [MachineController::class, 'editMachineOperation'])->name('edit.machine');


//Delete Machine Route
Route::delete('/deleteweeklymachine/{machineID}', [MachineController::class, 'deleteWeeklyMachine'])->name('delete.machine');
Route::delete('/deletemachineoperation/{machineOperationID}', [MachineController::class, 'deleteMachineOperation'])->name('delete.machine.operation');
Route::delete('deleteglobaldescription/{globaldDescriptionID}', [MachineController::class, 'deleteGlobalDescription'])->name('delete.global.description');

//Show Machine Route
Route::get('/showmachine',[MachineController::class, 'showAllMachines'])->name('show.all.machine');
Route::get('/showweeklymachine',[MachineController::class, 'showAllWeeklyMachine'])->name('show.weekly.machine');
Route::get('/showmachineoperation', [MachineController::class, 'showMachineOperation'])->name('show.machine.operation');
Route::get('/showglobaldescription', [MachineController::class, 'showAllGlobalDescription'])->name('show.all.global.description');
Route::get('/showcodeline', [MachineController::class, 'showCodeLine'])->name('show.code.line');

//Backup MachineOperation Route
Route::get('/machineoperation/export', [BackupController::class, 'export'])->name('export');
Route::post('/machineoperation/import', [BackupController::class, 'import'])->name('import');

//----------------------------------------------------------------------------------------------------------------------------------------------------------------

//Manager Route

//Show Approval Route
Route::get('/showwaitingapproval', [ManagerController::class, 'showWaitingApproval'])->name('show.waiting.approval');
Route::get('/showwaitingapprovalcard', [ManagerController::class, 'showWaitingApprovalCard'])->name('show.waiting.approval.card');
Route::post('/approve}', [ManagerController::class, 'approve'])->name('approve');
