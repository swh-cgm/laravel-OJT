<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileDownloadController;


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

// Route::get('/create', function () {
//     return view('users.create');
// });

Route::get('users/create', [UserController::class, 'create'])->name('users.create');
Route::post('users/store', [UserController::class, 'store'])->name('users.store');
Route::get('users/detail/{id}', [UserController::class, 'show'])->name('users.detail');
Route::get('index', [UserController::class, 'index'])->name('users.index');
Route::get('/media/{file:id}', [FileDownloadController::class, 'getImg']);
