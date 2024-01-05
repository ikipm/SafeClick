<div>
    <div class="sidebar">
        <a href="/admin" class="sidebar-button">@lang('admin.adminButton')</a>
        <a href="/admin/users" class="sidebar-button">@lang('admin.usersTitle')</a>
        <a href="/admin/courses" class="sidebar-button">@lang('admin.courses')</a>
        <a href="/admin/logs/404" class="sidebar-button">404 logs</a>
        <a href="/admin/logs/guest" class="sidebar-button">Guest logs</a>
        <a href="/admin/users" class="sidebar-button">@lang('admin.newUsers')</a>
    </div>

    <button class="sidebar-toggle">
        <span></span>
        <span></span>
        <span></span>
    </button>
</div>

<link rel="stylesheet" type="text/css" href="{{ asset('css/sideBar.css') }}">