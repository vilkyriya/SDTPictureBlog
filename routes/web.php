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

//Route::get('/', function () {
//    return view('blog.mainboard');
//});

Route::group(['middleware' => ['status', 'auth']], function (){
    $groupData = [
    ];

    Route::group($groupData, function (){
        Route::resource('admin/index', 'Blog\Admin\MainController');
        Route::resource('admin/destroy', 'Blog\ImagesController');
        Route::resource('admin/edit', 'Blog\ImagesController');
        Route::resource('admin/create', 'Blog\Admin\MainController');
    });

Route::get('/', 'Blog\ImagesController@index');
Route::get('/show', 'Blog\ImagesController@show');

Auth::routes();



});
