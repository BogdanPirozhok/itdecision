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

Route::get('/','Auth\LoginController@showLoginForm')->name('home');

Route::post('/login',  'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout');

Route::group([
		'prefix' => '/home',
        'middleware' => ['auth', 'can:dev-panel']
    ],
    function () {
    	Route::namespace('Home')->group(function () {
    		Route::get('/', 'HomeController@index');

	    	Route::post('/category/delete', 'TasksController@delete');
	    	Route::post('/category/create', 'TasksController@create');
	    	Route::post('/category/edit',   'TasksController@edit');
    	});
    }
);
