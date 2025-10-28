<?php
namespace App\Controllers\Api;

use App\Models\PurchaseModel;
use App\Models\PurchaseItemModel;
use App\Models\ProductModel;
use CodeIgniter\RESTful\ResourceController;

class PurchaseController extends ResourceController {
    protected $modelName = 'App\\Models\\PurchaseModel';
    protected $format = 'json';

    public function create() {
        $db = \\Config\\Database::connect();
        $data = $this->request->getJSON(true);
        if (empty($data['supplier_id']) || empty($data['items'])) {
            return $this->failValidationError('supplier_id and items are required');
        }
        $items = $data['items'];
        $total = 0;
        $db->transStart();
        try {
            $purchaseModel = new PurchaseModel();
            $purchaseId = $purchaseModel->insert([
                'supplier_id' => $data['supplier_id'],
                'reference' => $data['reference'] ?? null,
                'total' => 0,
                'status' => 'received'
            ]);
            $pmItem = new PurchaseItemModel();
            $productModel = new ProductModel();
            foreach ($items as $it) {
                $qty = (int)$it['qty'];
                $cost = (float)$it['cost'];
                $total += $qty * $cost;
                $pmItem->insert([
                    'purchase_id' => $purchaseId,
                    'product_id' => $it['product_id'],
                    'qty' => $qty,
                    'cost' => $cost
                ]);
                $product = $productModel->find($it['product_id']);
                if ($product) {
                    $newQty = $product['stock_qty'] + $qty;
                    $productModel->update($product['id'], ['stock_qty' => $newQty]);
                }
            }
            $purchaseModel->update($purchaseId, ['total'=>$total]);
            $db->transComplete();
        } catch (\\Exception $e) {
            $db->transRollback();
            return $this->failServerError('Failed to create purchase: ' . $e->getMessage());
        }
        return $this->respondCreated(['id'=>$purchaseId,'total'=>$total]);
    }
}
