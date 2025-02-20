<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showForm(){
        $user = Auth::user();
        return view('profile',compact('user'));
    }

    public function profileUpdate(ProfileRequest $request){
        if($request->ajax()){
            $collection = collect($request->validated());
            $image = $request->old_image;
            if($request->hasFile('image')){
                if(!empty($request->old_image)){
                    $this->deleteFile($request->old_image);
                }
                $image = $this->uploadFile($request->file('image'),USER_IMAGE_PATH);
            }

            $collection = $collection->merge(compact('image'));
            $data = User::find(auth()->user()->id);
            if($data){
                $data->update($collection->all());
                return response()->json(['status'=>'success','message'=>'Profile updated successfull.']);
            }else{
                return response()->json(['status'=>'error','message'=>'Profile cannot updated!']);
            }
        }
    }

    public function passwordUpdate(PasswordRequest $request){
        if($request->ajax()){

        }
    }
}
