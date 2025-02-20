<?php

use Illuminate\Support\Facades\Storage;

define('USER_IMAGE_PATH','user');
define('LOGO_PATH','logo');
define('STATUS',[
    1 => 'Pending',
    2 => 'In Progress',
    3 => 'Completed',
]);

define('STATUS_LABEL',[
    1 => '<span class="rounded-0 fw-normal badge badge-sm bg-danger">Pending</span>',
    2 => '<span class="rounded-0 fw-normal badge badge-sm bg-warning text-dark">In Progress</span>',
    3 => '<span class="rounded-0 fw-normal badge badge-sm bg-success">Completed</span>',
]);

define('GENDER',[
    1 => 'Male',
    2 => 'Female',
]);

if(!function_exists('dateFormat')){
    function dateFormat($date, $format = 'd-m-Y'){
        return date($format,strtotime($date));
    }
}

if(!function_exists('dateTimeFormat')){
    function dateTimeFormat($date, $format = 'd-m-Y h:i'){
        return date($format,strtotime($date));
    }
}

if(!function_exists('storage_url')){
    function storage_url($path){
        return Storage::disk('public')->url($path);
    }
}
