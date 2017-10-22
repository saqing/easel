@extends('canvas::backend.layout')

@section('title')
    <title>{{ \Canvas\Models\Settings::blogTitle() }} | Sign In</title>
@stop

@section('login')
    <div class="login-container">
        @include('canvas::backend.shared.partials.errors')
        @include('canvas::auth.partials.form')
    </div>
@endsection

@section('unique-js')
    @include('canvas::backend.shared.components.show-password', ['inputs' => 'input[name="password"]'])
@stop