@extends('admin.layouts.app')

@section('title', 'Swippy - Add New Product')
@section('page-title', 'Create Product')

@section('css')
    <!-- Summernote CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">

    <style>
        .is-invalid {
            border-color: #ef4444 !important;
        }

        .invalid-feedback {
            color: #ef4444;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }

        /* Image Upload */
        .image-upload-container {
            border: 2px dashed #e2e8f0;
            border-radius: 0.5rem;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .image-upload-container:hover {
            border-color: var(--swippy-primary);
        }

        .image-upload-container.drag-over {
            border-color: var(--swippy-primary);
            background-color: rgba(59, 130, 246, 0.05);
        }

        .thumbnail-preview {
            max-width: 200px;
            max-height: 200px;
            display: block;
            margin: 0 auto 10px;
        }

        .gallery-preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
        }

        .gallery-preview-item {
            position: relative;
            width: 100px;
            height: 100px;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
        }

        .gallery-preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .gallery-preview-item .remove-image {
            position: absolute;
            top: 2px;
            right: 2px;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .gallery-preview-item .remove-image:hover {
            background: rgba(0, 0, 0, 0.8);
        }
    </style>
@endsection

@section('content')
    <div class="admin-main mt-3">
        <div class="card card-glass p-4" style="width: 75vw; margin: auto;">
            <h4 class="mb-4"><i class="bi bi-tag me-2"></i>Add Product</h4>

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
                @csrf

                <div class="row">

                    <!-- Sku Field -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Sku <span class="text-danger">*</span></label>
                        <input type="text" name="sku" value="{{ old('sku') }}"
                            class="form-control @error('sku') is-invalid @enderror">
                        @error('sku')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Name Field -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Slug Field -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Slug <span class="text-danger">*</span></label>
                        <input type="text" name="slug" value="{{ old('slug') }}"
                            class="form-control @error('sku') is-invalid @enderror">
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Main Category Dropdown -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Main Category <span class="text-danger">*</span></label>
                        <select name="main_category_id" class="form-select @error('main_category_id') is-invalid @enderror"
                            id="mainCategory">
                            <option value="" selected disabled>Select main category</option>
                            @foreach ($mainCategories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('main_category_id') == $category->id ? 'selected' : '' }}>
                                    {{ ucfirst($category->name) }}
                                </option>
                            @endforeach
                        </select>
                        @error('main_category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Sub Category Dropdown -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub Category <span class="text-danger">*</span></label>
                        <select name="sub_category_id" class="form-select @error('sub_category_id') is-invalid @enderror"
                            id="subCategory">
                            <option value="" selected disabled>Select sub category</option>
                        </select>
                        @error('sub_category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <!-- Price -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Price <span class="text-danger">*</span></label>
                            <input type="number" name="price" step="0.01"
                                class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Discount -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Discount</label>
                            <input type="number" name="discount" step="0.01"
                                class="form-control @error('discount') is-invalid @enderror"
                                value="{{ old('discount', 0) }}">
                            @error('discount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tax -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tax</label>
                            <input type="number" name="tax" step="0.01"
                                class="form-control @error('tax') is-invalid @enderror" value="{{ old('tax', 0) }}">
                            @error('tax')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Thumbnail Image -->
                        <div class="col-md-6 mb-3">
                            <div class="card card-glass mb-4">
                                <div class="card-header bg-white border-0">
                                    <h5 class="mb-0">Product Thumbnail <span class="text-danger">*</span></h5>
                                </div>
                                <div class="card-body">
                                    <div class="image-upload-container" id="thumbnailUploadContainer">
                                        <i class="bi bi-cloud-arrow-up fs-1 text-muted mb-2"></i>
                                        <p class="mb-1">Drag & drop your image here</p>
                                        <p class="text-muted small mb-0">or click to browse</p>
                                        <input type="file" name="thumbnail" id="thumbnailImage" accept="image/*"
                                            class="d-none">
                                    </div>
                                    <div class="mt-3 text-center" id="thumbnailPreviewContainer" style="display: none;">
                                        <img src="" alt="Preview" class="thumbnail-preview"
                                            id="thumbnailPreview">
                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 w-100"
                                            id="removeThumbnailBtn">
                                            <i class="bi bi-trash"></i> Remove Image
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @error('thumbnail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Product Multiple images -->
                        <div class="col-md-6 mb-3">
                            <div class="card card-glass mb-4">
                                <div class="card-header bg-white border-0">
                                    <h5 class="mb-0">Product Gallery Images</h5>
                                </div>
                                <div class="card-body">
                                    <div class="image-upload-container" id="multiImageUploadContainer">
                                        <i class="bi bi-cloud-arrow-up fs-1 text-muted mb-2"></i>
                                        <p class="mb-1">Drag & drop multiple images here</p>
                                        <p class="text-muted small mb-0">or click to browse</p>
                                        <input type="file" name="images[]" id="multiImages" accept="image/*"
                                            class="d-none" multiple>
                                    </div>
                                    <div class="gallery-preview-container" id="multiImagePreviewContainer"></div>
                                </div>
                            </div>
                            @error('images')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @error('images.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Short Description -->
                    <div class="mb-3">
                        <label for="short_description" class="form-label">Short Description</label>
                        <textarea name="short_description" id="short_description" rows="3"
                            class="form-control @error('short_description') is-invalid @enderror"
                            placeholder="E.g., Lightweight, breathable cotton t-shirt ideal for summer.">{{ old('short_description') }}</textarea>
                        @error('short_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Full Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Full Description</label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <!-- Active Switch -->
                        <div class="col-md-6 mb-3">
                            <div class="form-check form-switch">
                                <input type="hidden" name="is_active" value="0">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                                    value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>

                        <!-- Featured Switch -->
                        <div class="col-md-6 mb-3">
                            <div class="form-check form-switch">
                                <input type="hidden" name="is_featured" value="0">
                                <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured"
                                    value="1" {{ old('is_featured', 0) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">Featured</label>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary me-2">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-swippy text-light">
                            <i class="bi bi-save me-1"></i> Create Product
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Summernote JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Summernote
            $('#description').summernote({
                height: 300,
                placeholder: 'Write full product description here...',
                tabsize: 2,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video', 'table']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            // Slug

// Slug generation via AJAX
$('#name').on('input', function() {
        const name = $(this).val();
        const slugField = $('input[name="slug"]');

        if (name) {
            // Show loading state
            slugField.val('Generating slug...').prop('readonly', true);

            // First try AJAX request
            $.ajax({
                url: '{{ route("admin.products.generate-slug") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: name
                },
                success: function(response) {
                    if (response.slug) {
                        slugField.val(response.slug);
                    }
                },
                error: function(xhr) {
                    console.log('AJAX failed, using client-side generation');
                    // Fallback to client-side generation
                    generateSlugClientSide(name, slugField);
                },
                complete: function() {
                    slugField.prop('readonly', false);
                }
            });
        } else {
            slugField.val('');
        }
    });
            $('#mainCategory').change(function() {
    const mainCategoryId = $(this).val();
    const subCategorySelect = $('#subCategory');

    subCategorySelect.empty().append(
        '<option value="" selected disabled>Loading...</option>'
    ).prop('disabled', true);

    if (mainCategoryId) {
        $.ajax({
            url: `/admin/categories/${mainCategoryId}/sub-categories`,
            type: 'GET',
            success: function(data) {
                subCategorySelect.empty();

                if (data.length > 0) {
                    subCategorySelect.append(
                        '<option value="" selected disabled>Select sub category</option>'
                    );

                    $.each(data, function(key, subCategory) {
                        subCategorySelect.append(
                            $('<option></option>') // Fixed the incorrect 'N' here
                                .attr('value', subCategory.id)
                                .text(subCategory.name)
                        );
                    });
                } else {
                    subCategorySelect.append(
                        '<option value="" selected disabled>No Sub Categories Available</option>'
                    );
                }

                subCategorySelect.prop('disabled', false);

                // Set old value if exists
                @if (old('sub_category_id'))
                    subCategorySelect.val({{ old('sub_category_id') }});
                @endif
            },
            error: function(xhr) {
                let errorMessage = 'Error loading subcategories';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                subCategorySelect.empty().append(
                    `<option value="" selected disabled>${errorMessage}</option>`
                );
                console.error('Error:', xhr.responseText);
            }
        });
    } else {
        subCategorySelect.empty().append(
            '<option value="" selected disabled>Select sub category</option>'
        ).prop('disabled', false);
    }
});

            // Thumbnail image handling
            const thumbnailUploadContainer = $('#thumbnailUploadContainer');
            const thumbnailImage = $('#thumbnailImage');
            const thumbnailPreview = $('#thumbnailPreview');
            const thumbnailPreviewContainer = $('#thumbnailPreviewContainer');
            const removeThumbnailBtn = $('#removeThumbnailBtn');

            // Click to upload
            thumbnailUploadContainer.on('click', function(e) {
                // Only trigger if the click is directly on the container (not its children)
                if (e.target === this) {
                    thumbnailImage.trigger('click');
                }
            });

            // Drag and drop for thumbnail
            thumbnailUploadContainer.on('dragover', function(e) {
                e.preventDefault();
                $(this).addClass('drag-over');
            });

            thumbnailUploadContainer.on('dragleave', function() {
                $(this).removeClass('drag-over');
            });

            thumbnailUploadContainer.on('drop', function(e) {
                e.preventDefault();
                $(this).removeClass('drag-over');
                if (e.originalEvent.dataTransfer.files.length) {
                    thumbnailImage[0].files = e.originalEvent.dataTransfer.files;
                    handleThumbnailUpload();
                }
            });

            // Handle thumbnail image change
            thumbnailImage.on('change', handleThumbnailUpload);

            function handleThumbnailUpload() {
                const file = thumbnailImage[0].files[0];
                if (file) {
                    if (file.type.match('image.*')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            thumbnailPreview.attr('src', e.target.result);
                            thumbnailUploadContainer.hide();
                            thumbnailPreviewContainer.show();
                        };
                        reader.readAsDataURL(file);
                    } else {
                        alert('Please select an image file');
                        thumbnailImage.val('');
                    }
                }
            }

            // Remove thumbnail
            removeThumbnailBtn.on('click', function() {
                thumbnailImage.val('');
                thumbnailPreview.attr('src', '');
                thumbnailPreviewContainer.hide();
                thumbnailUploadContainer.show();
            });

            // Multiple images handling
            const multiImageUploadContainer = $('#multiImageUploadContainer');
            const multiImages = $('#multiImages');
            const multiImagePreviewContainer = $('#multiImagePreviewContainer');

            // Click to upload
            multiImageUploadContainer.on('click', function(e) {
                // Only trigger if the click is directly on the container (not its children)
                if (e.target === this) {
                    multiImages.trigger('click');
                }
            });

            // Drag and drop for multiple images
            multiImageUploadContainer.on('dragover', function(e) {
                e.preventDefault();
                $(this).addClass('drag-over');
            });

            multiImageUploadContainer.on('dragleave', function() {
                $(this).removeClass('drag-over');
            });

            multiImageUploadContainer.on('drop', function(e) {
                e.preventDefault();
                $(this).removeClass('drag-over');
                if (e.originalEvent.dataTransfer.files.length) {
                    multiImages[0].files = e.originalEvent.dataTransfer.files;
                    handleMultiImageUpload();
                }
            });

            // Handle multiple image change
            multiImages.on('change', handleMultiImageUpload);

            function handleMultiImageUpload() {
                const files = multiImages[0].files;
                if (files.length > 0) {
                    multiImagePreviewContainer.empty();

                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];
                        if (file.type.match('image.*')) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const previewItem = $(
                                    '<div class="gallery-preview-item">' +
                                    '<img src="' + e.target.result + '" alt="Preview">' +
                                    '<button type="button" class="remove-image" data-index="' + i +
                                    '">&times;</button>' +
                                    '</div>'
                                );
                                multiImagePreviewContainer.append(previewItem);
                            };
                            reader.readAsDataURL(file);
                        } else {
                            alert('Please select only image files');
                            multiImages.val('');
                            multiImagePreviewContainer.empty();
                            break;
                        }
                    }
                }
            }

            // Remove gallery image
            multiImagePreviewContainer.on('click', '.remove-image', function() {
                const index = $(this).data('index');
                const files = Array.from(multiImages[0].files);
                files.splice(index, 1);

                // Create new FileList (since we can't modify the original)
                const dataTransfer = new DataTransfer();
                files.forEach(file => dataTransfer.items.add(file));
                multiImages[0].files = dataTransfer.files;

                // Update preview
                handleMultiImageUpload();
            });

            // Form validation
            // $('#productForm').on('submit', function(e) {
            //     // You can add additional validation here if needed
            //     const thumbnailRequired = thumbnailImage[0].files.length === 0;
            //     if (thumbnailRequired) {
            //         e.preventDefault();
            //         alert('Please upload a thumbnail image');
            //         return false;
            //     }
            //     return true;
            // });
        });
    </script>
@endsection
