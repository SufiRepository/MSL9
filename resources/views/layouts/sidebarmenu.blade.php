<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        {{-- @can('user-list') --}}
        <li
            class="nav-item {{ Request::is('users*') ? 'menu-open' : '' }} {{ Request::is('roles*') ? 'menu-open' : '' }} {{ Request::is('permissions*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user-cog"></i>
                <p>ADMIN PANELS<i class="fas fa-angle-left right"></i> </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>USERS</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-suitcase-rolling"></i>
                        <p>ROLES</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('permissions.index') }}"
                        class="nav-link {{ Request::is('permissions*') ? 'active' : '' }}">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>PERMISSIONS</p>
                    </a>
                </li>
            </ul>
        </li>
        {{-- @endcan --}}

        {{-- Projects --}}
        <li class="nav-item">
            <a href="{{ route('projects.index') }}" class="nav-link {{ Request::is('projects*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>PROJECTS</p>
            </a>
        </li>
        {{-- Tasks --}}
        <li class="nav-item">
            <a href="{{ route('tasks.index') }}" class="nav-link {{ Request::is('tasks*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>TASKS</p>
            </a>
        </li>
        {{-- Resources --}}
        <li class="nav-item">
            <a href="{{ route('resources.index') }}" class="nav-link {{ Request::is('resources*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>RESOURCES</p>
            </a>
        </li>
        {{-- CALENDAR --}}
        <li class="nav-item">
            <a href="{{ route('calendars.index') }}" class="nav-link {{ Request::is('calendars*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>CALENDAR</p>
            </a>
        </li>
        {{-- Resources --}}
        <li class="nav-item">
            <a href="{{ route('userscsv') }}" class="nav-link {{ Request::is('csvusers*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>USERS FROM CSV</p>
            </a>
        </li>
        {{-- Notifications --}}
        <li class="nav-item">
            <a href="{{ route('notifications.index') }}"
                class="nav-link {{ Request::is('notifications*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>NOTIFICATIONS</p>
            </a>
        </li>
        {{-- GeoMaps --}}
        <li class="nav-item">
            <a href="{{ route('geomaps.index') }}"
                class="nav-link {{ Request::is('notifications*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>MAPS</p>
            </a>
        </li>
    </ul>
</nav>
