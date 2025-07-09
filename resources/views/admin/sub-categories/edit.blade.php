@extends('admin.layouts.app')

@section('title', 'Edit User')
@section('page-title', 'Update User')

@section('css')
<style>
    .password-toggle {
        position: relative;
    }
    .password-toggle input {
        padding-right: 40px;
    }
    .password-toggle .toggle {
        position: absolute;
        right: 10px;
        top: 75%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #64748b;
    }
</style>
@endsection

@section('content')
<div class="admin-main mt-3">
    <div class="card card-glass p-4" style="width: 75vw; margin: auto;">
        <h4 class="mb-4"><i class="bi bi-person-gear me-2"></i>Edit User</h4>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" id="userForm">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
            </div>

            <div class="mb-3 password-toggle">
                <label class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Leave blank to keep current password">
                <i class="bi bi-eye-slash toggle" id="togglePassword"></i>
            </div>

            <div class="mb-3 password-toggle">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="confirmPassword" class="form-control" placeholder="Leave blank to keep current password">
                <i class="bi bi-eye-slash toggle" id="toggleConfirmPassword"></i>
            </div>

            <div class="mb-3">
                <label class="form-label">Role <span class="text-danger">*</span></label>
                <select name="role" class="form-select">
                    <option value="admin" {{ old('role', $user->getRoleNames()->first()) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="manager" {{ old('role', $user->getRoleNames()->first()) == 'manager' ? 'selected' : '' }}>Manager</option>
                    <option value="salesperson" {{ old('role', $user->getRoleNames()->first()) == 'salesperson' ? 'selected' : '' }}>Salesperson</option>
                </select>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.users.index') }}" class="btn-swippy-cancel me-2"><i class="bi bi-x-circle"></i> Cancel</a>
                <button type="submit" class="btn btn-swippy text-light">
                    <i class="bi bi-check-circle me-1"></i> Update User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        // Password toggle functionality
        $('#togglePassword').click(function() {
            const passwordInput = $('#password');
            const icon = $(this);

            if (passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
                icon.removeClass('bi-eye-slash').addClass('bi-eye');
            } else {
                passwordInput.attr('type', 'password');
                icon.removeClass('bi-eye').addClass('bi-eye-slash');
            }
        });

        // Confirm password toggle functionality
        $('#toggleConfirmPassword').click(function() {
            const confirmInput = $('#confirmPassword');
            const icon = $(this);

            if (confirmInput.attr('type') === 'password') {
                confirmInput.attr('type', 'text');
                icon.removeClass('bi-eye-slash').addClass('bi-eye');
            } else {
                confirmInput.attr('type', 'password');
                icon.removeClass('bi-eye').addClass('bi-eye-slash');
            }
        });
    });
</script>
@endsection
