<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Token -->
@yield('token')

<!-- Title of the Page -->
<title>
    @hasSection('title')
        @yield('title')
    @else
        {{ config('app.name') }} | Admin
    @endif
</title>

<!-- Stylesheets -->
<link rel="stylesheet" href="{{ asset('admin/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/fonts.css') }}">
<!-- Font Awesome Stylesheet -->
<link rel="stylesheet" href="{{ asset('admin/fontawesome.css') }}">
<!-- Material Design Icons Stylesheet -->
<link rel="stylesheet" href="{{ asset('admin/materialdesign.css') }}">
<!-- Flag Icons Stylesheet -->
<link rel="stylesheet" href="{{ asset('flag-icons.min.css') }}">
<!-- Custom StyleSheet -->
<link rel="stylesheet" href="{{ asset('admin/admin.css') }}">
