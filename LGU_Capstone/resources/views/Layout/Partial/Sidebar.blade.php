<!-- Mobile Navigation Toggle -->
<button class="nav-toggle">
    <i class="fas fa-bars"></i>
</button>

<!-- Sidebar Overlay -->
<div class="sidebar-overlay"></div>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="logo small">
        <img src="{{ asset('images/icon/logo.png') }}" alt="Logo">
    </div>
    <ul class="nav-list">
        <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="small"><i class="fas fa-tachometer-alt"></i><span class="fs-6">Dashboard</span></a>
        </li>
        <li class="nav-item {{ request()->is('appointments*') ? 'active' : '' }}">
            <a href="{{ route('appointments') }}" class="small"><i class="fas fa-calendar-check"></i><span class="fs-6">Appointment</span></a>
        </li>
        <li class="nav-item {{ request()->is('employee*') ? 'active' : '' }}">
            <a href="{{ route('employee.index') }}" class="small"><i class="fas fa-user-tie"></i><span class="fs-6">Employees</span></a>
        </li>
        <li class="nav-item {{ request()->is('Plantilla*') ? 'active' : '' }}">
            <a href="{{ route('Plantilla') }}" class="small"><i class="fas fa-users"></i><span class="fs-6">Plantilla</span></a>
        </li>
        <li class="nav-item {{ request()->is('nosa*') ? 'active' : '' }}">
            <a href="{{ route('nosa.index') }}" class="small has-arrow"><i class="fas fa-file-alt"></i><span class="fs-6">NOSA </span></a>
        </li>
        <li class="nav-item {{ request()->is('service_records*') ? 'active' : '' }}">
            <a href="{{ route('service_records') }}" class="small has-arrow"><i class="fas fa-file-alt"></i><span class="fs-6">Service Record</span></a>
        </li>
        <li class="nav-item {{ request()->is('account_list*', 'edit_account*', 'view_account*') ? 'active' : '' }}">
            <a href="{{ route('account_list') }}" class="small has-arrow"><i class="fas fa-user-cog"></i><span class="fs-6">Account</span></a>
        </li>
    </ul>
</div>
