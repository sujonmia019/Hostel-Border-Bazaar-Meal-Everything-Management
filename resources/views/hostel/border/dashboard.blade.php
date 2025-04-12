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
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="card rounded-0">
                <div class="card-header bg-white">
                    <h6 class="card-title mb-0">Bazaar Expense</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered mb-0">
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
        <div class="col-md-4">
            <div class="card rounded-0">
                <div class="card-header bg-white">
                    <h6 class="card-title mb-0">Meal History</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered mb-0">
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
        <div class="col-md-4">
            <div class="card rounded-0">
                <div class="card-header bg-white">
                    <h6 class="card-title mb-0">Hostel Costs</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered mb-0">
                            <thead>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Note</th>
                            </thead>
                            <tbody>
                                @php
                                    $totalAmount = 0;
                                @endphp
                                @foreach ($borderConsts as $cost)
                                @php
                                    $totalAmount += $cost->amount;
                                @endphp
                                <tr>
                                    <td>{{ $cost->billStatus->name }}</td>
                                    <td>{{ $cost->amount }}</td>
                                    <td class="text-start">{{ $cost->note }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td><strong>Total Amount:</strong> {{ $totalAmount }} TK</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>