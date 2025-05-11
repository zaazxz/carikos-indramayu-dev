<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SettingModel;

class Setting extends BaseController
{

    // Variable
    private $settingModel;

    public function __construct()
    {
        $this->settingModel = new SettingModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Setting',
            'page' => 'template/backend/setting/index',
            'setting' => $this->settingModel->getSetting()
        ];
        return view('template/backend/index', $data);
    }
}
