@extends('front.layouts.app')

@section('content')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/card/2.5.0/card.min.css">
    <style>
        /* Aapki .card CSS yahan */
        .jp-card-container {
            margin-top: 20px;
        }

        .jp-card {
            font-family: 'Sanchez', serif !important;
        }
    </style>
@endsection

<!-- Checkout Section -->
<section class="py-5">
    <div class="container">
        <div class="mb-5">
            <h2 class="mb-0">Checkout</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="cart.html">Cart</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </nav>
        </div>

        <div class="row g-5">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills mb-5" id="checkoutTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="shipping-tab" data-bs-toggle="pill"
                                    data-bs-target="#shipping" type="button">
                                    <i class="fas fa-truck me-2"></i> Shipping
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="payment-tab" data-bs-toggle="pill"
                                    data-bs-target="#payment" type="button">
                                    <i class="far fa-credit-card me-2"></i> Payment
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="review-tab" data-bs-toggle="pill" data-bs-target="#review"
                                    type="button">
                                    <i class="fas fa-check-circle me-2"></i> Review
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content" id="checkoutTabContent">
                            <!-- Shipping Tab -->
                            <div class="tab-pane fade show active" id="shipping" role="tabpanel">
                                <h5 class="mb-4">Shipping Information</h5>
                                <form>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="firstName" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="firstName" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lastName" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="lastName" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address"
                                                placeholder="1234 Main St" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="address2" class="form-label">Address 2 <span
                                                    class="text-muted">(Optional)</span></label>
                                            <input type="text" class="form-control" id="address2"
                                                placeholder="Apartment or suite">
                                        </div>
                                        <div class="col-md-5">
                                            <label for="country" class="form-label">Country</label>
                                            <select class="form-select" id="country" required>
                                                <option value="">Choose...</option>
                                                <option>United States</option>
                                                <option>Canada</option>
                                                <option>United Kingdom</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="state" class="form-label">State</label>
                                            <select class="form-select" id="state" required>
                                                <option value="">Choose...</option>
                                                <option>California</option>
                                                <option>New York</option>
                                                <option>Texas</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="zip" class="form-label">Zip</label>
                                            <input type="text" class="form-control" id="zip" required>
                                        </div>
                                    </div>

                                    <hr class="my-4">

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="same-address">
                                        <label class="form-check-label" for="same-address">Shipping address is the
                                            same as my billing address</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="save-info">
                                        <label class="form-check-label" for="save-info">Save this information for next
                                            time</label>
                                    </div>

                                    <hr class="my-4">

                                    <h5 class="mb-3">Shipping Method</h5>

                                    <div class="form-check">
                                        <input id="free-shipping" name="shipping" type="radio"
                                            class="form-check-input" checked required>
                                        <label class="form-check-label" for="free-shipping">Standard Shipping (Free) -
                                            3-5 business days</label>
                                    </div>

                                    <div class="form-check">
                                        <input id="express-shipping" name="shipping" type="radio"
                                            class="form-check-input" required>
                                        <label class="form-check-label" for="express-shipping">Express Shipping
                                            ($9.99) - 1-2 business days</label>
                                    </div>

                                    <div class="d-flex justify-content-between mt-5">
                                        <a href="cart.html" class="btn btn-outline-secondary">Back to Cart</a>
                                        <button type="button" class="btn btn-primary"
                                            onclick="nextTab('payment-tab')">Continue to Payment</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Payment Tab -->
                            <div class="tab-pane fade" id="payment" role="tabpanel">
                                <h5 class="mb-4">Payment Method</h5>
                                <form id="payment-form">
                                    <div class="row gy-3">
                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <input id="credit" name="paymentMethod" type="radio"
                                                    class="form-check-input" checked required>
                                                <label class="form-check-label" for="credit">Credit card</label>
                                            </div>
                                            <div class="form-check">
                                                <input id="debit" name="paymentMethod" type="radio"
                                                    class="form-check-input" required>
                                                <label class="form-check-label" for="debit">Debit card</label>
                                            </div>
                                            <div class="form-check">
                                                <input id="paypal" name="paymentMethod" type="radio"
                                                    class="form-check-input" required>
                                                <label class="form-check-label" for="paypal">PayPal</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <label for="cc-name" class="form-label">Name on card</label>
                                            <input type="text" class="form-control" id="cc-name" name="name"
                                                required>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="cc-number" class="form-label">Credit card number</label>
                                            <input type="text" class="form-control" id="cc-number" name="number"
                                                required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="cc-expiration" class="form-label">Expiration</label>
                                            <input type="text" class="form-control" id="cc-expiration"
                                                name="expiry" placeholder="MM/YY" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="cc-cvv" class="form-label">CVV</label>
                                            <input type="text" class="form-control" id="cc-cvv" name="cvc"
                                                required>
                                        </div>
                                    </div>
                                </form>
                                <!-- Card.js Preview Container -->
                                <div id="card-wrapper" class="my-4"></div>
                                <div class="d-flex justify-content-between mt-5">
                                    <a  onclick="nextTab('shipping-tab')" class="btn btn-outline-secondary">Back to Shipping</a>
                                    <button type="button" class="btn btn-primary" onclick="nextTab('review-tab')">Continue to Review</button>
                                  </div>
                            </div>

                            <!-- Review Tab -->
                            <div class="tab-pane fade" id="review" role="tabpanel">
                                <h5 class="mb-4">Review Your Order</h5>

                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h6 class="mb-3">Shipping Information</h6>
                                        <p class="mb-1">John Doe</p>
                                        <p class="mb-1">1234 Main St, Apt 4B</p>
                                        <p class="mb-1">New York, NY 10001</p>
                                        <p class="mb-0">United States</p>
                                        <p class="mb-0">john.doe@example.com</p>
                                        <p class="mb-0">(123) 456-7890</p>
                                        <a href="#" class="btn btn-sm btn-outline-primary mt-3"
                                            onclick="prevTab('shipping-tab')">Edit</a>
                                    </div>
                                </div>

                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h6 class="mb-3">Payment Method</h6>
                                        <p class="mb-1">Visa ending in 4242</p>
                                        <p class="mb-0">Expires 12/25</p>
                                        <a href="#" class="btn btn-sm btn-outline-primary mt-3"
                                            onclick="prevTab('payment-tab')">Edit</a>
                                    </div>
                                </div>

                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h6 class="mb-3">Order Summary</h6>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                        <th>Qty</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Wireless Headphones</td>
                                                        <td>$99.99</td>
                                                        <td>1</td>
                                                        <td>$99.99</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Smart Watch</td>
                                                        <td>$149.99</td>
                                                        <td>1</td>
                                                        <td>$149.99</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Air Fryer</td>
                                                        <td>$79.99</td>
                                                        <td>1</td>
                                                        <td>$79.99</td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3">Subtotal</td>
                                                        <td>$329.97</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">Shipping</td>
                                                        <td>$0.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">Tax</td>
                                                        <td>$19.80</td>
                                                    </tr>
                                                    <tr class="fw-bold">
                                                        <td colspan="3">Total</td>
                                                        <td>$349.77</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" id="agree-terms" required>
                                    <label class="form-check-label" for="agree-terms">
                                        I agree to the <a href="#">Terms and Conditions</a> and <a
                                            href="#">Privacy Policy</a>
                                    </label>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="prevTab('payment-tab')">Back to Payment</button>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#orderConfirmation">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Order Summary</h5>
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div class="d-flex align-items-center">
                                    <img src="../assets/images/product1.jpg" class="rounded me-3" width="60"
                                        alt="Product">
                                    <div>
                                        <h6 class="mb-0">Wireless Headphones</h6>
                                        <small class="text-muted">1 × $99.99</small>
                                    </div>
                                </div>
                                <span>$99.99</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div class="d-flex align-items-center">
                                    <img src="../assets/images/product2.jpg" class="rounded me-3" width="60"
                                        alt="Product">
                                    <div>
                                        <h6 class="mb-0">Smart Watch</h6>
                                        <small class="text-muted">1 × $149.99</small>
                                    </div>
                                </div>
                                <span>$149.99</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div class="d-flex align-items-center">
                                    <img src="../assets/images/product3.jpg" class="rounded me-3" width="60"
                                        alt="Product">
                                    <div>
                                        <h6 class="mb-0">Air Fryer</h6>
                                        <small class="text-muted">1 × $79.99</small>
                                    </div>
                                </div>
                                <span>$79.99</span>
                            </li>
                        </ul>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                Subtotal
                                <span>$329.97</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                Shipping
                                <span>$0.00</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                Tax
                                <span>$19.80</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 fw-bold">
                                Total
                                <span>$349.77</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body">
                        <h6 class="mb-3">Need Help?</h6>
                        <p class="mb-3">If you have any questions or need assistance with your order, please contact
                            our customer service.</p>
                        <a href="#" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-headset me-2"></i> Contact Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Order Confirmation Modal -->
