@extends('layouts.app')
@section('title',$siteTitle)
@push('styles')

@endpush

@section('content')
<div class="container my-4">
    <div class="card rounded-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm mb-0" id="bill-datatable">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Bill Type</th>
                            <th>Bill Status</th>
                            <th>Amount</th>
                            <th>Bill Month</th>
                            <th>Note</th>
                            <th>User</th>
                            <th>Created Date</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endSection

@push('scripts')
    <script>
        table = new DataTable('#bill-datatable', {
            processing: true,
            serverSide: true,
            responsive: true,
            order: [], // Initial no order
            bInfo: true, // Show total number of data
            bFilter: false, // Hide default search box
            ordering: false,
            lengthMenu: [
                [5, 10, 15, 25, 50, 100, 200],
                [5, 10, 15, 25, 50, 100, 200]
            ],
            pageLength: 15, // Rows per page
            ajax: {
                url: "{{ route('app.hostel-admin.bills.index') }}",
                type: "GET",
                dataType: "JSON",
                data: function (d) {
                    d._token     = _token;
                    d.search     = $('input[name="search_here"]').val();
                },
            },
            columns: [
                {data: 'DT_RowIndex'},
                {data: 'type'},
                {data: 'bill_status'},
                {data: 'amount'},
                {data: 'bill_month'},
                {data: 'note'},
                {data: 'border'},
                {data: 'created_at'},
                {data: 'action'}
            ],
            language: {
                emptyTable: '<strong class="text-danger">No Data Found</strong>',
                infoEmpty: '',
                zeroRecords: '<strong class="text-danger">No Data Found</strong>',
                paginate: {
                    previous: "Previous",
                    next: "Next"
                },
                lengthMenu: `<div class="d-flex align-items-center w-100 justify-content-between">
                         _MENU_
                         <input name="search_here" class="form-control-sm form-control ms-2 rounded-0 shadow-none" placeholder="Search here..." autocomplete="off"/>
                     </div>`,
            },
            dom: "<'row mb-2'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 text-end'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-2 align-items-center'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 text-end'p>>",
            buttons: [
                {
                    text: '+ Add Bill',
                    className: 'btn btn-sm btn-primary add_bill'
                }
            ]
        });

        $(document).on('click','.add_bill', function(){
            location.href = "{{ route('app.hostel-admin.bills.create') }}";
        });

    </script>
@endpush
