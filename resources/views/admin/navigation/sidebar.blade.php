 <!-- Sidebar -->
 <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: linear-gradient(135deg, #00523B, #003366);">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ Route('dashboard') }}">
        <div class="sidebar-brand-icon ">
            <img src="{{ asset('images/logo.svg') }}" alt="Brand Logo" class="sidebar-brand-image" style="height: 40px; width: auto;">
        </div>
        <div class="sidebar-brand-text mx-3">
            <img src="{{ asset('images/hafaraText.svg') }}" alt="Brand Logo" class="sidebar-brand-image" style="height: 15px; width: auto;">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}"">
        <a class="nav-link" href="{{ Route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    @if (Auth::user()->role == 'admin')
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Booking
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Rooms</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Room Management</h6>
                <a class="collapse-item" href="{{ url('view_room') }}">View Room</a>
                <a class="collapse-item" href="{{ url('view_roomType') }}">View Room Type</a>
            </div>
        </div>
    </li>

<li class="nav-item {{ Request::is('bookings') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.booking') }}">
            <i class="fas fa-fw bi bi-book-fill"></i>
            <span>Booking</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Customer
    </div>

<li class=" nav-item {{ Request::is('message') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('message') }}">
            <i class="fas fa-fw bi bi-envelope"></i>
            <span>Message</span></a>
    </li>

<li class="nav-item {{ Request::is('customer') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('customer') }}">
            <i class="fas fa-fw bi bi-file-earmark-person"></i>
            <span>Customer</span></a>
    </li>

<!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Report
    </div>

    
    <li class=" nav-item {{ Request::is('report') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('report') }}">
            <i class="fas fa-fw bi bi-journal"></i>
            <span>Report</span></a>
    </li>
    @endif

    @if (Auth::user()->role == 'owner')
    <li class="nav-item {{ Request::is('owner') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('owner') }}">
                <i class="fas fa-fw bi bi-journal"></i>
                <span>Report</span></a>
    </li>

    @endif
    <!-- Divider -->
    <hr class="sidebar-divider d-none ">

    <li class="nav-item">
    <form method="POST" action="{{ route('logout') }}" class="dropdown-item d-flex align-items-center">
        @csrf
        <button type="submit" class="nav-link">
            <i class="fas fa-sign-out-alt fa-fw"></i>
            <span>Logout</span>
        </button>
    </form>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->