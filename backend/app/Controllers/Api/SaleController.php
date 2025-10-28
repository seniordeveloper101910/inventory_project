<?php
namespace App\Controllers\Api;

use App\Models\SaleModel;
use App\Models\SaleItemModel;
use App\Models\ProductModel;
use CodeIgniter\RESTful\ResourceController;

class SaleController extends ResourceController {
    protected $modelName = 'App\\Models\\SaleModel';
    protected $format = 'json';

    public function create() {
        $db = \\Config\\Database::connect();
        $data = $this->request->getJSON(true);
        if (empty($data['items'])) {
            return $this->failValidationError('items are required');
        }
        $items = $data['items'];
        $total = 0;
        $db->transStart();
        try {
            $saleModel = new SaleModel();
            $saleId = $saleModel->insert([
                'customer_name' => $data['customer_name'] ?? null,
                'reference' => $data['reference'] ?? null,
                'total' => 0,
                'status' => 'completed'
            ]);
            $siModel = new SaleItemModel();
            $productModel = new ProductModel();
            foreach ($items as $it) {
                $qty = (int)$it['qty'];
                $price = (float)$it['price'];
                $total += $qty * $price;
                $siModel->insert([
                    'sale_id' => $saleId,
                    'product_id' => $it['product_id'],
                    'qty' => $qty,
                    'price' => $price
                ]);
                $product = $productModel->find($it['product_id']);
                if ($product) {
                    $newQty = max(0, $product['stock_qty'] - $qty);
                    $productModel->update($product['id'], ['stock_qty' => $newQty]);
                }
            }
            $saleModel->update($saleId, ['total'=>$total]);
            $db->transComplete();
        } catch (\\Exception $e) {
            $db->transRollback();
            return $this->failServerError('Failed to create sale: ' . $e->getMessage());
        }
        return $this->respondCreated(['id'=>$saleId,'total'=>$total]);
    }
}
