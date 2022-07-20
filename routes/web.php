<?php

use App\Category;
use App\User;
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
    $data = [];
    $data['category'] = Category::all();
    $data['user'] = User::all();
    return view('index',compact(['data']));
});

Route::get('/login','UserController@loginPage')->name('login');
Route::get('/logout','UserController@logout')->name('logout');
Route::get('/captcha','UserController@captcha')->name('captcha');
Route::get('/list','GardenController@listPage')->name('list');
Route::get('/detail/{id}','BorderController@viewPage')->name('detail');
Route::get('/border','BorderController@borderPage')->name('border');
Route::get('/accept','BorderController@accept')->name('accept');
Route::get('/my','MyController@myPage')->name('my');
Route::get('/set','MyController@setPage')->name('set');
Route::get('/view/{id}','GardenController@viewPage')->name('view');

Route::post('/set','MyController@set')->name('set');
Route::post('/write','BorderController@write')->name('write');
Route::post('/create','BorderController@create')->name('create');
Route::post('/login','UserController@login')->name('login');
Route::post('/sign','UserController@sign')->name('sign');
