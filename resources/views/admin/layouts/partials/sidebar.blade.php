<aside class="sidebar">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold swippy-highlight mb-0 animate__animated animate__fadeInLeft">
            <i class="bi bi-lightning-fill me-2"></i>
            <span class="sidebar-text">Swippy</span>
        </h2>
        <button class="btn btn-sm btn-outline-secondary d-none d-lg-block sidebar-toggle">
            <i class="bi bi-chevron-double-left"></i>
        </button>
    </div>

    <nav class="nav flex-column">
        <a href="#" class="nav-link active animate__animated animate__fadeInLeft animate__fast">
            <i class="bi bi-speedometer2"></i>
            <span class="sidebar-text">Dashboard</span>
        </a>

        <!-- Users Dropdown -->
        <div class="dropdown animate__animated animate__fadeInLeft animate__fast">
            <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                <i class="bi bi-people-fill"></i>
                <span class="sidebar-text">Users</span>
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('admin.users.create') }}">
                    <i class="bi bi-plus-circle me-2"></i>Add User</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.users.index') }}">
                    <i class="bi bi-list-ul me-2"></i>User List</a></li>
                <li>
                    <hr class="dropdown-divider m-0">
                </li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-graph-up me-2"></i>User Analytics</a></li>
            </ul>
        </div>

        <div class="dropdown animate__animated animate__fadeInLeft animate__fast">
            <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.products.*') ? 'active' : '' }}"
                data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                <i class="bi bi-box-seam"></i>
                <span class="sidebar-text">Products</span>
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('admin.products.create') }}">
                    <i class="bi bi-plus-circle me-2"></i>Add Product</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.products.index') }}">
                    <i class="bi bi-list-ul me-2"></i>Product List</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-tags me-2"></i>Inventory</a></li>
            </ul>
        </div>

        <div class="dropdown animate__animated animate__fadeInLeft animate__fast">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-bag-check-fill"></i>
                <span class="sidebar-text">Orders</span>
                <span class="notification-badge">5</span>
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#"><i class="bi bi-plus-circle me-2"></i>Add Order</a></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-list-ul me-2"></i>Order List</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-arrow-return-right me-2"></i>Returns</a>
                </li>
            </ul>
        </div>
        <!-- Categories Dropdown -->
        <div class="dropdown animate__animated animate__fadeInLeft animate__fast">
            <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
                data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                <i class="bi bi-tags-fill"></i>
                <span class="sidebar-text">Categories</span>
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('admin.categories.create') }}"><i
                            class="bi bi-plus-circle me-2"></i>Add Main Category</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.categories.index') }}"><i
                            class="bi bi-list-ul me-2"></i> Main Category List</a></li>
                <li>
                    <hr class="dropdown-divider m-0 bg-light">
                </li>
                <li><a class="dropdown-item" href="{{ route('admin.sub-categories.create') }}"><i
                            class="bi bi-plus-circle me-2"></i>Add Sub Category</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.sub-categories.index') }}"><i
                            class="bi bi-list-ul me-2"></i> Sub Category List</a></li>
            </ul>
        </div>

        <a href="#" class="nav-link animate__animated animate__fadeInLeft animate__fast">
            <i class="bi bi-graph-up-arrow"></i>
            <span class="sidebar-text">Analytics</span>
        </a>

        <a href="#" class="nav-link animate__animated animate__fadeInLeft animate__fast">
            <i class="bi bi-gear-fill"></i>
            <span class="sidebar-text">Settings</span>
        </a>

        <a href="#" class="nav-link animate__animated animate__fadeInLeft animate__fast"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i>
            <span class="sidebar-text">Logout</span>
        </a>

        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

    </nav>
</aside>
