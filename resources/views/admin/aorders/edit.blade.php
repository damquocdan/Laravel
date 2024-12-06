@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Order #{{ $order->id }}</h1>

    <form action="{{ route('admin.aorders.update', $order) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" required>
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-warning">Update Order</button>
    </form>

    <a href="{{ route('admin.aorders.index') }}" class="btn btn-primary">Back to Orders</a>
</div>
@endsection
