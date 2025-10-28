<?php
namespace App\Models;
use CodeIgniter\Model;

class PurchaseModel extends Model {
    protected $table = 'purchases';
    protected $allowedFields = ['supplier_id','reference','total','status'];
    protected $useTimestamps = true;
}
