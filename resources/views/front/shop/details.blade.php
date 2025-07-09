@extends('front.layouts.app')

@section('content')
<!-- Product Detail Section -->
<section class="py-5">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        {{-- <li class="breadcrumb-item"><a href="{{ route('shop.category', $product->category->slug) }}">{{ $product->category->name }}</a></li> --}}
        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
      </ol>
    </nav>

    <div class="row g-5">
      <div class="col-lg-6">
        <div class="row g-3">
          <div class="col-2">
            <div class="d-flex flex-column gap-3">
                @foreach($product->images as $image)
                <img src="{{ asset($image) }}" class="img-fluid border rounded cursor-pointer thumb-image"
                    alt="Thumbnail" data-full="{{ asset($image) }}">
            @endforeach
            </div>
          </div>
          <div class="col-10">
            <div class="border rounded-3 overflow-hidden">
              {{-- <img src="{{ $product->image_url }}" class="img-fluid w-100" alt="Product Image" id="mainImage"> --}}
                @if ($product->thumbnail && file_exists(public_path($product->thumbnail)))
                    <img src="{{ asset($product->thumbnail) }}"  class="img-fluid w-100" alt="Product Image" id="mainImage">
                @else
                    <img src="{{ asset('assets/images/test.jpg') }}" alt="Default product Image"
                        style="width: 40px; height: 40px; border-radius: 5px; object-fit: cover;">
                @endif
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="ps-lg-5">
          <div class="d-flex justify-content-between align-items-start">
            <div>
              <h2 class="mb-2">{{ $product->name }}</h2>
              <div class="rating mb-3">
                @for($i = 1; $i <= 5; $i++)
                  <i class="fas fa-star{{ $i <= $product->rating ? '' : '-half-alt' }}"></i>
                @endfor
                <span class="ms-2">{{ $product->reviews_count }} Reviews</span>
              </div>
            </div>
            <button class="btn btn-outline-secondary rounded-circle p-2">
              <i class="far fa-heart"></i>
            </button>
          </div>

          <div class="mb-4">
            @if($product->discount)
              <span class="badge bg-primary text-dark me-2">Sale</span>
            @endif
            <span class="badge bg-success me-2">In Stock</span>
            <span class="text-muted">SKU: {{ $product->sku }}</span>
          </div>

          <div class="mb-4">
            <h3 class="text-primary">${{ number_format($product->price, 2) }}</h3>
            @if($product->discount)
              <del class="text-muted">${{ number_format($product->original_price, 2) }}</del>
              <span class="badge bg-danger ms-2">{{ $product->discount }}% OFF</span>
            @endif
          </div>

          <p class="mb-4">{{ $product->short_description }}</p>

          {{-- @if($product->colors->count() > 0)
            <div class="mb-4">
              <h6>Color:</h6>
              <div class="color-options d-flex gap-2">
                @foreach($product->colors as $color)
                  <button class="btn btn-sm border rounded-circle p-3"
                    style="background-color: {{ $color->code }}"
                    title="{{ $color->name }}"></button>
                @endforeach
              </div>
            </div>
          @endif --}}

          <form action="{{ route('cart') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <div class="row g-3 mb-4">
              <div class="col-md-4">
                <label class="form-label">Quantity</label>
                <div class="input-group">
                  <button class="btn btn-outline-secondary" type="button" id="decrement">-</button>
                  <input type="text" class="form-control text-center" name="quantity" value="1" id="quantity">
                  <button class="btn btn-outline-secondary" type="button" id="increment">+</button>
                </div>
              </div>
            </div>

            <div class="d-flex gap-3 mb-5">
              <button type="submit" class="btn btn-primary flex-grow-1 py-3">
                <i class="fas fa-shopping-cart me-2"></i> Add to Cart
              </button>
              <button type="submit" class="btn btn-outline-primary py-3" name="checkout" value="1">
                <i class="fas fa-bolt me-2"></i> Buy Now
              </button>
            </div>
          </form>

          <div class="accordion mb-4" id="productAccordion">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#description">
                  Description
                </button>
              </h2>
              <div id="description" class="accordion-collapse collapse show" data-bs-parent="#productAccordion">
                <div class="accordion-body">
                  {!! $product->description !!}
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#specs">
                  Specifications
                </button>
              </h2>
              <div id="specs" class="accordion-collapse collapse" data-bs-parent="#productAccordion">
                <div class="accordion-body">
                  <table class="table">
                    {{-- @foreach($product->specifications as $spec)
                      <tr>
                        <th>{{ $spec->key }}</th>
                        <td>{{ $spec->value }}</td>
                      </tr>
                    @endforeach --}}
                  </table>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#shipping">
                  Shipping & Returns
                </button>
              </h2>
              <div id="shipping" class="accordion-collapse collapse" data-bs-parent="#productAccordion">
                <div class="accordion-body">
                  <p>Free standard shipping on all orders. Delivery within 3-5 business days.</p>
                  <p>30-day return policy. Items must be unused and in original packaging.</p>
                </div>
              </div>
            </div>
          </div>

          <div class="d-flex align-items-center gap-2">
            <span>Share:</span>
            <a href="#" class="btn btn-outline-secondary rounded-circle p-2"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="btn btn-outline-secondary rounded-circle p-2"><i class="fab fa-twitter"></i></a>
            <a href="#" class="btn btn-outline-secondary rounded-circle p-2"><i class="fab fa-instagram"></i></a>
            <a href="#" class="btn btn-outline-secondary rounded-circle p-2"><i class="fab fa-whatsapp"></i></a>
          </div>
        </div>
      </div>
    </div>

    <!-- Product Tabs -->
    <div class="row mt-5">
      <div class="col-12">
        <ul class="nav nav-tabs" id="productTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button">
              Reviews ({{ $product->reviews_count }})
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="questions-tab" data-bs-toggle="tab" data-bs-target="#questions" type="button">
              Questions ({{ $product->questions_count }})
            </button>
          </li>
        </ul>
        <div class="tab-content p-4 border border-top-0 rounded-bottom" id="productTabsContent">
          <div class="tab-pane fade show active" id="reviews" role="tabpanel">
            <div class="row">
              <div class="col-lg-5">
                <h4>Customer Reviews</h4>
                <div class="d-flex align-items-center mb-4">
                  <div class="text-center me-4">
                    <h1 class="mb-0">{{ number_format($product->rating, 1) }}</h1>
                    <div class="rating mb-2">
                      @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star{{ $i <= floor($product->rating) ? '' : ($i == ceil($product->rating) && !$product->rating == floor($product->rating) ? '-half-alt' : '') }}"></i>
                      @endfor
                    </div>
                    <p class="text-muted mb-0">{{ $product->reviews_count }} reviews</p>
                  </div>
                  <div class="flex-grow-1">
                    @for($i = 5; $i >= 1; $i--)
                      @php
                        $percentage = $product->reviews_count > 0 ?
                          ($product->reviews->where('rating', $i)->count() / $product->reviews_count) * 100 : 0;
                      @endphp
                      <div class="d-flex align-items-center mb-2">
                        <span class="me-2">{{ $i }}</span>
                        <i class="fas fa-star text-warning me-2"></i>
                        <div class="progress flex-grow-1" style="height: 8px;">
                          <div class="progress-bar bg-warning" style="width: {{ $percentage }}%"></div>
                        </div>
                        <span class="ms-2">{{ round($percentage) }}%</span>
                      </div>
                    @endfor
                  </div>
                </div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal">Write a Review</button>
              </div>
              <div class="col-lg-7">
                <div class="review-list">
                  {{-- @foreach($product->reviews as $review)
                    <div class="border-bottom pb-4 mb-4">
                      <div class="d-flex justify-content-between mb-2">
                        <div class="d-flex align-items-center">
                          <img src="{{ $review->user->avatar_url }}" class="rounded-circle me-3" width="50" alt="User">
                          <div>
                            <h6 class="mb-0">{{ $review->user->name }}</h6>
                            <div class="rating small">
                              @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star{{ $i <= $review->rating ? '' : '-half-alt' }}"></i>
                              @endfor
                            </div>
                          </div>
                        </div>
                        <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                      </div>
                      <h5>{{ $review->title }}</h5>
                      <p>{{ $review->comment }}</p>
                      <div class="d-flex gap-3">
                        <button class="btn btn-sm btn-outline-secondary"><i class="far fa-thumbs-up me-1"></i> Helpful ({{ $review->helpful_count }})</button>
                        <button class="btn btn-sm btn-outline-secondary"><i class="far fa-comment me-1"></i> Comment</button>
                      </div>
                    </div>
                  @endforeach --}}
                </div>
                @if($product->reviews_count > 3)
                  <button class="btn btn-outline-primary w-100">Load More Reviews</button>
                @endif
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="questions" role="tabpanel">
            <h4>Customer Questions</h4>
            <div class="mb-4">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Have a question? Search for answers...">
                <button class="btn btn-primary">Search</button>
              </div>
            </div>

            <div class="accordion" id="questionsAccordion">
              {{-- @foreach($product->questions as $question)
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                      data-bs-toggle="collapse" data-bs-target="#question{{ $question->id }}">
                      {{ $question->question }}
                    </button>
                  </h2>
                  <div id="question{{ $question->id }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                    data-bs-parent="#questionsAccordion">
                    <div class="accordion-body">
                      <p>{{ $question->answer }}</p>
                      <div class="d-flex align-items-center text-muted">
                        <small>Answered by <strong>{{ $question->answered_by }}</strong> • {{ $question->answered_at->diffForHumans() }}</small>
                      </div>
                      <div class="mt-3">
                        <button class="btn btn-sm btn-outline-secondary"><i class="far fa-thumbs-up me-1"></i> Helpful ({{ $question->helpful_count }})</button>
                        <button class="btn btn-sm btn-outline-secondary ms-2"><i class="far fa-thumbs-down me-1"></i> Not Helpful ({{ $question->not_helpful_count }})</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach --}}
            </div>

            <div class="mt-4">
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#questionModal">Ask a Question</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
      <div class="row mt-5">
        <div class="col-12">
          <h4 class="mb-4">You May Also Like</h4>
          <div class="row g-4">
            @foreach($relatedProducts as $related)
              <div class="col-lg-3 col-md-6">
                <div class="product-card card h-100">
                  @if($related->discount)
                    <div class="badge bg-primary text-dark">Sale</div>
                  @endif
                  {{-- @if($related->isNew())
                    <div class="badge bg-danger">New</div>
                  @endif --}}

                  {{-- <img src="{{ $related->image_url }}" class="card-img-top" alt="{{ $related->name }}"> --}}
                  @if ($product->thumbnail && file_exists(public_path($product->thumbnail)))
                    <img src="{{ asset($related->thumbnail) }}"  class="img-fluid w-100" alt="Product Image" id="mainImage">
                  @else
                    <img src="{{ asset('assets/images/test.jpg') }}" alt="Default product Image"
                        style="width: 40px; height: 40px; border-radius: 5px; object-fit: cover;">
                  @endif
                  <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                      {{-- <span class="text-muted">{{ $related->category->name }}</span> --}}
                      <div class="rating">
                        @for($i = 1; $i <= 5; $i++)
                          <i class="fas fa-star{{ $i <= $related->rating ? '' : '-half-alt' }}"></i>
                        @endfor
                      </div>
                    </div>
                    <h5 class="card-title">{{ $related->name }}</h5>
                    <p class="card-text">{{ Str::limit($related->description, 60) }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <h5 class="mb-0 text-primary">${{ number_format($related->price, 2) }}</h5>
                      @if($related->discount)
                        <del class="text-muted">${{ number_format($related->original_price, 2) }}</del>
                      @endif
                    </div>
                  </div>
                  <div class="card-footer bg-transparent border-top-0">
                    <a href="{{ route('product.show', $related->slug) }}" class="btn btn-primary w-100">View Details</a>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    @endif
  </div>
</section>

<!-- Review Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      {{-- <form action="{{ route('reviews.store') }}" method="POST"> --}}
      <form action="#" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <div class="modal-header">
          <h5 class="modal-title" id="reviewModalLabel">Write a Review</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Rating</label>
            <div class="rating-input">
              @for($i = 1; $i <= 5; $i++)
                <i class="far fa-star" data-rating="{{ $i }}"></i>
              @endfor
              <input type="hidden" name="rating" id="ratingValue" required>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Review</label>
            <textarea class="form-control" name="comment" rows="5" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Submit Review</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Question Modal -->
<div class="modal fade" id="questionModal" tabindex="-1" aria-labelledby="questionModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      {{-- <form action="{{ route('questions.store') }}" method="POST"> --}}
      <form action="#" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <div class="modal-header">
          <h5 class="modal-title" id="questionModalLabel">Ask a Question</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Question</label>
            <textarea class="form-control" name="question" rows="5" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Submit Question</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  // Thumbnail image click
  document.querySelectorAll('.thumb-image').forEach(thumb => {
    thumb.addEventListener('click', function() {
      document.getElementById('mainImage').src = this.dataset.full;
    });
  });

  // Quantity increment/decrement
  document.getElementById('increment').addEventListener('click', function() {
    const quantity = document.getElementById('quantity');
    quantity.value = parseInt(quantity.value) + 1;
  });

  document.getElementById('decrement').addEventListener('click', function() {
    const quantity = document.getElementById('quantity');
    if (parseInt(quantity.value) > 1) {
      quantity.value = parseInt(quantity.value) - 1;
    }
  });

  // Rating stars in modal
  document.querySelectorAll('.rating-input i').forEach(star => {
    star.addEventListener('click', function() {
      const rating = parseInt(this.dataset.rating);
      document.getElementById('ratingValue').value = rating;

      // Update star display
      document.querySelectorAll('.rating-input i').forEach((s, index) => {
        if (index < rating) {
          s.classList.remove('far');
          s.classList.add('fas');
        } else {
          s.classList.remove('fas');
          s.classList.add('far');
        }
      });
    });
  });
</script>
@endpush
