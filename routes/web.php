<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use \App\Http\Controllers\CommentController;
use \App\Http\Controllers\newsController;
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

Route::get('/',[PagesController::class, 'index']);
Route::post('/search', [PagesController::class, 'search']);

// Routes to sort movies
Route::get('/movie/latest',[MoviesController::class, 'latest']);
Route::get('/movie/commented',[MoviesController::class, 'commented']);
Route::get('/movie/coming',[MoviesController::class, 'coming']);

Route::resource('movies',MoviesController::class);
Route::resource('contact',ContactController::class);
Route::resource('comment',CommentController::class);
Route::resource('news', newsController::class);

Auth::routes();

Route::get('/home/{id}', [HomeController::class, 'index'])->name('home');
Route::post('/edit_user', [HomeController::class, 'edit']);

