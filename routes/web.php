<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\MachineController;
use Illuminate\Http\Request;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

Route::middleware(['auth', 'line'])->group(function () {
    Route::get('/pjl/{line}/dashboard', function ($line) {
        return view('pjl.dashboard', ['line' => $line]);
    })->name('pjl.line.dashboard');

    Route::get('/pjl/{line}/mesin', function ($line) {
        return view('pjl.mesin', ['line' => $line]);
    })->name('pjl.line.mesin');

    Route::get('/pjl/view', function (Request $request) {
        $line = $request->query('line');  // Access 'line' parameter
        $year = $request->query('year');  // Access 'year' parameter
        $month = $request->query('month'); // Access 'month' parameter

        return view('pjl.view', compact('line', 'year', 'month'));
    })->name('pjl.view');

    Route::get('/pjl/onlyView', function (Request $request) {
        $line = $request->query('line');  // Access 'line' parameter
        $year = $request->query('year');  // Access 'year' parameter
        $month = $request->query('month'); // Access 'month' parameter

        return view('pjl.onlyView', compact('line', 'year', 'month'));
    })->name('pjl.onlyView');



    Route::get('/pjl/{line}/pm', function (Request $request, $line) {
        $year = $request->query('year');
        $month = $request->query('month');
        return view('pjl.pm', compact('line', 'year', 'month'));
    })->name('pjl.line.pm');

    Route::get('/pjl/{line}/pmdashboard', function ($line) {
        return view('pjl.pmDashboard', ['line' => $line]);
    })->name('pjl.line.pmDashboard');

    Route::get('/pjl/{line}/approval', function ($line) {
        return view('pjl.approval', ['line' => $line]);
    })->name('pjl.line.approval');
});

Route::get('/guest/index', function () {
    return view('guest.index');
});

Route::get('/guest/viewGuest', function (Request $request) {
    $line = $request->query('line');
    $year = $request->query('year');
    $month = $request->query('month');
    return view('guest.viewGuest', compact('line', 'year', 'month'));
})->name('viewGuest');

Route::middleware('manager')->group(function () {
    Route::get('/manager/dashboard', function () {
        return view('manager.dashboard');
    })->name('manager.dashboard');

    Route::get('/manager/approve', function () {
        return view('manager.approve');
    })->name('manager.approve');
});

Route::middleware('admin')->group(function () {
    Route::get('/admin/convert', function () {
        return view('admin.convert');
    })->name('admin.convert');
});


Route::get('/guest/dashboard', function () {
    return view('guest.dashboardGuest');
})->name('guest.dashboard');


require __DIR__.'/auth.php';
