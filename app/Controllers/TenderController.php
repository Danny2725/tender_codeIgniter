<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Config\JWT as JWTConfig;
use App\Models\TenderModel;
use App\Models\InviteModel;

class TenderController extends ResourceController {

    // Phương thức để tạo tender mới
    public function createTender() {
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

            // Lấy ID người dùng từ payload của token
            $userId = $decoded->data->id;

            // Lấy dữ liệu từ request
            $title = $this->request->getVar('title');
            $description = $this->request->getVar('description');
            $visibility = $this->request->getVar('visibility') ?? 'public';
            $invitedSuppliers = $this->request->getVar('invited_suppliers'); // Danh sách email nhà cung cấp

            // Kiểm tra tính hợp lệ của dữ liệu
            if (empty($title) || empty($description)) {
                return $this->respond(['status' => 'error', 'message' => 'Tiêu đề và mô tả là bắt buộc'], 400);
            }

            // Tạo tender mới trong bảng `tenders`
            $tenderModel = new TenderModel();
            $tenderId = $tenderModel->insert([
                'title' => $title,
                'description' => $description,
                'visibility' => $visibility,
                'creator_id' => $userId
            ]);

            // Nếu là tender riêng tư, lưu thông tin các nhà cung cấp được mời vào bảng `invites`
            if ($visibility === 'private' && !empty($invitedSuppliers)) {
                $inviteModel = new InviteModel();
                foreach ($invitedSuppliers as $email) {
                    $inviteModel->insert([
                        'tender_id' => $tenderId,
                        'supplier_email' => $email
                    ]);
                }
            }

            return $this->respond(['status' => 'success', 'message' => 'Tender đã được tạo thành công'], 201);

        } catch (\Exception $e) {
            // Xử lý lỗi khi giải mã token
            return $this->respond(['status' => 'error', 'message' => 'Token không hợp lệ'], 401);
        }
    }



    public function getTenders() {
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

            // Lấy thông tin người dùng từ token
            $userId = $decoded->data->id;
            $userRole = $decoded->data->role;
            $userEmail = $decoded->data->email;

            $tenderModel = new TenderModel();

            if ($userRole === 'contractor') {
                // Contractor: lấy tất cả các tender do họ tạo
                $tenders = $tenderModel->where('creator_id', $userId)->findAll();
            } else if ($userRole === 'supplier') {
                // Supplier: lấy các tender công khai hoặc các tender riêng tư mà họ được mời
                $inviteModel = new InviteModel();
                $invites = $inviteModel->where('supplier_email', $userEmail)->findAll();
                $invitedTenderIds = array_column($invites, 'tender_id');

                // Lấy tất cả các tender công khai hoặc tender riêng tư mà họ được mời
                $tenders = $tenderModel
                    ->groupStart()
                        ->where('visibility', 'public')
                        ->orWhereIn('id', $invitedTenderIds)
                    ->groupEnd()
                    ->findAll();
            }

            return $this->respond(['status' => 'success', 'data' => $tenders], 200);

        } catch (\Exception $e) {
            // Xử lý lỗi khi giải mã token
            return $this->respond(['status' => 'error', 'message' => 'Token không hợp lệ'], 401);
        }
    }
}