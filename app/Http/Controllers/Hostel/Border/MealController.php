<?php

namespace App\Http\Controllers\Hostel\Border;

use Carbon\Carbon;
use App\Models\Meal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MealController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $currentMonth = Carbon::now()->format('Y-m');
        $meals = Meal::where('user_id', $user->id)
                     ->whereYear('created_at', Carbon::now()->year)
                     ->whereMonth('created_at', Carbon::now()->month)
                     ->get();

        $this->setPageData('Meal List', 'Meal List');
        return view('hostel.border.meal.index', compact('meals','currentMonth'));
    }
}
