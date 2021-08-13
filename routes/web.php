<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use \App\Http\Controllers\CommentController;
use \App\Http\Controllers\cmsController;
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
Route::get('/news',[PagesController::class, 'news']);
Route::get('/news/{news}',[PagesController::class, 'showNews']);
Route::post('/search', [PagesController::class, 'search']);

// Routes to sort movies
Route::get('/movie/latest',[MoviesController::class, 'latest']);
Route::get('/movie/commented',[MoviesController::class, 'commented']);
Route::get('/movie/coming',[MoviesController::class, 'coming']);

Route::resource('movies',MoviesController::class);
Route::resource('contact',ContactController::class);
Route::resource('comment',CommentController::class);


Auth::routes();

Route::get('/home/{id}', [HomeController::class, 'index'])->name('home');
Route::post('/edit_user', [HomeController::class, 'edit']);

// Routes concerning CMS
Route::get('/cms',[cmsController::class, 'index'])->name('cms');
Route::get('/cms/news',[cmsController::class, 'news'])->name('cms');
Route::get('/cms/movies',[cmsController::class, 'movies'])->name('cms');
Route::get('/cms/comments',[cmsController::class, 'comments'])->name('cms');
Route::get('/cms/users',[cmsController::class, 'users'])->name('cms');
Route::get('/cms/contact_page',[cmsController::class, 'contact_page'])->name('cms');
/*
/cms
/news
/movies
/comments
/users
/contact_page

 */
