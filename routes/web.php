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

Auth::routes();

Route::group([
		'prefix' => '/editor',
        'middleware' => ['auth', 'can:admin-panel']
    ], 
    function () {
    	Route::namespace('Admin')->group(function () {
    		Route::get('/', 'AdminController@index');
			Route::get('/category', 'CategoryController@index');
	    	Route::post('/category/delete', 'CategoryController@delete');
	    	Route::post('/category/create', 'CategoryController@create');
	    	Route::post('/category/edit', 'CategoryController@edit');
    	});
    }
);
