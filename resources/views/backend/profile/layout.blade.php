@extends('canvas::backend.layout')

@section('title')
    <title>{{ \Canvas\Models\Settings::blogTitle() }} | Profile</title>
@stop

@section('content')
    <section id="main">
        @include('canvas::backend.shared.partials.sidebar-navigation')
        <section id="content">
            <div class="container container-alt">
                <div class="block-header">
                    <h2>Profile</h2>
                    <ul class="actions">
                        <li class="dropdown">
                            <a href="" data-toggle="dropdown">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="{!! route('canvas.admin.profile.index') !!}"><i class="zmdi zmdi-refresh-alt pd-r-5"></i> Refresh Profile</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="card" id="profile-main">
                    @include('canvas::backend.profile.partials.sidebar')
                    <div class="pm-body clearfix">
                        @section('profile-content')
                            <ul class="tab-nav tn-justified">
                                <li class="{{ Route::is('canvas.admin.profile.index') ? 'active' : '' }}">
                                    <a href="{!! route('canvas.admin.profile.index') !!}">Profile</a>
                                </li>
                                <li class="{{ Route::is('canvas.admin.profile.privacy') ? 'active' : '' }}">
                                    <a href="{!! route('canvas.admin.profile.privacy') !!}">Privacy</a>
                                </li>
                            </ul>
                            {{--@if(Session::has('errors') || Session::has('success'))--}}
                                {{--<div class="pmb-block">--}}
                                    {{--<div class="pmbb-header">--}}
                                        {{--@include('canvas::backend.shared.partials.errors')--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--@endif--}}
                        @show
                    </div>
                </div>
            </div>
        </section>
    </section>
@stop