<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('index') }}"><i class="nav-icon icons cui-dashboard"></i> Dashboard</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('document-tracking') }}"><i class="nav-icon icon-folder"></i> Document Tracking System</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cea') }}"><i class="nav-icon icon-drawer"></i> PMACEA</a>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-globe"></i> Settings</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item"><a class="nav-link" href="{{ route('personnel.index') }}"><span class="ml-4">Personnel</span></a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('office.index') }}"><span class="ml-4">Office</span></a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('unit.index') }}"><span class="ml-4">Unit</span></a></li>
                        </ul>
            </li>--}}
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-wrench"></i> Management</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}"><span class="ml-4">Users</span></a></li>
                            {{-- <li class="nav-item"><a class="nav-link" href="{{ route('manage.roles') }}"><span class="ml-4">Roles</span></a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('manage.permissions') }}"><span class="ml-4">Permissions</span></a></li> --}}
                        </ul>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>