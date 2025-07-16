<?php

use App\Http\Controllers\DaftarUser;
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
        }elseif (Auth::user()->role == 'Security') {
            return redirect('security-dashboard'); // Redirect to DHI's specific dashboard
        }
    }
    return view('auth.login'); // Default login page if not authenticated or roles don't match
})->name('/');

// Route::get('/', VendorList::class)->name('home');

// vendor visitor const
Route::get('/new-permit',[App\Http\Controllers\VendorController::class, 'create'])->name('vendor_create');
Route::post('/vendor_store',[App\Http\Controllers\VendorController::class, 'store'])->name('vendor.store');
Route::get('/permits',[App\Http\Controllers\VendorController::class, 'index'])->name('vendor.index');
Route::get('/search-vendors', [App\Http\Controllers\VendorController::class, 'search'])->name('vendor.search');
Route::post('/vendors/approve', [App\Http\Controllers\VendorController::class, 'approve'])->name('vendors.approve');
Route::post('/visitor/approve', [App\Http\Controllers\VisitorController::class, 'approve'])->name('visitor.approve');
Route::post('/visitor/reject', [App\Http\Controllers\VisitorController::class, 'reject'])->name('visitor.reject');
Route::post('/visitor/info', [App\Http\Controllers\VisitorController::class, 'info'])->name('visitor.info');
Route::post('/vendors/info', [App\Http\Controllers\VendorController::class, 'info'])->name('vendors.info');
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
Route::get('/view_visitor/pdf/{id_visitor}',[App\Http\Controllers\FHController::class, 'pdf_visitor'])->name('pdf_visitor');
Route::get('/view_vendor/pdf/{id_vendor}',[App\Http\Controllers\FHController::class, 'pdf_vendor'])->name('pdf_vendor');
Route::get('/view_visitor/{id_visitor}',[App\Http\Controllers\FHController::class, 'view_visitor'])->name('visitor_view');
Route::get('/view_visitor/pdf_manual_visitor/{id_visitor}',[App\Http\Controllers\FHController::class, 'pdf_manual_visitor'])->name('pdf_manual_visitor');
Route::get('/view/pdf_manual_vendor/{id_vendor}',[App\Http\Controllers\FHController::class, 'pdf_manual_vendor'])->name('pdf_manual_vendor');

Route::get('/view_visitor2/{id_visitor}',[App\Http\Controllers\ApprovedCloseController::class, 'view_visitor2'])->name('visitor_view2');
Route::get('/view2/{id_vendor}',[App\Http\Controllers\ApprovedCloseController::class, 'view2'])->name('vendor_view2');
// DHI const
Route::get('/dhi-dashboard',[App\Http\Controllers\DHIController::class, 'index'])->name('dhi-dashboard');
Route::get('/regisuser',[App\Http\Controllers\DaftarUser::class, 'create'])->name('regisuser');
Route::post('/regisuser',[App\Http\Controllers\DaftarUser::class, 'store'])->name('regisuser.store');
Route::get('/user-list',[App\Http\Controllers\DaftarUser::class, 'index'])->name('user-list');
Route::delete('/delete-user/{id}', [App\Http\Controllers\DaftarUser::class, 'destroy'])->name('delete-user');
Route::get('/edit-user/{id}', [App\Http\Controllers\DaftarUser::class, 'edit'])->name('edit-user');
Route::get('/permision-user/{id}', [App\Http\Controllers\DaftarUser::class, 'permision'])->name('permision-user');
Route::put('/roleupdate/{id}',[App\Http\Controllers\DaftarUser::class, 'update'])->name('regisuser.update');
Route::get('/employee-data',[App\Http\Controllers\EmployeController::class, 'index'])->name('employee-data');
Route::post('/employee-tambah',[App\Http\Controllers\EmployeController::class, 'store'])->name('employee-store');
Route::post('/employee-edit',[App\Http\Controllers\EmployeController::class, 'update'])->name('employee-update');
Route::post('/employee-delete',[App\Http\Controllers\EmployeController::class, 'delete'])->name('employee-delete');
Route::get('/profile/{id}', [App\Http\Controllers\DaftarUser::class, 'profile'])->name('profile');
Route::put('/profile_edit/{id}', [App\Http\Controllers\DaftarUser::class, 'edit_profile'])->name('edit_profile');
Route::get('/permit-data', [App\Http\Controllers\ApprovedCloseController::class, 'index'])->name('permit-data');
Route::post('/update-permit-status', [App\Http\Controllers\ApprovedCloseController::class, 'updateStatus'])->name('updatePermitStatus');
Route::get('/reports',  [App\Http\Controllers\ReportController::class, 'index'])->name('reports');
Route::post('/reports/cetak',  [App\Http\Controllers\ReportController::class, 'cetak'])->name('reports.cetak');
Route::post('/reports/shedule',  [App\Http\Controllers\ReportController::class, 'shedule'])->name('reports.shedule');
Route::get('/reports/download/{id_repot}',  [App\Http\Controllers\ReportController::class, 'download'])->name('reports.download');
Route::delete('delete-report/{id_repot}', [App\Http\Controllers\ReportController::class, 'delete'])->name('report.delete');
Route::post('/roleupdatedata',[App\Http\Controllers\DaftarUser::class, 'roleupdatedata'])->name('regisuser.roleupdatedata');

// client
Route::get('/vehicle-list',[App\Http\Controllers\VehicleController::class, 'index'])->name('vehicle-list');
Route::post('/vehicle-create',[App\Http\Controllers\VehicleController::class, 'store'])->name('vehicle-store');
Route::post('/vehicle-delete',[App\Http\Controllers\VehicleController::class, 'delete'])->name('vehicle-delete');
Route::post('/vehicle-edit',[App\Http\Controllers\VehicleController::class, 'update'])->name('vehicle-update');
Route::get('/employee-safety-list',[App\Http\Controllers\SafetiController::class, 'index'])->name('employee-safety-list');
Route::post('/update-safety-status', [App\Http\Controllers\SafetiController::class, 'date'])->name('update.safety.status');
Route::post('/update-lampu-status',[App\Http\Controllers\SafetiController::class, 'updateLampuStatus'])->name('update.lampu.status');
Route::get('/history',[App\Http\Controllers\SafetiController::class, 'histori'])->name('history');
Route::get('/history/reset',[App\Http\Controllers\SafetiController::class, 'reset'])->name('history.reset');
Route::post('/upload-photo', [App\Http\Controllers\SafetiController::class, 'uploadPhoto'])->name('upload.photo');



Route::get('/daily-report', function () {
    return view('daily-report');
})->name('daily-report');

Route::get('/employee-safety-list-fm', function () {
    return view('employee-safety-list-fm');
})->name('employee-safety-list-fm');


// Client const
Route::get('/datamasuk',[App\Http\Controllers\DataMasuk::class, 'index'])->name('datamasuk');
Route::get('/security-dashboard',[App\Http\Controllers\ClientController::class, 'index'])->name('security-dashboard');
Route::get('/employee-safety-list-client', function () {
    return view('employee-safety-list-client');
})->name('employee-safety-list-client');


Route::get('/preview-file', function () {
    return view('preview-file');
})->name('preview-file');


Route::get('/permit-details', function () {
    return view('permit-details');
});
Route::get('/vendor_status', function () {
    return view('emails.vendor_status');
});




Route::get('/database', function () {
    return view('database');
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


// <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