<div class="modal fade" id="orderConfirmation" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-5 text-center">
                <div class="mb-4">
                    <div class="icon-box bg-primary bg-opacity-10 text-primary mx-auto mb-4">
                        <i class="fas fa-check fa-3x"></i>
                    </div>
                    <h3 class="mb-3">Order Confirmed!</h3>
                    <p class="text-muted mb-4">Your order #123456 has been placed successfully. We've sent you an email
                        with all the details.</p>
                </div>
                <div class="d-grid gap-3">
                    <a href="{{ route('shop') }}" class="btn btn-primary">Continue Shopping</a>
                    <a href="#" class="btn btn-outline-secondary">View Order Details</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- Card.js Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/card/2.5.0/card.min.js"></script>

<!-- Custom JS for tab navigation -->
<script>
    function nextTab(tabId) {
        const triggerEl = document.querySelector(`#${tabId}`);
        bootstrap.Tab.getInstance(triggerEl)?.show() || new bootstrap.Tab(triggerEl).show();
    }

    function prevTab(tabId) {
        const triggerEl = document.querySelector(`#${tabId}`);
        bootstrap.Tab.getInstance(triggerEl)?.show() || new bootstrap.Tab(triggerEl).show();
    }

    document.addEventListener('DOMContentLoaded', function() {
        new Card({
            form: '#payment-form',
            container: '#card-wrapper',
            formSelectors: {
                numberInput: 'input[name="number"]',
                expiryInput: 'input[name="expiry"]',
                cvcInput: 'input[name="cvc"]',
                nameInput: 'input[name="name"]'
            }
        });
    });
</script>
@endsection
