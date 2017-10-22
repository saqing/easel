@extends('canvas::backend.layout')

@section('title')
    <title>{{ \Canvas\Models\Settings::blogTitle() }} | Users</title>
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
                            <li class="active">Users</li>
                        </ol>
                        <ul class="actions">
                            <li class="dropdown">
                                <a href="" data-toggle="dropdown">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="{!! route('canvas.admin.user.index') !!}"><i class="zmdi zmdi-refresh-alt pd-r-5"></i> Refresh Users</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <h2>Users&nbsp;
                            <a href="{!! route('canvas.admin.user.create') !!}" id="create-user"><i class="zmdi zmdi-plus-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Create a new user"></i></a>

                            <small>This page provides a comprehensive overview of all the current users. Click the <span class="zmdi zmdi-edit text-primary"></span> icon next to each user to update their site access or remove them from the system.</small>
                        </h2>
                        @include('canvas::backend.shared.partials.errors')
                    </div>

                    <div class="table-responsive">
                        <table id="users" class="table table-condensed table-vmiddle">
                            <thead>
                            <tr>
                                <th data-column-id="id" data-type="numeric" data-order="asc">ID</th>
                                <th data-column-id="display_name">Name</th>
                                <th data-column-id="email">Email</th>
                                <th data-column-id="role">Role</th>
                                <th data-column-id="posts">Posts</th>
                                <th data-column-id="edit_url" data-sortable="false" data-visible="false">Edit URL</th>
                                <th data-column-id="commands" data-formatter="commands" data-sortable="false">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->display_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->isAdmin($user->role) ? '<span class="label label-primary">Administrator</span>' : '<span class="label label-default">User</span>' }}</td>
                                    <td>{{ $user->postCount($user->id) }}</td>
                                    <td>{!! route('canvas.admin.user.edit', $user->id) !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </section>
@stop

@section('unique-js')
    @include('canvas::backend.user.partials.datatable')

    @if(Session::get('_new-user'))
        @include('canvas::backend.shared.notifications.notify', ['section' => '_new-user'])
        {{ \Session::forget('_new-user') }}
    @endif

    @if(Session::get('_delete-user'))
        @include('canvas::backend.shared.notifications.notify', ['section' => '_delete-user'])
        {{ \Session::forget('_delete-user') }}
    @endif
@stop
