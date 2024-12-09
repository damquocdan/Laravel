@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Thông tin tài khoản</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <a href="{{ route('account.edit') }}" class="btn btn-warning">Sửa thông tin</a>
    <a href="{{ url()->previous() }}" class="btn btn-primary">Quay lại</a>

</div>
@endsection
