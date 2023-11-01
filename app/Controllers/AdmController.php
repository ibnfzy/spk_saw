<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdmController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('admin/home');
    }

    public function kriteria()
    {
        return view('admin/kriteria', [
            'data' => $this->db->table('kriteria')->get()->getResultArray()
        ]);
    }

    public function kriteria_create()
    {
        $rules = [
            'nama_kriteria' => 'required',
            'bobot' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel/Kriteria'))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $this->db->table('kriteria')->insert([
            'nama_kriteria' => $this->request->getPost('nama_kriteria'),
            'bobot' => $this->request->getPost('bobot'),
        ]);

        return redirect()->to(base_url('AdmPanel/Kriteria'))->with('type-status', 'success')
            ->with('message', 'Data berhasil ditambahkan');
    }

    public function kriteria_edit()
    {
        $rules = [
            'id_kriteria' => 'required',
            'nama_kriteria' => 'required',
            'bobot' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel/Kriteria'))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $this->db->table('kriteria')->where('id_kriteria', $this->request->getPost('id'))->update([
            'nama_kriteria' => $this->request->getPost('nama_kriteria'),
            'bobot' => $this->request->getPost('bobot'),
        ]);

        return redirect()->to(base_url('AdmPanel/Kriteria'))->with('type-status', 'success')
            ->with('message', 'Data berhasil diubah');
    }

    public function kriteria_delete($id)
    {
        $this->db->table('kriteria')->where('id_kriteria', $id)->delete();

        return redirect()->to(base_url('AdmPanel/Kriteria'))->with('type-status', 'success')
            ->with('message', 'Data berhasil dihapus');
    }

    public function siswa()
    {
        return view('admin/siswa', [
            'data' => $this->db->table('siswa')->get()->getResultArray(),
            'kelas' => $this->db->table('kelas')->get()->getResultArray(),
        ]);
    }

    public function siswa_add()
    {
        $rules = [
            'id_kelas' => 'required',
            'nama_siswa' => 'required|max_length[60]',
            'username' => 'required|max_length[25]|is_unique[siswa.username]',
            'password' => 'required|max_length[16]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel/Siswa'))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $this->db->table('siswa')->insert([
            'id_kelas' => $this->request->getPost('id_kelas'),
            'nama_siswa' => $this->request->getPost('nama_siswa'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);

        return redirect()->to(base_url('AdmPanel/Siswa'))->with('type-status', 'success')
            ->with('message', 'Data berhasil ditambahkan');
    }

    public function siswa_edit()
    {
        $rules = [
            'id_siswa' => 'required',
            'id_kelas' => 'required',
            'nama_siswa' => 'required|max_length[60]',
        ];

        if ($this->request->getPost('username') != $this->request->getPost('username_old')) {
            $rules['username'] = 'required|max_length[25]|is_unique[siswa.username]';
        } else {
            $rules['username'] = 'required|max_length[25]';
        }

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel/Siswa'))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $this->db->table('siswa')->where('id_siswa', $this->request->getPost('id_siswa'))->update([
            'id_kelas' => $this->request->getPost('id_kelas'),
            'nama_siswa' => $this->request->getPost('nama_siswa'),
            'username' => $this->request->getPost('username'),
        ]);

        return redirect()->to(base_url('AdmPanel/Siswa'))->with('type-status', 'success')
            ->with('message', 'Data berhasil diubah');
    }

    public function siswa_password()
    {
        $rules = [
            'id_siswa' => 'required',
            'password' => 'required|max_length[16]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel/Siswa'))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $this->db->table('siswa')->where('id_siswa', $this->request->getPost('id_siswa'))->update([
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);

        return redirect()->to(base_url('AdmPanel/Siswa'))->with('type-status', 'success')
            ->with('message', 'Data berhasil diubah');
    }

    public function siswa_delete($id)
    {
        $this->db->table('siswa')->where('id_siswa', $id)->delete();

        return redirect()->to(base_url('AdmPanel/Siswa'))->with('type-status', 'success')
            ->with('message', 'Data berhasil diubah');
    }

    public function mapel()
    {
        return view('admin/mapel');
    }

    public function kelas()
    {
        return view('admin/kelas');
    }

    public function laporan()
    {
        return view('admin/laporan');
    }
}