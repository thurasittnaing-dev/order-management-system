<nav class="sidebar-nav scroll-sidebar" data-simplebar="">
    <ul id="sidebarnav">
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu text-primary">Main Menus</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="#" aria-expanded="false">
                <span>
                    <i class="ti ti-chart-line"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
            </a>
        </li>


        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu text-primary">Master Data</span>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link {{ menu_active('order_tables') }}" href="{{ route('order_tables.index') }}"
                aria-expanded="false">
                <span>
                    <i class="ti ti-armchair"></i>
                </span>
                <span class="hide-menu">Table</span>
            </a>
        </li>


        <li class="sidebar-item">
            <a class="sidebar-link {{ menu_active('user') }}" href="{{ route('user.index') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">User</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link {{ menu_active('category') }}" href="{{ route('category.index') }}"
                aria-expanded="false">
                <span>
                    <i class="ti ti-list-numbers"></i>
                </span>
                <span class="hide-menu">Category</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link {{ menu_active('room') }}" href="{{ route('room.index') }}"
                aria-expanded="false">
                <span>
                    <i class="ti ti-list-numbers"></i>
                </span>
                <span class="hide-menu">Room</span>
            </a>
        </li>
    </ul>
</nav>
