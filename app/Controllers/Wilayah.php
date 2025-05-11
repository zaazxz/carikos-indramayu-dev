<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SettingModel;
use App\Models\WilayahModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Wilayah extends BaseController
{

    // Variable
    protected $WilayahModel;
    protected $SettingModel;

    public function __construct()
    {
        $this->WilayahModel = new WilayahModel();
        $this->SettingModel = new SettingModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Wilayah',
            'page' => 'template/backend/wilayah/index',
            'wilayah' => $this->WilayahModel->getData(),
            'setting' => $this->SettingModel->getSetting()
        ];

        return view('template/backend/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Create Wilayah',
            'page' => 'template/backend/wilayah/create',
            'wilayah' => $this->WilayahModel->getData(),
            'setting' => $this->SettingModel->getSetting()
        ];
        return view('template/backend/index', $data);
    }

    public function store()
    {

        // Validating
        if ($this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong'
                ]
            ],
            'warna' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Warna tidak boleh kosong'
                ]
            ],
            'geojson' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Geojson tidak boleh kosong'
                ]
            ]
        ]));

        // getting data
        $geojson = $this->request->getPost('geojson');

        // Encode geojson sebelum disimpan ke database
        $geojson = json_encode(json_decode($geojson));

        // Making data variable for insert
        $data = [
            'name' => $this->request->getPost('name'),
            'warna' => $this->request->getPost('warna'),
            'geojson' => $geojson
        ];

        // Inserting Data
        $this->WilayahModel->insertData($data);

        // Redirect back with alert in javascript
        if ($this->WilayahModel->errors()) {
            return redirect()->to('/dashboard/wilayah')->with('error', $this->WilayahModel->errors());
        } else {
            return redirect()->to('/dashboard/wilayah')->with('success', 'Data berhasil ditambahkan');
        }
    }

    public function edit($id)
    {

        // Getting wilayah name
        $wilayah = $this->WilayahModel->getDataWhere($id);

        $data = [
            'title' => 'Edit Wilayah' . $wilayah[0]['name'],
            'page' => 'template/backend/wilayah/edit',
            'wilayah' => $this->WilayahModel->getDataWhere($id),
            'setting' => $this->SettingModel->getSetting()
        ];
        return view('template/backend/index', $data);
    }

    public function update($id)
    {

        // getting data
        $geojson = $this->request->getPost('geojson');

        // // Encode geojson sebelum disimpan ke database
        $geojson = json_decode($geojson);

        // var_dump($geojson);

        // updating data
        $this->WilayahModel
            ->set([
                'geojson' => $geojson,
                'name' => $this->request->getPost('name'),
                'warna' => $this->request->getPost('warna')
            ])
            ->where('id', $id)
            ->update();

        // Redirect back with alert in javascript
        if ($this->WilayahModel->errors()) {
            return redirect()->to('/dashboard/wilayah')->with('error', $this->WilayahModel->errors());
        } else {
            return redirect()->to('/dashboard/wilayah')->with('success', 'Data berhasil diubah');
        }
    }

    public function delete($id)
    {
        $this->WilayahModel->delete($id);
        
        if ($this->WilayahModel->errors()) {
            return redirect()->to('/dashboard/wilayah')->with('error', $this->WilayahModel->errors());
        } else {
            return redirect()->to('/dashboard/wilayah')->with('success', 'Data berhasil dihapus');
        }
    }
}
