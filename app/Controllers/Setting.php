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

    public function update($id) {
        $data = [
            'coordinat' => $this->request->getPost('coordinat'),
            'zoom' => $this->request->getPost('zoom')
        ];

        $this->settingModel->update($id, $data);
        
        if ($this->settingModel->errors()) {
            return redirect()->to('/dashboard/setting')->withInput()->with('error', $this->settingModel->errors());
        } else {
            return redirect()->to('/dashboard/setting')->with('success', 'Data berhasil diubah');
        }

    } 

}
