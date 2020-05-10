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

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/blog/posts/{post}', 'PostController@show')->name('blog.show');

Route::get('/blog/categories/{category}', 'PostController@category')->name('blog.category');
Route::get('/blog/tags/{tag}', 'PostController@tag')->name('blog.tag');


Auth::routes();


Route::middleware(['auth'])->group(function (){

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('categories','CategoryController');
    Route::resource('tags','TagController');
    Route::resource('posts','PostController');
    Route::get('trashed-posts','PostController@trashed')->name('trashed-posts.index');
    Route::put('restored-posts/{post}','PostController@restore')->name('restored-posts');



});


Route::middleware(['auth','admin'])->group(function (){

    Route::get('/users', 'UserController@index')->name('users.index');
    Route::post('/users/{user}/make-admin', 'UserController@makeAdmin')->name('users.make-admin');
    Route::get('/users/profile', 'UserController@edit')->name('users.edit-profile');
    Route::put('/users/update-profile', 'UserController@update')->name('users.update-profile');
    Route::get('/users/profile', 'UserController@edit')->name('users.edit-profile');
    Route::put('/users/update-profile', 'UserController@update')->name('users.update-profile');


});

