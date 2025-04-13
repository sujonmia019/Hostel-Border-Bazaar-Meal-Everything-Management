<div class="container my-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info rounded-0 border-0">
                    <h6 class="mb-0 card-title text-light">Count of {{ date('F y') }} Reports:</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-md-4 col-sm-6 col-12">
            <div class="card rounded-0">
                <div class="card-header bg-white">
                    <h6 class="card-title mb-0">Bazaar Expense</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive scrollable-table">
                        <table class="table table-sm table-bordered mb-0 table-hover">
                            <thead>
                                <th>SL</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                    $totalExpense = 0;
                                @endphp
                                @foreach ($bazaarExpense as $key=>$expense)
                                @php
                                    $totalExpense += $expense->amount;
                                @endphp
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $expense->amount }}</td>
                                    <td class="text-start">{{ dateFormat($expense->date,' d M') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td><strong>Total Amount:</strong> {{ $totalExpense }} TK</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12 mt-3 mt-md-0">
            <div class="card rounded-0">
                <div class="card-header bg-white">
                    <h6 class="card-title mb-0">Meal History</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive scrollable-table">
                        <table class="table table-sm table-bordered mb-0 table-hover">
                            <thead>
                                <th>Type</th>
                                <th>Meal</th>
                                <th>Day</th>
                            </thead>
                            <tbody>
                                @php
                                    $totalMeal = 0;
                                @endphp
                                @foreach ($borderMeals as $meal)
                                @php
                                    $totalMeal += $meal->total_meal;
                                @endphp
                                <tr>
                                    <td>{{ MEAL_TYPE[$meal->meal_type] }}</td>
                                    <td>{{ $meal->total_meal }}</td>
                                    <td class="text-start">{{ dateFormat($meal->meal_date,'d M') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td><strong>Total Meal:</strong> {{ $totalMeal }}</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12 mt-3 mt-md-0">
            <div class="card rounded-0">
                <div class="card-header bg-white">
                    <h6 class="card-title mb-0">Hostel Costs</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive scrollable-table">
                        <table class="table table-sm table-bordered mb-0 table-hover">
                            <thead>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Note</th>
                            </thead>
                            <tbody>
                                @php
                                    $totalWithoutBorderAmount = 0;
                                    $totalBorderAmount = 0;
                                @endphp
                                @foreach ($borderWithoutCostData as $withoutBorder)
                                @php
                                    $totalWithoutBorderAmount += $withoutBorder->amount;
                                @endphp
                                <tr>
                                    <td>{{ $withoutBorder->billStatus->name }}</td>
                                    <td>{{ $withoutBorder->amount }}</td>
                                    <td class="text-start">{{ $withoutBorder->note }}</td>
                                </tr>
                                @endforeach

                                @foreach ($borderCostData as $withBorder)
                                @php
                                    $totalBorderAmount += $withBorder->amount;
                                @endphp
                                <tr>
                                    <td>{{ $withBorder->billStatus->name }}</td>
                                    <td>{{ $withBorder->amount }}</td>
                                    <td class="text-start">{{ $withBorder->note }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td><strong>Total Amount:</strong> {{ $totalWithoutBorderAmount + $totalBorderAmount }} TK</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info rounded-0 border-0">
                    <h6 class="mb-0 card-title text-light">Meal Cost Reports:</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive scrollable-table">
                        <table class="table table-sm table-bordered mb-0 table-hover">
                            <tbody>
                                <tr>
                                    <td><strong>In-Total Meal:</strong></td>
                                    <td>50</td>
                                </tr>
                                <tr>
                                    <td><strong>In-Total Bazaar:</strong></td>
                                    <td>500 tk</td>
                                </tr>
                                <tr>
                                    <td><strong>Meal Per Cost:</strong> (500/50) = </td>
                                    <td>55.00 tk</td>
                                </tr>
                                <tr>
                                    <td><strong>Total Meal:</strong></td>
                                    <td>15</td>
                                </tr>
                                <tr>
                                    <td><strong>Meal Cost:</strong> (55.00*15)</td>
                                    <td>825 tk</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
