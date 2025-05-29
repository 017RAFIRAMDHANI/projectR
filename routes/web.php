<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\VendorList;
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
    return view('welcome');
});

Auth::routes();

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('/');
Route::redirect('home','/');
Route::get('/', VendorList::class)->name('home');

Route::get('/permit-details', function () {
    return view('permit-details');
});

Route::get('/approvals', function () {
    return view('approvals');
});

Route::get('/new-permit', function () {
    return view('new-permit');
});

Route::get('/permits', function () {
    return view('permits');
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

Route::get('/fh-dashboard', function () {
    return view('fh-dashboard');
});

Route::get('/maintenance', function () {
    return view('maintenance');
});

Route::get('/inventory', function () {
    return view('inventory');
});

Route::get('/dhi-dashboard', function () {
    return view('dhi-dashboard');
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

Route::get('/visitor-dashboard', function () {
    return view('visitor-dashboard');
});

Route::get('/vendor-dashboard', function () {
    return view('vendor-dashboard');
});

Route::get('/fm-permit-review', function () {
    return view('fm-permit-review');
});

Route::get('/active-tasks', function () {
    return view('active-tasks');
});

Route::get('/login-menu', function () {
    return view('login-menu');
});
