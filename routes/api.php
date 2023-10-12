<?php

use App\Http\Controllers\user\BillingController;
use App\Http\Controllers\user\MasterController;
use App\Http\Controllers\user\SellersLabel;
use App\Http\Controllers\user\User;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[User::class,'create_account']);
Route::post('/otp-validation',[User::class,'otp_validation']);
Route::post('/resend-otp',[User::class,'resend_otp']);
Route::post('/change-password',[User::class,'new_password']);
Route::post('/login',[User::class,'login']);





Route::middleware('auth:sanctum','ability:U')->group(function(){
    Route::post('/add_unit',[MasterController::class,'add_unit']);
    Route::get('/list_unit',[MasterController::class,'list_unit']);


    Route::post('/add_catagory',[MasterController::class,'add_catagory']);
    Route::get('/list_catagory',[MasterController::class,'list_catagory']);


    Route::post('/add_food',[MasterController::class,'add_food']);
    Route::get('/list_food',[MasterController::class,'list_food']);
    Route::get('/search_food',[MasterController::class,'search_food']);

    Route::post('/create_bill',[BillingController::class,'create_bill']);
    Route::get('/list_bill',[BillingController::class,'list_bill']);


    Route::post('/add_sellers',[SellersLabel::class,'createSellers']);
    //===================logout=========================
    Route::post('/logout',[User::class,'logout']);
});
