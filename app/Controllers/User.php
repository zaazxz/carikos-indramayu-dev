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

    // Index Page
    public function index()
    {
        $data = [
            'title' => 'Users',
            'page' => 'template/backend/users/index',
            'users' => $this->userModel->getData()
        ];
        return view('template/backend/index', $data);
    }

    // Create Page
    public function create()
    {
        $data = [
            'title' => 'Create User',
            'page' => 'template/backend/users/create'
        ];
        return view('template/backend/index', $data);
    }

    // Store Data
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
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Email tidak boleh kosong'
                ]
            ],
            'phone' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor Telepon tidak boleh kosong'
                ]
            ]
        ]));

        /*

            'id'                : not null, auto_increment, int
            'name'              : not null, varchar(100), text
            'email'             : not null, varchar(100), email
            'account'           : null
            'account_username'  : null
            'account_id'        : null
            'phone'             : null
            'password'          : not null    
            'level'             : null
            'foto'              : null
            'status'            : null
            'created_at'        : not null
            'updated_at'        : not null

        */

        // Making data variable for insert
        $data = [
            'name'          => $this->request->getPost('name'),
            'email'         => $this->request->getPost('email'),
            'phone'         => $this->request->getPost('phone'),
            'password'      => password_hash('admin123', PASSWORD_DEFAULT),
            'level'         => 'Admin',
            'status'        => 'Verified',
            'created_at'    => date('Y-m-d H:i:s'),
        ];

        // Inserting Data
        $this->userModel->insert($data);

        // Redirect back with alert in javascript
        if ($this->userModel->errors()) {
            return redirect()->to('/dashboard/users/create')->with('error', $this->userModel->errors());
        } else {
            return redirect()->to('/dashboard/users')->with('success', 'Data berhasil ditambahkan');
        }
    }

    // Showing Data
    public function show($id)
    {

        // Getting user name
        $user = $this->userModel->getDataWhere($id);

        $data = [
            'title' => 'Detail User ' . $user[0]['name'],
            'page' => 'template/backend/users/detail',
            'user' => $this->userModel->getDataWhere($id)
        ];
        return view('template/backend/index', $data);
    }

    // Edit Page
    public function edit($id)
    {

        // Getting user name
        $user = $this->userModel->getDataWhere($id);

        $data = [
            'title' => 'Edit User '. $user[0]['name'],
            'page' => 'template/backend/users/edit',
            'user' => $this->userModel->getDataWhere($id)
        ];
        return view('template/backend/index', $data);
    }

    // Update Data
    public function update($id)
    {

        // Validating
        if ($this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong'
                ]
            ],
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Email tidak boleh kosong'
                ]
            ],
            'phone' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor Telepon tidak boleh kosong'
                ]
            ]
        ]));

        // Making data variable for insert
        $data = [
            'name'          => $this->request->getPost('name'),
            'email'         => $this->request->getPost('email'),
            'phone'         => $this->request->getPost('phone'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        // Inserting Data
        $this->userModel->update($id, $data);

        // Redirect back with alert in javascript
        if ($this->userModel->errors()) {
            return redirect()->to('/dashboard/users/edit/' . $id)->with('error', $this->userModel->errors());
        } else {
            return redirect()->to('/dashboard/users')->with('success', 'Data berhasil diubah');
        }
    }

    // Delete Data
    public function delete($id)
    {
        $this->userModel->delete($id);
        
        if ($this->userModel->errors()) {
            return redirect()->to('/dashboard/users')->with('error', $this->userModel->errors());
        } else {
            return redirect()->to('/dashboard/users')->with('success', 'Data berhasil dihapus');
        }
    }
}
