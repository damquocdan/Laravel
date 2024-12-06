@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Đơn Hàng Của Bạn</h1>

    @if($orders->isEmpty())
        <p>Bạn chưa có đơn hàng nào.</p>
    @else
        <div class="order-list mt-4">
            @foreach($orders as $order)
                <div class="order card mb-3 p-3">
                    <h5 class="order-id">Mã Đơn Hàng: {{ $order->id }}</h5>
                    <p class="total-amount">Tổng Số Tiền: <span class="text-success">${{ $order->total }}</span></p>
                    <p class="status">Trạng Thái: <span class="{{ $order->status == 'completed' ? 'text-success' : ($order->status == 'pending' ? 'text-warning' : 'text-danger') }}">{{ ucfirst($order->status) }}</span></p>
                    <h6>Sản Phẩm:</h6>
                    <ul class="item-list">
                        @foreach($order->items as $item)
                            <li class="item">
                                {{ $item->product->name }} - Số Lượng: {{ $item->quantity }} - Giá: <span class="text-success">${{ $item->price }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Custom CSS to style the order list -->
<style>
    .order-list {
        padding: 15px;
        background-color: #f8f9fa; /* Light background for better readability */
        border-radius: 8px; /* Rounded corners */
    }

    .order {
        background-color: #fff; /* White background for individual orders */
        border: 1px solid #dee2e6; /* Border color */
        border-radius: 5px; /* Rounded corners for orders */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    }

    .order-id {
        font-weight: bold;
    }

    .total-amount {
        font-size: 1.2rem;
        font-weight: bold;
    }

    .status {
        font-weight: bold;
    }

    .item-list {
        list-style-type: none; /* Remove default list styling */
        padding-left: 0; /* Remove left padding */
    }

    .item {
        padding: 5px 0; /* Space between items */
        border-bottom: 1px solid #e9ecef; /* Bottom border for items */
    }

    .item:last-child {
        border-bottom: none; /* Remove border from last item */
    }

    .text-success {
        color: #28a745; /* Green color for success messages */
    }

    .text-warning {
        color: #ffc107; /* Yellow color for pending status */
    }

    .text-danger {
        color: #dc3545; /* Red color for failed status */
    }
</style>
@endsection
