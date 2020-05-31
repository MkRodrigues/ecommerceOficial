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

// Route::get('/linkstorage', function () {
//     Artisan::call('storage:link');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('products', 'ProductsController');
    Route::resource('categories', 'CategoriesController');
    Route::resource('tags', 'TagsController');
    Route::get('trashed-product', 'ProductsController@trashed')->name('trashed-products.index');
    Route::get('trashed-category', 'CategoriesController@trashed')->name('trashed-categories.index');
    Route::get('trashed-tag', 'TagsController@trashed')->name('trashed-tags.index');
    Route::put('restore-products/{product}', 'ProductsController@restore')->name('restore-products.update');
    Route::put('restore-categories/{categories}', 'CategoriesController@restore')->name('restore-categories.update');
    Route::put('restore-tags/{tag}', 'TagsController@restore')->name('restore-tags.update');
});