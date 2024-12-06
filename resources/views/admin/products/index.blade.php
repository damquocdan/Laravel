@extends('layouts.admin')

@section('content')
<style>
    /* Container Styles */
    .container {
        background-color: #ffffff;
        /* White background for the main content */
        border-radius: 8px;
        /* Rounded corners for the container */
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        /* Subtle shadow for depth */
        padding: 20px;
    }

    /* Headings */
    h1 {
        font-size: 24px;
        color: #343a40;
        /* Dark color for the heading */
        margin-bottom: 20px;
        /* Spacing below the heading */
    }

    /* Alert Styles */
    .alert {
        margin-bottom: 20px;
        /* Spacing below the alert */
    }

    /* Button Styles */
    .btn {
        border-radius: 5px;
        /* Rounded corners for buttons */
    }

    .btn-primary {
        background-color: #007bff;
        /* Primary button color */
        border-color: #007bff;
        /* Primary button border color */
    }

    .btn-primary:hover {
        background-color: #0056b3;
        /* Darker blue on hover */
        border-color: #0056b3;
        /* Darker border on hover */
    }

    .btn-info {
        background-color: #17a2b8;
        /* Info button color */
        border-color: #17a2b8;
        /* Info button border color */
    }

    .btn-warning {
        background-color: #ffc107;
        /* Warning button color */
        border-color: #ffc107;
        /* Warning button border color */
    }

    .btn-danger {
        background-color: #dc3545;
        /* Danger button color */
        border-color: #dc3545;
        /* Danger button border color */
    }

    /* Table Styles */
    .table {
        width: 100%;
        /* Full width table */
        border-collapse: collapse;
        /* Collapse borders for cleaner look */
    }

    .table-bordered {
        border: 1px solid #dee2e6;
        /* Border color for the table */
    }

    .table th,
    .table td {
        padding: 10px;
        /* Padding inside table cells */
        text-align: left;
        /* Left align text */
        vertical-align: middle;
        /* Center content vertically */
    }

    .table th {
        background-color: #e9ecef;
        /* Light gray for header */
        color: #495057;
        /* Dark gray for header text */
    }

    /* Image Styles */
    .table img {
        border-radius: 4px;
        /* Rounded corners for images */
    }

    /* Responsive Styles */
    @media (max-width: 768px) {

        /* Adjust table for small screens */
        .table-responsive {
            overflow-x: auto;
            /* Allow horizontal scrolling */
        }

        .table {
            display: block;
            /* Change display to block for responsiveness */
            width: 100%;
            /* Full width for mobile */
        }

        .btn {
            margin-bottom: 10px;
            /* Space between buttons in mobile view */
            width: 100%;
            /* Full width buttons */
        }
    }
</style>
<div class="container">
    <h1>Quản lý sản phẩm</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Tạo sản phẩm mới</a>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Mô tả</th>
                <th>Danh mục</th> <!-- Cột mới cho Danh mục -->
                <th>Hình ảnh</th> <!-- Cột mới cho Hình ảnh -->
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ number_format($product->price, 2) }} VNĐ</td> <!-- Hiển thị giá theo định dạng VNĐ -->
                <td>{{ $product->description }}</td>
                <td>{{ $product->category->name ?? 'N/A' }}</td> <!-- Hiển thị tên danh mục -->
                <td>
                    @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 50px; height: auto;">
                    @else
                    N/A
                    @endif
                </td>

                <td>
                    <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-info">Xem</a>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">Chỉnh sửa</a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection