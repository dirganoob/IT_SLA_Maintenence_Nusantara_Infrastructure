<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:sanctum')->post('/user', function (Request $request) {      
    return $request->user();
});

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function($router){
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
});

// Main Route

Route::get('/scheadule', 'App\Http\Controllers\ScheaduleController@scheadule');
Route::get('/toll', 'App\Http\Controllers\ActivityController@toll');
Route::get('/nontoll', 'App\Http\Controllers\ActivityController@nontoll');
Route::get('/pengembangan', 'App\Http\Controllers\ActivityController@pengembangan');
Route::get('/location', 'App\Http\Controllers\LocationController@location');
Route::get('/kategori', 'App\Http\Controllers\KategoriController@kategori');
Route::get('/users', 'App\Http\Controllers\UsersController@users');
Route::get('/allusers', 'App\Http\Controllers\UsersController@allusers');
Route::get('/dashboard', 'App\Http\Controllers\pages@index');



