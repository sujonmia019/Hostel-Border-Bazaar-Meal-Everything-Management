<?php

namespace App\Services;

use App\Repositories\DashboardRepository;

class DashboardService
{
    protected $dashboardRepo;

    public function __construct(DashboardRepository $DashboardRepository)
    {
        $this->dashboardRepo = $DashboardRepository;
    }

    public function dashboardData(){
        $roleId = auth()->user()->role; // auth user role (id)
        return $this->dashboardRepo->getDashboardData($roleId);
    }
}
