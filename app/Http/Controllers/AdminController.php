<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Retrieve counts for each model
        $productCount = Product::count();
        $categoryCount = Category::count();
        $userCount = User::count();
        $orderCount = Order::count();

        // Return the view with the counts
        return view('admin.dashboard', [
            'productCount' => $productCount,
            'categoryCount' => $categoryCount,
            'userCount' => $userCount,
            'orderCount' => $orderCount
        ]);
    }
    public function drawChart()
    {
        // Retrieve counts for each model
        $productCount = Product::count();
        $categoryCount = Category::count();
        $userCount = User::count();
        $orderCount = Order::count();

        // Create an image
        $width = 400;
        $height = 300;
        $image = imagecreate($width, $height);
        $backgroundColor = imagecolorallocate($image, 255, 255, 255);
        $barColor = imagecolorallocate($image, 0, 102, 204);

        // Draw bars
        $barWidth = 30;
        $barSpacing = 10;

        // Draw each bar
        $this->drawBar($image, $barColor, $productCount, 10, $barWidth);
        $this->drawBar($image, $barColor, $categoryCount, 70, $barWidth);
        $this->drawBar($image, $barColor, $userCount, 130, $barWidth);
        $this->drawBar($image, $barColor, $orderCount, 190, $barWidth);

        // Output image to browser
        header('Content-Type: image/png');
        imagepng($image);
        imagedestroy($image);
    }

    private function drawBar($image, $color, $value, $x, $width)
    {
        $height = $value * 2; // Scale height
        $y = 300 - $height; // Bottom of the image
        imagefilledrectangle($image, $x, $y, $x + $width, 300, $color);
    }
}

