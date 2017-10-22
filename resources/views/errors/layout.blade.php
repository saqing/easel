<!DOCTYPE html>
<html lang="en">
    <head>
        @include('canvas::backend.shared.partials.meta')
        @yield('title')
        @include('canvas::backend.shared.partials.css')
    </head>
    <body>
        @yield('content')
        @yield('unique-js')
    </body>
</html>