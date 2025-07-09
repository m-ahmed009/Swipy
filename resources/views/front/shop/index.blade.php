@extends('front.layouts.app')

@section('css')
<style>

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
</style>
@endsection

@section('content')
<!-- Products Section -->
<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 mb-4">
        <!-- Filters -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Filters</h5>
            <hr>
            <form id="filterForm" method="GET" action="{{ route('shop') }}">
              <h6 class="mt-3">Categories</h6>
              @foreach($categories as $category)
                <div class="form-check">
                  <input class="form-check-input category-filter" type="checkbox"
                    id="cat-{{ $category->id }}"
                    value="{{ $category->slug }}"
                    {{ request('category') == $category->slug ? 'checked' : '' }}>
                  <label class="form-check-label" for="cat-{{ $category->id }}">
                    {{ $category->name }} ({{ $category->products_count }})
                  </label>
                </div>
              @endforeach

              <h6 class="mt-4">Price Range</h6>
              <div class="range-slider mt-3">
                <input type="range" class="form-range" min="0" max="1000" step="10"
                  id="priceRange"
                  value="{{ request('max_price', 1000) }}">
                <div class="d-flex justify-content-between mt-2">
                  <span>$<span id="minPriceValue">0</span></span>
                  <span>$<span id="maxPriceValue">{{ request('max_price', 1000) }}</span></span>
                </div>
                <input type="hidden" name="min_price" id="minPrice" value="{{ request('min_price', 0) }}">
                <input type="hidden" name="max_price" id="maxPrice" value="{{ request('max_price', 1000) }}">
              </div>

              <h6 class="mt-4">Brands</h6>
              {{-- @foreach($brands as $brand)
                <div class="form-check">
                  <input class="form-check-input brand-filter" type="checkbox"
                    id="brand-{{ $brand->id }}"
                    name="brand[]"
                    value="{{ $brand->id }}"
                    {{ in_array($brand->id, (array)request('brand')) ? 'checked' : '' }}>
                  <label class="form-check-label" for="brand-{{ $brand->id }}">
                    {{ $brand->name }} ({{ $brand->products_count }})
                  </label>
                </div>
              @endforeach --}}

              <h6 class="mt-4">Ratings</h6>
              @for($i = 5; $i >= 1; $i--)
                <div class="form-check">
                  <input class="form-check-input rating-filter" type="checkbox"
                    id="rating{{ $i }}"
                    name="rating"
                    value="{{ $i }}"
                    {{ request('rating') == $i ? 'checked' : '' }}>
                  <label class="form-check-label" for="rating{{ $i }}">
                    @for($j = 1; $j <= 5; $j++)
                      <i class="fas fa-star {{ $j <= $i ? 'text-warning' : 'far fa-star text-warning' }}"></i>
                    @endfor
                    @if($i < 5) & Up @endif
                  </label>
                </div>
              @endfor
            </form>
          </div>
          <div class="card-footer bg-transparent">
            <button type="submit" form="filterForm" class="btn btn-primary w-100">Apply Filters</button>
          </div>
        </div>
      </div>
      <div class="col-lg-9">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h4 class="mb-0">
            @if(isset($currentCategory))
              {{ $currentCategory->name }}
              @if(isset($currentSubcategory))
                > {{ $currentSubcategory->name }}
              @endif
            @else
              All Products
            @endif
          </h4>
          <div class="d-flex">
            <div class="me-3">
              <select class="form-select" id="sortSelect">
                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Sort by</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating</option>
              </select>
            </div>
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-outline-secondary active"><i class="fas fa-th"></i></button>
              <button type="button" class="btn btn-outline-secondary"><i class="fas fa-list"></i></button>
            </div>
          </div>
        </div>

        <div class="row g-4">
            @forelse($products as $product)
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

                  <!-- Out of Stock Badge -->
                  @if ($product->quantity <= 0)
                    <div class="position-absolute top-0 end-0 m-2 z-2">
                      <span class="badge bg-danger">Out of Stock</span>
                    </div>
                  @endif

                  <!-- Wishlist Button -->
                  <button class="btn-wishlist position-absolute top-0 end-0 m-2 z-1 rounded-circle add-to-wishlist" data-id="{{ $product->id }}">
                    <i class="far fa-heart"></i>
                  </button>

                  <!-- Image Container (clickable) -->
                  <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none text-dark">
                    <div class="product-image-container position-relative overflow-hidden">
                      <img src="{{ $product->thumbnail }}" class="img-fluid product-thumbnail w-100 h-100 object-fit-contain"
                        alt="{{ $product->name }}" loading="lazy" style="background: #f8f9fa; padding: 15px;">

                      @if (isset($product->images) && is_array($product->images) && count($product->images) > 0)
                        <img src="{{ $product->images[0] }}" class="img-fluid product-hover-image position-absolute top-0 start-0 w-100 h-100 object-fit-contain"
                          alt="{{ $product->name }}" loading="lazy" style="background: #f8f9fa; padding: 15px;">
                      @endif
                    </div>
                  </a>

                  <!-- Product Details -->
                  <div class="card-body pt-3 pb-2">
                    <div class="product-category mb-1">
                      <a href="{{ route('shop', ['category' => $product->mainCategory->slug]) }}" class="text-muted small text-decoration-none">
                        {{ $product->mainCategory->name }}
                      </a>
                    </div>

                    <h3 class="product-title h6 mb-2">
                      <a href="{{ route('product.show', $product->slug) }}" class="text-dark text-decoration-none">
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
                        {{-- ${{ number_format($product->current_price, 2) }} --}}
                        ${{ number_format($product->price, 2) }}
                      </span>
                      @if ($product->current_price < $product->original_price)
                        <span class="original-price text-muted text-decoration-line-through small">
                          ${{ number_format($product->original_price, 2) }}
                        </span>
                      @endif
                    </div>

                    <!-- Add to Cart Button -->
                    <div class="d-grid">
                      <button class="btn btn-outline-primary btn-sm add-to-cart @if ($product->quantity <= 0) disabled @endif"
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
            @empty
              <div class="col-12">
                <div class="alert alert-info">No products found matching your criteria.</div>
              </div>
            @endforelse
          </div>


        <!-- Pagination -->
        <nav class="mt-5">
          {{ $products->links() }}
        </nav>
      </div>
    </div>
  </div>
</section>
@endsection


{{-- <script>
  // Price range slider
  const priceRange = document.getElementById('priceRange');
  const minPriceValue = document.getElementById('minPriceValue');
  const maxPriceValue = document.getElementById('maxPriceValue');
  const minPriceInput = document.getElementById('minPrice');
  const maxPriceInput = document.getElementById('maxPrice');

  priceRange.addEventListener('input', function() {
    maxPriceValue.textContent = this.value;
    maxPriceInput.value = this.value;
  });

  // Sort select change
  document.getElementById('sortSelect').addEventListener('change', function() {
    const url = new URL(window.location.href);
    url.searchParams.set('sort', this.value);
    window.location.href = url.toString();
  });

  // Category filter - single select
  document.querySelectorAll('.category-filter').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
      document.querySelectorAll('.category-filter').forEach(cb => {
        if (cb !== this) cb.checked = false;
      });
      document.getElementById('filterForm').submit();
    });
  });

  // Rating filter - single select
  document.querySelectorAll('.rating-filter').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
      document.querySelectorAll('.rating-filter').forEach(rb => {
        if (rb !== this) rb.checked = false;
      });
      document.getElementById('filterForm').submit();
    });
  });
</script> --}}

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
