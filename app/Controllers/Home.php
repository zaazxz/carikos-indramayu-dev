<?php

namespace App\Controllers;

class Home extends BaseController
{

    protected $SettingModel;
    protected $WilayahModel;
    protected $KosModel;
    protected $JenisKosModel;
    protected $db;
    protected $request;

    public function __construct()
    {
        $this->SettingModel = new \App\Models\SettingModel();
        $this->WilayahModel = new \App\Models\WilayahModel();
        $this->KosModel = new \App\Models\KosModel();
        $this->JenisKosModel = new \App\Models\JenisKosModel();
        $this->request = \Config\Services::request();
    }

    public function index()
    {
        $wilayahFilter = $this->request->getGet('wilayah');
        $typeFilter    = $this->request->getGet('type');

        // get setting dan jenis kos seperti biasa
        $data = [
            'title' => 'Home',
            'page' => 'template/frontend/main/index',
            'setting' => $this->SettingModel->getSetting(),
            'wilayah' => $this->WilayahModel->getData(),
            'jenis' => $this->JenisKosModel->getJenisKos(),
            'request' => \Config\Services::request()
        ];

        // kalau ada filter, load data sesuai
        if ($wilayahFilter || $typeFilter) {
            $data['kos'] = $this->KosModel->getFilteredData($wilayahFilter, $typeFilter);
        } else {
            $data['kos'] = $this->KosModel->getData();
        }

        return view('template/frontend/index', $data);
    }
}
