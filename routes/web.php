<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', fn () => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth', 'checkrole:staff', ]], function () {
    Route::get('/verify', [VerificationController::class, 'index']);
    Route::post('/verify', [VerificationController::class, 'store']);
    Route::get('/verify/{unique_id}', [VerificationController::class, 'show']);
    Route::put('/verify/{unique_id}', [VerificationController::class, 'update']);
});

Route::group(['middleware' => ['auth', 'checkrole:staff', 'checkstatus'   ]], function () {
    Route::get('/staff', [StaffController::class, 'index']);
});
// Route::group(['middleware' => ['auth', 'checkrole:superadmin,admin']], function () {
//     Route::get('/dashboard', [DashboardController::class, 'index']);
// });
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('permission:view dashboard');
    Route::resource('users', UserController::class)->middleware('permission:manage users');
});
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/contact', function () {return view('contact');})->name('contact');

