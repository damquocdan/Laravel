@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Account Information</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Role:</strong> {{ $user->role }}</p>
    <a  class="btn btn-warning">Edit Account Information</a>
    <a class="btn btn-primary">Go to Cart</a>
</div>
@endsection
