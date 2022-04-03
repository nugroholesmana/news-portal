<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>News Portal - BMG</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 4.1.1 -->
    <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/news_portal.css') }}">
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
<div class="app-body">
    <main class="main">
        @yield('content')
    </main>
</div>
@include('frontend.components.footer')
</body>
<!-- jQuery 3.1.1 -->
<script src="{{url('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{url('js/popper.min.js')}}"></script>
<script src="{{url('js/bootstrap.min.js')}}"></script>
<script src="{{url('js/moment.min.js')}}"></script>
@stack('scripts')

</html>
