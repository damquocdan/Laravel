<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    // Hiển thị thông tin tài khoản
    public function index()
    {
        $user = Auth::user(); // Lấy thông tin người dùng đã đăng nhập
        return view('account.index', compact('user'));
    }

    // Hiển thị form chỉnh sửa thông tin tài khoản
    public function edit()
    {
        $user = Auth::user(); // Lấy thông tin người dùng đã đăng nhập
        return view('account.edit', compact('user')); // Gửi thông tin người dùng tới view
    }

    // Cập nhật thông tin tài khoản
    public function update(Request $request)
    {
        $user = Auth::user(); // Lấy thông tin người dùng đã đăng nhập

        // Xác thực dữ liệu từ form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            // Thêm các trường khác nếu cần
        ]);

        // Cập nhật thông tin
        $user->update($validated);

        // Chuyển hướng về trang thông tin tài khoản với thông báo thành công
        return redirect()->route('account.index')->with('success', 'Thông tin tài khoản đã được cập nhật.');
    }
}
