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
Route::get('/', 'Blog\ImagesController@index');
Auth::routes();
Route::get('/show/{id}', 'Blog\ImagesController@show');
Route::post('/vote/{id}', 'Blog\ImagesController@vote');

Route::group(['middleware' => ['status', 'auth']], function (){
    $groupData = [
    ];

    Route::group($groupData, function (){
        Route::get('admin/create', function () {
            return view('blog.admin.create');
        });
        Route::get('admin/edit/{id}', 'Blog\ImagesController@edit');
        Route::post('admin/store', 'Blog\ImagesController@store');
        Route::post('admin/update/{id}', 'Blog\ImagesController@update');
        Route::resource('admin/index', 'Blog\Admin\MainController');
        Route::post('admin/destroy/{id}', 'Blog\ImagesController@destroy');
    });
});
