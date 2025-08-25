<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::post('/store-post', [HomeController::class, 'store'])->name('post.store')->middleware('auth');
Route::post('/delete-post/{post}', [HomeController::class, 'deletePost'])->name('post.deletePost')->middleware('auth');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware('auth');
Route::post('/share-to-profile/{post}', [HomeController::class, 'shareToProfile'])->name('post.shareToProfile')->middleware('auth');
Route::post('/like/{post}', [HomeController::class, 'toggleLike'])->name('post.like')->middleware('auth');
Route::post('/delete-share/{post}', [HomeController::class, 'deleteShare'])->name('post.deleteShare')->middleware('auth');

// web.php
Route::post('/feed/update-duration', [HomeController::class, 'updateDuration'])->name('feed.updateDuration');

// Route::get('/', function () {
//     return view('welcome');
// });
