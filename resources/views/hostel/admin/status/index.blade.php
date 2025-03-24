@extends('layouts.app')
@section('title',$siteTitle)
@push('styles')

@endpush

@section('content')
<div class="container my-4">
    <div class="card rounded-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm mb-0" id="status-datatable">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
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

@include('hostel.admin.status.form')

@endSection

@push('scripts')
    <script>
        table = new DataTable('#status-datatable', {
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
                url: "{{ route('app.hostel-admin.statuses.index') }}",
                type: "GET",
                dataType: "JSON",
                data: function (d) {
                    d._token     = _token;
                    d.search     = $('input[name="search_here"]').val();
                },
            },
            columns: [
                {data: 'DT_RowIndex'},
                {data: 'name'},
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
                    text: '+ Add Status',
                    className: 'btn btn-sm btn-primary add_status'
                }
            ]
        });

        var bazaarModal = new bootstrap.Modal(document.getElementById('status-modal'));

        $(document).on('click','.add_status', function(){
            $('#status_form')[0].reset();
            $('#status_form #update_id').val('');
            $('#status_form').find('.is-invalid').removeClass('is-invalid');
            $('#status_form').find('.error').remove();
            bazaarModal.show();
        });

        $(document).on('click','#save_btn',function(){
            var form = document.getElementById('status_form');
            var formData = new FormData(form)
            $.ajax({
                url: "{{ route('app.hostel-admin.statuses.store-or-update') }}",
                type: "POST",
                data: formData,
                dataType: "JSON",
                contentType: false,
                processData: false,
                cache: false,
                beforeSend: function(){
                    $('#save_btn span').addClass('spinner-border spinner-border-sm text-primary');
                },
                complete: function(){
                    $('#save_btn span').removeClass('spinner-border spinner-border-sm text-primary');
                },
                success: function (data) {
                    $('#status_form').find('.is-invalid').removeClass('is-invalid');
                    $('#status_form').find('.error').remove();
                    if (data.status == false) {
                        $.each(data.errors, function (key, value) {
                            $('#status_form #' + key).addClass('is-invalid');
                            $('#status_form #' + key).parent().append('<small class="error d-block text-left text-danger">' + value + '</small>');
                        });
                    } else {
                        notification(data.status, data.message);
                        if (data.status == 'success') {
                            table.ajax.reload();
                            bazaarModal.hide();
                        }
                    }
                },
                error: function (xhr, ajaxOption, thrownError) {
                    console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
                }
            });
        });

        $(document).on('click','.edit_data',function(){
            let id = $(this).data('id');
            if(id){
                $.ajax({
                    type: "GET",
                    url: "{{ route('app.hostel-admin.statuses.edit') }}",
                    data: {_token:_token,id:id},
                    dataType: "json",
                    success: function (response) {
                        if(response.status == 'success'){
                            $('#status_form #update_id').val(response.data.id);
                            $('#status_form #name').val(response.data.name);
                            bazaarModal.show();
                        }
                    }
                });
            }
        });
    </script>
@endpush