<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MachineController;
use Illuminate\Support\Facades\Route;

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
//Default landing page
Route::get('/', function () {
    return view('welcome');
});

//Show logged in dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Middleware route to edit, update, and delete one's profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Show Guest Dashboard
Route::get('/dashboardGuest', function () {
    return view('guest.dashboardGuest');
});

Route::get('/machineoperation', [MachineController::class, 'showAllMachineOperation']);


require __DIR__.'/auth.php';
