<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/test', [CustomerController::class, 'test'])->name('test');


//Insert
Route::post('/insert-customer', [CustomerController::class, 'insertCustomer']);
//Show
Route::get('/show-customer', [CustomerController::class, 'showCustomer']);
//get customer details
Route::get('/get-customer/{entity_id}', [CustomerController::class, 'getCustomerDetails']);
//Update
Route::post('/update-customer', [CustomerController::class, 'updateCustomer']);
//Delete
Route::get('/delete-customer', [CustomerController::class, 'deleteCustomer']);