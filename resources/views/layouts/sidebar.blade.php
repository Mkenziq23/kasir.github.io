<div id="app-sidepanel" class="app-sidepanel bg-dark">
    <div id="sidepanel-drop" class="sidepanel-drop"></div>
    <div class="sidepanel-inner d-flex flex-column" id="sidebar">
        <a href="" id="sidepanel-close" class="sidepanel-close text-white"><i class="fa-solid fa-xmark"></i></a>

        <div class="app-branding p-3 text-center">
            <a class="app-logo d-flex align-items-center justify-content-center" href="/">
                <img class="logo-icon rounded-3" src="/images/logo.png" alt="logo"
                    style="width: 100px; height: auto;">
            </a>
        </div>

        <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1 mt-3">
            <ul class="app-menu list-unstyled">

                {{-- Dashboard --}}
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">
                        <span class="nav-icon">
                            <i class="fa-solid fa-house-chimney"></i>
                        </span>
                        <span class="nav-link-text">Overview</span>
                    </a>
                </li>

                {{-- Employee Management for Admin --}}
                @can('admin')
                    <li class="nav-item accordion-item">
                        <a class="nav-link {{ Request::is('user') || Request::is('user/create') ? 'active' : '' }}"
                            data-bs-toggle="collapse" href="#submenu-3" role="button"
                            aria-expanded="{{ Request::is('user') || Request::is('user/create') ? 'true' : 'false' }}"
                            aria-controls="submenu-3">
                            <span class="nav-icon">
                                <i class="fa-solid fa-user"></i>
                            </span>
                            <span class="nav-link-text">Employee</span>
                            <span class="submenu-arrow ms-auto">
                                <i class="fa-solid fa-chevron-down"></i>
                            </span>
                        </a>
                        <div class="collapse {{ Request::is('user') || Request::is('user/create') ? 'show' : '' }}"
                            id="submenu-3">
                            <ul class="submenu-list list-unstyled">
                                <li class="submenu-item"><a class="submenu-link {{ Request::is('user') ? 'active' : '' }}"
                                        href="/user">All Employee's</a></li>
                                <li class="submenu-item"><a
                                        class="submenu-link {{ Request::is('user/create') ? 'active' : '' }}"
                                        href="/user/create">Add New Employee</a></li>
                            </ul>
                        </div>
                    </li>
                @endcan

                {{-- Menu Management for Manager --}}
                @can('manager')
                    <li class="nav-item accordion-item">
                        <a class="nav-link {{ Request::is('menu') || Request::is('menu/create') ? 'active' : '' }}"
                            data-bs-toggle="collapse" href="#submenu-1" role="button"
                            aria-expanded="{{ Request::is('menu') || Request::is('menu/create') ? 'true' : 'false' }}"
                            aria-controls="submenu-1">
                            <span class="nav-icon">
                                <i class="fa-solid fa-bag-shopping"></i>
                            </span>
                            <span class="nav-link-text">Menu</span>
                            <span class="submenu-arrow ms-auto">
                                <i class="fa-solid fa-chevron-down"></i>
                            </span>
                        </a>
                        <div class="collapse {{ Request::is('menu') || Request::is('menu/create') ? 'show' : '' }}"
                            id="submenu-1">
                            <ul class="submenu-list list-unstyled">
                                <li class="submenu-item"><a class="submenu-link {{ Request::is('menu') ? 'active' : '' }}"
                                        href="/menu">All Menu's</a></li>
                                <li class="submenu-item"><a
                                        class="submenu-link {{ Request::is('menu/create') ? 'active' : '' }}"
                                        href="/menu/create">Add New Menu</a></li>
                            </ul>
                        </div>
                    </li>
                @endcan

                {{-- Transaction for Cashier and Manager --}}
                @cannot('admin')
                    <li class="nav-item accordion-item">
                        <a class="nav-link {{ Request::is('transaction') || Request::is('transaction/create') ? 'active' : '' }}"
                            data-bs-toggle="collapse" href="#submenu-2" role="button"
                            aria-expanded="{{ Request::is('transaction') || Request::is('transaction/create') ? 'true' : 'false' }}"
                            aria-controls="submenu-2">
                            <span class="nav-icon">
                                <i class="fa-solid fa-dollar-sign"></i>
                            </span>
                            <span class="nav-link-text">Transaction</span>
                            <span class="submenu-arrow ms-auto">
                                <i class="fa-solid fa-chevron-down"></i>
                            </span>
                        </a>
                        <div class="collapse {{ Request::is('transaction') || Request::is('transaction/create') ? 'show' : '' }}"
                            id="submenu-2">
                            <ul class="submenu-list list-unstyled">
                                @can('manager')
                                    <li class="submenu-item"><a
                                            class="submenu-link {{ Request::is('transaction') ? 'active' : '' }}"
                                            href="/transaction">All Transaction's</a></li>
                                @endcan
                                @can('cashier')
                                    <li class="submenu-item"><a
                                            class="submenu-link {{ Request::is('transaction') ? 'active' : '' }}"
                                            href="/transaction">All Transaction's</a></li>
                                    <li class="submenu-item"><a
                                            class="submenu-link {{ Request::is('transaction/create') ? 'active' : '' }}"
                                            href="/transaction/create">Make Order</a></li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan

                {{-- Activity Log for Non-Cashier Roles --}}
                @cannot('cashier')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('activityLog') ? 'active' : '' }}" href="/activityLog">
                            <span class="nav-icon">
                                <i class="fa-solid fa-clipboard-list"></i>
                            </span>
                            <span class="nav-link-text">Activity Log</span>
                        </a>
                    </li>
                @endcan

            </ul>
        </nav>
    </div>
</div>
