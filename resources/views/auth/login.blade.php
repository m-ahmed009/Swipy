@extends('front.layouts.app')

@section('content')
    <!-- Login Section -->
    <section class="py-5 my-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card shadow-sm">
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <h3 class="fw-bold">Welcome Back</h3>
                                <p class="text-muted">Sign in to your account to continue</p>
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" placeholder="Enter your email" required autofocus>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password"
                                        placeholder="Enter your password" required>
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    <div class="text-end mt-2">
                                        <a href="{{ route('password.request') }}"
                                            class="text-decoration-none text-primary">Forgot password?</a>
                                    </div>
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-2">Sign In</button>
                            </form>

                            <div class="text-center mt-4">
                                <p class="text-muted mb-0">Don't have an account? <a href="{{ route('register') }}"
                                        class="text-primary text-decoration-none">Sign up</a></p>
                            </div>
                            <div class="divider my-4">
                                <div class="divider-text">OR</div>
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-secondary">
                                    <i class="fab fa-google me-2"></i> Sign in with Google
                                </button>
                                <button class="btn btn-outline-secondary">
                                    <i class="fab fa-facebook-f me-2"></i> Sign in with Facebook
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
