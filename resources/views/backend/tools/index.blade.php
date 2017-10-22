@extends('canvas::backend.layout')

@section('title')
    <title>{{ \Canvas\Models\Settings::blogTitle() }} | Tools</title>
@stop

@section('content')
    <section id="main">
        @include('canvas::backend.shared.partials.sidebar-navigation')
        <section id="content">
            <div class="container">
                <div class="block-header">
                    <h2>Tools</h2>
                    <ul class="actions">
                        <li class="dropdown">
                            <a href="" data-toggle="dropdown">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="{!! route('canvas.admin.tools') !!}"><i class="zmdi zmdi-refresh-alt pd-r-5"></i> Refresh Tools</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        @include('canvas::backend.tools.sections.maintenance-mode')
                    </div>
                    <div class="col-sm-6 col-md-6">
                        @include('canvas::backend.tools.sections.export-data')
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        @include('canvas::backend.tools.sections.clear-cache')
                    </div>
                </div>
            </div>
        </section>
    </section>
    @include('canvas::backend.tools.partials.modals.cache-clear')
@stop

@section('unique-js')
    @if(Session::get('_cache-clear'))
        @include('canvas::backend.shared.notifications.notify', ['section' => '_cache-clear'])
        {{ \Session::forget('_cache-clear') }}
    @endif
    @if(Session::get('_enable-maintenance-mode'))
        @include('canvas::backend.shared.notifications.notify', ['section' => '_enable-maintenance-mode'])
        {{ \Session::forget('_enable-maintenance-mode') }}
    @endif
    @if(Session::get('_disable-maintenance-mode'))
        @include('canvas::backend.shared.notifications.notify', ['section' => '_disable-maintenance-mode'])
        {{ \Session::forget('_disable-maintenance-mode') }}
    @endif
@stop
