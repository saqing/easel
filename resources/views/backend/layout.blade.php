<!DOCTYPE html>
<html lang="en">
    <head>
        @include('canvas::backend.shared.partials.meta')
        @yield('title')
        @include('canvas::backend.shared.partials.css')
    </head>
    <body @if(Auth::guard('canvas')->check()) class="toggled sw-toggled" @endif>
        @if (Auth::guard('canvas')->guest())
            @yield('login')
        @else
            @include('canvas::backend.shared.partials.header')
            @yield('content')
            @include('canvas::backend.shared.components.preloader')
            @include('canvas::backend.shared.partials.footer')
        @endif
        @include('canvas::backend.shared.partials.js')
        @yield('unique-js')
    </body>
</html>
