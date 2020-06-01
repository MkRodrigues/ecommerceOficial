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

// Route::get('/linkstorage', function () {
//     Artisan::call('storage:link');
// });

// Qualquer usuário pode acessar
Auth::routes();
Route::get('/', 'HomeController@show');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search/category/{category}', 'HomeController@searchCategory')->name('search-category');
Route::get('/search/tag/{tag}', 'HomeController@searchTag')->name('search-tag');

// Somente os usuários autenticados
Route::middleware(['auth'])->group(function () {
    Route::get('user/profile', 'UsersCOntroller@edit')->name('users.edit-profile');
    Route::put('user/profile', 'UsersCOntroller@update')->name('users.update-profile');
});

// Estas rotas somente podem ser acessadas por usuário autenticados e que forem administradores (Kernel admin / Middleware VerifyisAdmin)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('products', 'ProductsController');
    Route::resource('categories', 'CategoriesController');
    Route::resource('tags', 'TagsController');
    Route::get('trashed-product', 'ProductsController@trashed')->name('trashed-products.index');
    Route::get('trashed-category', 'CategoriesController@trashed')->name('trashed-categories.index');
    Route::get('trashed-tag', 'TagsController@trashed')->name('trashed-tags.index');
    Route::put('restore-products/{product}', 'ProductsController@restore')->name('restore-products.update');
    Route::put('restore-categories/{categories}', 'CategoriesController@restore')->name('restore-categories.update');
    Route::put('restore-tags/{tag}', 'TagsController@restore')->name('restore-tags.update');
    Route::get('users', 'UsersController@index')->name('users.index');
    Route::put('users/{user}/change-admin', 'UsersController@changeAdmin')->name('users.change-admin');
});
