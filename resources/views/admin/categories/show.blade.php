@extends('admin.layouts.app')

@section('title', 'Category Details')
@section('page-title', 'Category Information')

@section('css')
    <style>
        .detail-wrapper {
            display: flex;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .detail-card {
            background: #fff;
            border-radius: 1rem;
            padding: 2rem 2.5rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
            width: 62rem;
            max-width: 62rem;
        }

        .detail-header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
        }

        .detail-header img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 0.5rem;
            margin-right: 1.5rem;
            border: 2px solid #e2e8f0;
        }

        .detail-header h4 {
            margin-bottom: 0.5rem;
        }

        .badge-status {
            padding: 0.4rem 0.9rem;
            border-radius: 1rem;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .badge-active {
            background-color: #10b981;
            color: white;
        }

        .badge-inactive {
            background-color: #9ca3af;
            color: white;
        }

        .detail-info {
            line-height: 1.8;
            padding-left: 1rem;
        }

        .detail-info p {
            margin: 0.6rem 0;
        }

        .detail-info strong {
            display: inline-block;
            width: 140px;
            color: #475569;
        }

        .back-btn {
            margin-top: 2rem;
        }

        .title {
            font-weight: 700;
            width: 140px;
            color: #475569
        }

        @media (max-width: 768px) {
            .detail-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .detail-header img {
                margin-bottom: 1rem;
                margin-right: 0;
            }

            .detail-info {
                padding-left: 0;
            }
        }
    </style>
@endsection

@section('content')
    <div class="admin-main">
        <div class="admin-content detail-wrapper">
            <div class="detail-card">
                <div class="detail-header">
                    <img src="{{ $category->image && file_exists(public_path($category->image)) ? asset($category->image) : asset('assets/images/test.jpg') }}"
                        alt="Category Image">
                    <div>
                        <h4>{{ $category->name }}</h4>
                        <span class="badge-status {{ $category->is_active ? 'badge-active' : 'badge-inactive' }}">
                            {{ ucfirst($category->is_active ? 'Active' : 'Inactive') }}
                        </span>
                    </div>
                </div>

                <div class="detail-info container">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p><span class="title">ID:</span> {{ $category->id }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><span class="title">Name:</span> {{ ucfirst($category->name) }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p>
                                <span class="title">Status:</span>
                                <span class="badge-status {{ $category->is_active ? 'badge-active' : 'badge-inactive' }}">
                                    {{ ucfirst($category->is_active ? 'active' : 'inactive') }}
                                </span>
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <p><span class="title">Created At:</span> {{ $category->created_at->format('d M Y, h:i A') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><span class="title">Last Updated:</span> {{ $category->updated_at->format('d M Y, h:i A') }}</p>
                        </div>
                    </div>
                </div>


                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary back-btn">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>
@endsection
