<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('/') }}css/all.min.css">
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
    </style>
    @stack('styles')
</head>
<body style="background: url({{ asset('img/Background.svg') }});background-repeat: no-repeat; background-size: cover;background-position: center bottom;">

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    <script src="{{ asset('/') }}js/jquery.min.js"></script>
    <script src="{{ asset('/') }}js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/') }}js/flatpickr.min.js"></script>
    <script src="{{ asset('/') }}js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        $(".datetime").flatpickr({
            enableTime: true,
            noCalendar: false,
            time_24hr: true,
        });
    </script>
    @stack('scripts')
</body>
</html>
