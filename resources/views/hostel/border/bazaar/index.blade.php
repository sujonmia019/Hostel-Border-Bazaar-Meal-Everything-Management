@extends('layouts.app')
@section('title',$siteTitle)
@push('styles')

@endpush

@section('content')
<div class="container my-4">
    <div class="card rounded-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm mb-0" id="user-datatable">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th width="45%">Bazaar Name</th>
                            <th>Amount</th>
                            <th>Note</th>
                            <th>Status</th>
                            <th width="10%">Bazaar Date</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('hostel.border.bazaar.form')

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
                url: "{{ route('app.border.bazaars.index') }}",
                type: "GET",
                dataType: "JSON",
                data: function (d) {
                    d._token     = _token;
                    d.search     = $('input[name="search_here"]').val();
                    d.start_date = $('input[name="start_date"]').val();
                    d.end_date   = $('input[name="end_date"]').val();
                },
            },
            columns: [
                {data: 'DT_RowIndex'},
                {data: 'name'},
                {data: 'amount'},
                {data: 'note'},
                {data: 'status'},
                {data: 'date'},
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
                    text: '+ Add Bazaar',
                    className: 'btn btn-sm btn-primary add_bazaar'
                }
            ]
        });

        var bazaarModal = new bootstrap.Modal(document.getElementById('bazaar-modal'),{
            keyboard: false,
            backdrop: "static"
        });

        $(document).on('click','.add_bazaar', function(){
            $('#bazaar_form')[0].reset();
            $('#bazaar_form #update_id').val('');
            $('#bazaar_form').find('.is-invalid').removeClass('is-invalid');
            $('#bazaar_form').find('.error').remove();
            bazaarModal.show();
        });

        $(document).on('click','#save_btn',function(){
            var form = document.getElementById('bazaar_form');
            var formData = new FormData(form)
            $.ajax({
                url: "{{ route('app.border.bazaars.store') }}",
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
                    $('#bazaar_form').find('.is-invalid').removeClass('is-invalid');
                    $('#bazaar_form').find('.error').remove();
                    if (data.status == false) {
                        $.each(data.errors, function (key, value) {
                            $('#bazaar_form #' + key).addClass('is-invalid');
                            $('#bazaar_form #' + key).parent().append('<small class="error d-block text-left text-danger">' + value + '</small>');
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
    </script>
@endpush