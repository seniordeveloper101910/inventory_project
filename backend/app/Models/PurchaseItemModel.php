<?php
namespace App\Models;
use CodeIgniter\Model;

class PurchaseItemModel extends Model {
    protected $table = 'purchase_items';
    protected $allowedFields = ['purchase_id','product_id','qty','cost'];
    protected $useTimestamps = true;
}
