@extends('front.layouts.app')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Add this to your styles section */
        #categoriesCarousel .carousel-control-prev,
        #categoriesCarousel .carousel-control-next {
            width: 40px;
            height: 40px;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        #categoriesCarousel .carousel-control-prev:hover,
        #categoriesCarousel .carousel-control-next:hover {
            opacity: 1;
        }

        #categoriesCarousel .carousel-control-prev {
            left: -50px;
        }

        #categoriesCarousel .carousel-control-next {
            right: -50px;
        }

        #categoriesCarousel .carousel-indicators li {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.25);
            margin: 0 5px;
        }

        #categoriesCarousel .carousel-indicators li.active {
            background-color: #0d6efd;
        }



        /* Bootstrap Carousel Active State */
        #categoriesCarousel .carousel-indicators [data-bs-target].active {
            background-color: #00ff90;
        }

        .stretched-link: {
            color: rgb(255, 255, 255) !important;
        }

        .stretched-link:hover {
            color: rgb(255, 255, 255) !important;
            border: 1px solid white !important;
        }

        .stretched-link:active {
            color: rgb(5, 5, 5) !important;
            border: 1px solid white !important;
        }

        .stretched-link:active,
        .stretched-link:focus {
            color: rgb(5, 5, 5) !important;
            background-color: white !important;
            border: 1px solid rgb(0, 0, 0) !important;
        }

        /* Wishlist Button */
        .btn-wishlist {
            width: 32px;
            height: 32px;
            background: white;
            border: 1px solid #e1e1e1;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 2;
            position: absolute;
            top: 10px;
            right: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            outline: none;
        }

        .btn-wishlist i {
            font-size: 16px;
            color: #333;
            transition: color 0.2s ease;
        }

        .btn-wishlist:hover {
            background-color: #f8f9fa;
            border-color: #d1d1d1;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
        }

        .btn-wishlist:hover i {
            color: #dc3545;
        }

        .product-card:hover .btn-wishlist {
            opacity: 1;
        }

        /* Active state when clicked */
        .btn-wishlist.active i {
            color: #dc3545;
        }

        @media (max-width: 768px) {
            #categoriesCarousel .carousel-control-prev {
                left: -20px;
            }

            #categoriesCarousel .carousel-control-next {
                right: -20px;
            }
        }

        /* Hero Section */
        .hero-section {
            /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
            /* background: linear-gradient(135deg, rgb(0, 191, 174), rgb(255, 255, 255)); */
            background: linear-gradient(135deg, rgb(23 183 113), rgb(255, 255, 255));
            min-height: 600px;
            padding: 100px 0;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.1);
        }

        .hero-image-container {
            position: relative;
            animation: float 6s ease-in-out infinite;
        }

        .hero-badge {
            position: absolute;
            top: 4px;
            right: -20px;
        }

        /* Categories */
        .category-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 10px;
            overflow: hidden;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .category-image-container {
            height: 120px;
            position: relative;
        }

        .category-image {
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .category-card:hover .category-image {
            transform: scale(1.1);
        }

        /* Product Card Styles */
        .product-card {
            transition: all 0.3s ease;
            border-radius: 8px;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
        }

        /* Image Container */
        .product-image-container {
            position: relative;
            aspect-ratio: 1/1;
            background-color: #f8f9fa;
        }

        .product-thumbnail {
            transition: opacity 0.3s ease;
            opacity: 1;
        }

        .product-hover-image {
            transition: opacity 0.3s ease;
            opacity: 0;
        }

        .product-image-container:hover .product-thumbnail {
            opacity: 0;
        }

        .product-image-container:hover .product-hover-image {
            opacity: 1;
        }


        .brand-logo-container {
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .brand-logo {
            max-height: 60px;
            width: auto;
            opacity: 0.7;
            transition: all 0.3s ease;
            filter: grayscale(100%);
        }

        .brand-logo:hover {
            opacity: 1;
            filter: grayscale(0%);
            transform: scale(1.1);
        }

        .grayscale {
            filter: grayscale(100%);
        }

        /* Quick View Button */
        .product-actions {
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }

        .product-card:hover .product-actions {
            opacity: 1;
            transform: translateY(0);
        }

        /* Price */
        .current-price {
            color: #dc3545 !important;
        }

        /* Add to Cart Button */
        .add-to-cart {
            transition: all 0.3s ease;
        }

        .add-to-cart:hover {
            background-color: #00ff90 !important;
            border: 1px solid white !important;
            color: white !important;
        }

        /* Product Meta */
        .product-meta li {
            margin-right: 10px;
        }

        .product-meta li:last-child {
            margin-right: 0;
        }

        /* Flash Sale Animation */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .flash-sale-banner {
            animation: pulse 2s infinite;
        }

        /* Responsive adjustments */
        @media (max-width: 767px) {
            .product-card {
                max-width: 100%;
                margin: 0 auto;
            }
        }

        /* Features */
        .feature-item {
            transition: transform 0.3s ease;
        }

        .feature-item:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Deal of the Day */
        .deal-tag {
            background: rgba(255, 255, 255, 0.2);
            display: inline-block;
            padding: 5px 15px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .deal-image-container {
            position: relative;
        }

        .deal-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: #ff6b6b;
            color: white;
            padding: 5px 15px;
            border-radius: 30px;
            font-weight: bold;
            animation: pulse 2s infinite;
        }

        .countdown-item {
            text-align: center;
        }

        .countdown-number {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            font-size: 24px;
            font-weight: bold;
            width: 50px;
            height: 50px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .countdown-label {
            font-size: 12px;
            margin-top: 5px;
            opacity: 0.8;
        }

        /* Testimonials */
        .testimonial-card {
            transition: transform 0.3s ease;
            border-radius: 10px;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
        }

        /* Brands */
        .brand-logo {
            opacity: 0.7;
            transition: opacity 0.3s ease, filter 0.3s ease;
            padding: 4px;
        }

        .brand-logo:hover {
            opacity: 1;
            filter: grayscale(0);
        }

        .grayscale {
            filter: grayscale(100%);
        }

        /* Newsletter */
        .newsletter-section {
            background: url('https://images.unsplash.com/photo-1486401899868-0e435ed85128?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center;
            background-size: cover;
            padding: 80px 0;
        }

        .newsletter-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
        }

        /* Instagram */
        .instagram-post {
            aspect-ratio: 1/1;
        }

        .instagram-post img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        .instagram-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .instagram-post:hover .instagram-overlay {
            opacity: 1;
        }

        /* Animations */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Flash sale banner */
        .flash-sale-banner {
            animation: flash 2s infinite;
        }

        @keyframes flash {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.8;
            }

            100% {
                opacity: 1;
            }
        }

        /* Instagram Section Styles */
        .btn-instagram {
            background: linear-gradient(45deg, #405DE6, #5851DB, #833AB4, #C13584, #E1306C, #FD1D1D);
            color: white;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-instagram:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(225, 48, 108, 0.3);
        }

        .instagram-post {
            aspect-ratio: 1/1;
            transition: all 0.3s ease;
        }

        .instagram-post:hover {
            transform: scale(1.03);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .instagram-overlay {
            background: linear-gradient(0deg, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.3) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .instagram-post:hover .instagram-overlay {
            opacity: 1;
        }

        .instagram-overlay .badge {
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }

        .instagram-post:hover .instagram-overlay .badge {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section with Animation -->
    <section class="hero-section d-flex align-items-center text-white position-relative overflow-hidden">
        <div class="hero-overlay"></div>
        <div class="container position-relative z-index-1">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeInDown">Shop Smarter with Swippy</h1>
                    <p class="lead mb-5 animate__animated animate__fadeIn animate__delay-1s">Discover the latest trends and
                        exclusive deals on thousands of premium products.</p>
                    <div class="animate__animated animate__fadeIn animate__delay-2s">
                        <a href="{{ route('shop') }}" class="btn btn-primary btn-lg px-4 me-2">Shop Now</a>
                        <a href="#features" class="btn btn-outline-light btn-lg px-4">Learn More</a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="hero-image-container">
                        {{-- <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" --}}
                        <img src="{{ asset('assets/front/images/1.png') }}" alt="Swippy Banner"
                            class="img-fluid hero-image animate__animated animate__fadeInRight">
                        <div class="hero-badge animate__animated animate__bounceIn animate__delay-1s">
                            <span class="badge bg-danger">50% OFF</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Slider Section -->
    <section class="py-5">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2 class="fw-bold">Shop by Categories</h2>
                <p class="text-muted">Browse our wide range of product categories</p>
            </div>

            <div id="categoriesCarousel" class="carousel slide" data-bs-ride="carousel">
                <!-- Carousel items -->
                <div class="carousel-inner">
                    @foreach ($mainCategories->chunk(6) as $key => $chunk)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <div class="row g-4">
                                @foreach ($chunk as $category)
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                                        <div class="category-card card border-0 text-center h-100 shadow-sm">
                                            <div class="category-image-container overflow-hidden p-3">
                                                @if ($category->image && file_exists(public_path($category->image)))
                                                    <img src="{{ asset($category->image) }}"
                                                        class="card-img-top category-image" alt="Category Image"
                                                        style="width: 80px; height: 80px; border-radius: 5px; object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('assets/images/test.jpg') }}"
                                                        alt="Default Category Image"
                                                        style="width: 80px; height: 80px; border-radius: 5px; object-fit: cover;">
                                                @endif
                                                <div class="category-overlay"></div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title fw-bold" style="font-size: 12px">{{ $category->name }}
                                                </h5>
                                                <a href="{{ route('shop', ['category' => $category->slug]) }}"
                                                    class="btn btn-sm btn-outline-primary mt-2 stretched-link">Shop Now</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Carousel controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#categoriesCarousel"
                    data-bs-slide="prev">
                    <span class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 40px; height: 40px;" aria-hidden="true">
                        <i class="fas fa-caret-left text-white"></i>
                    </span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#categoriesCarousel"
                    data-bs-slide="next">
                    <span class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 40px; height: 40px;" aria-hidden="true">
                        <i class="fas fa-caret-right text-white"></i>
                    </span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <!-- Custom Dot Indicators -->
            {{-- <div class="text-center mt-4">
                @foreach ($mainCategories->chunk(6) as $key => $chunk)
                    <button type="button" data-bs-target="#categoriesCarousel" data-bs-slide-to="{{ $key }}"
                        class="indicator-dot mx-1 {{ $key === 0 ? 'active' : '' }}" aria-label="Slide {{ $key + 1 }}">
                    </button>
                @endforeach
            </div> --}}
        </div>
    </section>

    <!-- Featured Products with Countdown Timer -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2 class="fw-bold">Featured Products</h2>
                <p class="text-muted">Our most popular products this week</p>
                <div class="flash-sale-banner bg-danger text-white py-2 px-3 d-inline-block rounded mt-3">
                    <span class="fw-bold">FLASH SALE:</span>
                    Ends in <span id="countdown" class="fw-bold">23:59:59</span>
                </div>
            </div>
            <div class="row g-4">
                @foreach ($featuredProducts as $product)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="product-card card h-100 border-0 shadow-sm position-relative">
                            <!-- Badges -->
                            <div class="product-badges position-absolute top-0 start-0 z-2">
                                @if ($product->discount > 0)
                                    <span class="badge bg-danger me-1">-{{ $product->discount }}%</span>
                                @endif
                                @if ($product->is_new)
                                    <span class="badge bg-primary">New</span>
                                @endif
                            </div>

                            <!-- Out of Stock Badge (Top Right) -->
                            @if ($product->quantity <= 0)
                                <div class="position-absolute top-0 end-0 m-2 z-2">
                                    <span class="badge bg-danger">Out of Stock</span>
                                </div>
                            @endif

                            <!-- Wishlist Button (Top Right) -->
                            <button
                                class="btn-wishlist position-absolute top-0 end-0 m-2 z-1 rounded-circle add-to-wishlist"
                                data-id="{{ $product->id }}">
                                <i class="far fa-heart"></i>
                            </button>

                            <!-- Image Container -->
                            <div class="product-image-container position-relative overflow-hidden">
                                <!-- Main Thumbnail (shown by default) -->
                                <img src="{{ $product->thumbnail }}"
                                    class="img-fluid product-thumbnail w-100 h-100 object-fit-contain"
                                    alt="{{ $product->name }}" loading="lazy" style="background: #f8f9fa; padding: 15px;">

                                <!-- Secondary Image (shown on hover) -->
                                @if (isset($product->images) && count($product->images) > 0)
                                    <img src="{{ $product->images[0] }}"
                                        class="img-fluid product-hover-image position-absolute top-0 start-0 w-100 h-100 object-fit-contain"
                                        alt="{{ $product->name }}" loading="lazy"
                                        style="background: #f8f9fa; padding: 15px;">
                                @endif

                                <!-- Quick View Button (Center) -->
                                <div class="product-actions position-absolute bottom-0 start-0 end-0 text-center mb-3">
                                    <button class="btn btn-sm btn-dark rounded-pill quick-view px-3"
                                        data-id="{{ $product->id }}">
                                        <i class="fas fa-eye me-1"></i> Quick View
                                    </button>
                                </div>
                            </div>

                            <!-- Product Details -->
                            <div class="card-body pt-3 pb-2">
                                <!-- Category -->
                                <div class="product-category mb-1">
                                    <a href="{{ route('shop', ['category' => $product->mainCategory->slug]) }}"
                                        class="text-muted small text-decoration-none">
                                        {{ $product->mainCategory->name }}
                                    </a>
                                </div>

                                <!-- Product Title -->
                                <h3 class="product-title h6 mb-2">
                                    <a href="#" class="text-dark text-decoration-none">
                                        {{ Str::limit($product->name, 50) }}
                                    </a>
                                </h3>

                                <!-- Rating -->
                                <div class="product-rating mb-2 small">
                                    <div class="rating-stars d-inline-block">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= floor($product->average_rating))
                                                <i class="fas fa-star text-warning"></i>
                                            @elseif($i == ceil($product->average_rating) && $product->average_rating - floor($product->average_rating) >= 0.5)
                                                <i class="fas fa-star-half-alt text-warning"></i>
                                            @else
                                                <i class="far fa-star text-warning"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="ms-1 text-muted">({{ $product->reviews_count }})</span>
                                </div>

                                <!-- Price -->
                                <div class="product-price d-flex align-items-center mb-3">
                                    <span class="current-price text-primary fw-bold fs-5 me-2">
                                        ${{ number_format($product->current_price, 2) }}
                                    </span>
                                    @if ($product->current_price < $product->original_price)
                                        <span class="original-price text-muted text-decoration-line-through small">
                                            ${{ number_format($product->original_price, 2) }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Add to Cart Button -->
                                <div class="d-grid">
                                    <button
                                        class="btn btn-outline-primary btn-sm add-to-cart @if ($product->quantity <= 0) disabled @endif"
                                        data-id="{{ $product->id }}" @if ($product->quantity <= 0) disabled @endif>
                                        <i class="fas fa-shopping-cart me-1"></i>
                                        @if ($product->quantity <= 0)
                                            Out of Stock
                                        @else
                                            Add to Cart
                                        @endif
                                    </button>
                                </div>
                            </div>

                            <!-- Product Footer (Additional Info) -->
                            <div class="card-footer bg-transparent border-top-0 pt-0 pb-3">
                                <ul class="product-meta list-inline small text-muted mb-0">
                                    <li class="list-inline-item">
                                        <i class="fas fa-check-circle text-success me-1"></i>
                                        In Stock: {{ $product->quantity }}
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="fas fa-shipping-fast text-info me-1"></i>
                                        Free Shipping
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- View All Button -->
            <div class="text-center mt-5">
                <a href="{{ route('shop') }}" class="btn btn-outline-primary btn-sm add-to-cart  px-5">
                    View All Products <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section with Icons -->
    <section class="py-5" id="features">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3 col-6 text-center">
                    <div class="p-4 feature-item">
                        <div class="feature-icon bg-primary bg-opacity-10 text-white rounded-circle mx-auto mb-3">
                            <i class="fas fa-truck fa-2x"></i>
                        </div>
                        <h5 class="fw-bold">Free Shipping</h5>
                        <p class="mb-0 text-muted">On all orders over $50</p>
                    </div>
                </div>
                <div class="col-md-3 col-6 text-center">
                    <div class="p-4 feature-item">
                        <div class="feature-icon bg-primary bg-opacity-10 text-white rounded-circle mx-auto mb-3">
                            <i class="fas fa-undo fa-2x"></i>
                        </div>
                        <h5 class="fw-bold">Easy Returns</h5>
                        <p class="mb-0 text-muted">30-day return policy</p>
                    </div>
                </div>
                <div class="col-md-3 col-6 text-center">
                    <div class="p-4 feature-item">
                        <div class="feature-icon bg-primary bg-opacity-10 text-white rounded-circle mx-auto mb-3">
                            <i class="fas fa-lock fa-2x"></i>
                        </div>
                        <h5 class="fw-bold">Secure Payment</h5>
                        <p class="mb-0 text-muted">100% secure checkout</p>
                    </div>
                </div>
                <div class="col-md-3 col-6 text-center">
                    <div class="p-4 feature-item">
                        <div class="feature-icon bg-primary bg-opacity-10 text-white rounded-circle mx-auto mb-3">
                            <i class="fas fa-headset fa-2x"></i>
                        </div>
                        <h5 class="fw-bold">24/7 Support</h5>
                        <p class="mb-0 text-muted">Dedicated support</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Deal of the Day -->
    <section class="py-5 bg-dark text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="deal-tag mb-3">DEAL OF THE DAY</div>
                    <h2 class="fw-bold mb-3">Premium Wireless Headphones</h2>
                    <div class="rating mb-3">
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star-half-alt text-warning"></i>
                        <span class="ms-2">(124 reviews)</span>
                    </div>
                    <p class="mb-4">Experience crystal clear sound with our noise-cancelling wireless headphones. Limited
                        time offer!</p>

                    <div class="d-flex align-items-center mb-4">
                        <h3 class="text-danger fw-bold me-3 mb-0">$89.99</h3>
                        <del class="text-muted">$129.99</del>
                        <span class="badge bg-danger ms-2">31% OFF</span>
                    </div>

                    <div class="deal-countdown mb-4">
                        <div class="countdown-title mb-2">Hurry up! Offer ends in:</div>
                        <div class="countdown-timer d-flex">
                            <div class="countdown-item me-2">
                                <div class="countdown-number">23</div>
                                <div class="countdown-label">Hours</div>
                            </div>
                            <div class="countdown-item me-2">
                                <div class="countdown-number">59</div>
                                <div class="countdown-label">Minutes</div>
                            </div>
                            <div class="countdown-item">
                                <div class="countdown-number">59</div>
                                <div class="countdown-label">Seconds</div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-danger btn-lg px-4 me-2">
                        <i class="fas fa-bolt me-2"></i> Buy Now
                    </button>
                    <button class="btn btn-outline-light btn-lg px-4">
                        <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                    </button>
                </div>
                <div class="col-lg-6">
                    <div class="deal-image-container position-relative">
                        <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                            alt="Deal of the Day" class="img-fluid rounded shadow">
                        <div class="deal-badge">Limited Stock</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials with Carousel -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2 class="fw-bold">What Our Customers Say</h2>
                <p class="text-muted">Trusted by thousands of happy customers worldwide</p>
            </div>

            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="testimonial-card card border-0 shadow-sm">
                                    <div class="card-body text-center p-4">
                                        <div class="rating mb-3">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                        </div>
                                        <p class="card-text fs-5 mb-4">"The quality of products is amazing and delivery was
                                            super fast. Will definitely shop here again! Customer service is exceptional."
                                        </p>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <img src="https://randomuser.me/api/portraits/women/32.jpg"
                                                class="rounded-circle me-3" width="60" alt="User">
                                            <div class="text-start">
                                                <h6 class="mb-0 fw-bold">Sarah Johnson</h6>
                                                <small class="text-muted">Verified Buyer • 2 days ago</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="testimonial-card card border-0 shadow-sm">
                                    <div class="card-body text-center p-4">
                                        <div class="rating mb-3">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star-half-alt text-warning"></i>
                                        </div>
                                        <p class="card-text fs-5 mb-4">"Great prices and fast shipping. The product
                                            exceeded my expectations. The packaging was also very secure and eco-friendly."
                                        </p>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <img src="https://randomuser.me/api/portraits/men/42.jpg"
                                                class="rounded-circle me-3" width="60" alt="User">
                                            <div class="text-start">
                                                <h6 class="mb-0 fw-bold">Michael Chen</h6>
                                                <small class="text-muted">Verified Buyer • 1 week ago</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('shop') }}" class="btn btn-outline-primary px-4">
                    Read All Reviews <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Brands Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2 class="fw-bold">Trusted Brands</h2>
                <p class="text-muted">We partner with the best brands in the industry</p>
            </div>
            <div class="row align-items-center justify-content-center g-4">
                <!-- Apple -->
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="brand-logo-container p-3">
                        <img src="{{ asset('assets/front/images/brands/apple.png') }}" alt="Apple"
                            class="img-fluid brand-logo grayscale" loading="lazy">
                    </div>
                </div>

                <!-- Samsung -->
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="brand-logo-container p-3">
                        <img src="{{ asset('assets/front/images/brands/samsung.jpg') }}" alt="Samsung"
                            class="img-fluid brand-logo grayscale" loading="lazy">
                    </div>
                </div>

                <!-- Nike -->
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="brand-logo-container p-3">
                        <img src="{{ asset('assets/front/images/brands/nike.png') }}" alt="Nike"
                            class="img-fluid brand-logo grayscale" loading="lazy">
                    </div>
                </div>

                <!-- Adidas -->
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="brand-logo-container p-3">
                        <img src="{{ asset('assets/front/images/brands/adidas.jpg') }}" alt="Adidas"
                            class="img-fluid brand-logo grayscale" loading="lazy">
                    </div>
                </div>

                <!-- Sony -->
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="brand-logo-container p-3">
                        <img src="{{ asset('assets/front/images/brands/sony.webp') }}" alt="Sony"
                            class="img-fluid brand-logo grayscale" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Newsletter with Background Image -->
    <section class="py-5 newsletter-section position-relative text-white">
        <div class="newsletter-overlay"></div>
        <div class="container position-relative z-index-1">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-3">Subscribe to Our Newsletter</h2>
                    <p class="mb-4">Get exclusive deals, product updates, and 10% off your first order</p>
                    <form class="row g-2 justify-content-center">
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-0"><i
                                        class="fas fa-envelope text-primary"></i></span>
                                <input type="email" class="form-control border-0" placeholder="Your email address"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary w-100">
                                Subscribe <i class="fas fa-paper-plane ms-2"></i>
                            </button>
                        </div>
                    </form>
                    <p class="small mt-3">We respect your privacy. Unsubscribe at any time.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Instagram Feed -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2 class="fw-bold">Follow Us on Instagram</h2>
                <p class="text-muted">Tag <strong>@swippy</strong> for a chance to be featured</p>
                <a href="https://instagram.com/swippy" target="_blank" class="btn btn-instagram mt-3">
                    <i class="fab fa-instagram me-2"></i> Follow @swippy
                </a>
            </div>

            <div class="row g-2">
                <!-- Product-focused placeholder images from Picsum -->
                @php
                    $instagramPosts = [
                        [
                            'id' => 1,
                            'image' => 'https://picsum.photos/id/100/600/600',
                            'likes' => 142,
                            'comments' => 23,
                        ],
                        [
                            'id' => 2,
                            'image' => 'https://picsum.photos/id/200/600/600',
                            'likes' => 256,
                            'comments' => 42,
                        ],
                        [
                            'id' => 3,
                            'image' => 'https://picsum.photos/id/300/600/600',
                            'likes' => 189,
                            'comments' => 17,
                        ],
                        [
                            'id' => 4,
                            'image' => 'https://picsum.photos/id/400/600/600',
                            'likes' => 321,
                            'comments' => 38,
                        ],
                        [
                            'id' => 5,
                            'image' => 'https://picsum.photos/id/500/600/600',
                            'likes' => 278,
                            'comments' => 29,
                        ],
                        [
                            'id' => 6,
                            'image' => 'https://picsum.photos/id/600/600/600',
                            'likes' => 412,
                            'comments' => 56,
                        ],
                    ];
                @endphp

                @foreach ($instagramPosts as $post)
                    <div class="col-4 col-md-2">
                        <div class="instagram-post position-relative overflow-hidden rounded">
                            <img src="{{ $post['image'] }}" alt="Instagram post {{ $post['id'] }}"
                                class="img-fluid w-100 h-100 object-fit-cover" loading="lazy">

                            <div
                                class="instagram-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-between p-3">
                                <div class="d-flex justify-content-end">
                                    <span class="badge bg-white text-dark">
                                        <i class="fas fa-heart text-danger me-1"></i> {{ $post['likes'] }}
                                    </span>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <a href="#" class="text-white fs-3">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </div>

                                <div class="d-flex justify-content-start">
                                    <span class="badge bg-white text-dark">
                                        <i class="fas fa-comment text-primary me-1"></i> {{ $post['comments'] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Quick View Modal -->
    <div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
        <!-- Modal content would be loaded via AJAX -->
    </div>
@endsection


<!-- Add this right before </body> or in your scripts section -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function() {
        // Countdown timer for flash sale
        function updateCountdown() {
            const countdownElement = document.getElementById('countdown');
            let hours = 23 - new Date().getHours();
            let minutes = 59 - new Date().getMinutes();
            let seconds = 59 - new Date().getSeconds();

            // Add leading zeros
            hours = hours < 10 ? '0' + hours : hours;
            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;

            countdownElement.textContent = `${hours}:${minutes}:${seconds}`;
        }

        // Update every second
        updateCountdown();
        setInterval(updateCountdown, 1000);

        // Quick view modal
        $(document).on('click', '.quick-view', function(e) {
            e.preventDefault();
            const productId = $(this).data('id');
            console.log('Quick view for product:', productId);
            // Implement your quick view functionality here
        });

        // Add to cart
        $(document).on('click', '.add-to-cart', function(e) {
            e.preventDefault();
            const productId = $(this).data('id');
            console.log('Add to cart:', productId);
            // Implement your add to cart functionality here
        });

        // Add to wishlist
        $(document).on('click', '.add-to-wishlist', function(e) {
            e.preventDefault();
            const productId = $(this).data('id');
            const button = $(this);

            // Toggle heart icon
            if (button.find('i').hasClass('far')) {
                button.html('<i class="fas fa-heart text-danger"></i>');
                console.log('Added to wishlist:', productId);
            } else {
                button.html('<i class="far fa-heart"></i>');
                console.log('Removed from wishlist:', productId);
            }
            // Implement your wishlist functionality here
        });
    });
</script>
