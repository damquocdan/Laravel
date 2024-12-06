@extends('layouts.admin')

@section('content')
<style>
    .container {
        max-width: 900px;
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

    .table {
        background-color: #fff;
        /* Màu nền bảng trắng */
        border-radius: 0.5rem;
        /* Bo tròn góc bảng */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Hiệu ứng bóng */
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
        /* Màu nền cho các hàng lẻ */
    }

    .table th {
        background-color: #007bff;
        /* Màu nền tiêu đề bảng */
        color: white;
        /* Màu chữ tiêu đề bảng */
    }

    .table td {
        vertical-align: middle;
        /* Căn giữa nội dung */
    }

    .btn-primary {
        background-color: #007bff;
        /* Màu sắc nút chính */
        border-color: #007bff;
        /* Đường viền nút chính */
    }

    .btn-info {
        background-color: #17a2b8;
        /* Màu sắc nút xem */
        border-color: #17a2b8;
        /* Đường viền nút xem */
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
    <h1>Quản lý Người dùng</h1>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Tạo Người dùng Mới</a>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info">Xem</a>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">Sửa</a>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?');">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection