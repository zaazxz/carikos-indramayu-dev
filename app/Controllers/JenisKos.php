<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JenisKosModel;
use CodeIgniter\HTTP\ResponseInterface;

class JenisKos extends BaseController
{

    protected $jenisKosModel;

/*************  ✨ Windsurf Command ⭐  *************/
    /**
     * Constructor for JenisKos controller.
     * Initializes the JenisKosModel instance.
     */

/*******  17ff9657-01ed-464e-82fd-6ca2d13383ab  *******/
    public function __construct()
    {
        $this->jenisKosModel = new JenisKosModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Jenis Kos',
            'page' => 'template/backend/jenis/index',
            'jeniskos' => $this->jenisKosModel->getJenisKos()
        ];
        return view('template/backend/index', $data);
    }

    public function update($id)
    {

        // Getting old data
        $data = $this->jenisKosModel->find($id);

        // Check if file exist
        if ($data['marker']) {
            unlink(ROOTPATH . 'public/uploadmarker/' . $data['marker']);

            // Getting File
            $marker = $this->request->getFile('marker');

            // Getting Name File
            $name_file = $marker->getName();

            $data = [
                'marker' => $name_file,
            ];

            // Move File
            $marker->move(ROOTPATH . 'public/upload/marker', $name_file);

            // Update Data
            $this->jenisKosModel->update($id, $data);
        } else {

            // Getting File
            $marker = $this->request->getFile('marker');

            // Getting Name File
            $name_file = $marker->getName();

            $data = [
                'marker' => $name_file,
            ];

            // Move File
            $marker->move(ROOTPATH . 'public/upload/marker', $name_file);

            // Update Data
            $this->jenisKosModel->update($id, $data);
        }

        if ($this->jenisKosModel->errors()) {
            return redirect()->to('/dashboard/jeniskos')->withInput()->with('error', $this->jenisKosModel->errors());
        } else {
            return redirect()->to('/dashboard/jeniskos')->with('success', 'Data berhasil diubah');
        }
    }
}
