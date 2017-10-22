@extends('canvas::backend.layout')

@section('title')
    <title>{{ \Canvas\Models\Settings::blogTitle() }} | Tags</title>
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
                            <li class="active">Tags</li>
                        </ol>
                        <ul class="actions">
                            <li class="dropdown">
                                <a href="" data-toggle="dropdown">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="{!! route('canvas.admin.tag.index') !!}"><i class="zmdi zmdi-refresh-alt pd-r-5"></i> Refresh Tags</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        @include('canvas::backend.shared.partials.errors')
                        <h2>Tags&nbsp;
                            <a href="{!! route('canvas.admin.tag.create') !!}" id="create-tag"><i class="zmdi zmdi-plus-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Create a new tag"></i></a>
                            <small>This page provides a comprehensive overview of all your blog tags. Click the <span class="zmdi zmdi-edit text-primary"></span> icon next to each tag to update its contents.</small>
                        </h2>
                    </div>

                    <div class="table-responsive">
                        <table id="tags" class="table table-condensed table-vmiddle">
                            <thead>
                                <tr>
                                    <th data-column-id="id" data-type="numeric" data-order="desc">Id</th>
                                    <th data-column-id="title">Title</th>
                                    <th data-column-id="subtitle">Subtitle</th>
                                    <th data-column-id="layout">Layout</th>
                                    <th data-column-id="direction">Direction</th>
                                    <th data-column-id="created" data-type="date">Created</th>
                                    <th data-column-id="edit_url" data-sortable="false" data-visible="false">Edit URL</th>
                                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $tag)
                                    <tr>
                                        <td>{!! $tag->id !!}</td>
                                        <td>{!! $tag->title !!}</td>
                                        <td class="hidden-sm">{!! str_limit($tag->subtitle, config('blog.backend_trim_width')) !!}</td>
                                        <td class="hidden-md">{{ $tag->layout }}</td>
                                        <td class="hidden-sm">
                                            @if ($tag->reverse_direction)
                                                Reverse
                                            @else
                                                Normal
                                            @endif
                                        </td>
                                        <td>{!! $tag->created_at->format('M d, Y') !!}</td>
                                        <td>{!! route('canvas.admin.tag.edit', $tag->id) !!}</td>
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
    @include('canvas::backend.tag.partials.datatable')

    @if(Session::get('_new-tag'))
        @include('canvas::backend.shared.notifications.notify', ['section' => '_new-tag'])
        {!! \Session::forget('_new-tag') !!}
    @endif

    @if(Session::get('_delete-tag'))
        @include('canvas::backend.shared.notifications.notify', ['section' => '_delete-tag'])
        {!! \Session::forget('_delete-tag') !!}
    @endif
@stop
