@extends('canvas::backend.layout')

@section('title')
    <title>{{ \Canvas\Models\Settings::blogTitle() }} | Edit User Privacy</title>
@stop

@section('content')
    <section id="main">
        @include('canvas::backend.shared.partials.sidebar-navigation')
        <section id="content">
            <div class="container container-alt">
                <div class="block-header">
                    <h2>User Profile</h2>
                    <ul class="actions">
                        <li class="dropdown">
                            <a href="" data-toggle="dropdown">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="{!! route('canvas.admin.user.edit', $data['id']) !!}"><i class="zmdi zmdi-refresh-alt pd-r-5"></i> Refresh User</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="card" id="profile-main">
                    @include('canvas::backend.user.partials.sidebar')
                    <div class="pm-body clearfix">
                        <ul class="tab-nav tn-justified">
                            <li class="{{ Route::is('canvas.admin.user.edit') ? 'active' : '' }}">
                                <a href="{!! route('canvas.admin.user.edit', $data['id']) !!}">Profile</a>
                            </li>
                            <li class="{{ Route::is('canvas.admin.user.privacy') ? 'active' : '' }}">
                                <a href="{!! route('canvas.admin.user.privacy', $data['id']) !!}">Privacy</a>
                            </li>
                        </ul>
                        <div class="pmb-block">
                            <div class="pmbb-header">
                                <h2><i class="zmdi zmdi-shield-security m-r-10"></i> Change Password</h2>
                            </div>

                            <div class="pmbb-body p-l-30">
                                @include('canvas::backend.shared.partials.errors')
                                @include('canvas::backend.user.partials.form.password')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@stop

@section('unique-js')
    @include('canvas::backend.shared.components.show-password', ['inputs' => 'input[name="new_password"], input[name="new_password_confirmation"]'])

    @if(Session::get('_passwordUpdate'))
        @include('canvas::backend.shared.notifications.notify', ['section' => '_passwordUpdate'])
        {{ \Session::forget('_passwordUpdate') }}
    @endif
@stop
