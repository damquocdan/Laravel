<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AOrderController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



// Route yêu cầu middleware admin
Route::middleware(['admin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // Categories management
    Route::get('admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('admin/categories/{category}', [CategoryController::class, 'show'])->name('admin.categories.show');
    Route::get('admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // Products management
    Route::get('admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('admin/products/{product}', [ProductController::class, 'show'])->name('admin.products.show');
    Route::get('admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('admin/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    Route::get('admin/users', [UserController::class, 'index'])->name('admin.users.index'); // List users
    Route::get('admin/users/create', [UserController::class, 'create'])->name('admin.users.create'); // Create user form
    Route::post('admin/users', [UserController::class, 'store'])->name('admin.users.store'); // Store user
    Route::get('admin/users/{user}', [UserController::class, 'show'])->name('admin.users.show'); // Show user details
    Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit'); // Edit user form
    Route::put('admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update'); // Update user
    Route::delete('admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy'); // Delete user

    Route::get('admin/aorders', [AOrderController::class, 'index'])->name('admin.aorders.index'); // List all orders
    Route::get('admin/aorders/create', [AOrderController::class, 'create'])->name('admin.aorders.create'); // Show form to create an order
    Route::post('admin/aorders', [AOrderController::class, 'store'])->name('admin.aorders.store'); // Store a new order
    Route::get('admin/aorders/{order}', [AOrderController::class, 'show'])->name('admin.aorders.show'); // Show a specific order
    Route::get('admin/aorders/{order}/edit', [AOrderController::class, 'edit'])->name('admin.aorders.edit'); // Show form to edit an order
    Route::put('admin/aorders/{order}', [AOrderController::class, 'update'])->name('admin.aorders.update'); // Update an order
    Route::delete('admin/aorders/{order}', [AOrderController::class, 'destroy'])->name('admin.aorders.destroy'); // Delete an order

    Route::get('/admin/draw-chart', [AdminController::class, 'drawChart'])->name('admin.drawChart');
    Route::patch('/admin/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('admin.aorders.updateStatus');

});

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');

    // Route for removing a product from the cart
    Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');


    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('checkout.placeOrder');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/account', [AccountController::class, 'index'])->name('account.index');
    Route::get('/account/edit', [AccountController::class, 'edit'])->name('account.edit');
    
    
});
