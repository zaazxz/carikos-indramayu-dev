<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\WilayahModel;

class Dashboard extends BaseController
{

    protected $WilayahModel;

    public function __construct()
    {
        $this->WilayahModel = new WilayahModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'page' => 'template/backend/dashboard/index',
            'wilayah' => $this->WilayahModel->countData(),
        ];
        return view('template/backend/index', $data);
    }
}
