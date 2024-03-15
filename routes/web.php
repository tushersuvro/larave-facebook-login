<?php

use App\Http\Controllers\SocialController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('auth/facebook', [SocialController::class, 'facebookRedirect'])->name('login.facebook');

Route::get('auth/facebook/callback', [SocialController::class, 'facebookCallback']);

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'facebookCallback'])->name('dashboard');
