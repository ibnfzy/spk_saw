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
        return view('admin/kriteria');
    }

    public function siswa()
    {
        return view('admin/siswa');
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