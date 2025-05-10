<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;


class User extends BaseController
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Users',
            'page' => 'template/backend/users/index',
            'users' => $this->userModel->getData()
        ];
        return view('template/backend/index', $data);
    }
}
