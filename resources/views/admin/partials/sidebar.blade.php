<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">Main</li>

        <li class="{{ request()->routeIs('admin.index') ? 'mm-active' : '' }}">
            <a href="{{ route('admin.index') }}" class="waves-effect {{ request()->routeIs('admin.index') ? 'mm-active' : '' }}">
                <i class="mdi mdi-view-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="{{ request()->routeIs('admin.organizations.index') ? 'mm-active' : '' }} {{ request()->routeIs('admin.organizations.create') ? 'mm-active' : '' }} {{ request()->routeIs('admin.organizations.edit') ? 'mm-active' : '' }}">
            <a href="{{ route('admin.organizations.index') }}" class="waves-effect {{ request()->routeIs('admin.organizations.index') ? 'mm-active' : '' }}">
                <i class="mdi mdi-domain"></i>
                <span>Organizations</span>
            </a>
        </li>

        <li class="{{ request()->routeIs('admin.plans.index') ? 'mm-active' : '' }} {{ request()->routeIs('admin.plans.create') ? 'mm-active' : '' }} {{ request()->routeIs('admin.plans.edit') ? 'mm-active' : '' }}">
            <a href="{{ route('admin.plans.index') }}" class="waves-effect {{ request()->routeIs('admin.plans.index') ? 'mm-active' : '' }}">
                <i class="mdi mdi-cube-outline"></i>
                <span>Plans</span>
            </a>
        </li>

    </ul>
</div>