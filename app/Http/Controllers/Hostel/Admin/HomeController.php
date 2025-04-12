<?php

namespace App\Http\Controllers\Hostel\Admin;

use Illuminate\Http\Request;
use App\Services\DashboardService;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public $dashboard;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboard = $dashboardService;
    }

    public function dashboard(){
        $data = $this->dashboard->dashboardData();

        $this->setPageData('Dashboard','Dashboard');
        return view('hostel.admin.dashboard', $data);
    }

}
