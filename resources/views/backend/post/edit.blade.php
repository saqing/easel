@extends('canvas::backend.layout')

@section('title')
    <title>{{ \Canvas\Models\Settings::blogTitle() }} | Edit Post</title>
@stop

@section('content')
    <section id="main">
        @include('canvas::backend.shared.partials.sidebar-navigation')
        <section id="content">
            <div class="container">
                @include('canvas::backend.post.partials.form')
            </div>
        </section>
    </section>
    @include('canvas::backend.post.partials.modals.delete')
@stop

@section('unique-js')
    @include('canvas::backend.post.partials.editor')

    @include('canvas::backend.shared.components.datetime-picker')

    @if(Session::get('_update-post'))
        @include('canvas::backend.shared.notifications.notify', ['section' => '_update-post'])
        {{ \Session::forget('_update-post') }}
    @endif

    @if(Session::get('_new-post'))
        @include('canvas::backend.shared.notifications.notify', ['section' => '_new-post'])
        {{ \Session::forget('_new-post') }}
    @endif

    @include('canvas::backend.shared.components.slugify')
@stop
