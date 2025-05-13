<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KosModel;
use App\Models\WilayahModel;
use App\Models\JenisKosModel;
use App\Models\UserModel;
use App\Models\SettingModel;
use CodeIgniter\HTTP\ResponseInterface;

class Kos extends BaseController
{

    protected $kosModel;
    protected $wilayahModel;
    protected $jenisKosModel;
    protected $userModel;
    protected $SettingModel;

    public function __construct()
    {
        $this->kosModel = new KosModel();
        $this->wilayahModel = new WilayahModel();
        $this->jenisKosModel = new JenisKosModel();
        $this->userModel = new UserModel();
        $this->SettingModel = new SettingModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kos',
            'page' => 'template/backend/kos/index',
            'kos' => $this->kosModel->getData(),
        ];
        return view('template/backend/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Kos',
            'page' => 'template/backend/kos/create',
            'user' => $this->userModel->getData(),
            'wilayah' => $this->wilayahModel->getData(),
            'jenis' => $this->jenisKosModel->getJenisKos(),
            'setting' => $this->SettingModel->getSetting()
        ];
        return view('template/backend/index', $data);
    }

    public function store() {

        // Getting Photo
        $photo = $this->request->getFile('photo');

        // Getting Name File
        $name_file = $photo->getName();

        // Move to Folder
        $photo->move(ROOTPATH . 'public/upload/photo', $name_file);

        $data = [
            'name' => $this->request->getPost('name'),
            'id_jenis' => $this->request->getPost('id_jenis'),
            'price' => $this->request->getPost('price'),
            'available' => $this->request->getPost('available'),

            // Dummy
            'id_user' => "3",


            'coordinat' => $this->request->getPost('coordinat'),
            'photo' => $name_file,
            'address' => $this->request->getPost('address'),
            'bathroom' => $this->request->getPost('bathroom'),
            'air_conditioner' => $this->request->getPost('air_conditioner'),
            'wifi' => $this->request->getPost('wifi'),
            'id_wilayah' => $this->request->getPost('id_wilayah'),
            'flood_info' => $this->request->getPost('flood_info'),
            'status' => "Unverified",
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Insert Data
        $this->kosModel->insert($data);
       
        // Redirect
        if ($this->kosModel->errors()) {
            return redirect()->to('/dashboard/kos')->withInput()->with('error', $this->kosModel->errors());
        } else {
            return redirect()->to('/dashboard/kos')->with('success', 'Data berhasil ditambahkan');
        }

    }

    public function show($id) {

        // Getting user name
        $kos = $this->kosModel->getDataWhere($id);

        $data = [
            'title' => 'Detail Kos ' . $kos[0]['name'],
            'page' => 'template/backend/kos/detail',
            'kos' => $kos,
            'wilayah' => $this->wilayahModel->getData(),
            'setting' => $this->SettingModel->getSetting()
        ];
        return view('template/backend/index', $data);
    }

    // Change Status
    public function verification($id) {
        
        // Data
        $data = [
            'status' => "Verified",
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Update
        $this->kosModel->update($id, $data);
        
        if ($this->kosModel->errors()) {
            return redirect()->to('/dashboard/kos')->withInput()->with('error', $this->kosModel->errors());
        } else {
            return redirect()->to('/dashboard/kos')->with('success', 'Data berhasil diverifikasi');
        }

    }

    public function edit($id) {

        // Data
        $kos = $this->kosModel->getDataWhere($id);

        $data = [
            'title' => 'Edit Kos ' . $kos[0]['name'],
            'page' => 'template/backend/kos/edit',
            'user' => $this->userModel->getData(),
            'wilayah' => $this->wilayahModel->getData(),
            'jenis' => $this->jenisKosModel->getJenisKos(),
            'setting' => $this->SettingModel->getSetting(),
            'kos' => $kos
        ];
        return view('template/backend/index', $data);
    }

    public function update($id) {

        // Getting Photo
        $photo = $this->request->getFile('photo');

        // Getting Name File
        $name_file = $photo->getName();

        // Move to Folder
        $photo->move(ROOTPATH . 'public/upload/photo', $name_file);

        $data = [
            'name' => $this->request->getPost('name'),
            'id_jenis' => $this->request->getPost('id_jenis'),
            'price' => $this->request->getPost('price'),
            'available' => $this->request->getPost('available'),
            'coordinat' => $this->request->getPost('coordinat'),
            'photo' => $name_file,
            'address' => $this->request->getPost('address'),
            'bathroom' => $this->request->getPost('bathroom'),
            'air_conditioner' => $this->request->getPost('air_conditioner'),
            'wifi' => $this->request->getPost('wifi'),
            'id_wilayah' => $this->request->getPost('id_wilayah'),
            'flood_info' => $this->request->getPost('flood_info'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Getting old photo
        $old_photo = $this->kosModel->find($id);

        // unlink old photo
        unlink(ROOTPATH . 'public/upload/photo/' . $old_photo['photo']);

        // Update Data
        $this->kosModel->update($id, $data);
        
        // Redirect
        if ($this->kosModel->errors()) {
            return redirect()->to('/dashboard/kos')->withInput()->with('error', $this->kosModel->errors());
        } else {
            return redirect()->to('/dashboard/kos')->with('success', 'Data berhasil diubah');
        }

    }

}
