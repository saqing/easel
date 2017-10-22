@extends('canvas::backend.layout')

@section('title')
    <title>{{ \Canvas\Models\Settings::blogTitle() }} | Help</title>
@stop

@section('content')
    <section id="main">
        @include('canvas::backend.shared.partials.sidebar-navigation')
        <section id="content">
            <div class="container">
                <div class="block-header">
                    <h2>Help</h2>
                    <ul class="actions">
                        <li class="dropdown">
                            <a href="" data-toggle="dropdown">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="{!! route('canvas.admin.help') !!}"><i class="zmdi zmdi-refresh-alt pd-r-5"></i> Refresh Help</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2>Help Topics
                            <small>Help is available for all of the following topics:</small>
                        </h2>
                    </div>
                    <div class="card-body card-padding">
                        @include('canvas::backend.help.partials.overview')
                        <hr>
                        @include('canvas::backend.help.partials.topics')
                        <hr>
                        @include('canvas::backend.help.partials.items')
                    </div>
                </div>
            </div>
        </section>
    </section>
@stop

@section('unique-js')
    @include('canvas::backend.shared.components.smooth-scroll')
@endsection
