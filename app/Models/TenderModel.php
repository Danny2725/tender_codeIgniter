<?php

namespace App\Models;

use CodeIgniter\Model;


class TenderModel extends Model
{

    protected $table = 'tenders';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'description', 'visibility', 'creator_id'];


