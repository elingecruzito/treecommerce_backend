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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//---------------------------------------------------------------------------------------------------------------------
Route::post('/login/authenticate', [App\Http\Controllers\Auth\LoginController::class, 'authenticate']);

Route::get('/home/carrucel', [App\Http\Controllers\Backend\HomeController::class, 'carrucel']);
Route::post('/home/lastView', [App\Http\Controllers\Backend\HomeController::class, 'lastView']);
Route::post('/home/offers', [App\Http\Controllers\Backend\HomeController::class, 'offers']);
