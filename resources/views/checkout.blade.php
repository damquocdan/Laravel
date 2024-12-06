@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checkout</h1>

    @if($carts->isEmpty())
        <p>Your cart is empty.</p>
    @else
        <div class="cart-items">
            @foreach($carts as $cart)
                <div class="cart-item">
                    <h5>{{ $cart->product->name }}</h5>
                    <p>Price: ${{ $cart->product->price }}</p>
                    <p>Quantity: {{ $cart->quantity }}</p>
                </div>
            @endforeach
        </div>
        <h3>Total Amount: ${{ $total }}</h3>

        <form action="{{ route('checkout.placeOrder') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="payment_method">Payment Method:</label>
                <select name="payment_method" id="payment_method" required>
                    <option value="cod">Cash on Delivery</option>
                    <option value="bank_transfer">Bank Transfer</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Place Order</button>
        </form>
    @endif
</div>
@endsection
