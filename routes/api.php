<?php

use App\Http\Controllers\KaryawanController;
use Illuminate\Http\Request;
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
// Route::post('/')
