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

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('admin');

Route::group(['prefix' => 'admin', 'middleware'=> 'auth'], function (){

    Route::get('posts/trashed',  [
        'uses' => 'PostController@trashed',
        'as' => 'posts.trashed'
    ]);
    Route::get('posts/kill/{id}',  [
        'uses' => 'PostController@kill',
        'as' => 'posts.kill'
    ]);
    Route::get('posts/restore/{id}',  [
        'uses' => 'PostController@restore',
        'as' => 'posts.restore'
    ]);
    Route::resource('posts', 'PostController');
    Route::resource('categories', 'CategoryController');
    Route::resource('tags', 'TagController');
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions','PermissionController');

});