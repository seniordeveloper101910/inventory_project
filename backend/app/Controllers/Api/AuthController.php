<?php
namespace App\Controllers\Api;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use Firebase\\JWT\\JWT;

class AuthController extends ResourceController {
    protected $format = 'json';

    public function login() {
        $data = $this->request->getJSON(true);
        if (empty($data['username']) || empty($data['password'])) {
            return $this->failValidationError('username and password required');
        }
        $userModel = new UserModel();
        $user = $userModel->where('username', $data['username'])->first();
        if (!$user) return $this->failNotFound('User not found');
        if (!password_verify($data['password'], $user['password'])) {
            return $this->fail('Invalid credentials', 401);
        }
        $key = getenv('JWT_SECRET') ?: 'change_this_secret';
        $payload = [
            'iss' => base_url(),
            'iat' => time(),
            'exp' => time() + 3600*24,
            'uid' => $user['id'],
            'role' => $user['role']
        ];
        $jwt = JWT::encode($payload, $key, 'HS256');
        return $this->respond(['token' => $jwt]);
    }
}
