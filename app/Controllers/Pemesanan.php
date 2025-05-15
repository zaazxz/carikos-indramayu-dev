<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;

class Pemesanan extends BaseController
{

    protected $pemesananModel;
    protected $kosModel;
    protected $SettingModel;
    protected $WilayahModel;

    public function __construct()
    {
        $this->pemesananModel = new \App\Models\PemesananModel();
        $this->kosModel = new \App\Models\KosModel();
        $this->SettingModel = new \App\Models\SettingModel();
        $this->WilayahModel = new \App\Models\WilayahModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pemesanan',
            'page' => 'template/backend/pemesanan/index',
            'setting' => $this->SettingModel->getSetting(),
            'pemesanan' => $this->pemesananModel->getData(),
        ];
        return view('template/backend/index', $data);
    }

    public function create($id_kos)
    {
        $data = [
            'title' => 'Pemesanan',
            'page' => 'template/backend/pemesanan/create',
            'kos' => $this->kosModel->getDataWhere($id_kos),
            'setting' => $this->SettingModel->getSetting(),
            'wilayah' => $this->WilayahModel->getData()
        ];
        return view('template/frontend/index', $data);
    }

    public function store()
    {

        // Validation
        if ($this->validate([
            'id_user' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'User harus diisi',
                ]
            ],
            'id_kos' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kos harus diisi',
                ]
            ],
            'id_wilayah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Wilayah harus diisi',
                ]
            ],
            'tanggal_mulai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Mulai harus diisi',
                ]
            ],
            'tanggal_selesai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Selesai harus diisi',
                ]
            ],
        ]));

        // Getting file
        $file = $this->request->getFile('proof_of_payment');

        // Getting user name from session
        $userName = session()->get('name');

        // getting now date
        $nowDate = Time::now('Asia/Jakarta')->format('d-M-Y');

        // Getting file name
        $fileName = $file->getName();

        // Getting file extension
        $fileExtension = $file->getClientExtension();

        // Getting random name
        $randomName = bin2hex(random_bytes(10));

        // Generate new file name
        $newFileName = $userName . "_" . $nowDate . '_' . $randomName . '.' . $fileExtension;

        // Move file to folder
        $file->move(ROOTPATH . 'public/upload/pemesanan', $newFileName);

        // Save data to database
        $data = [
            'id_user' => session()->get('id'),
            'id_kos' => $this->request->getPost('id_kost'),
            'proof_of_payment' => $newFileName,
            'status' => 'Pending',
            'start_date' => Time::now('Asia/Jakarta')->format('Y-m-d'),
            'outstanding_balance' => Time::now('Asia/Jakarta')->addMonths(1)->format('Y-m-d'),
            'created_at' => Time::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ];

        $this->pemesananModel->insert($data);

        if ($this->pemesananModel->errors()) {
            return redirect()->back()->withInput()->with('errors', $this->pemesananModel->errors());
        } else {
            return redirect()->to('/dashboard/kos')->with('success', 'Data berhasil disimpan');
        }
    }

    // Detail Pemesanan
    public function detail($id)
    {
        $data = [
            'title' => 'Detail Pemesanan',
            'page' => 'template/backend/pemesanan/detail',
            'pemesanan' => $this->pemesananModel->getDataById($id),
            'setting' => $this->SettingModel->getSetting(),
            'wilayah' => $this->WilayahModel->getData()
        ];
        return view('template/backend/index', $data);
    }

    // Approve Pemesanan
    public function approve($id)
    {
        $data = [
            'status' => 'Approved',
            'updated_at' => Time::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ];

        $dataKos = [
            'available' => $this->pemesananModel->getDataById($id)['available'] - 1,
            'updated_at' => Time::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ];

        $this->kosModel->update( $this->pemesananModel->getDataById($id)['id_kos'] ,$dataKos);
        $this->pemesananModel->update($id, $data);
        return redirect()->to('/dashboard/pemesanan')->with('success', 'Data berhasil disimpan');
    }

    // Reject Pemesanan
    public function reject($id)
    {
        $data = [
            'status' => 'Rejected',
            'updated_at' => Time::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ];
        $this->pemesananModel->update($id, $data);
        return redirect()->to('/dashboard/pemesanan')->with('success', 'Data berhasil disimpan');
    }

    // Delete Pemesanan
    public function delete($id)
    {

        // Getting old photo
        $old_photo = $this->pemesananModel->find($id);

        // Delete file
        unlink(ROOTPATH . 'public/upload/pemesanan/' . $old_photo['proof_of_payment']);

        // Add Available to Kos
        $dataKos = [
            'available' => $this->pemesananModel->getDataById($id)['available'] + 1,
            'updated_at' => Time::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ];

        $this->kosModel->update($this->pemesananModel->getDataById($id)['id_kos'], $dataKos);
        $this->pemesananModel->delete($id);

        if ($this->pemesananModel->errors()) {
            return redirect()->back()->withInput()->with('errors', $this->pemesananModel->errors());
        } else {
            return redirect()->to('/dashboard/pemesanan')->with('success', 'Data berhasil dihapus');
        }
        
    }
}
