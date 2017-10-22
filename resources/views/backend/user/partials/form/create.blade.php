<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">First Name</label>
        <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="First Name">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">Last Name</label>
        <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="Last Name">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">Display Name</label>
        <textarea class="form-control auto-size" id="display_name" name="display_name" placeholder="Display Name">{{ old('display_name') }}</textarea>
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">Email</label>
        <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Email">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">Password</label>
        <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}" placeholder="Password">
    </div>
</div>

<br>

<div class="form-group">
    <label class="radio radio-inline m-r-20">
        <input type="radio" name="role" id="role" value="0" @if (Input::old('role') == 0) checked @endif>
        <i class="input-helper"></i>
        User
    </label>

    <label class="radio radio-inline m-r-20">
        <input type="radio" name="role" value="1" @if (Input::old('role') == 1) checked @endif>
        <i class="input-helper"></i>
        Administrator
    </label>
</div>

<br>