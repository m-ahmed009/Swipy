@extends('admin.layouts.app')

@section('title', 'Add New Category')
@section('page-title', 'Create Category')

@section('css')
    <style>
        .is-invalid {
            border-color: #ef4444 !important;
        }

        .invalid-feedback {
            color: #ef4444;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }

        .image-preview {
            max-width: 200px;
            max-height: 200px;
            margin-top: 10px;
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="admin-main mt-3">
        <div class="card card-glass p-4" style="width: 75vw; margin: auto;">
            <h4 class="mb-4"><i class="bi bi-tag me-2"></i>Add Main Category</h4>

            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" id="categoryForm">
                @csrf

                <div class="row">
                    <!-- Name Field -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image Field -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" id="imageInput"
                            class="form-control @error('image') is-invalid @enderror" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <img id="imagePreview" class="image-preview" />
                    </div>

                    <!-- Active Switch -->
                    <div class="col-md-6 mb-3">
                        <div class="form-check form-switch">
                            <input type="hidden" name="is_active" value="0"> <!-- Default: inactive -->
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
                            {{ old('is_active', 1) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>


                    <!-- Buttons -->
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary me-2">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-swippy text-light">
                            <i class="bi bi-save me-1"></i> Create Category
                        </button>
                    </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#imageInput').on('change', function() {
            const file = this.files[0];
            const preview = $('#imagePreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.attr('src', e.target.result);
                    preview.show();
                }
                reader.readAsDataURL(file);
            } else {
                preview.hide();
                preview.attr('src', '');
            }
        });
    </script>
@endsection
