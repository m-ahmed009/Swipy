@extends('admin.layouts.app')

@section('title', 'User Management')
@section('page-title', 'User List')

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

        /* User avatar */
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

        /* DataTables customization */
        .dataTables_wrapper .dataTables_filter {
            display: none; /* Hide default DataTables search */
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_info {
            padding: 0.5rem 0;
        }

        .dataTables_wrapper .dataTables_paginate {
            padding-top: 0.5rem;
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
                        <h5 class="card-title mb-3 mb-md-0"><i class="bi bi-people-fill me-2"></i>Users</h5>
                        <div class="d-flex flex-column flex-md-row align-items-md-center gap-3">
                            <div class="search-box">
                                <i class="bi bi-search"></i>
                                <input type="text" id="customSearch" class="form-control" placeholder="Search...">
                            </div>
                            <a href="{{ route('admin.users.create') }}" class="btn btn-swippy text-light">
                                <i class="bi bi-plus-circle me-1"></i> Add User
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="usersTable" class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-2 ext-light">
                                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                                </div>
                                                {{ $user->name }}
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        @php
                                            $role = $user->getRoleNames()->first(); // Get the first assigned role
                                            $icon = '';

                                            switch ($role) {
                                                case 'admin':
                                                    $icon = 'bi-shield-lock'; // Admin icon
                                                    break;
                                                case 'manager':
                                                    $icon = 'bi-person-gear'; // Manager icon
                                                    break;
                                                case 'salesperson':
                                                    $icon = 'bi-currency-dollar'; // Sales icon
                                                    break;
                                            }
                                        @endphp

                                        <td>
                                            <span
                                                class="badge
                                    {{ $role === 'admin' ? 'bg-primary' : ($role === 'manager' ? 'bg-info' : '') }}"
                                                style="{{ $role === 'salesperson' ? 'background-color: #00ff90; color: white;' : '' }}">
                                                <i class="bi {{ $icon }} me-1"></i> {{ ucfirst($role) }}
                                            </span>
                                        </td>


                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('admin.users.show', $user->id) }}"
                                                    class="btn btn-sm btn-outline-info me-2">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                    class="btn btn-sm btn-outline-primary me-2">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Are you sure?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
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
            var table = $('#usersTable').DataTable({
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
                },
                initComplete: function() {
                    // Hide default search box
                    $('.dataTables_filter').hide();
                }
            });

            // Custom search functionality
            $('#customSearch').keyup(function(){
                table.search($(this).val()).draw();
            });

            // Style pagination buttons
            $('.dataTables_paginate .paginate_button').addClass('btn btn-sm');
            $('.dataTables_paginate .paginate_button.current').addClass('btn-primary').removeClass('btn-secondary');
        });
    </script>
@endsection
