<!DOCTYPE html>
<html lang="en">
<head>
    @section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    @show

    <title>{{ env('WEBSITE_NAME') }} | @yield('title')</title>

    @section('css')
    <link rel="stylesheet" href="{{ asset('assets/cms/css/app.css') }}">
        <style>
            .btn-primary {
                color: #fff;
                background-color: #b5d2e0;
                border-color: #b5d2e0;
            }
            .login-page, .register-page {
                background: url("{{ asset('assets/cms/images/bg_image.png') }}");
                background-repeat: no-repeat;
                background-size: cover;
                background-position: top center;
            }
        </style>
    @show
    @section('script-top')
    @show
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <h1>{{ env('WEBSITE_NAME') }}</h1>
{{--        <a href="#"><img src="{{ asset('assets/cms/images/user-default.png') }}" style="width: 100%"/></a>--}}
    </div>
    <!-- /.login-logo -->
    @yield('content')

</div>
@section('script-bottom')
    <script src="{{ asset('/assets/cms/js/app.js') }}"></script>
@show
</body>
</html>
