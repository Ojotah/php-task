<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChangePasswordController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');

Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments.store')->middleware('auth');

Route::get('/rgister', [AuthController::class, 'register'])->name('register');
Route::post('/rgister', [AuthController::class, 'store']);

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('users', UserController::class)->only('show', 'edit', 'update')->middleware('auth');
Route::get('profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');

Route::get('change-password', [ChangePasswordController::class, 'index'])->name('change-password')->middleware('auth');
Route::post('change-password', [ChangePasswordController::class, 'changePassword'])->middleware('auth');

Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('auth');
