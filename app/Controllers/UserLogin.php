<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UserLogin extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('login/siswa');
    }

    public function auth()
    {
        $session = session();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $data = $this->db->table('siswa')->where('username', $username)->get()->getRowArray();

        if ($data) {
            $password_data = $data['password'];
            $id = $data['id_siswa'];

            $verify = password_verify($password ?? '', $password_data);

            if ($verify) {
                $sessionData = [
                    'id_siswa' => $data['id_siswa'],
                    'fullname_siswa' => $data['nama_siswa'],
                    'username_siswa' => $data['username'],
                    'logged_in_siswa' => TRUE
                ];

                $session->set($sessionData);
                // $session->markAsTempdata('logged_in_siswa', 1800); //timeout 30 menit

                return redirect()->to(base_url('Panel'))->with('type-status', 'info')
                    ->with('message', 'Selamat Datang Kembali ' . $sessionData['fullname_siswa']);
            } else {
                return redirect()->to(base_url('Login'))->with('type-status', 'error')
                    ->with('message', 'Password tidak benar');
            }
        } else {
            return redirect()->to(base_url('Login'))->with('type-status', 'error')
                ->with('message', 'Username tidak benar');
        }
    }

    public function logoff()
    {
        $session = session();

        $session->destroy();

        return redirect()->to(base_url('Login'));
    }
}