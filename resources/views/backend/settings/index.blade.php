@extends('canvas::backend.layout')

@section('title')
    <title>{{ \Canvas\Models\Settings::blogTitle() }} | Settings</title>
@stop

@section('content')
    <section id="main">
        @include('canvas::backend.shared.partials.sidebar-navigation')
        <section id="content">
            <div class="container">
                <div class="block-header">
                    <h2>Settings</h2>
                    <ul class="actions">
                        <li class="dropdown">
                            <a href="" data-toggle="dropdown">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="{!! route('canvas.admin.settings') !!}"><i class="zmdi zmdi-refresh-alt pd-r-5"></i> Refresh Settings</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                @include('canvas::backend.settings.partials.settings')
                @include('canvas::backend.settings.partials.system-information')
                @include('canvas::backend.settings.partials.about')
            </div>
        </section>
    </section>
@stop

@section('unique-js')
    @if(Session::get('_update-settings'))
        @include('canvas::backend.shared.notifications.notify', ['section' => '_update-settings'])
        {{ \Session::forget('_update-settings') }}
    @endif
    <script async defer src="https://buttons.github.io/buttons.js"></script>
@stop
