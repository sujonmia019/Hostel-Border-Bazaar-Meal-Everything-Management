<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Constants\Constants;
use Illuminate\Support\Facades\DB;
use App\Interfaces\DashboardInterface;
use App\Models\Bill;

class DashboardRepository implements DashboardInterface {

    public function getDashboardData(int $roleId) {
        if ($roleId === Constants::BORDER_ROLE) {
            return $this->borderDashboardData();
        }

        return $this->hostelSuperDashboardData();
    }

    public function borderDashboardData(){
        $authUser = auth()->user();
        $data['bazaarExpense'] = DB::table('hostel_bazaars')->whereMonth('date',Carbon::now())
                    ->where(['hostel_id'=>$authUser->hostel_id,'user_id'=>$authUser->id])
                    ->where('status',Constants::ACTIVE)->orderBy('date','ASC')->get();

        $data['borderMeals'] = DB::table('meals')->select('total_meal','meal_type','meal_date')->whereMonth('meal_date',Carbon::now())
                    ->where(['hostel_id'=>$authUser->hostel_id,'user_id'=>$authUser->id])->orderBy('meal_date','ASC')
                    ->get();

        $data['borderConsts'] = Bill::with('billStatus')->select('type','note','amount','bill_month','bill_status_id')->whereMonth('bill_month',Carbon::now())
                    ->where('hostel_id',$authUser->hostel_id)->orderBy('id','ASC')
                    ->get();

        return $data;
    }

    public function hostelSuperDashboardData(){
        return [];
    }

}
