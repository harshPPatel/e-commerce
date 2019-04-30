<?php

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

// Index Page Route
Route::get('/', 'PagesController@index');

// About Page Route
Route::get('/about', 'PagesController@about');

// Contact Us Page Route
Route::get('/contact', 'PagesController@contact');

// Authentication Routes
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Categories Routes
Route::resource('/admin/categories', 'CategoriesController');

// Admin Base Routes
Route::get('/user/admin', 'HomeController@index')->name('Home');

// Logout Route
Route::get('/logout', 'Auth\LoginController@logout');
