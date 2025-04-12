<?php

namespace App\Http\Controllers\Hostel\Admin;

use Illuminate\Http\Request;
use App\Traits\ResponseMessage;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\Hostel_Admin\UserService;

class UserController extends Controller
{
    use ResponseMessage;

    protected $user;

    public function __construct(UserService $userService)
    {
        $this->user = $userService;
    }

    public function index(Request $request){
        if($request->ajax()){
            return $this->user->getData($request);
        }

        if (Gate::allows('hostel-admin')) {
            $this->setPageData('User List');
            return view('hostel.admin.user.index');
        }else{
            return $this->unauthorized();
        }
    }

    public function create(){
        if (Gate::allows('hostel-admin')) {
            $this->setPageData('Create User');
            return view('hostel.admin.user.store-or-update');
        }else{
            return $this->unauthorized();
        }
    }

    public function storeOrUpdate(UserRequest $request){
        if($request->ajax()){
            $result = $this->user->createOrUpdate($request);
            return $this->store_message($result, $request->update_id);
        }
    }

    public function edit(int $id){
        if (Gate::allows('hostel-admin')) {
            $user =  $this->user->editUser($id);
            $this->setPageData('Edit User');
            return view('hostel.admin.user.store-or-update', ['user'=>$user]);
        }else{
            return $this->unauthorized();
        }
    }

    public function delete(Request $request){
        if($request->ajax()){
            if (Gate::allows('hostel-admin')) {
                return $this->user->deleteUser($request);
            } else {
                return $this->response_json('error',UNAUTHORIZED_MSG);
            }
        }
    }

}
