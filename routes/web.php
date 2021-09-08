<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    //only authenticated users can access these routes
    Route::get('/contact-tracing', [App\Http\Controllers\UserController::class, 'traceIndex']);
    Route::post('/trace-user',  [App\Http\Controllers\UserController::class, 'traceUser']);
    Route::post('/update-location', [App\Http\Controllers\UserController::class, 'updateLocation']);
});