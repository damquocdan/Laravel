<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', auth()->id())->with('product')->get(); // Use eager loading
        $total = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

        return view('cart.index', compact('carts', 'total'));
    }

    public function add(Product $product)
    {
        // Check if the product is already in the cart
        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        // If the product is already in the cart, increase the quantity
        if ($cart) {
            $cart->update(['quantity' => $cart->quantity + 1]);
        } else {
            // If not, create a new cart entry
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    public function update(Request $request, Product $product)
    {
        // Validate the input
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Find the cart item for the authenticated user
        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->firstOrFail();

        // Update the cart quantity
        $cart->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.index')->with('success', 'Số lượng giỏ hàng đã được cập nhật thành công!');
    }


    public function remove(Product $product)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->firstOrFail();

        // Delete the cart entry
        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }
}
