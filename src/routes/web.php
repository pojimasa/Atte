<?php

use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\StampController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\ManagementController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [AuthenticatedSessionController::class,'showLoginForm'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'login']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/users', [RegisteredUserController::class, 'index'])->name('users.index');
    Route::delete('/user/{id}', [RegisteredUserController::class, 'destroy'])->name('user.destroy');
    Route::post('/logout-confirm', [AuthenticatedSessionController::class, 'showLogoutConfirm'])->name('logout.confirm');
    Route::delete('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout.destroy');
    Route::get('/stamp', [StampController::class, 'index'])->name('stamps.index');
    Route::post('/stamp', [StampController::class, 'store'])->name('stamps.store');
    Route::delete('/stamp/{id}', [StampController::class, 'destroy'])->name('stamps.destroy');
});

Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');

Route::get('/userlist', [UserListController::class, 'index'])->name('userlist.index');

Route::get('/attendance/user', [AttendanceController::class, 'userAttendance'])->name('attendance.user')->middleware('auth');

Route::get('/home', function () {
    return redirect()->route('stamps.index');
})->name('home');
