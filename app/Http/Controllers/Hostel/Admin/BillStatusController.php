<?php

namespace App\Http\Controllers\Hostel\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StatusRequest;
use Illuminate\Support\Facades\Gate;
use App\Services\Hostel_Admin\BillStatusService;
use App\Traits\ResponseMessage;

class BillStatusController extends Controller
{
    use ResponseMessage;

    protected $billStatusRepo;

    public function __construct(BillStatusService $billStatusService)
    {
        $this->billStatusRepo = $billStatusService;
    }

    public function index(Request $request){
        if($request->ajax()){
            return $this->billStatusRepo->getData($request);
        }

        if (Gate::allows('hostel-admin')) {
            $this->setPageData('Bill Status List');
            return view('hostel.admin.status.index');
        }else{
            return $this->unauthorized();
        }
    }

    public function storeOrUpdate(StatusRequest $request){
        if($request->ajax()){
            $result = $this->billStatusRepo->createOrUpdate($request);
            return $this->store_message($result, $request->update_id);
        }
    }

    public function edit(Request $request){
        if($request->ajax()){
            $data = $this->billStatusRepo->editData($request->id);
            return $this->response_json('success',null,$data);
        }
    }

}
