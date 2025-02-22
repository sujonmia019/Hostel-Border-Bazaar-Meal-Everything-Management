@extends('layouts.app')
@section('title',$siteTitle)
@push('styles')

@endpush

@section('content')
<div class="container my-4">
    <div class="card rounded-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0" id="user-datatable">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Issue Date</th>
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
        table = new DataTable('#user-datatable', {
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
                url: "{{ route('app.hostel-admin.users.index', auth()->user()->username) }}",
                type: "GET",
                dataType: "JSON",
                data: function (d) {
                    d._token     = _token;
                    d.search     = $('input[name="search_here"]').val();
                    d.start_date = $('input[name="start_date"]').val();
                    d.end_date   = $('input[name="end_date"]').val();
                    d.brand      = $('select#brand').val();
                },
            },
            columns: [
                {data: 'DT_RowIndex'},
                {data: 'image'},
                {data: 'name'},
                {data: 'email'},
                {data: 'status'},
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
                    text: '+ Add New',
                    className: 'btn btn-sm btn-primary add_user'
                }
            ]
        });

        // search table
        $(document).on('keyup keypress','input[name="search_here"]',function(){
            table.ajax.reload();
        });

        $(document).on('click','.add_user',function(){
            window.location.href = "{{ route('app.hostel-admin.users.create', auth()->user()->username) }}";
        });

    </script>
@endpush
