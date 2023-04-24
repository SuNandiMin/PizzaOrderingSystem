<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>
        @yield('title')
    </title>
    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
        media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- admin/Vendor CSS-->
    <link href="{{ asset('admin/vendor/animsition/animsition.min.css') }} " rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('admin/vendor/wow/animate.css') }} " rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/css-hamburgers/hamburgers.min.css') }} " rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/slick/slick.css') }} " rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }} " rel="stylesheet" media="all">
    {{-- font-awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Main CSS-->
    <link href="{{ asset('admin/css/theme.css') }}" rel="stylesheet" media="all">
    {{-- bootsrap five css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>


@yield('content')
{{-- jquery --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
    integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Jquery JS-->
{{-- <script src="{{ asset('admin/vendor/jquery-3.2.1.min.js') }} "></script> --}}

{{-- Bootstrap Five JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>
<!-- Bootstrap JS-->
<script src="{{ asset('admin/vendor/bootstrap-4.1/popper.min.js') }} "></script>
<script src="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js') }} "></script>
<!-- {{ asset('') }} admin/Vendor JS       -->
<script src="{{ asset('admin/vendor/slick/slick.min.js') }} "></script>
<script src="{{ asset('admin/vendor/wow/wow.min.js') }} "></script>
<script src="{{ asset('admin/vendor/animsition/animsition.min.js') }} "></script>
<script src="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }} "></script>
<script src="{{ asset('admin/vendor/counter-up/jquery.waypoints.min.js') }} "></script>
<script src="{{ asset('admin/vendor/counter-up/jquery.counterup.min.js') }} "></script>
<script src="{{ asset('admin/vendor/circle-progress/circle-progress.min.js') }} "></script>
<script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }} "></script>
<script src="{{ asset('admin/vendor/chartjs/Chart.bundle.min.js') }} "></script>
<script src="{{ asset('admin/vendor/select2/select2.min.js') }} "></script>

<!-- Main JS-->
<script src="{{ asset('admin/js/main.js') }}"></script>

</body>
@yield('js-script')
</html>
<!-- end document-->
