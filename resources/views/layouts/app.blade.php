<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light"
    data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('build/images/favicon.ico') }}">
    {{-- @include('layouts.head-css') --}}
    <x-head-css />


</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
        {{-- @include('layouts.topbar') --}}
        <x-topbar />
        {{-- @include('layouts.sidebar') --}}
        <x-sidebar />
     
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>

            </div>

        </div>

    </div>

    <x-customizer />
    <x-foot />

</body>

</html>
