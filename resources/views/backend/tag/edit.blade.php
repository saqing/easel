@extends('canvas::backend.layout')

@section('title')
    <title>{{ \Canvas\Models\Settings::blogTitle() }} | Edit Tag</title>
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
                            <li class="active">Edit Tag</li>
                        </ol>
                        <h2>
                            Edit <em>{{ $data['title'] }}</em>
                            <small>
                                @if(isset($data['updated_at']))
                                    Last edited on {{$data['updated_at']->format('M d, Y') }} at {{ $data['updated_at']->format('g:i A') }}
                                @else
                                    Last edited on {{ $data['created_at']->format('M d, Y') }} at {{ $data['created_at']->format('g:i A') }}
                                @endif
                            </small>
                        </h2>

                    </div>
                    <div class="card-body card-padding">

                        @include('canvas::backend.shared.partials.errors')

                        <form class="keyboard-save" role="form" method="POST" id="tagUpdate" action="{!! route('canvas.admin.tag.update', $data['id']) !!}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="id" value="{{ $data['id'] }}">

                            @include('canvas::backend.tag.partials.form')

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-icon-text">
                                    <i class="zmdi zmdi-floppy"></i> Save
                                </button>&nbsp;
                                <button type="button" class="btn btn-danger btn-icon-text" data-toggle="modal" data-target="#modal-delete">
                                    <i class="zmdi zmdi-delete"></i> Delete
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </section>
    @include('canvas::backend.tag.partials.modals.delete')
@stop

@section('unique-js')
    @if(Session::get('_update-tag'))
        @include('canvas::backend.shared.notifications.notify', ['section' => '_update-tag'])
        {{ \Session::forget('_update-tag') }}
    @endif
@stop
