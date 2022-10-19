@if (Auth::user()->role == 'Admin')
    admin
@else
    owner
@endif
