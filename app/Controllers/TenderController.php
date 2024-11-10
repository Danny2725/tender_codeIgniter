<?php

namespace App\Controllers;

use App\Models\TenderModel;

class TenderController extends BaseController
{
    protected $tenderModel;

    public function __construct()
    {
        // Khởi tạo model TenderModel để lấy dữ liệu mẫu
        $this->tenderModel = new TenderModel();
    }

    // Trang tạo tender
    public function create()
    {
        return view('tender/create', ['title' => 'Create Tender']);
    }

    public function store()
    {
        // Lấy dữ liệu từ form
        $title = $this->request->getPost('title');
        $description = $this->request->getPost('description');
        $visibility = $this->request->getPost('visibility');
        $suppliers = $this->request->getPost('suppliers');

        // Tạo dữ liệu mẫu (dummy) để kiểm tra
        $dummyData = [
            'title' => $title,
            'description' => $description,
            'visibility' => $visibility,
            'suppliers' => $suppliers,
        ];

        // Hiển thị dữ liệu mẫu hoặc chuyển hướng với thông báo thành công
        // (Có thể thay thế bằng lưu vào cơ sở dữ liệu sau này)
        session()->setFlashdata('success', 'Tender created successfully!');

        return redirect()->to('/tender/create');
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

    // Trang danh sách tender cho supplier
    public function listSupplier()
    {
        $data = [
            'title' => 'Available Tenders (Supplier)',
            'tenders' => $this->tenderModel->getDummyDataForSupplier()
        ];
        return view('tender/list_supplier', $data);
    }
}
