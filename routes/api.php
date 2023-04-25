<?php

use App\Http\Controllers\Api\AllController;
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

Route::get('all-list',[AllController::class,'getAllData']);

Route::prefix('category')->group(function(){
    Route::post('create',[AllController::class,'categoryCreate']);
    Route::get('delete/{id}',[AllController::class,'categoryDelete']);
    Route::post('edit/{id}',[AllController::class,'updateCategory']);
    Route::get('categoty-list/{id}',[AllController::class,'categoryDetail']);
});

Route::prefix('contact')->group(function(){
    Route::post('create',[AllController::class,'contactCreate']);
});
