<!-- Sidebar Navigation-->
<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-dashboard">
        <div class="avatar"><a href="{{ route('dashboard') }}">&nbsp;</a></div>
        <div class="title">{{ Auth::user()->name }}{{ (Auth::user()->role_id == 1) ? ' (Admin)' : '' }}</div>
    </div>
    <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
    <ul class="list-unstyled">
        <li class="{{ (\Request::route()->getName() == 'dashboard') ? 'active' : '' }}"><a href="/dashboard"><i class="icon-home"></i>Dashboard</a></li>
        <li>User Management</li>
        <li class="{{ (\Request::route()->getName() == 'roles') ? 'active' : '' }}"><a href="/roles"><i class="icon-home"></i>Roles</a></li>
        <li class="{{ (\Request::route()->getName() == 'users') ? 'active' : '' }}"><a href="/users"><i class="icon-writing-whiteboard"></i>Users</a></li>
        <li>Expense Management</li>
        <li class="{{ (\Request::route()->getName() == 'expense_categories') ? 'active' : '' }}"><a href="/expense_categories"><i class="icon-home"></i>Expense Categories</a></li>
        <li class="{{ (\Request::route()->getName() == 'expenses') ? 'active' : '' }}"><a href="/expenses"><i class="icon-writing-whiteboard"></i>Expenses</a></li>
    </ul>
</nav>
<!-- Sidebar Navigation end-->