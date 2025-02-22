<?php

namespace App\Http\Controllers\Hostel\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request, string $username){
        if($request->ajax()){
            $getData = User::orderBy('id','DESC');

            return DataTables::eloquent($getData)
                ->addIndexColumn()
                ->filter(function ($query) use ($request) {
                    if (!empty($request->search)) {
                        $query->where('name', 'LIKE', "%$request->search%");
                    }
                })
                ->addColumn('image', function($row){
                    return user_image($row->image,$row->name);
                })
                ->addColumn('status', function($row){
                    return change_status($row->id,$row->status, $row->name);
                })
                ->addColumn('created_at', function($row){
                    return dateFormat($row->created_at, 'd-m-Y h:i A');
                })
                ->addColumn('action', function($row){
                    $action = '<div class="d-flex align-items-center justify-content-end">';
                    $action .= '<a href="'.route('app.hostel-admin.users.edit', ['username'=>auth()->user()->username,'id'=>$row->id]).'" class="btn-style btn-style-edit me-1"><i class="fa fa-edit"></i></a>';

                    $action .= '<button type="button" class="btn-style btn-style-danger delete_data" data-id="' . $row->id . '" data-name="' . $row->name . '"><i class="fa fa-trash"></i></button>';
                    $action .= '</div>';

                    return $action;
                })
                ->rawColumns(['image','status','action'])
                ->make(true);
        }

        $this->setPageData('User List');
        return view('hostel.admin.user.index');
    }

    public function create($username){
        $this->setPageData('Create User');
        return view('hostel.admin.user.store-or-update');
    }

    public function storeOrUpdate(Request $request, string $username){

    }

    public function edit(string $username, int $id){

    }

    public function delete(Request $request, string $username){

    }
}
