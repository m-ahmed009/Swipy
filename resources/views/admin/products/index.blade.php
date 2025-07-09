@extends('admin.layouts.app')

@section('title', ' Swippy - Products Management')
@section('page-title', ' Products List')

@section('css')
    <style>
        /* Admin Layout Structure */
        .admin-body {
            background-color: #f1f5f9;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        .admin-main {
            flex: 1;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .admin-content {
            width: 100%;
            height: 100%;
        }

        /* Full-width card */
        .card-glass {
            width: 100%;
            margin: 0;
            border-radius: 0.75rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        /* Search box */
        .search-box {
            position: relative;
            width: 250px;
        }

        .search-box input {
            padding-left: 2.5rem;
            border-radius: 0.5rem;
            border: 1px solid #e2e8f0;
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
        }

        /* product avatar */
        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: var(--swippy-primary);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.75rem;
        }

        /* Badge styles */
        .badge-main {
            background-color: #3b82f6;
            color: white;
        }

        .badge-sub {
            background-color: #10b981;
            color: white;
        }

        /* DataTables customization */
        .dataTables_wrapper .dataTables_filter {
            display: none;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_info {
            padding: 0.5rem 0;
        }

        .dataTables_wrapper .dataTables_paginate {
            padding-top: 0.5rem;
        }

        /* Toggle button animations */
        .btn-sm {
            transition: all 0.2s ease;
        }

        /* Status indicator */
        .status-badge {
            font-size: 0.75rem;
            padding: 0.25em 0.4em;
        }

        /* Loading spinner */
        .spinner-border-sm {
            width: 0.8rem;
            height: 0.8rem;
            border-width: 0.15em;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .admin-main {
                margin-left: 0;
                width: 100%;
                padding: 1rem;
            }

            .search-box {
                width: 200px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="admin-main">
        <div class="admin-content">
            <div class="card card-glass">
                <div class="card-body" style="width: 72vw">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
                        <h5 class="card-title mb-3 mb-md-0"><i class="bi bi-tags-fill me-2"></i>Products</h5>
                        <div class="d-flex flex-column flex-md-row align-items-md-center gap-3">
                            <div class="search-box">
                                <i class="bi bi-search"></i>
                                <input type="text" id="customSearch" class="form-control" placeholder="Search...">
                            </div>
                            <a href="{{ route('admin.products.create') }}" class="btn btn-swippy text-light">
                                <i class="bi bi-plus-circle me-1"></i> Add Products
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="categoriesTable" class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Sku #</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->sku }}</td>
                                        <td>
                                            @if ($product->thumbnail && file_exists(public_path($product->thumbnail)))
                                                <img src="{{ asset($product->thumbnail) }}" alt="product Image"
                                                    style="width: 60px; height: 60px; border-radius: 5px; object-fit: cover;">
                                            @else
                                                <img src="{{ asset('assets/images/test.jpg') }}" alt="Default product Image"
                                                    style="width: 40px; height: 40px; border-radius: 5px; object-fit: cover;">
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-2">
                                                    {{ strtoupper(substr($product->name, 0, 2)) }}
                                                </div>
                                                {{ $product->name ? ucfirst($product->name) : '' }}
                                            </div>
                                        </td>
                                        <td>
                                            @if ($product->quantity < 5)
                                                {{ $product->quantity }} <span
                                                    style="color: red; font-size: 10px; font-weight: 600;"> ( Low Stock
                                                    )</span>
                                            @else
                                                {{ $product->quantity }}
                                            @endif
                                        </td>
                                        <td>{{ $product->price ?? '' }}</td>
                                        <td>
                                            <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-nowrap align-items-center gap-1">
                                                <!-- Active Toggle Button with Tooltip -->
                                                <button type="button"
                                                    class="status-toggle btn btn-sm {{ $product->is_active ? 'btn-success' : 'btn-outline-secondary' }} px-2 py-1"
                                                    data-id="{{ $product->id }}" data-status="{{ $product->is_active }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="{{ $product->is_active ? 'Inactive' : 'Active' }}">
                                                    <i class="bi bi-power"></i>
                                                    <span
                                                        class="visually-hidden">{{ $product->is_active ? 'Active' : 'Inactive' }}</span>
                                                </button>

                                                <!-- Featured Toggle Button with Tooltip -->
                                                <button type="button"
                                                    class="featured-toggle btn btn-sm {{ $product->is_featured ? 'btn-primary' : 'btn-outline-secondary' }} px-2 py-1"
                                                    data-id="{{ $product->id }}"
                                                    data-featured="{{ $product->is_featured }}" data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="{{ $product->is_featured ? 'Remove Featured' : 'Mark as Featured' }}">
                                                    <i class="bi bi-star{{ $product->is_featured ? '-fill' : '' }}"></i>
                                                    <span
                                                        class="visually-hidden">{{ $product->is_featured ? 'Featured' : 'Not Featured' }}</span>
                                                </button>

                                                <!-- Action Buttons -->
                                                <div class="d-flex gap-1">
                                                    <a href="{{ route('admin.products.show', $product->id) }}"
                                                        class="btn btn-sm btn-outline-info px-2 py-1">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                                        class="btn btn-sm btn-outline-primary px-2 py-1">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-danger px-2 py-1"
                                                            onclick="return confirm('Are you sure?')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
    // Initialize DataTable
    const table = $('#categoriesTable').DataTable({
        responsive: true,
        dom: '<"d-flex flex-column flex-md-row justify-content-between"<"mb-3"l><"mb-3"f>><"table-responsive"t><"d-flex flex-column flex-md-row justify-content-between align-items-center"ip>',
        language: {
            search: "",
            searchPlaceholder: "Search...",
            lengthMenu: "_MENU_ records per page",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            infoEmpty: "No entries found",
            infoFiltered: "(filtered from _MAX_ total entries)",
            paginate: {
                first: '<i class="bi bi-chevron-double-left"></i>',
                previous: '<i class="bi bi-chevron-left"></i>',
                next: '<i class="bi bi-chevron-right"></i>',
                last: '<i class="bi bi-chevron-double-right"></i>'
            }
        }
    });

    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip({
        trigger: 'hover'
    });

    // Custom search
    $('#customSearch').keyup(function() {
        table.search($(this).val()).draw();
    });

    // Handle Active Status Toggle
    $(document).on('click', '.status-toggle', function() {
        const button = $(this);
        const productId = button.data('id');
        const currentStatus = button.data('status');
        const newStatus = currentStatus ? 0 : 1;
        const row = button.closest('tr');

        // Show loading state
        button.html('<span class="spinner-border spinner-border-sm"></span>');
        button.prop('disabled', true);

        $.ajax({
            url: `/admin/products/${productId}/toggle-status`,
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                is_active: newStatus
            },
            success: function(response) {
                // Update button appearance
                button.toggleClass('btn-success btn-outline-secondary');
                button.data('status', newStatus);
                button.attr('title', newStatus ? 'Deactivate' : 'Activate');
                button.find('.visually-hidden').text(newStatus ? 'Active' : 'Inactive');

                // Update status badge in the table
                row.find('.badge')
                    .toggleClass('bg-success bg-secondary')
                    .text(newStatus ? 'Active' : 'Inactive');

                // Refresh tooltip
                button.tooltip('dispose').tooltip({
                    trigger: 'hover'
                });

                showToast('Status updated', 'success');
            },
            error: function() {
                showToast('Error updating status', 'error');
            },
            complete: function() {
                button.html('<i class="bi bi-power"></i>');
                button.prop('disabled', false);
            }
        });
    });

    // Handle Featured Status Toggle
    $(document).on('click', '.featured-toggle', function() {
        const button = $(this);
        const productId = button.data('id');
        const currentFeatured = button.data('featured');
        const newFeatured = currentFeatured ? 0 : 1;

        // Show loading state
        button.html('<span class="spinner-border spinner-border-sm"></span>');
        button.prop('disabled', true);

        $.ajax({
            url: `/admin/products/${productId}/toggle-featured`,
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                is_featured: newFeatured
            },
            success: function(response) {
                // Update button appearance
                button.toggleClass('btn-primary btn-outline-secondary');
                button.find('i').toggleClass('bi-star bi-star-fill');
                button.data('featured', newFeatured);
                button.attr('title', newFeatured ? 'Remove Featured' : 'Mark as Featured');
                button.find('.visually-hidden').text(newFeatured ? 'Featured' : 'Not Featured');

                // Refresh tooltip
                button.tooltip('dispose').tooltip({
                    trigger: 'hover'
                });

                showToast('Featured status updated', 'success');
            },
            error: function() {
                showToast('Error updating featured status', 'error');
            },
            complete: function() {
                button.html(`<i class="bi bi-star${newFeatured ? '-fill' : ''}"></i>`);
                button.prop('disabled', false);
            }
        });
    });

    // Toast notification function
    function showToast(message, type) {
        const bgColor = type === 'success' ? '#10b981' : '#ef4444';
        Toastify({
            text: message,
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: bgColor,
        }).showToast();
    }
});
</script>
@endsection
