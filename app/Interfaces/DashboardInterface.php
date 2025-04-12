<?php

namespace App\Interfaces;

interface DashboardInterface {

    public function getDashboardData(int $roleId);
    public function borderDashboardData();
    public function hostelSuperDashboardData();

}
