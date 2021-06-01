<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\EventContoller;
use App\Http\Controllers\Api\customerslist;



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

// Route::get('users_list',[LoginController::class,'userList']);
// Route::resource('events',EventContoller::class);
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Routes::resource('events',EventContoller::class);

Route::post('login',[LoginController::class,'login']);
Route::middleware('auth:api')->group(function () {
   	Route::resource('events',EventContoller::class);
   	Route::resource('customer',customerslist::class);
});


//  Route::middleware(['basicAuth'])->group(function() {
//  	Route::resource('events',EventContoller::class);
// });

