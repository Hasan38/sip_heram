<?php

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
 
Route::post("login",[App\Http\Controllers\Api\LoginController::class,'login']);
Route::post("register",[App\Http\Controllers\Api\LoginController::class,'register']);
Route::get("kelurahan",[App\Http\Controllers\Api\KelurahanController::class,'index']);

Route::group(['prefix' => config('sanctum.prefix', 'v1'),'middleware' => 'auth:sanctum'], function(){
    Route::post("profile",[App\Http\Controllers\Api\PemohonController::class,'profile']);
   
    

});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
     return '<h1>Cache facade value cleared</h1>';
});




