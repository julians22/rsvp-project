<?php

use App\Http\Controllers\EventController;
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
    return view('register-visitor');
});

Route::group(['prefix' => 'event', 'as' => 'event.'], function() {
    Route::get('{slug}', [EventController::class, 'show'])->name('show');

    Route::get('{slug}/register', [EventController::class, 'register'])->name('register');
});
