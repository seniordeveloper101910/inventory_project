<?php
namespace App\Models;
use CodeIgniter\Model;

class SaleModel extends Model {
    protected $table = 'sales';
    protected $allowedFields = ['customer_name','reference','total','status'];
    protected $useTimestamps = true;
}
