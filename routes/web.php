<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
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

Route::get('/', function() {
    return to_route('chats.index');
})->name('home');

Route::prefix('auth')->controller(AuthController::class)->group(function() {
    Route::get('login', 'login')->name('auth.login');
    Route::get('register', 'register')->name('auth.register');
    Route::post('store', 'store')->name('auth.store');
    Route::post('authenticate', 'authenticate')->name('auth.authenticate');
    Route::post('logout', 'logout')->name('auth.logout');
});


Route::resource('chats', ChatController::class);

Route::resource('messages', MessageController::class)
    ->except(['index', 'show']);
