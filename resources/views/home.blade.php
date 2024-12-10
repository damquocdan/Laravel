@extends('layouts.app')

@section('content')
<style>
    /* Background for the entire page */
    body {
        /* Set your background image here */
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    /* Banner Styling */
    .banner {
        position: relative;
        background-image: url('C:\xampp\htdocs\damquocdan\resources\images\26.9.2023.jpg');
        /* Set your banner image here */
        background-size: cover;
        background-position: center;
        height: 300px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .banner .overlay {
        background-color: rgba(0, 0, 0, 0.5);
        /* Add a dark overlay for better text visibility */
        padding: 20px;
        text-align: center;
        color: #fff;
        width: 100%;
    }

    .banner h1 {
        font-size: 2.5rem;
        font-weight: bold;
    }

    .banner p {
        font-size: 1.2rem;
        margin-top: 10px;
    }

    /* Card Styling */
    .product-card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
        background-color: #fff;
    }

    .product-card:hover {
        transform: scale(1.05);
    }

    .product-card img {
        height: 250px;
        object-fit: cover;
    }

    .product-card .card-body {
        text-align: center;
    }

    .product-card .card-title {
        font-size: 1.2rem;
        font-weight: bold;
    }

    .product-card .card-text {
        font-size: 1rem;
        color: #555;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    /* Product Section Styling */
    .product-section {
        margin-top: 40px;
    }
</style>
<div class="banner">
    <div class="overlay">
        <h1>Chào Mừng Bạn Đến Với Website Thương Mại Điện Tử Của Chúng Tôi</h1>
        <p>Khám phá bộ sưu tập sản phẩm và tìm kiếm những ưu đãi tốt nhất!</p>
    </div>
</div>

<div class="container product-section">
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4">
            <div class="card mb-4 product-card">
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">${{ number_format($product->price, 2) }}</p>
                    <!-- Button to trigger modal -->
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#productModal{{ $product->id }}">
                        Xem Chi Tiết
                    </button>
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary mt-2">Thêm vào giỏ</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal for Product Details -->
        <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="productModalLabel{{ $product->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="productModalLabel{{ $product->id }}">{{ $product->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid mb-3">
                        <p>{{ $product->description }}</p>
                        <p>Giá: ${{ number_format($product->price, 2) }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Thêm vào giỏ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Include Bootstrap JS (Make sure to include jQuery if not already included) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection