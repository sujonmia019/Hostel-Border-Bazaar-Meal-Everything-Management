<?php

namespace App\Repositories;

use App\Models\User;
use App\Constants\Constants;
use Illuminate\Http\Request;
use App\Interface\UserInterface;
use App\Traits\UploadAble;

class UserRepository {

    use UploadAble;

    public function userUpdateOrCreate($request){
        $collection = collect($request->validated());
        $role_id    = Constants::BORDER_ROLE;
        $hostel_id  = auth()->user()->hostel_id;
        $username   = auth()->user()->username;
        $image      = $request->old_image;
        // image upload
        if($request->hasFile('image')){
            $image = $this->uploadDataFile($request->file('image'),auth()->user()->username.'/'.USER_IMAGE_PATH);
        }

        $collection = $collection->merge(compact('role_id','username','hostel_id','image'));
        $result     = User::updateOrCreate(['id'=>$request->update_id],$collection->all());
        return $result ;
    }

}
