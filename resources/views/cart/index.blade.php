@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Giỏ Hàng Của Bạn</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if($carts->isEmpty())
        <div class="alert alert-info text-center">
            Giỏ hàng của bạn đang trống.
        </div>
    @else
        <div class="cart-items row">
            @foreach($carts as $cart)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ $cart->product->image_url }}" class="card-img-top" alt="{{ $cart->product->name }}"> <!-- Display Product Image -->
                        <div class="card-body">
                            <h5 class="card-title">{{ $cart->product->name }}</h5>
                            <p class="card-text">Giá: ${{ $cart->product->price }}</p>

                            <!-- Form để cập nhật số lượng -->
                            <form action="{{ route('cart.update', $cart->product->id) }}" method="POST" class="d-flex flex-column align-items-center">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="quantity_{{ $cart->product->id }}">Số lượng:</label>
                                    <input type="number" id="quantity_{{ $cart->product->id }}" name="quantity" class="form-control" value="{{ $cart->quantity }}" min="1" style="width: 100px;">
                                </div>

                                <button type="submit" class="btn btn-primary w-100 mt-2">Cập nhật số lượng</button>
                            </form>

                            <!-- Form để xóa sản phẩm khỏi giỏ hàng -->
                            <form action="{{ route('cart.remove', $cart->product->id) }}" method="POST" class="mt-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100">Xóa khỏi giỏ hàng</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-5">
            <h3 class="text-right">Tổng Tiền: <span class="text-success">${{ $total }}</span></h3>
        </div>

        <!-- Payment Options Section -->
        <div class="payment-options mt-4">
            <h2 class="text-center">Phương Thức Thanh Toán</h2>
            <form action="{{ route('checkout.placeOrder') }}" method="POST" class="mt-3">
                @csrf
                <div class="form-group">
                    <label for="payment_method">Chọn phương thức thanh toán:</label>
                    <select id="payment_method" name="payment_method" class="form-control" required>
                        <option value="cod">Thanh toán khi nhận hàng</option>
                        <option value="bank_transfer">Chuyển khoản ngân hàng</option>
                    </select>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success btn-lg">Tiến Hành Thanh Toán</button>
                </div>
            </form>
        </div>
    @endif
</div>

<!-- Custom CSS to style the page -->
<style>
    .container {
        max-width: 900px;
    }

    .cart-items {
        display: flex;
        flex-wrap: wrap;
    }

    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    .btn-success {
        font-size: 1.2rem;
        padding: 10px 20px;
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    h1,
    h2,
    h3 {
        font-family: 'Helvetica Neue', sans-serif;
    }

    h1 {
        font-weight: bold;
        color: #333;
    }

    h3 {
        font-weight: normal;
    }

    label {
        font-weight: bold;
    }

    .text-success {
        font-weight: bold;
        font-size: 1.5rem;
    }
</style>
@endsection
