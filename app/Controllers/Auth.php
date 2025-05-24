<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class Auth extends BaseController
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        return view('auth/login');
    }

    public function register()
    {

        $uri = service('uri');

        // Check url request if request is pemilik kos
        if ($uri->getSegment(2) == 'pemilik') {

            // Making Data
            $data = [
                'title' => 'Register Pemilik Kos',
                'page' => 'auth/register',
                'password' => 'pemilik123',
                'level' => 'Pemilik Kos'
            ];

            return view('auth/register', $data);
        }

        // Check url request if request is pencari kos
        elseif ($uri->getSegment(1) == 'register') {

            // Making Data
            $data = [
                'title' => 'Register Pencari Kos',
                'page' => 'auth/register',
                'password' => 'pencari123',
                'level' => 'Pencari Kos'
            ];

            return view('auth/register', $data);
        }
    }

    public function changePassword()
    {
        $data = [
            'title' => 'Change Password',
            'page' => 'auth/changePassword'
        ];

        return view('auth/changePassword', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'Anda berhasil logout');
    }

    public function registerUser()
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
            'password'      => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'level'         => $this->request->getPost('level'),
            'status'        => 'Unverified',
            'created_at'    => date('Y-m-d H:i:s'),
        ];

        // Inserting Data
        $this->userModel->insert($data);

        // Redirect back with alert in javascript
        return redirect()->to('/login')->with('success', 'Data berhasil ditambahkan');
    }

    public function checkLogin()
    {

        // getting form data
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('email', $email)->get()->getFirstRow('array');

        if ($user) {
            if (password_verify($password, $user['password'])) {

                // default password
                $defaultPassword = ['admin123', 'pencari123', 'pemilik123'];

                // variable is default
                $isDefault = false;

                // Looping
                foreach ($defaultPassword as $pass) {
                    if (password_verify($pass, $user['password'])) {
                        $isDefault = true;
                    }
                }

                session()->set([
                    'isLoggedIn' => true,
                    'email' => $user['email'],
                    'name' => $user['name'],
                    'level' => $user['level'],
                    'photo' => $user['foto'],
                    'password' => $isDefault,
                    'account' => $user['account'],
                    'status' => $user['status'],
                    'id' => $user['id']
                ]);
                
                if ($user['level'] == 'Admin') {
                    return redirect()->to('/dashboard')->with('success', 'Login Berhasil');
                } elseif ($user['level'] == 'Pencari Kos') {
                    return redirect()->to('/')->with('success', 'Login Berhasil');
                } elseif ($user['level'] == 'Pemilik Kos') {
                    return redirect()->to('/dashboard/kos')->with('success', 'Login Berhasil');
                }

            } else {
                return redirect()->to('/login')->withInput()->with('errors', 'Password / Email Salah');
            }
        } else {
            return redirect()->to('/login')->withInput()->with('errors', 'Password / Email Salah');
        }
    }
}
