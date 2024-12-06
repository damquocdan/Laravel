<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->with('items.product')->get();
        return view('orders.index', compact('orders'));
    }

    public function checkout()
    {
        $carts = Cart::where('user_id', auth()->id())->get();
        $total = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

        return view('checkout', compact('carts', 'total'));
    }

    public function placeOrder(Request $request)
    {
        // Validate the request
        $request->validate([
            'payment_method' => 'required|in:cod,bank_transfer',
        ]);

        // Get the authenticated user
        $user = auth()->user();

        // Fetch the user's cart items
        $carts = Cart::where('user_id', $user->id)->get();

        // Calculate total amount
        $totalAmount = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

        // Create the order
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $totalAmount,
            'status' => 'pending', // Set initial status
        ]);

        // Create order items
        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price,
            ]);
        }

        // Clear the cart after placing the order
        Cart::where('user_id', $user->id)->delete();

        // Redirect to a success page or display a success message
        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }
}
