<nav class="sidebar-nav scroll-sidebar" data-simplebar="">
    <ul id="sidebarnav">
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu text-primary">Main Menus</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link {{ singleMenuActive('singleMenuActive') }}" href="{{ route('rooms') }}"
                aria-expanded="false">
                <span>
                    <i class="ti ti-home-search text-dark"></i>
                </span>
                <span class="hide-menu">Rooms</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link {{ singleMenuActive('singleMenuActive') }}" href=" "
                aria-expanded="false">
                <span>
                    <i class="ti ti-home-search text-dark"></i>
                </span>
                <span class="hide-menu">History</span>
            </a>
        </li>
    </ul>
</nav>
