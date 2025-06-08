@php use App\Orbit\core\Orbit; @endphp
    <!DOCTYPE html>
<html lang="en" data-bs-theme="{{ is_dark() ? "dark" : "light" }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="apple-touch-icon" href="{{ orbit_asset("img/apple-touch-icon.png") }}" sizes="180x180">
    <link rel="icon" href="{{ orbit_asset("img/favicon-32x32.png") }}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{ orbit_asset("img/favicon-16x16.png") }}" sizes="16x16" type="image/png">
    <link rel="icon" href="{{ orbit_asset("img/favicon.ico") }}">
    <meta name="theme-color" content="#563d7c">

    @yield("head")

    <title>{{ Orbit::TITLE }} > {{ $title ?? "Dashboard" }}</title>

    <link rel="stylesheet" href="{{ orbit_asset("css/adminlte.min.css") }}">
    <link rel="stylesheet" href="{{ orbit_asset("css/bootstrap-icons.min.css") }}">
    <link rel="stylesheet" href="{{ orbit_asset("css/main.css") }}">

    @yield("stylesheet")

</head>
<body class="@yield("body_class")">
@yield("start")
<div class="{{ isset($app_wrapper) && $app_wrapper ? "app-wrapper" : "wrapper" }}">
    @yield("content")
</div>

<script src="{{ orbit_asset("js/popper.min.js") }}"></script>
<script src="{{ orbit_asset("js/bootstrap.min.js") }}"></script>
<script src="{{ orbit_asset("js/adminlte.min.js") }}"></script>
<script src="{{ orbit_asset("js/jquery-3.7.1.min.js") }}"></script>
<script src="{{ orbit_asset("js/jquery-ui.min.js") }}"></script>
<script src="{{ orbit_asset("js/axios.min.js") }}"></script>

@yield("javascript")
@yield("end")

</body>
</html>
