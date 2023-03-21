<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Models\User;
use App\Notifications\ResetPasswordVerificationNotification;


class ForgotPasswordController extends Controller
{
    public function forgotPassword(ForgotPasswordRequest $request){
        $input=$request->only('email');
        $user=User::where('email',$input)->first();
        $user->notify(new ResetPasswordVerificationNotification());
        $success['success']=true;
        return response()->json($success,200);
    }
}
