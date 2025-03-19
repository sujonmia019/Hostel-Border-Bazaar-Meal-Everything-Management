<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Generates a JSON response to send back to the client.
     *
     * @param string $status
     * @param string $message
     * @param mixed $data
     * @param int $response_code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function response_json($status='success',$message=null,$data=[],$response_code=200)
    {
        return response()->json([
            'status'        => $status,
            'message'       => $message,
            'data'          => $data,
            'response_code' => $response_code,
        ],$response_code);
    }


    protected function setPageData($siteTitle, $title = null){
        return view()->share(['siteTitle'=>$siteTitle,'title'=>$title]);
    }


    protected function unauthorized(){
        return redirect('unauthorized');
    }

}
