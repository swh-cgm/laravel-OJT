<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\PostOwner;
use App\Http\Middleware\Role;
use App\Http\Middleware\VerifyUserExists;
use App\Http\Middleware\VerifyPostExists;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

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

Route::prefix('users')->controller(UserController::class)->name('users.')->group(function () {
    Route::get('create', 'create')->name('create');
    Route::post('store', 'store')->name('store');
    Route::get('detail/{id}', 'show')->name('detail')->middleware(VerifyUserExists::class);
    Route::get('index', 'index')->name('index');
    Route::get('delete/{id}', 'destroy')->name('delete')->middleware([VerifyUserExists::class, Role::class]);
    Route::get('edit/{id}', 'edit')->name('edit')->middleware([VerifyUserExists::class, Role::class]);
    Route::post('update', 'update')->name('update');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'create')->name('loginScreen');
    Route::post('login', 'authenticate')->name('login');
    Route::get('changePassword/{id}', 'changePassword')->name('changePasswordScreen')->middleware([VerifyUserExists::class, Role::class]);
    Route::post('changePassword', 'changePasswordStore')->name('changePassword');
    Route::get('forgot-password', 'forgotPassword')->name('password.request');
    Route::post('forgot-password', 'forgotPasswordEmail')->name('password.email');
    Route::get('reset-password/{token}', 'resetPassword')->name('password.reset');
    Route::post('reset-password', 'resetPasswordStore')->name('password.update');
});

Route::prefix('posts')->controller(PostController::class)->name('posts.')->group(function () {
    Route::get('index', 'index')->name('index');
    Route::get('create', 'create')->name('create')->middleware('auth');
    Route::post('create', 'store')->name('store');
    Route::get('edit/{id}', 'edit')->name('edit')->middleware([VerifyPostExists::class, PostOwner::class]);
    Route::post('edit', 'update')->name('update')->middleware(PostOwner::class);
    Route::get('{id}', 'show')->name('show')->middleware(VerifyPostExists::class);
    Route::get('delete/{id}', 'destroy')->name('delete')->middleware([VerifyPostExists::class, PostOwner::class]);
});

Route::prefix('admin')->controller(AdminController::class)->name('admin.')->group(function() {
    Route::get('edit/users/{id}', 'editUser')->name('edit.users')->middleware(Admin::class);
    Route::get('edit/posts/{id}', 'editPost')->name('edit.posts')->middleware(Admin::class);
    Route::post('edit/users/update', 'updateUser')->name('edit.users.update');
});

// Route::get('posts/index', [PostController::class, 'index'])->name('posts.index');
// Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
// Route::post('posts/create', [PostController::class, 'store'])->name('posts.store');

// Route::get('posts/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
// Route::post('posts/edit', [PostController::class, 'update'])->name('posts.update');

// Route::get('posts/{id}', [PostController::class, 'show'])->name('posts.show');
// Route::get('posts/delete/{id}', [PostController::class, 'destroy'])->name('posts.delete');

Route::post('posts/{post_id}/comments/{user_id}', [CommentController::class, 'store'])->name('posts.comment.store');
Route::get('posts/{post_id}/comments', [CommentController::class, 'index'])->name('posts.comment.list');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');
