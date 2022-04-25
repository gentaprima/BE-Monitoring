<?php

use App\Http\Controllers\KaryawanController;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// AUTH

Route::post('/auth','AuthController@login');

Route::get('/karyawan','KaryawanController@index');
Route::post('/karyawan','KaryawanController@store');
Route::put('/karyawan/{id}','karyawanController@update');
Route::delete('/karyawan/{id}','KaryawanController@destroy');

Route::get('/jabatan','JabatanController@index');
Route::post('/jabatan','JabatanController@store');
Route::put('/jabatan/{id}','JabatanController@update');
Route::delete('/jabatan/{id}','JabatanController@destroy');

Route::get('/product','ProductController@index');
Route::post('/product','ProductController@store');
Route::put('/product/{id}','ProductController@update');
Route::delete('/product/{id}','ProductController@destroy');
Route::get('/product/get-by-category/{id}','ProductController@getByCategory');

Route::get('/alasan','ReasonController@index');
Route::post('/alasan','ReasonController@store');
Route::put('/alasan/{id}','ReasonController@update');
Route::delete('/alasan/{id}','ReasonController@destroy');
Route::get('/alasan/get-by-type/{id}','ReasonController@index');

Route::get('/category-product','CategoryProductController@index');
Route::post('/category-product','CategoryProductController@store');
Route::put('/category-product/{id}','CategoryProductController@update');
Route::delete('/category-product/{id}','CategoryProductController@destroy');

Route::get('/program','ProgramController@index');
Route::post('/program','ProgramController@store');
Route::put('/program/{id}','ProgramController@update');
Route::delete('/program/{id}','ProgramController@destroy');
Route::get('/program/get-by-product/{id}','ProgramController@getByProduct');

Route::put('/account/update-profile/{id}','AccountController@updateProfile');
Route::put('/account/update-password/{id}','AccountController@changePassword');

Route::get('/leads/{id}','LeadsController@index');
Route::post('/leads/{id}','LeadsController@store');
Route::put('/leads/{id}','LeadsController@update');
Route::delete('/leads/{id}','LeadsController@destroy');

Route::post("/leads-product/{id}",'LeadsProductController@store');
Route::get("/leads-product/get-by-status/",'LeadsProductController@index');
Route::put("/leads-product/update-response/{id}",'LeadsProductController@update');

Route::get("/dashboard/{id}",'DashboardController@index');



Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});
// Route::post('/')
