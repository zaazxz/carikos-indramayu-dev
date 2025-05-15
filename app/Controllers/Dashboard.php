<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\WilayahModel;
use App\Models\UserModel;
use App\Models\KosModel;
use App\Models\JenisKosModel;
use App\Models\SettingModel;


class Dashboard extends BaseController
{

    protected $WilayahModel;
    protected $UserModel;
    protected $KosModel;
    protected $JenisKosModel;
    protected $SettingModel;

    public function __construct()
    {
        $this->WilayahModel = new WilayahModel();
        $this->UserModel = new UserModel();
        $this->KosModel = new KosModel();
        $this->JenisKosModel = new JenisKosModel();
        $this->SettingModel = new SettingModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'page' => 'template/backend/dashboard/index',
            'wilayah' => $this->WilayahModel->countData(),
            'kos' => $this->KosModel->countAllResults(),
            'kostPutra' => $this->KosModel->where('id_jenis', '1')->countAllResults(),
            'kostPutri' => $this->KosModel->where('id_jenis', '2')->countAllResults(),
            'kostCampur' => $this->KosModel->where('id_jenis', '3')->countAllResults(),
        ];
        return view('template/backend/index', $data);
    }
}
