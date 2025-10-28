<?php
namespace App\Models;
use CodeIgniter\Model;

class ProductModel extends Model {
    protected $table = 'products';
    protected $allowedFields = ['sku','name','category_id','cost','price','stock_qty'];
    protected $useTimestamps = true;
}
