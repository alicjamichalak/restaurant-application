<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
    </a>


    <!-- Nav Item - Dashboard -->
@if (Route::has('dashboard_client'))
    <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <li class="nav-item {{ in_array(Request::segment(1), ['dashboard', '']) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.index') }}"> <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
@endif

<!-- Divider -->
    <hr class="sidebar-divider">

    @if (Auth::check())
        @if(auth()->user()->user_type === 'administrator')
            <!-- Heading -->
                <div class="sidebar-heading">
                    Administration Interface
                </div>
                <li class="nav-item {{ Request::segment(2) === 'menu' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.menu.index') }}"> <i class="fas fa-utensils"></i> <span>Restaurant Menu</span></a>
                </li>
                <li class="nav-item {{ Request::segment(2) === 'food-type' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.food-type.index') }}"> <i class="fas fa-coffee"></i> <span>Food Types</span></a>
                </li>
                <li class="nav-item {{ Request::segment(2) === 'employee' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.employee.index') }}"><i class="fas fa-address-book"></i><span>Employees</span></a>
                </li>
                <li class="nav-item {{ Request::segment(2) === 'table' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.table.index') }}"> <i class="fas fa-microchip"></i> <span>Tables</span></a>
                </li>
                <li class="nav-item {{ Request::segment(2) === 'client' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.client.index') }}"> <i class="fas fa-users"></i>  <span>Clients</span></a>
                </li>
                <li class="nav-item {{ Request::segment(2) === 'receipt' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.receipt.index') }}"> <i class="fas fa-receipt"></i> <span>Receipts</span></a>
                </li>
                <li class="nav-item {{ Request::segment(2) === 'order' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.order.index') }}"> <i class="fas fa-hourglass-half"></i> <span>Orders</span></a>
                </li>
        @elseif(auth()->user()->user_type === 'employee')
                <div class="sidebar-heading">
                    Employee Interface
                </div>
                <li class="nav-item {{ Request::segment(2) === 'receipt' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('employee.receipt.index') }}"> <i class="fas fa-receipt"></i> <span>Reeceipts</span></a>
                </li>
                <li class="nav-item {{ Request::segment(2) === 'order' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('employee.order.index') }}"> <i class="fas fa-hourglass-half"></i> <span>Orders</span></a>
                </li>
        @else
                <div class="sidebar-heading">
                    Client Interface
                </div>
                @if(empty(Cookie::get('tableId')))
                <li class="nav-item {{ Request::segment(2) === 'tables' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('client.table.index') }}"> <i class="fas fa-microchip"></i> <span>Tables</span></a>
                </li>
                @endif

                @if(!empty(Cookie::get('tableId')) && !empty(Cookie::get('receiptId')) && !empty(Cookie::get('clientId')) )
                    <li class="nav-item {{ Request::segment(2) === 'menu' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('client.menu.index') }}"> <i class="fas fa-utensils"></i> <span>Restaurant Menu</span></a>
                    </li>
                    <li class="nav-item {{ Request::segment(2) === 'receipt' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('client.receipt.show', Cookie::get('receiptId')) }}"> <i class="fas fa-receipt"></i> <span>My Receipt</span></a>
                    </li>
                    <li class="nav-item {{ Request::segment(2) === 'order' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('client.order.show', Cookie::get('receiptId')) }}"><i class="fas fa-hourglass-half"></i> <span>My Orders</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('client.receipt.show', Cookie::get('receiptId')) }}"> <i class="fab fa-amazon-pay"></i> <span>Close Tab</span></a>
                    </li>
                @endif
        @endif

        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i> <span>Logout</span> </a>
        </li>
    @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">
                <i class="fas fa-sign-in-alt"></i> <span> Login </span> </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">
                <i class="fas fa-registered"></i> <span>Register !</span> </a>
        </li>

@endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <sidebar-toggle></sidebar-toggle>
    </div>

</ul>
