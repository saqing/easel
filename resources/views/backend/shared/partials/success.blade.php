@if (Session::has('success'))
    <ul style="padding-left: 0">
        <li class="text-success" style="list-style-type: none"><small><i class="zmdi zmdi-check-circle"></i> {{ Session::get('success') }}</small></li>
    </ul>
@endif