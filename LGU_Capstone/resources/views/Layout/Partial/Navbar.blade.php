<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark ">
    <div class="container">
        <!-- Sidebar Toggle Button -->
        <button class="btn btn-outline-light me-3" id="sidebar-toggle">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Brand Text -->
        <a class="navbar-brand me-auto fw-bold" href="#">LGU HR Management</a>

        <!-- Toggle Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Notification Dropdown -->
                <li class="nav-item dropdown mr-3">
                    <a class="nav-link dropdown-toggle mt-4" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-bell fa-lg"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end bg-dark ml-3">
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-bell me-2"></i>Notification 1
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-bell me-2"></i>Notification 2
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-bell me-2"></i>Notification 3
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Profile Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mt-1" href="#" role="button" data-bs-toggle="dropdown">
                        @if(auth()->check())
                            <img src="{{ asset(auth()->user()->profile_picture ?? 'default-profile.png') }}" 
                                 class="rounded-circle me-2" 
                                 style="width: 50px; height: 50px; object-fit: cover;">
                            <span class="d-none d-md-inline">{{ auth()->user()->first_name }}</span>
                        @else
                            <i class="fas fa-user-circle fa-lg"></i>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end bg-dark">
                        <li class="text-center mb-2">
                            @if(auth()->check())
                                <img src="{{ asset(auth()->user()->profile_picture ?? 'default-profile.png') }}" 
                                     class="rounded-circle mb-2 shadow-sm" 
                                     style="width: 80px; height: 80px; object-fit: cover;">
                                <div class="text-light">{{ auth()->user()->first_name }} {{ auth()->user()->middle_name ?? '' }} {{ auth()->user()->last_name }}</div>
                                <small class="text-muted">{{ auth()->user()->email }}</small>
                            @endif
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-light" href="/profile"><i class="fas fa-user me-2"></i>Profile</a></li>
                        <li><a class="dropdown-item text-light" href="/settings"><i class="fas fa-cog me-2"></i>Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-light" href="/logout"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>