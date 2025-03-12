{{-- Button bar for user list --}}
<div class="btn-group">
    <button type="button" class="btn btn-outline-primary btn-header dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        List types
    </button>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ route('user-list-active', app()->getLocale()) }}">Active users</a>
        <a class="dropdown-item" href="{{ route('user-list-status', app()->getLocale()) }}">Users with status</a>
        <a class="dropdown-item" href="{{ route('user-list-check', app()->getLocale()) }}">Users to check</a>

        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('user-list', app()->getLocale()) }}">All users</a>
    </div>
</div>
<button onclick="print();" type="button" class="btn btn-outline-info btn-header">Print</button>
<button data-toggle="modal" data-target="#modal_user_search" type="button" class="btn btn-outline-secondary btn-header">Search all users</button>
<button onclick="window.location.href = '{{ route('user-add', app()->getLocale()) }}';" type="button" class="btn btn-outline-success btn-header">Add new user</button>


