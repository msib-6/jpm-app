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

Route::get('/getallmachineoperation', function () {
    return $request->user();
});

Route::post('/addMachine', [MachineController::class, 'addMachine']);
Route::post('/addWeeklyMachine', [MachineController::class, 'addWeeklyMachine']);
Route::post('/addMachineOperation/{machineID}', [MachineController::class, 'addMachineOperation']);