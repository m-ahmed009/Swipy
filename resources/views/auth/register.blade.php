@extends('front.layouts.app')

@section('content')
    <!-- Registration Section -->
    <section class="py-5 my-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card shadow-sm">
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <h3 class="fw-bold">Create Account</h3>
                                <p class="text-muted">Get started with your free account</p>
                            </div>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Enter your full name" value="{{ old('name') }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="Enter your email" value="{{ old('email') }}">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password"
                                        placeholder="Create a password">
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="confirm-password" class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                        id="confirm-password" placeholder="Confirm your password">
                                    @error('password_confirmation')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="terms" required>
                                    <label class="form-check-label" for="terms">
                                        I agree to the <a href="#" class="text-primary">Terms & Conditions</a>
                                    </label>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-2">Create Account</button>
                            </form>

                            <div class="text-center mt-4">
                                <p class="text-muted mb-0">Already have an account? <a href="{{ route('login') }}"
                                        class="text-primary text-decoration-none">Sign in</a></p>
                            </div>
                            <div class="divider my-4">
                                <div class="divider-text">OR</div>
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-secondary">
                                    <i class="fab fa-google me-2"></i> Sign up with Google
                                </button>
                                <button class="btn btn-outline-secondary">
                                    <i class="fab fa-facebook-f me-2"></i> Sign up with Facebook
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
