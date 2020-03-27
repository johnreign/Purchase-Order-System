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

            <li class="pcoded-hasmenu {{ active_class(Active::checkUriPattern('purchase_orders*')) }}">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="fa fa-shopping-cart"></i></i></span>
                    <span class="pcoded-mtext">Purchase Orders</span>
                </a>
                <ul class="pcoded-submenu">
                    <li>
                        <a href="{{ url('admin/list') }}">
                            <span class="pcoded-mtext">PO List</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('admin/list/create') }}">
                            <span class="pcoded-mtext">Create PO</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>