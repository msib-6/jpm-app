<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MachineController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//Middleware route to edit, update, and delete profile


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/reset', function () {
    return view('auth.reset-password');
});
Route::get('/summary', function () {
    return view('history.summary');
});
Route::get('/auditlog', function () {
    return view('history.auditlog');
});


//Show Guest Dashboard
Route::get('/pjl/dashboard', function () {
    return view('pjl.dashboard');
});

Route::get('/pjl/mesin', function () {
    return view('pjl.mesin');
});

Route::get('/guest/viewGuest', function (Illuminate\Http\Request $request) {
    $line = $request->query('line');  // Access 'line' parameter
    $year = $request->query('year');  // Access 'year' parameter
    $month = $request->query('month'); // Access 'month' parameter

    return view('guest.viewGuest', compact('line', 'year', 'month'));
})->name('viewGuest');


//Route::get('/guest/dashboard', [MachineController::class, 'showAllMachineOperation'])->name('guest.dashboardGuest');
Route::get('/guest/dashboard', function () {
    return view('guest.dashboardGuest');
});

Route::get('/manager/dashboard', function () {
    return view('manager.dashboard');
});


Route::get('/approval', function () {
    return view('pjl.approval');
})->name('approval');

require __DIR__.'/auth.php';
