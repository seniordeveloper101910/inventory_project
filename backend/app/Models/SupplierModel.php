<?php
namespace App\Models;
use CodeIgniter\Model;

class SupplierModel extends Model {
    protected $table = 'suppliers';
    protected $allowedFields = ['name','contact','email','phone'];
    protected $useTimestamps = true;
}
