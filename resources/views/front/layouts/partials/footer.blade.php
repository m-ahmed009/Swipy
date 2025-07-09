  <!-- Footer -->
  <footer class="footer py-5">
      <div class="container">
          <div class="row">
              <div class="col-lg-3 mb-4">
                  <h5 class="text-white mb-3"><i class="bi bi-lightning-fill me-2"></i> Swippy</h5>
                  <p>The modern e-commerce platform for all your needs. Quality products with fast delivery.</p>
                  <div class="social-icons mt-3">
                      <a href="https://www.facebook.com/yourpage" target="_blank" rel="noopener noreferrer" class="me-2">
                          <i class="fab fa-facebook-f"></i>
                      </a>
                      <a href="https://twitter.com/yourhandle" target="_blank" rel="noopener noreferrer" class="me-2">
                          <i class="fab fa-twitter"></i>
                      </a>
                      <a href="https://www.instagram.com/yourprofile" target="_blank" rel="noopener noreferrer"
                          class="me-2">
                          <i class="fab fa-instagram"></i>
                      </a>
                      <a href="https://www.linkedin.com/in/yourprofile" target="_blank" rel="noopener noreferrer"
                          class="me-2">
                          <i class="fab fa-linkedin-in"></i>
                      </a>
                  </div>
              </div>
              <div class="col-lg-3 mb-4">
                  <h5 class="text-white mb-3"> <i class="bi bi-folder-symlink "></i> Quick Links</h5>
                  <ul class="list-unstyled">
                      <li class="mb-2"><a href="index.html">Home</a></li>
                      <li class="mb-2"><a href="products.html">Shop</a></li>
                      <li class="mb-2"><a href="#">About Us</a></li>
                      <li class="mb-2"><a href="#">Contact</a></li>
                      <li class="mb-2"><a href="#">FAQ</a></li>
                  </ul>
              </div>
              <div class="col-lg-3 mb-4">
                  <h5 class="text-white mb-3"> <i class="bi bi-headphones me-2"></i> Customer Service</h5>
                  <ul class="list-unstyled">
                      <li class="mb-2"><a href="#">My Account</a></li>
                      <li class="mb-2"><a href="#">Order Tracking</a></li>
                      <li class="mb-2"><a href="#">Wishlist</a></li>
                      <li class="mb-2"><a href="#">Terms & Conditions</a></li>
                      <li class="mb-2"><a href="#">Privacy Policy</a></li>
                  </ul>
              </div>
              <div class="col-lg-3 mb-4">
                  <h5 class="text-white mb-3"> <i class="bi bi-card-heading me-2"></i> Newsletter</h5>
                  <p>Subscribe to our newsletter for the latest updates and offers.</p>
                  <form class="mt-3">
                      <div class="input-group mb-3">
                          <input type="email" class="form-control" placeholder="Your Email">
                          <button class="btn btn-primary" type="submit">Subscribe</button>
                      </div>
                  </form>
              </div>
          </div>
          <hr class="my-4 bg-light">
          <div class="row">
              <div class="col-md-6 text-center text-md-start">
                  {{-- <p class="mb-0">&copy; 2023 Swippy. All rights reserved.</p> --}}
                  <p class="mb-0">© {{ now()->year }} Swippy. All rights reserved.</p>
              </div>
              <div class="col-md-6 text-center text-md-end">
                  <img src="{{ asset('assets/images/habib.png') }}" alt="Payment Methods" height="30">
                  <img src="{{ asset('assets/images/visa.png') }}" alt="Payment Methods" height="30">
                  <img src="{{ asset('assets/images/daraz.png') }}" alt="Payment Methods" height="30">
                  <img src="{{ asset('assets/images/easypaisa.png') }}" alt="Payment Methods" height="30">
                  <img src="{{ asset('assets/images/jazz.png') }}" alt="Payment Methods" height="30">
                  <img src="{{ asset('assets/images/mastercard.png') }}" alt="Payment Methods" height="30">
                  <img src="{{ asset('assets/images/union.png') }}" alt="Payment Methods" height="30">
              </div>
          </div>
      </div>
  </footer>
