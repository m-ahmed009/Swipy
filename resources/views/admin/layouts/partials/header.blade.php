<div class="card position-relative" style="border: 1px solid #ffffff; border-radius: 15px; magin-bottom: 1rem;"> <!-- Added position-relative here -->
    <div class="card-body">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <h3 class="fw-bold animate__animated animate__fadeInDown">@yield('page-title', 'Dashboard Overview')</h3>
            <div class="d-flex align-items-center gap-3 animate__animated animate__fadeInDown animate__fast">
                {{-- <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" class="form-control" placeholder="Search...">
                </div> --}}

                <div class="dropdown">
                    <button class="btn position-relative">
                        <i class="bi bi-bell-fill fs-5"></i>
                        <span class="notification-badge">3</span>
                    </button>
                </div>

                <div class="dropdown user-dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://ui-avatars.com/api/?name=Admin+User&background=00ff90&color=000&size=128"
                            class="user-avatar me-2">
                        <span class="d-none d-md-inline">Admin User</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
