@extends('layouts.app')
@section('title',$title)

@push('styles')
    <style>
        table tbody tr td:last-child {
            text-align: center !important;
        }
    </style>
@endpush
@section('content')
<div class="container my-4">
    <div class="card rounded-0">
        <div class="card-header bg-white">
            <h5 class="mb-0 card-title">Monthly Meal Calendar</h5>
        </div>
        <div class="card-body px-0">
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Sun</th>
                        <th>Mon</th>
                        <th>Tue</th>
                        <th>Wed</th>
                        <th>Thu</th>
                        <th>Fri</th>
                        <th>Sat</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $date        = \Carbon\Carbon::parse($currentMonth . '-01'); // start of month day
                        $startDay    = $date->dayOfWeek;
                        $daysInMonth = $date->daysInMonth;
                        $dayCounter  = 1;
                    @endphp
                    <tr>
                        @for ($i = 0; $i < $startDay; $i++)
                            <td></td>
                        @endfor

                        @for ($day = 1; $day <= $daysInMonth; $day++)
                            @php
                                $meal = $meals->where('created_at','=',$date->format('Y-m-d'))->first();
                            @endphp
                            <td class="p-2">
                                <div class="fw-bold">{{ $day }}</div>
                                @if ($meal)
                                    <span class="badge bg-success">{{ $meal->total_meal }} Meals</span>
                                    <small class="d-block">
                                        @switch($meal->meal_type)
                                            @case(1) 🍳 Breakfast @break
                                            @case(2) 🍛 Lunch @break
                                            @case(3) 🍽 Dinner @break
                                            @case(4) 🍵 Others @break
                                        @endswitch
                                    </small>
                                    <button class="btn btn-sm btn-primary mt-1" data-bs-toggle="modal" data-bs-target="#editMealModal" data-date="{{ $date->format('Y-m-d') }}">Edit</button>
                                @else
                                    <button class="btn btn-sm btn-outline-primary mt-1" data-bs-toggle="modal" data-bs-target="#addMealModal" data-date="{{ $date->format('Y-m-d') }}">Add</button>
                                @endif
                            </td>
                            @if (($day + $startDay) % 7 == 0)
                                </tr><tr>
                            @endif
                            @php $date->addDay(); @endphp
                        @endfor

                        @while (($day + $startDay) % 7 != 0)
                            <td></td>
                            @php $day++; @endphp
                        @endwhile
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
