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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['web']], function () {
    //Route::get('/', function() {
    //    return view('posts.index');
    //});
    Route::get('/', 'PostsController@index');

    Route::get('/posts/index', 'PostsController@index');
    Route::get('/posts/create', 'PostsController@create');
    Route::get('/posts/{id}', 'PostsController@show');
    Route::get('/posts/{id}/edit', 'PostsController@edit');
    Route::post('/posts', 'PostsController@store');
    Route::patch('/posts/{id}', 'PostsController@update');
    Route::delete('/posts/{id}', 'PostsController@destroy');
    
    Route::post('/posts/{post}/comments', 'CommentsController@store');
    Route::delete('/posts/{post}/comments/{comment}', 'CommentsController@destroy');

    Route::get('/categories/create', 'CategoriesController@create');
    Route::post('/categories', 'CategoriesController@store');

    Route::get('/auth/admin/index', 'Auth\AdminController@index');

    Route::post('/pictures', 'PicturesController@store');
    Route::get('/pictures/{name}', ['as' => 'picture.response', 'uses' => 'PicturesController@response']);
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
