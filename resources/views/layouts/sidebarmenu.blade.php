<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        @can('user-list')
            <li
                class="nav-item @isset($navlink) @if (in_array('pengurusan_pengguna', $navlink)) menu-open @endif @endisset">
                <a href="#"
                    class="nav-link @isset($navlink) @if (in_array('pengurusan_pengguna', $navlink)) active @endif @endisset">
                    <i class="nav-icon fas fa-user-cog"></i>
                    <p>ADMIN PANELS<i class="fas fa-angle-left right"></i> </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}"
                            class="nav-link @isset($navlink) @if (in_array('pengguna', $navlink)) active @endif @endisset">
                            <i class="nav-icon fas fa-user"></i>
                            <p>USERS</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('roles.index') }}"
                            class="nav-link @isset($navlink) @if (in_array('peranan', $navlink)) active @endif @endisset">
                            <i class="nav-icon fas fa-suitcase-rolling"></i>
                            <p>ROLES</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('permissions.index') }}"
                            class="nav-link @isset($navlink) @if (in_array('kebenaran', $navlink)) active @endif @endisset">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>PERMISSIONS</p>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan

        {{-- Projects --}}
        <li class="nav-item">
            <a href="{{ route('projects.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>PROJECTS</p>
            </a>
        </li>
        {{-- Projects --}}
        <li class="nav-item">
            <a href="{{ route('projects.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>PROJECT ADD</p>
            </a>
        </li>{{-- Projects --}}
    </ul>
</nav>
