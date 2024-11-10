<?php

namespace App\Models;

use CodeIgniter\Model;

class TenderModel extends Model
{
    // Dữ liệu mẫu cho Contractor
    public function getDummyDataForContractor()
    {
        return [
            [
                'title' => 'Tender 1',
                'description' => 'Description for Tender 1',
                'visibility' => 'Public',
            ],
            [
                'title' => 'Tender 2',
                'description' => 'Description for Tender 2',
                'visibility' => 'Private',
            ],
        ];
    }

    // Dữ liệu mẫu cho Supplier
    public function getDummyDataForSupplier()
    {
        return [
            [
                'title' => 'Public Tender 1',
                'description' => 'Description for Public Tender 1',
                'visibility' => 'Public',
            ],
            [
                'title' => 'Private Tender 1',
                'description' => 'Description for Private Tender 1',
                'visibility' => 'Private',
            ],
        ];
    }
}