@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Thông tin thanh toán</h1>
    <form action="{{ route('orders.placeOrder') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Họ và tên:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="phone">Số điện thoại:</label>
            <input type="text" name="phone" id="phone" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="address">Địa chỉ:</label>
            <textarea name="address" id="address" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="payment_method">Phương thức thanh toán:</label>
            <select name="payment_method" id="payment_method" class="form-control" required>
                <option value="cod">Thanh toán khi nhận hàng</option>
                <option value="bank_transfer">Chuyển khoản ngân hàng</option>
            </select>
        </div>
        <h4>Tổng tiền: {{ number_format($total, 2) }} VNĐ</h4>
        <button type="submit" class="btn btn-primary">Hoàn tất đơn hàng</button>
    </form>
</div>
@endsection
