<?php

use App\Http\Controllers\KaryawanController;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
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
Route::get('storage/{filename}', function ($filename)
{
    $path = storage_path('storage/app/icon' . $filename);
    dd($path);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});
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
// Route::post('/')
