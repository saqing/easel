<div class="card">
    <div class="card-header">
        <h2>Quick Draft
            <small>Save a quick draft post:</small>
        </h2>

        <br>

        @include('canvas::backend.shared.partials.errors')

        <form class="keyboard-save" role="form" method="POST" id="postCreate" action="{{ route('canvas.admin.post.store') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            @include('canvas::backend.home.partials.form')

            <br>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-icon-text"><i class="zmdi zmdi-floppy"></i> Save Draft</button>
            </div>
        </form>
    </div>
</div>