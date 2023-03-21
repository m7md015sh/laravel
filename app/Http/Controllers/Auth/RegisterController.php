<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Notifications\EmailVerificationNotification;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class RegisterController extends Controller
{
    public function  register(RegistrationRequest $request){
        $newUser=$request->validated();
        $newUser['password']=Hash::make($newUser['password']);
        $newUser['role']='user';
        $newUser['status']='active';
        $user=User::create($newUser);
        $success['token']=$user->createToken('user',['app:all'])->plainTextToken;
        $success['name']=$user->first_name;
        $success['success']=true;
        $user->notify(new EmailVerificationNotification());
        return response()->json($success,200);
    }
}
