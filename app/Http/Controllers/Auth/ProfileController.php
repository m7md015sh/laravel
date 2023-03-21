<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ProfileUpdateRequest;
use App\Traits\ImageProcessing;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use ImageProcessing;
    public function update(ProfileUpdateRequest $request){
        $user =$request->user();
        $validateData=$request->validated();
        if ($request->hasFile('image')){
            $this->deleteImage($user->image);
            $validateData['image']=$this->saveImage($request->file('image'));
        }
        $user->update($validateData);
        $user=$user->refresh();
        $user->image? $user->image=$user->image_url:'';
        $user->image_url;
        $success['user']=$user;
        $success['success']=true;
        return response()->json($success,200);
    }
}
