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


    public function setPageData($siteTitle, $title = null){
        return view()->share(['siteTitle'=>$siteTitle,'title'=>$title]);
    }

    /**
     * * Upload File Method * *
     * @param UploadedFile $file
     * @param null $folder
     * @param null $filename
     * @param null $disk
     * @return false|string
     */
    public function uploadData(UploadedFile $file, $folder = null, $file_name = null, $disk = 'public')
    {
        $filenameWithExt = $file->getClientOriginalName();
        $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension       = strtolower($file->getClientOriginalExtension());

        $fileNameToStore = !is_null($file_name) ?
            str()->slug($file_name,'-') . '.' . $extension :
            str()->slug($filename,'-') . '-' . time() . '.' . $extension;

        $url = $file->storeAs($folder,$fileNameToStore,$disk);
        return $url;
    }

    /**
     * ! Delete File Method !
     * @param string $filename
     * @param string $folder
     * @param string $disk
     * @return true|false
     */
    public function deleteFile($path,$disk = 'public')
    {
        if(Storage::disk($disk)->exists($path))
        {
            Storage::disk($disk)->delete($path);
            return true;
        }
        return false;
    }

}
