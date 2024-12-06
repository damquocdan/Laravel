@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Create Category</h1>
    
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Category Name" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
