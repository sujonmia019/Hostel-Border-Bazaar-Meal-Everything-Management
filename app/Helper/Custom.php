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

define('TYPE',[
    'all' => 'For All Border',
    'user' => 'For Spacific Border',
]);

define('TYPE_LABEL',[
    'all' => '<span class="rounded-0 fw-normal badge bg-primary">For All Border</span>',
    'user' => '<span class="rounded-0 fw-normal badge bg-danger">For Spacific Border</span>',
]);

define('GENDER',[
    1 => 'Male',
    2 => 'Female',
]);

define('MEAL_TYPE',[
    1 => 'Breakfast',
    2 => 'Lunch',
    3 => 'Dinner',
    4 => 'All'
]);

define('USER_ROLE',[
    1 => 'Super Admin',
    2 => 'Admin',
    3 => 'Border',
]);
define('UNAUTHORIZED_MSG', 'This action not allow!');

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

if(!function_exists('file_path')){
    function file_path($path){
        return Storage::disk('public')->url($path);
    }
}

/**
 * User profile image
 *
 * @return string
 */
if(!function_exists('user_profile')){
    function user_profile(){
        return auth()->user()->image ? file_path(auth()->user()->image) : "https://ui-avatars.com/api/?name=".auth()->user()->name."&size=64&rounded=true&color=fff&background=F97C4F";
    }
}

if(!function_exists('user_image')){
    function user_image($path, $name){
        $imagePath =  $path ? file_path($path) : "https://ui-avatars.com/api/?name=".$name."&size=40&color=fff&background=F97C4F";
        return "<img src='".$imagePath."' alt='".$name."' style='width: 40px; height: 40px;'>";
    }
}

if (!function_exists('table_image')) {
    function table_image($path,$name = null){
        return $path ? "<img src='".file_path($path)."' alt='".$name."' style='width: 35px; height: 40px;'/>"
        : "<img src='".asset('/')."img/default.svg' alt='Default Image' style='width: 35px; height: 40px;'/>";
    }
}

if (!function_exists('change_status')) {
    function change_status(int $id,int $status,string $name = null){
        return $status == 1 ? '<span class="badge rounded-0 bg-success change_status" data-id="' . $id . '" data-name="' . $name . '" data-status="2" style="cursor:pointer;">Active</span>' :
        '<span class="badge rounded-0 bg-danger change_status" data-id="' . $id . '" data-name="' . $name . '" data-status="1" style="cursor:pointer;">Inactive</span>';
    }
}
