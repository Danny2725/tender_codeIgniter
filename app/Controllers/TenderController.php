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

            if (empty($title) || empty($description)) {
                return $this->respond(['status' => 'error', 'message' => 'Tiêu đề và mô tả là bắt buộc'], 400);
            }

            $tenderModel = new TenderModel();
            $tenderId = $tenderModel->insert([
                'title' => $title,
                'description' => $description,
                'visibility' => $visibility,
                'creator_id' => $userId
            ]);

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
            return $this->respond(['status' => 'error', 'message' => 'Token không hợp lệ'], 401);
        }
    }



    public function getTenders() {
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
            $userRole = $decoded->data->role;
            $userEmail = $decoded->data->email;

            $tenderModel = new TenderModel();

            if ($userRole === 'contractor') {
                $tenders = $tenderModel->where('creator_id', $userId)->findAll();
            } else if ($userRole === 'supplier') {
                $inviteModel = new InviteModel();
                $invites = $inviteModel->where('supplier_email', $userEmail)->findAll();
                $invitedTenderIds = array_column($invites, 'tender_id');
                $tenders = $tenderModel
                    ->groupStart()
                        ->where('visibility', 'public')
                        ->orWhereIn('id', $invitedTenderIds)
                    ->groupEnd()
                    ->findAll();
            }

            return $this->respond(['status' => 'success', 'data' => $tenders], 200);

        } catch (\Exception $e) {
            return $this->respond(['status' => 'error', 'message' => 'Token không hợp lệ'], 401);
        }
    }

        // Trang danh sách tender cho contractor
        public function listContractor()
        {
            $data = [
                'title' => 'My Tenders (Contractor)',
                'tenders' => $this->tenderModel->getDummyDataForContractor()
            ];
            return view('tender/list_contractor', $data);
        }
    
        public function listSupplier()
        {
            $data = [
                'title' => 'Available Tenders (Supplier)',
                'tenders' => $this->tenderModel->getDummyDataForSupplier()
            ];
            return view('tender/list_supplier', $data);
        }
}