<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Datatable --}}
    <link rel="stylesheet" href="{{ asset('/') }}css/dataTables.bootstrap5.css" >
    <link rel="stylesheet" href="{{ asset('/') }}css/responsive.bootstrap5.css">
    <link rel="stylesheet" href="{{ asset('/') }}css/daterangepicker.css" />
    <link rel="stylesheet" href="{{ asset('/') }}css/all.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}css/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}css/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}css/style.css">
    <style>
         small {
            font-size: 13px;
        }

        input::placeholder {
            font-size: 13px;
            font-weight: 400;
        }
        input:-ms-input-placeholder {
            font-size: 13px;
            font-weight: 400;
        }
        input::-ms-input-placeholder {
            font-size: 13px;
            font-weight: 400;
        }
        input::-webkit-input-placeholder {
            font-size: 13px;
            font-weight: 400;
        }
        input::-moz-placeholder {
            font-size: 13px;
            font-weight: 400;
        }
        input:-moz-placeholder {
            font-size: 13px;
            font-weight: 400;
        }
        label{
            font-size: 13px;
            color: #000000;
            font-weight: 400;
        }
        .required::after{
            content: '*';
            color: red;
        }

        .toast-success {
            background-color: #28a745 !important;
            color: #fff !important;
        }
        .toast-error {
            background-color: #dc3545 !important;
            color: #fff !important;
        }

        .toast-info {
            background-color: #17a2b8 !important;
            color: #fff !important;
        }

        .toast-warning {
            background-color: #ffc107 !important;
            color: #212529 !important;
        }

    </style>
    @stack('styles')
</head>
<body>
    {{-- Header --}}
    @include('include.header')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('include.footer')


    <script src="{{ asset('/') }}js/jquery.min.js"></script>
    <script src="{{ asset('/') }}js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/') }}js/flatpickr.min.js"></script>
    <script src="{{ asset('/') }}js/select2.min.js"></script>
    <script src="{{ asset('/') }}js/dataTables.js"></script>
    <script src="{{ asset('/') }}js/dataTables.bootstrap5.js"></script>
    <script src="{{ asset('/') }}js/dataTables.responsive.js"></script>
    <script src="{{ asset('/') }}js/responsive.bootstrap5.js"></script>
    <script src="{{ asset('/') }}js/moment.min.js"></script>
    <script src="{{ asset('/') }}js/daterangepicker.min.js"></script>
    <script src="{{ asset('/') }}js/toastr.min.js"></script>
    <script>
        var _token = "{{ csrf_token() }}";

        // toastr alert
        function notification(status, message) {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "500",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            switch (status) {
                case 'success':
                    toastr.success(message);
                    break;

                case 'error':
                    toastr.error(message);
                    break;

                case 'warning':
                    toastr.warning(message);
                    break;

                case 'info':
                    toastr.info(message);
                    break;
            }
        }


        @if (Session::get('success'))
            notification('success',"{{ Session::get('success') }}")
        @elseif (Session::get('error'))
            notification('error',"{{ Session::get('error') }}")
        @elseif (Session::get('info'))
            notification('info',"{{ Session::get('info') }}")
        @elseif (Session::get('warning'))
            notification('warning',"{{ Session::get('warning') }}")
        @endif
    </script>
    @stack('scripts')
</body>
</html>
