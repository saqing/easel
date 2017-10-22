@extends('canvas::backend.layout')

@section('title')
    <title>{{ \Canvas\Models\Settings::blogTitle() }} | New Tag</title>
@stop

@section('content')
    <section id="main">
        @include('canvas::backend.shared.partials.sidebar-navigation')
        <section id="content">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <ol class="breadcrumb">
                            <li><a href="{!! route('canvas.admin') !!}">Home</a></li>
                            <li><a href="{!! route('canvas.admin.tag.index') !!}">Tags</a></li>
                            <li class="active">New Tag</li>
                        </ol>
                        <h2>Create a New Tag</h2>
                    </div>

                    <div class="card-body card-padding">

                        @include('canvas::backend.shared.partials.errors')

                        <form class="keyboard-save" role="form" method="POST" id="tagUpdate" action="{!! route('canvas.admin.tag.index') !!}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            @include('canvas::backend.tag.partials.form')

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-icon-text"><i class="zmdi zmdi-floppy"></i> Save</button>
                                &nbsp;
                                <a href="{!! route('canvas.admin.tag.index') !!}"><button type="button" class="btn btn-link">Cancel</button></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </section>
@stop

@section('unique-js')
    @include('canvas::backend.shared.notifications.protip')
@stop