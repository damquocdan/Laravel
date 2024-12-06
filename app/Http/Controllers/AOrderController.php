<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem; // Make sure to include this model
use Illuminate\Http\Request;

class AOrderController extends Controller
{
    // Display a list of all orders
    public function index()
    {
        $orders = Order::with('items.product')->get(); // Fetch all orders with related items
        return view('admin.aorders.index', compact('orders'));
    }

    // Show the form for creating a new order
    public function create()
    {
        // For creating orders manually; usually not needed if users place orders directly.
        return view('admin.aorders.create');
    }

    // Store a newly created order in the database
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total' => 'required|numeric',
            'status' => 'required|string|in:pending,completed,canceled', // Restrict status values
            'items' => 'required|array', // Ensure items are present
            'items.*.product_id' => 'required|exists:products,id', // Validate each product ID
            'items.*.quantity' => 'required|integer|min:1', // Validate quantity
            'items.*.price' => 'required|numeric|min:0', // Validate price
        ]);

        // Create a new order
        $order = Order::create([
            'user_id' => $request->user_id,
            'total' => $request->total,
            'status' => $request->status,
        ]);

        // Create order items
        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        return redirect()->route('admin.aorders.index')->with('success', 'Order created successfully!');
    }

    // Display a specific order's details
    public function show(Order $order)
    {
        $order->load('items.product'); // Eager load items with their products
        return view('admin.aorders.show', compact('order'));
    }

    // Show the form for editing an existing order
    public function edit(Order $order)
    {
        $order->load('items.product'); // Eager load items with their products
        return view('admin.aorders.edit', compact('order'));
    }

    // Update the specified order in the database
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|in:pending,completed,canceled', // Restrict status values
        ]);

        // Update order status
        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.aorders.index')->with('success', 'Order updated successfully!');
    }

    // Remove the specified order from the database
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('admin.aorders.index')->with('success', 'Order deleted successfully!');
    }
}
