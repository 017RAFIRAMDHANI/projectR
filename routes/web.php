<?php

use Illuminate\Support\Facades\Route;
// use App\Livewire\VendorList;
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


Auth::routes();

Route::get('/vendor-dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('vendor-dashboard');

Route::redirect('home','/');
Route::get('/', function () {
    if (Auth::check()) { // Check if user is authenticated
        if (Auth::user()->role == 'FM') {
            return redirect('fm-dashboard'); // Redirect to FM's specific dashboard
        } elseif (Auth::user()->role == 'DHI') {
            return redirect('dhi-dashboard'); // Redirect to DHI's specific dashboard
        }elseif (Auth::user()->role == 'Client') {
            return redirect('client-dashboard'); // Redirect to DHI's specific dashboard
        }
    }
    return view('auth.login'); // Default login page if not authenticated or roles don't match
});

// Route::get('/', VendorList::class)->name('home');

// vendor const
Route::get('/new-permit',[App\Http\Controllers\VendorController::class, 'create'])->name('vendor_create');
Route::post('/vendor_store',[App\Http\Controllers\VendorController::class, 'store'])->name('vendor.store');
Route::get('/permits',[App\Http\Controllers\VendorController::class, 'index'])->name('vendor.index');
Route::get('/search-vendors', [App\Http\Controllers\VendorController::class, 'search'])->name('vendor.search');
Route::post('/vendors/approve', [App\Http\Controllers\VendorController::class, 'approve'])->name('vendors.approve');
Route::post('/vendors/reject', [App\Http\Controllers\VendorController::class, 'reject'])->name('vendors.reject');

// profile const
Route::get('/profile/{id}',[App\Http\Controllers\ProfileController::class, 'index'])->name('profile');

// visitor const
Route::get('/visitor-dashboard',[App\Http\Controllers\VisitorController::class, 'index'])->name('visitor-dashboard');
Route::post('/visitor_store', [App\Http\Controllers\VisitorController::class, 'store'])->name('visitor.store');

// FH const
Route::get('/fm-dashboard',[App\Http\Controllers\FHController::class, 'index'])->name('fm-dashboard');
Route::get('/approvals',[App\Http\Controllers\FHController::class, 'index_approve'])->name('index_approve');
Route::get('/view/{id_vendor}',[App\Http\Controllers\FHController::class, 'view'])->name('vendor_view');

// DHI const
Route::get('/dhi-dashboard',[App\Http\Controllers\DHIController::class, 'index'])->name('dhi-dashboard');

Route::get('/regisuser', function () {
    return view('regisuser');
})->name('regisuser');
Route::get('/employee-safety-list', function () {
    return view('employee-safety-list');
})->name('employee-safety-list');
Route::get('/vehicle-list', function () {
    return view('vehicle-list');
})->name('vehicle-list');
Route::get('/daily-report', function () {
    return view('daily-report');
})->name('daily-report');
Route::get('/permit-data', function () {
    return view('permit-data');
})->name('permit-data');
Route::get('/employee-data', function () {
    return view('employee-data');
})->name('employee-data');
Route::get('/employee-safety-list-fm', function () {
    return view('employee-safety-list-fm');
})->name('employee-safety-list-fm');


// Client const
Route::get('/datamasuk',[App\Http\Controllers\DataMasuk::class, 'index'])->name('datamasuk');
Route::get('/client-dashboard',[App\Http\Controllers\ClientController::class, 'index'])->name('client-dashboard');
Route::get('/employee-safety-list-client', function () {
    return view('employee-safety-list-client');
})->name('employee-safety-list-client');


Route::get('/preview-file', function () {
    return view('preview-file');
})->name('preview-file');


Route::get('/permit-details', function () {
    return view('permit-details');
});




Route::get('/database', function () {
    return view('database');
});

Route::get('/reports', function () {
    return view('reports');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/dhi-profile', function () {
    return view('dhi-profile');
});

Route::get('/fh-profile', function () {
    return view('fh-profile');
});



Route::get('/maintenance', function () {
    return view('maintenance');
});

Route::get('/inventory', function () {
    return view('inventory');
});



Route::get('/permit-management', function () {
    return view('permit-management');
});

Route::get('/new-permits', function () {
    return view('new-permits');
});

Route::get('/my-permits-visitor', function () {
    return view('my-permits-visitor');
});

Route::get('/new-permit-visitor', function () {
    return view('new-permit-visitor');
});




Route::get('/fm-permit-review', function () {
    return view('fm-permit-review');
});

Route::get('/active-tasks', function () {
    return view('active-tasks');
});


