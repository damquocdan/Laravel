<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CProductController extends Controller
{
    public function index()
    {
        // Retrieve all products
        $products = Product::all();
        return view('home');
    }
}
