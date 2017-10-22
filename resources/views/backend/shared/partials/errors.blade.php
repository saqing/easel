@if (isset($errors) && count($errors) > 0)
    @foreach ($errors->all() as $error)
        <ul class="form-errors" style="padding-left: 0">
            <li class="text-danger" style="list-style-type: none"><small><i class="zmdi zmdi-close-circle"></i> {{ $error }}</small></li>
        </ul>
    @endforeach
@endif