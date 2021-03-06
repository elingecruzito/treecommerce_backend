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
Route::post('/home/launcher', [App\Http\Controllers\Backend\HomeController::class, 'launcher']);

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
Route::post('/watched/add', [App\Http\Controllers\Backend\WatchedController::class, 'add']);

//---------------------------------------------------------------------------------------------------------------------

Route::post('/offers/list', [App\Http\Controllers\Backend\OffersController::class, 'list']);

//---------------------------------------------------------------------------------------------------------------------

Route::post('/inspirated/list', [App\Http\Controllers\Backend\InspiratedController::class, 'list']);

//---------------------------------------------------------------------------------------------------------------------

Route::post('/search/search', [App\Http\Controllers\Backend\SearchController::class, 'search']);

//---------------------------------------------------------------------------------------------------------------------

Route::post('/products/product', [App\Http\Controllers\Backend\ProductosController::class, 'product']);
Route::post('/products/provider', [App\Http\Controllers\Backend\ProductosController::class, 'productsByProvider']);
Route::post('/products/favorites', [App\Http\Controllers\Backend\ProductosController::class, 'favoritesListProducts']);
Route::post('/products/favorite', [App\Http\Controllers\Backend\ProductosController::class, 'setFavorite']);

//---------------------------------------------------------------------------------------------------------------------

Route::post('/providers/product', [App\Http\Controllers\Backend\ProvidersController::class, 'valorationByProduct']);

//---------------------------------------------------------------------------------------------------------------------

Route::post('/valorations/all', [App\Http\Controllers\Backend\ValorationsController::class, 'previewall']);
Route::post('/valorations/positives', [App\Http\Controllers\Backend\ValorationsController::class, 'previewpositives']);
Route::post('/valorations/negatives', [App\Http\Controllers\Backend\ValorationsController::class, 'previewnegatives']);

//---------------------------------------------------------------------------------------------------------------------

Route::post('/galery', [App\Http\Controllers\Backend\GaleryController::class, 'galery']);
Route::post('/galery/cover', [App\Http\Controllers\Backend\GaleryController::class, 'cover']);

//---------------------------------------------------------------------------------------------------------------------

Route::post('/directions/list', [App\Http\Controllers\Backend\DirectionsController::class, 'completeList']);
Route::post('/directions/states', [App\Http\Controllers\Backend\DirectionsController::class, 'getStates']);
Route::post('/directions/countrys', [App\Http\Controllers\Backend\DirectionsController::class, 'getCountry']);
Route::post('/directions/add', [App\Http\Controllers\Backend\DirectionsController::class, 'add']);

//---------------------------------------------------------------------------------------------------------------------

Route::post('/buy/add', [App\Http\Controllers\Backend\BuysController::class, 'add']);
Route::post('/buy/list', [App\Http\Controllers\Backend\BuysController::class, 'list']);

//---------------------------------------------------------------------------------------------------------------------

Route::post('/notifications/list', [App\Http\Controllers\Backend\NotificationsController::class, 'list']);
