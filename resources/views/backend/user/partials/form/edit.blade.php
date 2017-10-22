<form class="keyboard-save" role="form" method="POST" id="userUpdate" action="{{ route('canvas.admin.user.update', $data['id']) }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_method" value="PUT">

    <div class="pmb-block">
        @include('canvas::backend.shared.partials.errors')
        <br>
        <div class="pmbb-header">
            <h2><i class="zmdi zmdi-key m-r-10"></i> Edit Role</h2>
        </div>
        <div class="pmbb-body p-l-30">
            <br>
            <div class="form-group">
                <label class="radio radio-inline m-r-20">
                    <input type="radio" name="role" id="role" value="0" @if (! \Canvas\Models\User::isAdmin($data->role)) checked="checked" @endif>
                    <i class="input-helper"></i>
                    User
                </label>

                <label class="radio radio-inline m-r-20">
                    <input type="radio" name="role" value="1" @if (\Canvas\Models\User::isAdmin($data->role)) checked="checked" @endif>
                    <i class="input-helper"></i>
                    Administrator
                </label>
            </div>
        </div>
    </div>

    <div class="pmb-block">
        <div class="pmbb-header">
            <h2><i class="zmdi zmdi-equalizer m-r-10"></i> Edit Summary</h2>
        </div>
        <div class="pmbb-body p-l-30">
            @include('canvas::backend.user.partials.form.summary')
        </div>
    </div>

    <div class="pmb-block">
        <div class="pmbb-header">
            <h2><i class="zmdi zmdi-account m-r-10"></i> Edit Basic Information</h2>
        </div>
        <div class="pmbb-body p-l-30">
            @include('canvas::backend.user.partials.form.basic-information')
        </div>
    </div>

    <div class="pmb-block">
        <div class="pmbb-header">
            <h2><i class="zmdi zmdi-phone m-r-10"></i> Edit Contact Information</h2>
        </div>
        <div class="pmbb-body p-l-30">
            @include('canvas::backend.user.partials.form.contact-information')
        </div>
    </div>

    <div class="pmb-block">
        <div class="pmbb-header">
            <h2><i class="zmdi zmdi-accounts m-r-10"></i> Edit Social Networks</h2>
        </div>
        <div class="pmbb-body p-l-30">
            @include('canvas::backend.user.partials.form.social-networks')
        </div>
        <div class="form-group m-l-30">
            <button type="submit" class="btn btn-primary btn-icon-text">
                <i class="zmdi zmdi-floppy"></i> Save
            </button>&nbsp;
            <button type="button" class="btn btn-danger btn-icon-text" data-toggle="modal" data-target="#modal-delete">
                <i class="zmdi zmdi-delete"></i> Delete
            </button>
        </div>
    </div>
</form>