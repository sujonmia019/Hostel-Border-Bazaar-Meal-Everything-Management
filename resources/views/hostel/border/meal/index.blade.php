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
                                    $meal = DB::table('meals')->whereDate('meal_date',$date->format('Y-m-d'))->sum('total_meal');
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

@include('hostel.border.meal.form')

@endsection

@push('scripts')
    <script>
        var mealModal = new bootstrap.Modal(document.getElementById('bazaar-modal'));

        $(document).on('click','.meal_add',function(){
            let mealDate = $(this).data('date');
            $('#bazaar_form')[0].reset();
            $('#bazaar_form #meal_date').val(mealDate);
            mealModal.show();
        });

        $(document).on('click','#save-btn',function(){
            var form = document.getElementById('bazaar_form');
            var formData = new FormData(form);

            $.ajax({
                url: "{{ route('app.border.meals.store') }}",
                type: "POST",
                data: formData,
                dataType: "JSON",
                contentType: false,
                processData: false,
                cache: false,
                beforeSend: function(){
                    $('#save-btn span').addClass('spinner-border spinner-border-sm text-light');
                },
                complete: function(){
                    $('#save-btn span').removeClass('spinner-border spinner-border-sm text-light');
                },
                success: function (data) {
                    $('#bazaar_form').find('.is-invalid').removeClass('is-invalid');
                    $('#bazaar_form').find('.error').remove();
                    if (data.status == false) {
                        $.each(data.errors, function (key, value) {
                            $('#bazaar_form #' + key).parent().append('<small class="error d-block text-left text-danger">' + value + '</small>');
                        });
                    } else {
                        notification(data.status, data.message);
                        if (data.status == 'success') {
                            location.reload(true);
                        }   
                    }
                },
                error: function (xhr, ajaxOption, thrownError) {
                    console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
                }
            });
        });
    </script>
@endpush
