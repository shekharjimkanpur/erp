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

Route::get('/generate-pdf','PDFController@generatePDF');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home/addclient', 'HomeController@addClient');
Route::post('/home/adddept', 'HomeController@addDept');
Route::post('/home/addtestMethods', 'HomeController@addtestMethods');
Route::post('/home/addtestMethodsParams', 'HomeController@addtestMethodsParams');
Route::get('/home/getDepts', 'HomeController@getDepts');
Route::get('/addtest/getTestParams', 'add_test@getTestParams');

Route::get('/addtest', 'add_test@index')->name('addtest');
Route::post('/submit_test','add_test@add_newtest');
Route::get('/edit_test','add_test@edit_test');
