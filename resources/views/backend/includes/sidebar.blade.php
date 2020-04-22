<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Basic</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class=" {{ active_class(Active::checkUriPattern('admin/dashboard*')) }}">
                <a href="{{ url('admin/dashboard') }}">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>

            <li class="pcoded-hasmenu {{ Request::is('admin/list*') ? 'pcoded-trigger' : ''}}">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-shopping-cart"></i></i></span>
                    <span class="pcoded-mtext">Purchase Orders</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ Request::is('admin/list', 'admin/list/edit/*') ? 'active' : ''}}">
                        <a href="{{ url('admin/list') }}">
                            <span class="pcoded-mtext">PO List</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/list/create') ? 'active' : ''}}">
                        <a href="{{ url('admin/list/create') }}">
                            <span class="pcoded-mtext">Create PO</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>