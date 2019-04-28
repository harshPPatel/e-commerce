<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>

    {{-- Use This in extended layout. --}}
    {{-- Title of the Page --}}
    {{--@section('title', 'Welcome to T-Mart')--}}

    {{-- Including Head --}}
    @include('includes.head')

  </head>
  
  <body>
    <!--[if lt IE 8]>
    <p class="browserupgrade">
      You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.
    </p>
    <![endif]-->

    {{-- Navigation --}}
    @include('includes.navigation')

    <!-- Body main wrapper start -->
    <div class="wrapper fixed__footer">

      @yield('content')

      {{-- Footer --}}
      @include('includes.footer')

    </div>

    @yield('modals')


    <!-- jquery latest version -->
    <script src="{{ asset('js/vendor/jquery-1.12.0.min.js') }}"></script>
    <!-- Bootstrap framework js -->
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
    <!-- All js plugins included in this file. -->
    <script src="{{ asset('js/vendor/plugins.js') }}"></script>
    <!-- Other vendors JavaScript -->
    <script src="{{ asset('js/vendor/slick.min.js') }}"></script>
    <script src="{{ asset('js/vendor/owl.carousel.min.js') }}"></script>
    <!-- Waypoints.min.js. -->
    <script src="{{ asset('js/vendor/waypoints.min.js') }}"></script>
    <!-- Template js file that contents all jQuery plugins activation. -->
    <script src="{{ asset('js/vendor/template.js') }}"></script>

    <!-- Main js - Custom file -->
    <script src="{{ asset('js/app.js') }}"></script>
  </body>
</html>
