@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="my-4">Chi tiết sản phẩm</h1>

    <div class="card shadow">
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text"><strong>Giá:</strong> {{ number_format($product->price, 2) }} VNĐ</p>
            <p class="card-text"><strong>Mô tả:</strong> {{ $product->description }}</p>
            <p class="card-text"><strong>Danh mục:</strong> {{ $product->category->name ?? 'N/A' }}</p>
            <div class="mb-3">
                <strong>Hình ảnh:</strong>
                @if ($product->image)
                    <div class="text-center">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded" style="max-width: 300px; height: auto;">
                    </div>
                @else
                    <p class="text-muted">Không có hình ảnh.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Quay lại danh sách sản phẩm</a>
    </div>
</div>
@endsection
