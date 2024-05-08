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
Route::get('/navbar', function () {
    return view('Navbar.aku');
});


//Show Guest Dashboard
//Route::get('/dashboardGuest', function () {
//    return view('guest.dashboardGuest');
//});

// web.php

Route::get('/guest/dashboard', [MachineController::class, 'showAllMachineOperation'])->name('guest.dashboardGuest');



require __DIR__.'/auth.php';
