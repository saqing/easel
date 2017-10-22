@extends('canvas::backend.layout')

@section('title')
    <title>{{ \Canvas\Models\Settings::blogTitle() }} | Search</title>
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
                            <li class="active">Search</li>
                        </ol>
                        <h2><i class="zmdi zmdi-search"></i> Search Results for <em>{{ request('search') }}</em></h2>
                        <br>
                        <div class="table-responsive">
                            @include('canvas::backend.search.partials.results')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@stop
