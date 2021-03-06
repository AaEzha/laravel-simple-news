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

// Route::get('/', function () {
//     return view('welcome');
// })->name('blog');

Route::get('/', 'BlogController@index')->name('blog');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/blank', function () {
    return view('blank');
})->name('blank');

Route::middleware('auth')->group(function() {
    Route::resource('basic', BasicController::class);
    Route::resource('category', CategoryController::class)->except('show');
    Route::resource('article', ArticleController::class)->except('show');

    // export
    Route::get('article/export/excel', ExportArticleController::class)->name('article.export-excel');
    Route::get('article/export/pdf', ExportArticlePDFController::class)->name('article.export-pdf');
});

// Route::get('/titles', 'BlogController@titles')->name('titles');
// Route::get('/user_views', 'BlogController@user_views')->name('user_views');
Route::get('/{article:slug}', 'BlogController@show')->name('read');
