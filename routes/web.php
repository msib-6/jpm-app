<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\System\AuditTrailController;
use App\Http\Controllers\System\ManagerApprovalController;
use App\Http\Controllers\System\PjlOnlyViewController;
use App\Http\Controllers\System\PjlViewController;
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
// Route::get('/auditlog', function () {
//     return view('history.auditlog');
// });

// new HIstory
Route::get('/auditlog', [AuditTrailController::class, 'index']);


Route::get('/historilog', function () {
    return view('logistik.dashboard');
});
Route::get('/rawdata', function () {
    return view('logistik.rawdata');
});

Route::middleware(['auth', 'line'])->group(function () {
    Route::get('/pjl/{line}/dashboard', function ($line) {
        return view('pjl.dashboard', ['line' => $line]);
    })->name('pjl.line.dashboard');

    Route::get('/pjl/{line}/mesin', function ($line) {
        return view('pjl.mesin', ['line' => $line]);
    })->name('pjl.line.mesin');

    // New PJL View Controller
    Route::get('/pjl/{line}/view', [PjlViewController::class, 'index'])->name('pjl.view');
    Route::get('/pjl/{line}/onlyView', [PjlOnlyViewController::class, 'onlyViewController'])->name('pjl.onlyView');

//    Route::get('/pjl/{line}/onlyView', function (Request $request, $line) {
//        $line = $request->query('line');  // Access 'line' parameter
//        $year = $request->query('year');  // Access 'year' parameter
//        $month = $request->query('month'); // Access 'month' parameter
//
//        return view('pjl.onlyView', compact('line', 'year', 'month'));
//    })->name('pjl.onlyView');

    Route::get('/pjl/{line}/return', function (Request $request) {
        $line = $request->query('line');
        $year = $request->query('year');
        $month = $request->query('month');
        $week = $request->query('week');
        return view('pjl.return', compact('line', 'year', 'month', 'week'));
    })->name('pjl.return');

    Route::get('/pjl/{line}/pm', function (Request $request, $line) {
        $line = $request->query('line');  // Access 'line' parameter
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

Route::get('/guest/viewguest', function (Request $request) {
    $line = $request->query('line');
    $year = $request->query('year');
    $month = $request->query('month');
    $month = $request->query('week');
    return view('guest.viewGuest', compact('line', 'year', 'month'));
})->name('guest.viewGuest');

Route::middleware('manager', 'auth')->group(function () {
    Route::get('/manager/dashboard', function () {
        return view('manager.dashboard');
    })->name('manager.dashboard');




//    Route::get('/manager/approve', [ManagerApprovalController::class, 'approveManagerController'])->name('manager.approve');

   Route::get('/manager/approve', function (Request $request) {
       $line = $request->query('line');
       $year = $request->query('year');
       $month = $request->query('month');
       $week = $request->query('week');
       return view('manager.approve', compact('line', 'year', 'month', 'week'));
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

Route::middleware(['auth', 'storage'])->group(function () {
    Route::get('/logistik/dashboard', function () {
        return view('logistik.dashboard');
    })->name('logistik.dashboard');
});

require __DIR__ . '/auth.php';
