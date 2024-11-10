<?php

namespace App\Controllers;

class UserController extends BaseController
{
    // Trang đăng nhập
    public function login()
    {
        return view('login', ['title' => 'Login']);
    }
    
    public function logout()
    {
        // Hủy session của người dùng
        session()->destroy();

        // Chuyển hướng đến trang đăng nhập hoặc trang chủ
        return redirect()->to('/login')->with('success', 'You have been logged out successfully.');
    }

    // Xử lý đăng nhập (dummy)
    public function authenticate()
    {
        // Lấy thông tin từ form
        $role = $this->request->getPost('role');

        // Chuyển hướng đến trang thích hợp dựa trên vai trò
        if ($role == 'contractor') {
            return redirect()->to('/tender/list_contractor');
        } elseif ($role == 'supplier') {
            return redirect()->to('/tender/list_supplier');
        } else {
            return redirect()->back()->with('error', 'Invalid role selected');
        }
    }
}
