<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Config\Services;

class JwtFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $header = $request->getServer('HTTP_AUTHORIZATION');
        if (!$header) {
            return Services::response()->setStatusCode(401)->setJSON(['error'=>'Missing Authorization header']);
        }
        if (preg_match('/Bearer\\s+(.*)$/i', $header, $matches)) {
            $token = $matches[1];
        } else {
            return Services::response()->setStatusCode(401)->setJSON(['error'=>'Malformed Authorization header']);
        }

        $key = getenv('JWT_SECRET') ?: 'change_this_secret';
        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            // attach user data if required
        } catch (\\Exception $e) {
            return Services::response()->setStatusCode(401)->setJSON(['error'=>'Invalid token: '.$e->getMessage()]);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // no-op
    }
}
