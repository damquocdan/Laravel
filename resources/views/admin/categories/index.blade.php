@extends('layouts.admin')
@section('content')
<style>
    .container {
        max-width: 800px;
        /* Giới hạn chiều rộng để không quá rộng */
        margin: 0 auto;
        /* Căn giữa */
    }

    h1 {
        font-size: 2rem;
        /* Kích thước tiêu đề lớn hơn */
        color: #333;
        /* Màu chữ tối hơn */
    }

    .list-group-item {
        transition: background-color 0.3s;
        /* Hiệu ứng chuyển tiếp */
    }

    .list-group-item:hover {
        background-color: #f8f9fa;
        /* Đổi màu khi hover */
    }

    .btn-primary {
        background-color: #007bff;
        /* Màu sắc nút chính */
        border-color: #007bff;
        /* Đường viền nút chính */
    }

    .btn-warning {
        background-color: #ffc107;
        /* Màu sắc nút sửa */
        border-color: #ffc107;
        /* Đường viền nút sửa */
    }

    .btn-danger {
        background-color: #dc3545;
        /* Màu sắc nút xóa */
        border-color: #dc3545;
        /* Đường viền nút xóa */
    }

    .alert-success {
        background-color: #d4edda;
        /* Màu nền thông báo thành công */
        border-color: #c3e6cb;
        /* Đường viền thông báo thành công */
        color: #155724;
        /* Màu chữ thông báo thành công */
    }
</style>
<div class="container mt-4">
    <h1>Categories</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Create New Category</a>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <ul class="list-group">
        @foreach($categories as $category)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ $category->name }}
            <div>
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">Delete</button>
                </form>
            </div>
        </li>
        @endforeach
    </ul>
</div>

@endsection