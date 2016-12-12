<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home');
});

Route::auth();
Route::get('posts', 'PostsController@index');
Route::get('admin', 'PostsController@admin_index')->middleware('auth');
Route::get('archive/{year}/{month}', 'PostsController@archive');
Route::get('category/{category}', 'CategoriesController@index');
Route::get('tag/{tag}', 'TagsController@index');
Route::get('{post}', 'PostsController@details');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::get('posts', 'PostsController@admin_index');
    Route::get('post/create', 'PostsController@admin_create');
    Route::post('post/create', 'PostsController@admin_create');
    Route::get('post/edit/{post}', 'PostsController@admin_edit');
    Route::post('post/edit/{post}', 'PostsController@admin_edit');
    Route::get('post/delete/{post}', 'PostsController@admin_delete');
    Route::post('post/delete/{post}', 'PostsController@admin_delete');

    Route::get('pages', 'PostsController@admin_pages_index');
    Route::get('page/create', 'PostsController@admin_page_create');
    Route::post('page/create', 'PostsController@admin_page_create');
    Route::get('post/edit/{page}', 'PostsController@admin_edit');
    Route::post('post/edit/{page}', 'PostsController@admin_edit');
    Route::get('page/delete/{page}', 'PostsController@admin_delete');
    Route::post('page/delete/{page}', 'PostsController@admin_delete');

    Route::get('categories', 'CategoriesController@admin_index');
    Route::get('category/create', 'CategoriesController@admin_create');
    Route::post('category/create', 'CategoriesController@admin_create');
    Route::get('category/edit/{category}', 'CategoriesController@admin_edit');
    Route::post('category/edit/{category}', 'CategoriesController@admin_edit');
    Route::get('category/delete/{category}', 'CategoriesController@admin_delete');
    Route::post('category/delete/{category}', 'CategoriesController@admin_delete');

    Route::get('comments', 'CommentsController@admin_index');

});

