<?php

namespace App\Http\Controllers\Hostel\Border;

use Illuminate\Http\Request;
use App\Traits\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\BazaarRequest;
use Illuminate\Support\Facades\Gate;
use App\Services\Border\BazaarService;

class BazaarController extends Controller
{
    use ResponseMessage;

    protected $bazaar;

    public function __construct(BazaarService $bazaarService)
    {
        $this->bazaar = $bazaarService;
    }

    public function index(Request $request){
        if($request->ajax()){
            return $this->bazaar->getData($request);
        }

        if (Gate::allows('border')) {
            $this->setPageData('Bazaar List');
            return view('hostel.border.bazaar.index');
        }else{
            return $this->unauthorized();
        }
    }

    public function store(BazaarRequest $request){
        if($request->ajax()){
            $result = $this->bazaar->bazaarStore($request);
            if($result){
                return $this->response_json('success','Bazaar added successful.');
            }else{
                return $this->response_json('error','Bazaar cannot add!');
            }
        }
    }
}
