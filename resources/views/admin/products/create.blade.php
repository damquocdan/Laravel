@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Tạo sản phẩm mới</h1>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"> <!-- Added enctype for file upload -->
        @csrf

        <div class="form-group">
            <label for="name">Tên sản phẩm:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="price">Giá:</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="quantity">Số lượng:</label> <!-- Added Quantity field -->
            <input type="number" name="quantity" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="category_id">Danh mục:</label>
            <select name="category_id" class="form-control" required>
                <option value="">Chọn một danh mục</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">Hình ảnh sản phẩm:</label> <!-- Added Image Upload field -->
            <input type="file" name="image" class="form-control" accept="image/*"> <!-- Accepts image files only -->
        </div>

        <button type="submit" class="btn btn-success">Tạo</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay lại</a> <!-- Back button -->
    </form>
</div>
@endsection
