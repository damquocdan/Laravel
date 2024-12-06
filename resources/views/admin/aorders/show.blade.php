@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Chi Tiết Đơn Hàng</h1>
    
    <div class="card mb-4">
        <div class="card-body">
            <h3 class="card-title">Mã Đơn Hàng: <span class="text-muted">{{ $order->id }}</span></h3>
            <p><strong>ID Người Dùng:</strong> {{ $order->user_id }}</p>
            <p><strong>Tổng Tiền:</strong> ${{ number_format($order->total, 2) }}</p>
            <p>
                <strong>Trạng Thái:</strong>
                <span class="badge {{ $order->status == 'completed' ? 'bg-success' : ($order->status == 'canceled' ? 'bg-danger' : 'bg-warning') }}">
                    {{ ucfirst($order->status) == 'Completed' ? 'Hoàn Thành' : (ucfirst($order->status) == 'Canceled' ? 'Đã Hủy' : 'Đang Chờ') }}
                </span>
            </p>
        </div>
    </div>

    <h3 class="mb-3">Sản Phẩm Trong Đơn Hàng</h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Mã Sản Phẩm</th>
                    <th>Số Lượng</th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product_id }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('admin.aorders.index') }}" class="btn btn-primary">Quay Về Danh Sách Đơn Hàng</a>
</div>

<style>
    .card {
        border-radius: 0.5rem;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .table th {
        background-color: #f8f9fa;
        color: #343a40;
    }

    .table td {
        vertical-align: middle;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
</style>
@endsection
