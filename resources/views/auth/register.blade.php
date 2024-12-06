@extends('layouts.app')
@section('content')
<body>
    <div class="container mt-5">
        <h2 class="text-center">Đăng Ký</h2>
        <form method="POST" action="{{ route('register') }}" class="mt-4">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Họ Tên</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Nhập họ tên của bạn" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Địa chỉ Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Nhập địa chỉ email của bạn" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật Khẩu</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Xác Nhận Mật Khẩu</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100" style="background-color: #007bff; border-color: #007bff; font-size: 1.1rem;">Đăng Ký</button>
            </div>
        </form>
        <div class="mt-3 text-center">
            <p>Bạn đã có tài khoản? <a href="{{ route('login') }}" class="link-primary">Đăng nhập tại đây</a>.</p>
        </div>
        @if (session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Custom CSS for styling -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        
        .container {
            max-width: 450px;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-family: 'Helvetica Neue', sans-serif;
            font-weight: bold;
            color: #333;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
        }

        .btn-primary {
            padding: 10px;
            font-size: 1.1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .alert {
            padding: 10px;
            border-radius: 5px;
        }

        .link-primary {
            color: #007bff;
            text-decoration: none;
        }

        .link-primary:hover {
            text-decoration: underline;
        }
    </style>
</body>
@endsection
