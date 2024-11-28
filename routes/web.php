<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\VisitorController;
use App\Models\Visitor;
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

Route::group(['prefix' => 'event', 'as' => 'event.'], function () {
    Route::get('{slug}', [EventController::class, 'show'])->name('show');

    Route::get('{slug}/register', [EventController::class, 'register'])->name('register');
});

// Route::get('test-main', function () {

//     $visitor = Visitor::find(103);

//     return new App\Mail\VisitorMail($visitor);
// });
