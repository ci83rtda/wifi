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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/', function (){
    dd('no input provided');
})->name('welcome');

Route::get('/guest/s/default', [App\Http\Controllers\WelcomeController::class, 'index'])->name('wifi.initiator');

Route::get('/wifi/connect', [App\Http\Controllers\WelcomeController::class, 'create'])->name('wifi.form');

Route::post('/wifi/process', [App\Http\Controllers\WelcomeController::class, 'store'])->name('wifi.process');

Route::get('/wifi/connected', [App\Http\Controllers\WelcomeController::class, 'show'])->name('wifi.connected');

Route::get('/wifi/error', [App\Http\Controllers\WelcomeController::class, 'error'])->name('wifi.error');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
