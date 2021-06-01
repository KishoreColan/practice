<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomersController;
use App\Http\Middleware\AuthRestrict;

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

Auth::routes();


// Route::get('/home/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');

Route::get('/home', [App\Http\Controllers\EventController::class, 'index'])->name('home');

// Route::get('/event_create', [App\Http\Controllers\EventController::class, 'create'])->name('create');

Route::resource('event','App\Http\Controllers\EventController');



Route::any('/Bus/booking', [App\Http\Controllers\BusController::class, 'create'])->name('booking');


Route::get('/Bus/payment', [App\Http\Controllers\BusController::class, 'payprocess'])->name('payment');

Route::any('/Bus/booked/{id?}', [App\Http\Controllers\BusController::class, 'paybook'])->name('booked');


Route::resource('Bus','App\Http\Controllers\BusController');



Route::resource('customer','App\Http\Controllers\CustomersController');
Route::get('customers/list',[CustomersController::class,'customerList']);
Route::get('customers/all',[CustomersController::class,'allCustomers']);
Route::get('customers/complete/{id}',[CustomersController::class,'statusChange']);

Route::middleware([AuthRestrict::class])->group(function(){
	Route::get('customer/{UserID}/edit', [CustomersController::class,'view']);
});
