@foreach ($products as $product)
    <div class="product">
        <h2>{{ $product->name }}</h2>
        <p>Price: {{ $product->price }}</p>
        <form action="{{ route('cart.add', $product->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Add to Cart</button>
        </form>
    </div>
@endforeach
