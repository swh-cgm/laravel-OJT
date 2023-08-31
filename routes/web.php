<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\CommentOwner;
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
    return redirect()->route('posts.index');
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
    Route::get('{id}', 'show')->name('show')->middleware([VerifyPostExists::class]);
    Route::get('delete/{id}', 'destroy')->name('delete')->middleware([VerifyPostExists::class, PostOwner::class]);
});

Route::prefix('admin')->controller(AdminController::class)->name('admin.')->group(function() {
    Route::get('index', 'index')->name('index')->middleware(Admin::class);
    Route::get('edit/users/{id}', 'editUser')->name('edit.users')->middleware([Admin::class, VerifyUserExists::class]);
    Route::post('edit/users', 'editUserForm')->name('edit.users.form');
    Route::get('edit/posts/{id}', 'editPost')->name('edit.posts')->middleware([Admin::class, VerifyPostExists::class]);
    Route::post('edit/posts', 'editPostForm')->name('edit.posts.form');
    Route::post('edit/users/update', 'updateUser')->name('edit.users.update');
    Route::get('file/csv', 'csvShow')->middleware(Admin::class)->name('file.csv.show');
    Route::get('file/csv/postTableDownload', 'postCsvDownload')->middleware(Admin::class)->name('file.csv.posts.download');
    Route::post('file/csv/userCsvUpload', 'postCsvUpload')->name('file.csv.posts.upload');
});

Route::controller(CommentController::class)->group(function(){
    Route::post('posts/{post_id}/comments/{user_id}', 'store')->name('posts.comment.store');
    Route::get('comments/delete/{id}', 'destroy')->middleware(CommentOwner::class)->name('comments.delete');
    Route::post('comments/update/{id}', 'update')->middleware(CommentOwner::class)->name('comments.update');
});

Route::get('logout', [AuthController::class, 'logout'])->name('logout');
