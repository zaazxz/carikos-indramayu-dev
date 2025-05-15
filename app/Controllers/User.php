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
            'title' => 'Edit User ' . $user[0]['name'],
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

    public function customize($id)
    {

        // Getting user name
        $user = $this->userModel->getDataWhere($id);

        $data = [
            'title' => 'Customize User',
            'page' => 'template/backend/users/customize',
            'user' => $user
        ];
        return view('template/backend/index', $data);
    }

    public function customizeUpdate($id)
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
            ],
            'account' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Akun Bank tidak boleh kosong'
                ]
            ],
            'account_username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username Akun Bank tidak boleh kosong'
                ]
            ],
            'account_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor Akun Bank tidak boleh kosong'
                ]
            ],
        ]));

        $file = $this->request->getFile('foto');
        $name_file = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {

            // Validasi manual untuk foto
            if (!in_array($file->getMimeType(), ['image/jpg', 'image/jpeg', 'image/png'])) {
                return redirect()->back()->withInput()->with('error', 'File yang diupload bukan gambar yang valid.');
            }

            // Ambil nama file
            $name_file = $file->getName();

            // Hapus foto lama kalau ada
            $old_foto = $this->userModel->find($id)['foto'];
            if ($old_foto && file_exists(ROOTPATH . 'public/upload/user/' . $old_foto)) {
                unlink(ROOTPATH . 'public/upload/user/' . $old_foto);
            }

            // Pindah file
            $file->move(ROOTPATH . 'public/upload/user', $name_file);
        } else {

            // Tetap gunakan foto lama kalau tidak upload baru
            $name_file = $this->userModel->find($id)['foto'];
        }

        // check account username, id, and account if not exist set to null
        if (!$this->request->getPost('account_username')) {
            $account_username = null;
        } else {
            $account_username = $this->request->getPost('account_username');
        }

        if (!$this->request->getPost('account_id')) {
            $account_id = null;
        } else {
            $account_id = $this->request->getPost('account_id');
        }

        if ($this->request->getPost('account') == 'null') {
            $account = null;
        } else {
            $account = $this->request->getPost('account');
        }

        // Making data variable for insert
        $data = [
            'name'              => $this->request->getPost('name'),
            'email'             => $this->request->getPost('email'),
            'phone'             => $this->request->getPost('phone'),
            'account'           => $account,
            'account_username'  => $account_username,
            'account_id'        => $account_id,
            'foto'              => $name_file,
            'updated_at'        => date('Y-m-d H:i:s')
        ];

        // Inserting Data
        $this->userModel->update($id, $data);

        // Redirect back with alert in javascript
        if ($this->userModel->errors()) {
            return redirect()->to('/dashboard')->with('error', $this->userModel->errors());
        } else {

            // destroy session
            session()->destroy();

            return redirect()->to('/login')->with('success', 'Data berhasil diubah');
        }
    }

    public function changePassword($id)
    {
        $data = [
            'title' => 'Change Password',
            'page' => 'template/backend/users/changePassword',
            'user' => $this->userModel->getDataWhere($id)
        ];
        return view('template/backend/index', $data);
    }

    public function changePasswordUpdate($id)
    {

        // Validating
        if ($this->validate([
            'oldpassword' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password tidak boleh kosong'
                ]
            ],
            'newpassword' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password tidak boleh kosong'
                ]
            ],
        ]));

        // Check apakah password lama sesuai dengan password di database
        if (password_verify($this->request->getPost('oldpassword'), $this->userModel->find($id)['password'])) {

            // Making data variable for insert
            $data = [
                'password'          => password_hash($this->request->getPost('newpassword'), PASSWORD_DEFAULT),
                'updated_at'        => date('Y-m-d H:i:s')
            ];

            // Updating Data
            $this->userModel->update($id, $data);

            // Redirect back with alert in javascript
            if ($this->userModel->errors()) {

                // destroy session
                session()->destroy();

                return redirect()->to('/login')->with('error', $this->userModel->errors());

            } else {
                return redirect()->to('/dashboard')->with('success', 'Password berhasil diubah');
            }
        } else {

            // Redirect back with alert in javascript
            return redirect()->to('/dashboard')->with('error', 'Password lama salah');

        }
    }

    public function verification($id)
    {
        $data = [
            'status' => "Verified",
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $this->userModel->update($id, $data);
        
        if ($this->userModel->errors()) {
            return redirect()->to('/dashboard/users')->withInput()->with('error', $this->userModel->errors());
        } else {
            return redirect()->to('/dashboard/users')->with('success', 'Data berhasil diverifikasi');
        }

    }
}
