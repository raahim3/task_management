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
        <li class="{{ request()->routeIs('admin.users.*') ? 'mm-active' : '' }}" >
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="mdi mdi-account"></i>
                <span>Users</span>
            </a>
            <ul class="sub-menu mm-collapse" aria-expanded="false">
                @php( $roles = \App\Models\Role::where('id','!=',1)->get() )
                @foreach ($roles as $role)
                    <li class="{{ request()->routeIs('admin.settings.general') ? 'mm-active' : '' }}"><a href="{{ route('admin.users.index',$role->id) }}">{{$role->name}}</a></li>
                @endforeach
            </ul>
        </li>

        <li class="{{ request()->routeIs('admin.roles.*') ? 'mm-active' : '' }}">
            <a href="{{ route('admin.roles.index') }}" class="waves-effect {{ request()->routeIs('admin.roles.index') ? 'mm-active' : '' }}">
                <i class="mdi mdi-domain"></i>
                <span>Roles</span>
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
        <li class="{{ request()->routeIs('admin.blogs.*') ? 'mm-active' : '' }} {{ request()->routeIs('admin.categories.*') ? 'mm-active' : '' }}" >
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="mdi mdi-newspaper"></i>
                <span>Blog Management</span>
            </a>
            <ul class="sub-menu mm-collapse" aria-expanded="false">
                <li class="{{ request()->routeIs('admin.categories.index') ? 'mm-active' : '' }}"><a href="{{ route('admin.categories.index') }}">Categories</a></li>
                <li class="{{ request()->routeIs('admin.blogs.index') ? 'mm-active' : '' }}"><a href="{{ route('admin.blogs.index') }}">All Blogs</a></li>
            </ul>
        </li>
        <li class="{{ request()->routeIs('admin.sections.*') ? 'mm-active' : '' }}">
            <a href="{{ route('admin.sections.index') }}" class="waves-effect {{ request()->routeIs('admin.sections.index') ? 'mm-active' : '' }}">
                <i class="mdi mdi-folder"></i>
                <span>Sections</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.settings.*') ? 'mm-active' : '' }}" >
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="mdi mdi-cog"></i>
                <span>Settings</span>
            </a>
            <ul class="sub-menu mm-collapse" aria-expanded="false">
                <li class="{{ request()->routeIs('admin.settings.general') ? 'mm-active' : '' }}"><a href="{{ route('admin.settings.general') }}">General Settings</a></li>
            </ul>
        </li>

    </ul>
</div>