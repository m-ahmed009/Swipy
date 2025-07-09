@extends('front.layouts.app')

@section('content')


<!-- Cart Section -->
<section class="py-5">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-5">
      <h2 class="mb-0">Your Cart</h2>
      <span class="text-muted">3 items</span>
    </div>

    <div class="row g-5">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table mb-0">
                <thead class="bg-light">
                  <tr>
                    <th scope="col" style="width: 50%">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Cart Item 1 -->
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="../assets/images/product1.jpg" class="rounded me-3" width="80" alt="Product">
                        <div>
                          <h6 class="mb-1">Wireless Headphones</h6>
                          <p class="text-muted mb-0">Color: Black</p>
                        </div>
                      </div>
                    </td>
                    <td>$99.99</td>
                    <td>
                      <div class="input-group" style="width: 120px;">
                        <button class="btn btn-outline-secondary" type="button">-</button>
                        <input type="text" class="form-control text-center" value="1">
                        <button class="btn btn-outline-secondary" type="button">+</button>
                      </div>
                    </td>
                    <td>$99.99</td>
                    <td>
                      <button class="btn btn-sm btn-outline-danger">
                        <i class="far fa-trash-alt"></i>
                      </button>
                    </td>
                  </tr>
                  <!-- Cart Item 2 -->
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="../assets/images/product2.jpg" class="rounded me-3" width="80" alt="Product">
                        <div>
                          <h6 class="mb-1">Smart Watch</h6>
                          <p class="text-muted mb-0">Color: Silver</p>
                        </div>
                      </div>
                    </td>
                    <td>$149.99</td>
                    <td>
                      <div class="input-group" style="width: 120px;">
                        <button class="btn btn-outline-secondary" type="button">-</button>
                        <input type="text" class="form-control text-center" value="1">
                        <button class="btn btn-outline-secondary" type="button">+</button>
                      </div>
                    </td>
                    <td>$149.99</td>
                    <td>
                      <button class="btn btn-sm btn-outline-danger">
                        <i class="far fa-trash-alt"></i>
                      </button>
                    </td>
                  </tr>
                  <!-- Cart Item 3 -->
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="../assets/images/product3.jpg" class="rounded me-3" width="80" alt="Product">
                        <div>
                          <h6 class="mb-1">Air Fryer</h6>
                          <p class="text-muted mb-0">Color: White</p>
                        </div>
                      </div>
                    </td>
                    <td>$79.99</td>
                    <td>
                      <div class="input-group" style="width: 120px;">
                        <button class="btn btn-outline-secondary" type="button">-</button>
                        <input type="text" class="form-control text-center" value="1">
                        <button class="btn btn-outline-secondary" type="button">+</button>
                      </div>
                    </td>
                    <td>$79.99</td>
                    <td>
                      <button class="btn btn-sm btn-outline-danger">
                        <i class="far fa-trash-alt"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer bg-white">
            <div class="row">
              <div class="col-md-6">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Coupon Code">
                  <button class="btn btn-primary">Apply</button>
                </div>
              </div>
              <div class="col-md-6 text-md-end">
                <button class="btn btn-outline-secondary me-2">Update Cart</button>
                <button class="btn btn-primary">Continue Shopping</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title mb-4">Order Summary</h5>
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
            <div class="d-grid mt-4">
              <a href="{{ route('checkout') }}" class="btn btn-primary btn-lg">Proceed to Checkout</a>
            </div>
          </div>
        </div>

        <div class="card mt-4">
          <div class="card-body">
            <h6 class="mb-3">We Accept</h6>
            <div class="d-flex flex-wrap gap-2">
              <img src="../assets/images/payment-visa.png" width="50" alt="Visa">
              <img src="../assets/images/payment-mastercard.png" width="50" alt="Mastercard">
              <img src="../assets/images/payment-amex.png" width="50" alt="American Express">
              <img src="../assets/images/payment-paypal.png" width="50" alt="PayPal">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
