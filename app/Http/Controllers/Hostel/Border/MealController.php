<?php

namespace App\Http\Controllers\Hostel\Border;

use Carbon\Carbon;
use App\Models\Meal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MealRequest;
use Illuminate\Support\Facades\Auth;

class MealController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $currentMonth = Carbon::now()->format('Y-m');
        $meals = Meal::where('user_id', $user->id)
                     ->whereYear('meal_date', Carbon::now()->year)
                     ->whereMonth('meal_date', Carbon::now()->month)
                     ->get();

        $this->setPageData('Meal List', 'Meal List');
        return view('hostel.border.meal.index', compact('meals','currentMonth'));
    }

    public function store(MealRequest $request)
    {
        if ($request->ajax()) {
            $collection = collect($request->validated());
            $collection = $collection->merge(['hostel_id'=>auth()->user()->hostel_id,'user_id'=>auth()->user()->id]);
            $result = Meal::create($collection->all());
            if ($result) {
                return $this->response_json('success','Your meal added successfull.');
            } else{
                return $this->response_json('error','Failed to add meal.');
            }
        }
    }

}
