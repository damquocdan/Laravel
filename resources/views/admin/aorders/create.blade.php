@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Create Order</h1>

    <form action="{{ route('admin.aorders.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">User ID</label>
            <input type="number" name="user_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="total">Total</label>
            <input type="text" name="total" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" required>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
                <option value="canceled">Canceled</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Create Order</button>
    </form>
</div>
@endsection
