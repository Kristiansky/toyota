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

Auth::routes();

Route::middleware('auth')->group(function (){
    Route::get('/', 'HomeController@index')->name('home');
    
    Route::delete('/users/{user}/destroy', 'UserController@destroy')->name('users.destroy');
    Route::get('/users/{user}/profile', 'UserController@show')->name('users.show');
    Route::put('/users/{user}/update', 'UserController@update')->name('users.update');
    Route::put('/users/{role}/attach', 'UserController@attach')->name('users.role.attach');
    Route::put('/users/{role}/detach', 'UserController@detach')->name('users.role.detach');
    
    Route::resource('/records', 'RecordController');
    Route::post('/records', 'RecordController@index')->name('records.index');
    Route::get('/records/{record}/fill', 'RecordController@fill')->name('records.fill');
});

Route::middleware(['role:administrator'])->group(function (){
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/users/create', 'UserController@create')->name('users.create');
    Route::post('/users/store', 'UserController@store')->name('users.store');
});
