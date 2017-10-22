@extends('canvas::errors.layout')

@section('title')
    <title>{{ \Canvas\Models\Settings::blogTitle() }} | Be right back</title>
@stop

@section('content')
    <div class="login-container">
        <p class="f-20 f-300 text-center">503 - Be right back</p>
        <p class="text-muted text-center">We're currently in Maintenance mode. Why don't you check back shortly?</p>
    </div>
@stop