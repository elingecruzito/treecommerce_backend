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

\DB::enableQueryLog();

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//---------------------------------------------------------------------------------------------------------------------

Route::post('/login/authenticate', [App\Http\Controllers\Auth\LoginController::class, 'authenticate']);

//---------------------------------------------------------------------------------------------------------------------

Route::get('/home/carrucel', [App\Http\Controllers\Backend\HomeController::class, 'carrucel']);
Route::post('/home/lastView', [App\Http\Controllers\Backend\HomeController::class, 'lastView']);
Route::post('/home/offers', [App\Http\Controllers\Backend\HomeController::class, 'offers']);
Route::post('/home/inspirated', [App\Http\Controllers\Backend\HomeController::class, 'inspirated']);
Route::post('/home/history', [App\Http\Controllers\Backend\HomeController::class, 'history']);

//---------------------------------------------------------------------------------------------------------------------

Route::post('/watched/list', [App\Http\Controllers\Backend\WatchedController::class, 'completeList']);

//---------------------------------------------------------------------------------------------------------------------

Route::post('/offers/list', [App\Http\Controllers\Backend\OffersController::class, 'list']);

//---------------------------------------------------------------------------------------------------------------------

Route::post('/inspirated/list', [App\Http\Controllers\Backend\InspiratedController::class, 'list']);

//---------------------------------------------------------------------------------------------------------------------

Route::post('/search/search', [App\Http\Controllers\Backend\SearchController::class, 'search']);

//---------------------------------------------------------------------------------------------------------------------

Route::post('/products/product', [App\Http\Controllers\Backend\ProductosController::class, 'product']);
Route::post('/products/provider', [App\Http\Controllers\Backend\ProductosController::class, 'productsByProvider']);

//---------------------------------------------------------------------------------------------------------------------

Route::post('/providers/product', [App\Http\Controllers\Backend\ProvidersController::class, 'valorationByProduct']);

//---------------------------------------------------------------------------------------------------------------------

Route::post('/galery', [App\Http\Controllers\Backend\GaleryController::class, 'galery']);
Route::post('/galery/cover', [App\Http\Controllers\Backend\GaleryController::class, 'cover']);
