<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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

Route::get('users/create', [UserController::class, 'create'])->name('users.create');
Route::post('users/store', [UserController::class, 'store'])->name('users.store');
Route::get('users/detail/{id}', [UserController::class, 'show'])->name('users.detail');
Route::get('users/index', [UserController::class, 'index'])->name('users.index');
Route::get('users/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::post('users/update', [UserController::class, 'update'])->name('users.update');

Route::get('login', [AuthController::class, 'create'])->name('loginScreen');
Route::post('login', [AuthController::class, 'authenticate'])->name('login');

Route::get('changePassword', [AuthController::class, 'changePassword'])->name('changePasswordScreen');
Route::post('changePassword', [AuthController::class, 'changePasswordStore'])->name('changePassword');

Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->name('password.request');
Route::post('forgot-password', [AuthController::class, 'forgotPasswordEmail'])->name('password.email');
Route::get('reset-password/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');
Route::post('reset-password', [AuthController::class, 'resetPasswordStore'])->name('password.update');
