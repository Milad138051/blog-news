<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{asset('front-assets/assets/favicon.ico')}}"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('front-assets/css/styles.css')}}" rel="stylesheet"/>
    <link href="{{asset('front-assets/bootstrap/bootstrap.rtl.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('front-assets/sweetalert/sweetalert2.css')}}">
    @yield('head-tag')
</head>

@include('front.layouts.header')

<body style="direction:rtl">
@yield('content')
@include('front.layouts.script')
@yield('script')
@include('admin.alerts.sweetalert.success')
@include('admin.alerts.sweetalert.error')
</body>
</html>
