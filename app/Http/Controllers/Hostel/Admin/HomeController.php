<?php

namespace App\Http\Controllers\Hostel\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard(){
        $this->setPageData('Dashboard','Dashboard');
        return view('hostel.admin.home');
    }
}
