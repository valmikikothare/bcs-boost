<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'BOOST') }}</title>
    <link rel="icon" href="{{ asset('images/user/Logo.png') }}" type="image/png"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('/css/frontend.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/calender.css')}}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">


    @yield('styles')

</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- Include jQuery (make sure it’s loaded before daterangepicker) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include the Date Range Picker CSS -->
<link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet">

<!-- Include the Date Range Picker JS -->
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>


<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('elements.header')
        <div class="content-wrapper">

            <script>
                setTimeout(function() {
                    @if (session('success'))
                        var successMessage = "{{ session('success') }}";
                        var successAlert = '<div class="alert alert-success text-center">' + successMessage + '</div>';
                        document.getElementById('success-message').innerHTML = successAlert;
                        setTimeout(function() {
                            $('#success-message').fadeOut(2000, function() {
                                $(this).remove(); // Remove the success message
                            });
                        }, 4000);
                    @endif
                }, 0);
            </script>
            
            <div id="success-message"></div>
            @yield('content')
        </div>

        @include('elements.footer')


    </div>

    <!-- REQUIRED SCRIPTS -->
    @vite('resources/js/app.js')
    <!-- AdminLTE App -->

    <!-- <script src="{{ asset('js/adminlte.min.js') }}" defer></script> -->
    {{-- <script src="{{ asset('js/ckeditor.js')}}"></script> --}}
    @yield('scripts')


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script>

        $('.select2').select2();
        
        $('.datepicker').datepicker({
            dateFormat: 'mm-dd-yy', // Set the date format
            minDate: 1 // Start date as tomorrow
        });
        
    </script>
</body>


</html>
