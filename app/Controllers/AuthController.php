<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key; // Đảm bảo sử dụng class Key cho JWT decode
use Config\JWT as JWTConfig;
use App\Models\UserModel;

class AuthController extends ResourceController {

    // Phương thức đăng ký người dùng mới
    public function register() {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $role = $this->request->getVar('role') ?? 'supplier';

        $userModel = new UserModel();

        // Kiểm tra xem email đã tồn tại chưa
        if ($userModel->where('email', $email)->first()) {
            return $this->respond(['status' => 'error', 'message' => 'Email đã tồn tại'], 409);
        }

        // Mã hóa mật khẩu
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Thêm người dùng vào cơ sở dữ liệu
        $userModel->insert([
            'email' => $email,
            'password' => $hashedPassword,
            'role' => $role
        ]);

        return $this->respond(['status' => 'success', 'message' => 'Đăng ký thành công'], 201);
    }

    // Phương thức đăng nhập và trả về JWT token
    public function login() {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        // Kiểm tra thông tin đăng nhập
        if ($user && password_verify($password, $user['password'])) {
            // Tạo JWT token
            $key = (new JWTConfig())->jwt_key;
            $payload = [
                'iss' => 'localhost', // Issuer
                'aud' => 'localhost', // Audience
                'iat' => time(),      // Thời gian tạo token
                'exp' => time() + 3600, // Thời gian hết hạn của token (1 giờ)
                'data' => [
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                ]
            ];

            // Mã hóa token với khóa bí mật
            $token = JWT::encode($payload, $key, 'HS256');

            return $this->respond(['status' => 'success', 'token' => $token], 200);
        } else {
            return $this->respond(['status' => 'error', 'message' => 'Thông tin đăng nhập không chính xác'], 401);
        }
    }

    public function getUserInfo() {
        $authHeader = $this->request->getHeader('Authorization');
        $token = null;

        // Kiểm tra Authorization header và lấy token
        if ($authHeader) {
            $headerValue = $authHeader->getValue();
            if (preg_match('/Bearer\s(\S+)/', $headerValue, $matches)) {
                $token = $matches[1];
            }
        }

        // Nếu không có token
        if (!$token) {
            return $this->respond(['status' => 'error', 'message' => 'Token không được cung cấp'], 401);
        }

        try {
            // Giải mã token JWT
            $key = (new JWTConfig())->jwt_key;
            $decoded = JWT::decode($token, new Key($key, 'HS256'));

            // Lấy thông tin người dùng từ payload của token
            $userData = (array) $decoded->data;

            return $this->respond(['status' => 'success', 'user' => $userData], 200);

        } catch (\Exception $e) {
            // Xử lý lỗi khi giải mã token
            return $this->respond(['status' => 'error', 'message' => 'Token không hợp lệ'], 401);
        }
    }
}