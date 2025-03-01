<?php

namespace App\Http\Controllers\Hostel\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Traits\ResponseMessage;
use App\Traits\UploadAble;
use Yajra\DataTables\Facades\DataTables;

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

        $this->setPageData('User List');
        return view('hostel.admin.user.index');
    }

    public function create(){
        $this->setPageData('Create User');
        return view('hostel.admin.user.store-or-update');
    }

    public function storeOrUpdate(UserRequest $request){
        if($request->ajax()){
            $result = $this->user->createOrUpdate($request);
            return $this->store_message($result, $request->update_id);
        }
    }

    public function edit(int $id){
        $user =  $this->user->editUser($id);
        $this->setPageData('Edit User');
        return view('hostel.admin.user.store-or-update', ['user'=>$user]);
    }

    public function delete(Request $request){
        if($request->ajax()){
            return $this->user->deleteUser($request);
        }
    }

}
