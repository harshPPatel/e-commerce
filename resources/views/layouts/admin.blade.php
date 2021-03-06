<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    {{-- Use This in extended layout. --}}
    {{-- Title of the Page --}}
    {{--@section('title', 'Welcome to T-Mart')--}}

    {{-- Including Head --}}
    @include('admin.includes.head')

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
<!--[if lt IE 8]>
<p class="browserupgrade">
    You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.
</p>
<![endif]-->


<!-- Body main wrapper start -->
<div class="dashboard-main-wrapper">

    {{-- Navigation --}}
    @include('admin.includes.navigation')
    @include('admin.includes.leftNavigation')

    <!-- wrapper  -->
    <div class="dashboard-wrapper">

        <div class="container-fluid dashboard-content">

            @yield('pageHeader')

            <div class="row">
                @yield('content')
            </div>
        </div>

        {{-- Footer --}}
        @include('admin.includes.footer')

    </div>
</div>

{{--@yield('modals')--}}

<!-- jquery latest version -->
<script src="{{ asset('admin/js/vendor/jquery-3.3.1.min.js') }}"></script>
<!-- bootstap bundle js -->
<script src="{{ asset('admin/js/vendor/bootstrap.bundle.js') }}"></script>
<!-- slimscroll js -->
<script src="{{ asset('admin/js/vendor/jquery.slimscroll.js') }}"></script>
<!-- main js -->
<script src="{{ asset('admin/js/vendor/main-js.js') }}"></script>
<!-- chart chartist js -->
<script src="{{ asset('admin/js/vendor/chartist.min.js') }}"></script>
<!-- sparkline js -->
<script src="{{ asset('admin/js/vendor/jquery.sparkline.js') }}"></script>
<!-- morris js -->
<script src="{{ asset('admin/js/vendor/raphael.min.js') }}"></script>
<script src="{{ asset('admin/js/vendor/morris.js') }}"></script>
<!-- chart c3 js -->
<script src="{{ asset('admin/js/vendor/c3.min.js') }}"></script>
<script src="{{ asset('admin/js/vendor/d3-5.4.0.min.js') }}"></script>
<script src="{{ asset('admin/js/vendor/C3chartjs.js') }}"></script>
<!-- Dashboard Scripts -->
<script src="{{ asset('admin/js/vendor/dashboard-ecommerce.js') }}"></script>

<!-- Main js - Custom file -->
<script src="{{ asset('js/app.js') }}"></script>

@yield('scripts')

</body>
</html>
