<?php
namespace App\Models;
use CodeIgniter\Model;

class SaleItemModel extends Model {
    protected $table = 'sale_items';
    protected $allowedFields = ['sale_id','product_id','qty','price'];
    protected $useTimestamps = true;
}
