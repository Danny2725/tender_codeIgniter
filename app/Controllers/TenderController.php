<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Config\JWT as JWTConfig;
use App\Models\TenderModel;
use App\Models\InviteModel;

class TenderController extends ResourceController {

    protected $tenderModel;
    public function __construct()
    {
        // Khởi tạo model TenderModel để lấy dữ liệu mẫu
        $this->tenderModel = new TenderModel();
    }

    public function create()
    {
        return view('tender/create', ['title' => 'Create Tender']);
    }


    public function createTender() {
        $authHeader = $this->request->getHeader('Authorization');
        $token = null;
    
        if ($authHeader) {
            $headerValue = $authHeader->getValue();
            if (preg_match('/Bearer\s(\S+)/', $headerValue, $matches)) {
                $token = $matches[1];
            }
        }
    
        if (!$token) {
            return $this->respond(['status' => 'error', 'message' => 'Token không được cung cấp'], 401);
        }
    
        try {
            $key = (new JWTConfig())->jwt_key;
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
    
            $userId = $decoded->data->id;
    
            $title = $this->request->getVar('title');
            $description = $this->request->getVar('description');
            $visibility = $this->request->getVar('visibility') ?? 'public';
            $invitedSuppliers = $this->request->getVar('invited_suppliers'); 
    
            // Kiểm tra các trường bắt buộc
            if (empty($title) || empty($description)) {
                return $this->respond(['status' => 'error', 'message' => 'Tiêu đề và mô tả là bắt buộc'], 400);
            }
    
            // Lưu tender vào bảng tenders
            $tenderModel = new TenderModel();
            $tenderId = $tenderModel->insert([
                'title' => $title,
                'description' => $description,
                'visibility' => $visibility,
                'creator_id' => $userId
            ]);
    
            // Lưu tất cả các invited_suppliers vào bảng invites, không phụ thuộc vào visibility
            if (!empty($invitedSuppliers) && is_array($invitedSuppliers)) {
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
            return $this->respond(['status' => 'error', 'message' => 'Token không hợp lệ'], 401);
        }
    }

        public function listContractor()
        {
            // Lấy token từ cookie hoặc header
            $authHeader = $this->request->getHeader('Authorization');
            $token = null;
            if ($authHeader) {
                $headerValue = $authHeader->getValue();
                if (preg_match('/Bearer\s(\S+)/', $headerValue, $matches)) {
                    $token = $matches[1];
                }
            } elseif ($this->request->getCookie('token')) {
                $token = $this->request->getCookie('token');
            }
        
            if (!$token) {
                return redirect()->to('/login')->with('error', 'Bạn cần đăng nhập.');
            }
        
            try {
                // Giải mã token để lấy ID người dùng
                $key = (new JWTConfig())->jwt_key;
                $decoded = JWT::decode($token, new Key($key, 'HS256'));
                $userId = $decoded->data->id;
        
                // Lấy tất cả các tender của contractor
                $tenders = $this->tenderModel->where('creator_id', $userId)->findAll();
        
                // Render trang danh sách tender cho contractor
                return view('tender/list_contractor', [
                    'title' => 'My Tenders (Contractor)',
                    'tenders' => $tenders
                ]);
            } catch (\Exception $e) {
                return redirect()->to('/login')->with('error', 'Token không hợp lệ hoặc đã hết hạn.');
            }
        }
        
        // public function listSupplier()
        // {
        //     // Lấy token từ cookie hoặc header
        //     $authHeader = $this->request->getHeader('Authorization');
        //     $token = null;
        //     if ($authHeader) {
        //         $headerValue = $authHeader->getValue();
        //         if (preg_match('/Bearer\s(\S+)/', $headerValue, $matches)) {
        //             $token = $matches[1];
        //         }
        //     } elseif ($this->request->getCookie('token')) {
        //         $token = $this->request->getCookie('token');
        //     }
        
        //     if (!$token) {
        //         return redirect()->to('/login')->with('error', 'Bạn cần đăng nhập.');
        //     }
        
        //     try {

        //         $key = (new JWTConfig())->jwt_key;
        //         $decoded = JWT::decode($token, new Key($key, 'HS256'));
        //         $userEmail = $decoded->data->email;
        //         $publicTenders = $this->tenderModel->where('visibility', 'public')->findAll();
        //         $inviteModel = new InviteModel();
        //         $invites = $inviteModel->where('supplier_email', $userEmail)->findAll();
        //         $invitedTenderIds = array_column($invites, 'tender_id');
        //         $privateTenders = [];
        //         if (!empty($invitedTenderIds)) {
        //             $privateTenders = $this->tenderModel->whereIn('id', $invitedTenderIds)->where('visibility', 'private')->findAll();
        //         }
        
        //         // Render trang danh sách tender cho supplier với các tab Public và Private
        //         return view('tender/list_supplier', [
        //             'title' => 'Available Tenders (Supplier)',
        //             'publicTenders' => $publicTenders,
        //             'privateTenders' => $privateTenders
        //         ]);
        //     } catch (\Exception $e) {
        //         return redirect()->to('/login')->with('error', 'Token không hợp lệ hoặc đã hết hạn.');
        //     }
        // }


        public function listSupplier()
{
    // Lấy token từ cookie hoặc header
    $authHeader = $this->request->getHeader('Authorization');
    $token = null;
    if ($authHeader) {
        $headerValue = $authHeader->getValue();
        if (preg_match('/Bearer\s(\S+)/', $headerValue, $matches)) {
            $token = $matches[1];
        }
    } elseif ($this->request->getCookie('token')) {
        $token = $this->request->getCookie('token');
    }

    if (!$token) {
        return redirect()->to('/login')->with('error', 'Bạn cần đăng nhập.');
    }

    try {
        // Giải mã token để lấy thông tin người dùng
        $key = (new JWTConfig())->jwt_key;
        $decoded = JWT::decode($token, new Key($key, 'HS256'));
        $userId = $decoded->data->id;
        $userEmail = $decoded->data->email;

        // Lấy tất cả các tender công khai mà người dùng không phải là creator
        $publicTenders = $this->tenderModel
            ->where('visibility', 'public')
            ->where('creator_id !=', $userId)
            ->findAll();

        // Lấy tất cả các tender riêng tư mà người dùng hiện tại được mời
        $inviteModel = new InviteModel();
        $invites = $inviteModel->where('supplier_email', $userEmail)->findAll();
        $invitedTenderIds = array_column($invites, 'tender_id');

        // Lấy các tender riêng tư mà người dùng được mời
        $privateTenders = [];
        if (!empty($invitedTenderIds)) {
            $privateTenders = $this->tenderModel->whereIn('id', $invitedTenderIds)->where('visibility', 'private')->findAll();
        }

        // Render trang danh sách tender cho supplier với các tab Public và Private
        return view('tender/list_supplier', [
            'title' => 'Available Tenders (Supplier)',
            'publicTenders' => $publicTenders,
            'privateTenders' => $privateTenders
        ]);
    } catch (\Exception $e) {
        return redirect()->to('/login')->with('error', 'Token không hợp lệ hoặc đã hết hạn.');
    }
}
}