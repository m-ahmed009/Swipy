{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
<style>
    /* Adding hover effect to buttons */

/* Avatar Button Hover Effect */
.btn-outline-light:hover {
    background-color: rgba(255, 255, 255, 0.1);
    border-color: #fff;
}

/* Dropdown Menu */
.dropdown-menu {
    border-radius: 8px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

/* Dropdown Items Icons */
.dropdown-item i {
    width: 20px;
    text-align: center;
    color: #333;
}

/* Dropdown Item Hover */
.dropdown-item:hover {
    background-color: rgb(23 183 113);
    color: white;
}

/* User Avatar Icon */
.btn-outline-light i.fas.fa-user {
    color: white !important;
    font-size: 16px;
}

.btn-outline-light, .dropdown-item {
    transition: all 0.2s ease-in-out;
}
.dropdown.show .btn-outline-light i.fas.fa-user {
    color: white !important;
}

.dropdown-submenu {
    position: relative;
}

.sub-category-menu {
    display: none;
    position: absolute;
    left: 100%;
    top: 0;
    margin-top: 0;
    z-index: 1000;
    min-width: 180px;
    background-color: #fff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.dropdown-submenu:hover > .sub-category-menu {
    display: block;
}



</style>

<div class="text-light py-1 small" style="background-color: rgb(23 183 113) !important;">
    <div class="container d-flex justify-content-between align-items-center">
        <div>
            <i class="fas fa-phone-alt"></i> +92 300 1234567 |
            <i class="fas fa-envelope ms-2"></i> support@swippy.com
        </div>
        <div>
            <span class="me-3"><i class="fas fa-truck"></i> Free Shipping on Orders Over Rs. 2000</span>
            <a href="#" class="text-light text-decoration-none me-3">EN</a>

            @guest
                <a href="{{ route('login') }}" class="text-light text-decoration-none me-2">Login</a> /
                <a href="{{ route('register') }}" class="text-light text-decoration-none">Register</a>
            @endguest

            @auth
                <span class="text-light">Welcome, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link text-light text-decoration-none p-0"> > Logout</button>
                </form>
            @endauth

        </div>
    </div>
</div>

<header class="navbar navbar-expand-lg navbar-dark sticky-top" style="background: #0f172a">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ url('/') }}" style="color:#00ff90;">
            <i class="bi bi-lightning-fill me-2"></i> SWIPPY
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link active" href="{{ url('/') }}"> <i class="fas fa-home"></i> Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('shop') }}"> <i class="fa-brands fa-shopify"></i> Shop</a></li>
                {{-- <li class="nav-item dropdown position-relative">
                    <a class="nav-link dropdown-toggle" href="#" role="button">
                        <i class="fa-solid fa-layer-group"></i> Categories
                    </a>
                    <ul class="dropdown-menu main-category-menu">
                        @foreach ($mainCategories as $category)
                            <li class="dropdown-submenu position-relative">
                                <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
                                    <span>
                                        @if ($category->icon)
                                            <i class="{{ $category->icon }} me-2"></i>
                                        @endif
                                        {{ $category->name }}
                                    </span>
                                    @if ($category->subcategories->count())
                                        <i class="fa fa-angle-right"></i>
                                    @endif
                                </a>
                                @if ($category->subcategories->count())
                                    <ul class="dropdown-menu sub-category-menu">
                                        @foreach ($category->subcategories as $subcategory)
                                            <li><a class="dropdown-item" href="{{ route('categories.show', $subcategory->id) }}">{{ $subcategory->name }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </li> --}}
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle">Categories</a>
                    <ul class="dropdown-menu main-category-menu">
                        @foreach ($categories as $category)
                            <li class="dropdown-submenu">
                                <a href="{{ route('shop.category', ['category' => $category->slug]) }}">
                                    {{ $category->name }}
                                </a>

                                @if ($category->subcategories->count())
                                    <ul class="dropdown-menu sub-category-menu">
                                        @foreach ($category->subcategories as $subcategory)
                                            <li>
                                                <a href="{{ route('shop.subcategory', ['category' => $mainCategory->slug, 'subcategory' => $subCategory->slug]) }}">
                                                    {{ $subCategory->name }}
                                                </a>

                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </li>


                <li class="nav-item"><a class="nav-link" href="#"> <i class="fa-solid fa-address-card"></i> About</a></li>
                <li class="nav-item"><a class="nav-link" href="#"> <i class="fa-solid fa-address-book"></i> Contact</a></li>
            </ul>
            <div class="d-flex align-items-center">
                <!-- Search Input -->
                <div class="input-group me-3">
                    <input type="text" class="form-control" placeholder="Search...">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>

                <!-- Cart Button -->
                <a href="{{ route('cart') }}" class="btn btn-primary position-relative rounded-circle me-3"
                   style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        3
                    </span>
                </a>

                <!-- User Profile Dropdown -->
                @auth
                <div class="dropdown">
                    <button class="btn btn-outline-light rounded-circle d-flex align-items-center justify-content-center"
                            type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                            style="width: 45px; height: 45px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <i class="fas fa-user text-white"></i> <!-- Added text-white to make the icon white -->
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li class="dropdown-header px-3">
                            <strong>{{ Auth::user()->name }}</strong>
                        </li>
                        <li><a class="dropdown-item" href="#"> <i class="fas fa-user-circle me-2"></i> My Profile</a></li>
                        <li><a class="dropdown-item" href="#"> <i class="fas fa-box me-2"></i> My Orders</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth



            </div>
        </div>
    </div>
</header>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


<script>
    $(document).ready(function () {
        // Hover on main "Categories"
        $(".nav-item.dropdown").hover(
            function () {
                $(this).find(".main-category-menu").stop(true, true).slideDown(200);
            },
            function () {
                $(this).find(".main-category-menu").stop(true, true).slideUp(200);
            }
        );

        // Hover on sub menu
        $(".dropdown-submenu").hover(
            function () {
                $(this).find(".sub-category-menu").stop(true, true).fadeIn(200);
            },
            function () {
                $(this).find(".sub-category-menu").stop(true, true).fadeOut(200);
            }
        );
    });
</script>

