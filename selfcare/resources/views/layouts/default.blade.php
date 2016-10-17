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
    <script src="{{ URL::asset('bower_components/jquery/dist/jquery.js') }}"></script>
    <script src="{{ URL::asset('bower_components/what-input/what-input.js') }}"></script>
    <script src="{{ URL::asset('bower_components/foundation-sites/dist/foundation.js') }}"></script>
    <script src="{{ URL::asset('js/app.js') }}"></script>
</body>
</html>