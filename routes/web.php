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

// Route::get('/', function () {
//     return view('welcome');
// });



//Admin Coontroller
Route::get('/adminLogin','AdminController@adminLogin')->name('adminLogin');
Route::get('/adminRegister','AdminController@adminRegister')->name('adminRegister');
Route::post('/registerAdmin','AdminController@registerAdmin')->name('registerAdmin');
Route::get('/adminLogout','AdminController@adminLogout')->name('adminLogout');
Route::post('/loginCheck','AdminController@loginCheck')->name('loginCheck');
Route::post('/changeRole','AdminController@changeRole')->name('changeRole');


//My Controller
Route::get('/','MyController@index')->name('index')->middleware('admin');
Route::post('/insertproduct','MyController@insertproduct')->name('insertproduct');
Route::post('/updateproduct','MyController@updateproduct')->name('updateproduct');
Route::get('/getproduct','MyController@getproduct')->name('getproduct');
Route::post('/deleteproduct','MyController@deleteproduct')->name('deleteproduct');

