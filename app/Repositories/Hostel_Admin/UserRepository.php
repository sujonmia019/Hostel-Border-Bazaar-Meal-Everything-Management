<?php

namespace App\Repositories\Hostel_Admin;

use App\Models\User;
use App\Traits\UploadAble;
use App\Constants\Constants;
use Illuminate\Http\Request;
use App\Traits\ResponseMessage;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use App\Interfaces\Hostel_Admin\UserInterface;

class UserRepository implements UserInterface {

    use UploadAble, ResponseMessage;

    public function getAllUsers($request){
        $getData = User::where('username', auth()->user()->username)->orderBy('id','DESC');

        return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->filter(function ($query) use ($request) {
                if (!empty($request->search)) {
                    $query->where('name', 'LIKE', "%$request->search%")
                        ->orWhere('email', 'LIKE', "%$request->search%");
                }
            })
            ->addColumn('role', function($row){
                return '<span class="badge bg-warning text-dark rounded-0">'.USER_ROLE[$row->role].'</span>';
            })
            ->addColumn('image', function($row){
                return user_image($row->image,$row->name);
            })
            ->addColumn('gender', function($row){
                return GENDER[$row->gender];
            })
            ->addColumn('status', function($row){
                return change_status($row->id,$row->status, $row->name);
            })
            ->addColumn('created_at', function($row){
                return dateFormat($row->created_at, 'd-m-Y h:i A');
            })
            ->addColumn('action', function($row){
                $action = '<div class="d-flex align-items-center justify-content-end">';
                $action .= '<a href="'.route('app.hostel-admin.borders.edit', $row->id).'" class="btn-style btn-style-edit me-1"><i class="fa fa-edit"></i></a>';

                $action .= '<button type="button" class="btn-style btn-style-danger delete_data" data-id="' . $row->id . '" data-name="' . $row->name . '"><i class="fa fa-trash"></i></button>';
                $action .= '</div>';

                return $action;
            })
            ->rawColumns(['role','image','status','action'])
            ->make(true);
    }

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

        if (!empty($request->password)) {
            $password = $collection->merge(['password' => Hash::make($request->password)]);
        }

        $collection = $collection->merge(compact('role_id','username','hostel_id','image'));
        $result     = User::updateOrCreate(['id'=>$request->update_id],$collection->all());
        return $result ;
    }

    public function edit(int $id){
        $data = User::where(['username'=>auth()->user()->username,'id'=>$id])->firstOrFail();
        return $data;
    }

    public function delete($request){
        $result = User::find($request->id);
        if($result){
            $this->deleteFile($result->image);
            $result->delete();
            return $this->delete_message($result);
        }
    }

}
