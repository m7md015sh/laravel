<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\forgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\SliderController;
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

Route::middleware('setapplang')->prefix('{locale}')->group(function(){

    Route::post('register',[RegisterController::class,'register']);
    Route::post('login',[LoginController::class,'login']);
    
    Route::post('password/forgot-password',[ForgotPasswordController::class,'forgotPassword']);
    Route::post('password/reset-password',[ResetPasswordController::class,'resetPassword']);
    
});





Route::middleware(['auth:sanctum','setapplang'])->prefix('{locale}')->group(function (){
    Route::get('/profile', function (Request $request) {
        return $request->user();
    });
    Route::post('/update-profile',[ProfileController::class,'update']);
   Route::post('email-verification',[EmailVerificationController::class,'email_verification']);
   Route::get('email-verification',[EmailVerificationController::class,'sendEmailVerification']);
});
Route::post('slider', [SliderController::class, 'store']); 
Route::get('get_all_sliders', [SliderController::class, 'index']); 
Route::get('slider/{id}', [SliderController::class, 'show']); 
Route::post('update_slider/{id}', [SliderController::class, 'update']);
Route::post('delete_slider/{id}', [SliderController::class, 'destroy']);
