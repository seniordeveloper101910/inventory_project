<?php
namespace App\Controllers\Api;

use App\Models\ProductModel;
use CodeIgniter\RESTful\ResourceController;

class ProductController extends ResourceController {
    protected $modelName = 'App\Models\ProductModel';
    protected $format = 'json';

    public function index() {
        $products = $this->model->findAll();
        return $this->respond($products);
    }

    public function show($id = null) {
        $product = $this->model->find($id);
        if (!$product) return $this->failNotFound('Product not found');
        return $this->respond($product);
    }

    public function create() {
        $data = $this->request->getJSON(true);
        if (!$data) return $this->failValidationError('Invalid JSON');
        $this->model->insert($data);
        return $this->respondCreated($data);
    }

    public function update($id = null) {
        $data = $this->request->getJSON(true);
        if (!$data) return $this->failValidationError('Invalid JSON');
        $this->model->update($id, $data);
        return $this->respond($this->model->find($id));
    }

    public function delete($id = null) {
        $this->model->delete($id);
        return $this->respondDeleted(['id'=>$id]);
    }
}
