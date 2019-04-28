<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Place favicon.ico in the root directory -->
<link rel="apple-touch-icon" href="apple-touch-icon.png">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

<!-- Title of the Page -->
<title>
    @hasSection('title')
        @yield('title')
    @else
        {{ config('app.name') }}
    @endif
</title>

<!-- Stylesheets-->
<link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
<link rel="stylesheet" href="{{ asset('css/overrides.css') }}">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<!-- Modernizr JS -->
<script src="{{ asset('js/vendor/modernizr-2.8.3.min.js') }}"></script>