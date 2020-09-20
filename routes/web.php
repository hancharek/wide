<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\RetornoController;

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

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('projects', ProjectController::class);
Route::resource('urls', UrlController::class);
Route::resource('retornos', RetornoController::class);
Route::post('/urlpesquisa','UrlsController@searchContent')->name('url.pesquisa');
