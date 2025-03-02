
<!-- Layout config Js -->
<script src="{{ URL::asset('build/js/layout.js') }}"></script>
<!-- Bootstrap Css -->
<link href="{{ URL::asset('build/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ URL::asset('build/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- font-awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
{{-- boxicons --}}
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
{{-- select2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- App Css-->
<link href="{{ URL::asset('build/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
{{-- sweetalert2 --}}
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- custom Css-->
<link href="{{ URL::asset('build/css/custom.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<style>
    label {
        font-size: 13px;
        color: black;
    }

    .flashy {
        font-family: Arial, sans-serif;
        border-radius: 4px;
        font-weight: 400;
        position: fixed;
        height: 50px;
        display: flex;
        align-items: center;
        top: 20px;
        right: 20px;
        font-size: 16px;
        color: #fff;
        z-index: +999999;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
        background-color: #405189 !important;
    }

    div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm {

        background-color: #04AA6D;
        lor: #04AA6D;
        border-color: #04AA6D !important;
        color: #ffffff;
        font-size: 15px;
        min-width: 119px;
        font-weight: 900;
    }
    /* website card cssðŸŒŸ */
    .weblistCard:hover {
        box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
    }

    .weblistCard p {
        /* font-size: 14px; */
    }

    .weblistCard i {
        font-size: 18px !important;

    }
    .weblistCard .web_url {
        font-weight: 700;

    }
    .tabs-card .nav-link{
    border-radius: 0px;

   }
   .web-card-header{
    background-color: #b3bcd683
   }

</style>
@stack('css')

@yield('css')
