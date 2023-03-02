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

//Auth::routes();

Route::get('/', function (){
    abort(404);
})->name('no-input');



Route::get('/guest/s/default', [App\Http\Controllers\InitialProcessController::class, 'start'])->name('start');


Route::get('/wifi/connect', [App\Http\Controllers\WelcomeController::class, 'create'])->name('wifi.form');

Route::name('access.')->prefix('access')->group(function () {

    Route::post('/verify', [App\Http\Controllers\InitialProcessController::class, 'verify'])->name('verify');
    Route::get('/show_code', [App\Http\Controllers\InitialProcessController::class, 'showCode'])->name('show_code');
    Route::get('/register', [App\Http\Controllers\InitialProcessController::class, 'register'])->name('register');
    Route::post('/register/store', [App\Http\Controllers\InitialProcessController::class, 'store'])->name('register.store');


    //throttle connection
    Route::middleware('throttle:3,1')->post('connect', [App\Http\Controllers\InitialProcessController::class, 'connect'])->name('connect');


});


Route::name('wifi.')->prefix('wifi')->group(function () {



});









Route::post('/wifi/process', [App\Http\Controllers\WelcomeController::class, 'store'])->name('wifi.process');

Route::get('/wifi/connected', [App\Http\Controllers\WelcomeController::class, 'show'])->name('wifi.connected');

Route::get('/wifi/error', [App\Http\Controllers\WelcomeController::class, 'error'])->name('wifi.error');

Route::get('/registration', [App\Http\Controllers\WelcomeController::class, 'register'])->name('registration');






Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
