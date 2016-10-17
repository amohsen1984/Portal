<!doctype html>
<html class="no-js" lang="en">
<head>
    @include('includes.head')
</head>
<body>
    @include('includes.header')

    <div class="app-body">
        @yield('content')
    </div>

    @include('includes.footer')
    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/what-input/what-input.js"></script>
    <script src="bower_components/foundation-sites/dist/foundation.js"></script>
    <script src="js/app.js"></script>
</body>
</html>