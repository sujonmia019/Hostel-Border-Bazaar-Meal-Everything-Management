<?php

namespace App\Http\Controllers\Hostel\Admin;

use App\Models\User;
use App\Models\BillStatus;
use App\Constants\Constants;
use Illuminate\Http\Request;
use App\Traits\ResponseMessage;
use App\Http\Requests\BillRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\Hostel_Admin\BillService;
use PHPUnit\TextUI\Configuration\Constant;

class BillController extends Controller
{

    use ResponseMessage;

    protected $billRepo;

    public function __construct(BillService $billService)
    {
        $this->billRepo = $billService;
    }

    public function index(Request $request){
        if($request->ajax()){
            return $this->billRepo->getData($request);
        }

        if (Gate::allows('hostel-admin')) {
            $this->setPageData('Bill List');
            return view('hostel.admin.bill.index');
        }else{
            return $this->unauthorized();
        }
    }

    public function create(){
        $data['billStatus'] = BillStatus::pluck('name','id');
        $data['borders'] = User::where(['hostel_id'=>auth()->user()->id,'role'=>Constants::BORDER_ROLE])->pluck('name','id');
        $this->setPageData('New Bill','New Bill');
        return view('hostel.admin.bill.form', $data);
    }

    public function storeOrUpdate(BillRequest $request){
        dd(date("Y-m-01", strtotime($request->bill_month)));
    }

}
