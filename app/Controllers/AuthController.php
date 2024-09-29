<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\JWT;
use App\Helpers\Response;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected $userRepository;

    public function __construct()
    {
    $this->userRepository = service('userRepositoryInterface');
    }

    public function index()
    {
        //
    }

    
    public function login(): ResponseInterface
    {
        try {
            $requestData = $this->request->getJSON(true);

            
            if (!isset($requestData['username']) || !isset($requestData['password'])) {
                return Response::send(400, 'Kesalahan pada request: "username" dan "password" harus ada.', null);
            }

            
            if (array_diff_key($requestData, array_flip(['username', 'password']))) {
                return Response::send(400, 'Kesalahan pada request: hanya "username" dan "password" yang diperbolehkan.', null);
            }
            
            $user = $this->userRepository->getUserByUsername($requestData['username']);

            if ($user && password_verify($requestData['password'], $user['password'])) {
                $claims = ['uid' => $user['user_id']];
                $tokens = JWT::generateTokens($claims);
                return Response::send(200, 'Login berhasil', $tokens);
            }

            
            return Response::send(401, 'Username atau password salah.', null);
        } catch (\Exception $e) {
            
            log_message('error', 'Login error: ' . $e->getMessage()); 
            return Response::send(500, 'Terjadi kesalahan pada server: ' . $e->getMessage(), null);
        }
    }
}