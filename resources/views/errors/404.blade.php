@extends('canvas::errors.layout')

@section('title')
    <title>{{ \Canvas\Models\Settings::blogTitle() }} | Page not found</title>
@stop

@section('content')
    <div class="login-container">
        <p class="f-20 f-300 text-center">404 - Page Not Found</p>
        <p class="text-muted text-center">Sorry, but nothing exists here.</p>
        @if(Auth::guard('canvas')->check())
            <div style="text-align: center">
                <a href="{!! route('canvas.admin') !!}" class="btn btn-link m-t-10">Back to Dashboard</a>
            </div>
        @else
            <div style="text-align: center">
                <a href="{!! route('canvas.blog.post.index') !!}" class="btn btn-link m-t-10">Back to Blog</a>
            </div>
        @endif
    </div>
@stop
