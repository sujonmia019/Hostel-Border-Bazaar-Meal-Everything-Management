@extends('layouts.app')
@section('title',$title)

@push('styles')
    <style>
        table tbody tr td:last-child {
            text-align: center !important;
        }
        table td {
            vertical-align: middle !important;
            max-height: 60px;
            height: 60px;
        }
        .meal_add:hover {
            background: #06d1a4;
            border-color: #02ac87
        }
        .meal_add:hover small {
            color: #ffffff !important;
        }
    </style>
@endpush
@section('content')
@php
    $date        = \Carbon\Carbon::parse($currentMonth . '-01'); // start of month day
    $startDay    = $date->dayOfWeek;
    $daysInMonth = $date->daysInMonth;
    $dayCounter  = 1;
    $totalMeal = DB::table('meals')->whereMonth('meal_date',Carbon\Carbon::now())->sum('total_meal');
@endphp

<div class="container my-4">
    <div class="card rounded-0">
        <div class="card-header bg-white border-0">
            <h5 class="mb-0 card-title d-flex align-items-center justify-content-between">
                <span>Monthly Meal Calendar</span>
                <span>Total Meal: {{ $totalMeal }}</span>
                <button class="btn btn-sm btn-danger" onclick="location.reload(true)"><i class="fas fa-refresh"></i></button>
            </h5>
        </div>
        <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered text-center mb-0">
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
                    <tr>
                        @for ($i = 0; $i < $startDay; $i++)
                            <td></td>
                        @endfor

                        @for ($day = 1; $day <= $daysInMonth; $day++)
                            <td class="p-2 meal_add" data-date="{{ $date->format('Y-m-d') }}" style="cursor: pointer;">
                                <div class="fw-bold">{{ $day }}</div>
                                @php
                                    $meal = DB::table('meals')->whereDate('meal_date',$date->format('Y-m-d'))->value('total_meal');
                                @endphp
                                @if ($meal)
                                <small class="text-secondary">Meal: <strong class="text-danger">{{ $meal }}</strong></small>
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

@push('scripts')
    <script>
        $(document).on('click','.meal_add',function(){
            let mealDate = $(this).data('date');
            alert(mealDate)
        });
    </script>
@endpush
