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
        session()->destroy();

        return redirect()->to('/login')->with('success', 'You have been logged out successfully.');
    }

    // Xử lý đăng nhập (dummy)
    public function authenticate()
    {

        $role = $this->request->getPost('role');

        if ($role == 'contractor') {
            return redirect()->to('/tender/list_contractor');
        } elseif ($role == 'supplier') {
            return redirect()->to('/tender/list_supplier');
        } else {
            return redirect()->back()->with('error', 'Invalid role selected');
        }
    }
}
