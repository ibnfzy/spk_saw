<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('user/home', [
            'data' => $this->db->table('siswa')->get()->getResultArray(),
            'mapel' => $this->db->table('mata_pelajaran')->get()->getResultArray(),
            'kriteria' => $this->db->table('kriteria')->get()->getResultArray(),
        ]);
    }

    public function saw($alternatif)
    {
        $rank = 1;

        foreach ($alternatif as $key => $alt) {
            $alternatif[$key]['total'] = $alt['total_nilai'] / 1000;
        }

        usort($alternatif, function ($a, $b) {
            return $b['total'] <=> $a['total'];
        });

        foreach ($alternatif as $key => $alt) {
            $this->db->table('rank')->where('id_rank', $alt['id_rank'])->update([
                'rank' => $rank++
            ]);
        }

        // $alternatif_terbaik = $alternatif[0];

        return $alternatif;
    }

    public function normalisasi($alternatif)
    {
        foreach ($alternatif as $key => $alt) {
            $alternatif[$key]['total'] = $alt['total_nilai'] / 1000;
        }

        return $alternatif;
    }

    public function proses()
    {
        // ganti ini
        $data = $this->db->query("SELECT DISTINCT id_siswa, SUM(nilai_alt) as total_nilai, id_rank FROM `rank_detail` GROUP BY id_siswa;")->getResultArray();

        return view('user/proses', [
            'alternatif' => $this->saw($data),
            'data' => $data,
            'mapel' => $this->db->table('mata_pelajaran')->get()->getResultArray(),
            'dataSiswa' => $this->db->table('siswa')->get()->getResultArray(),
            'kriteria' => $this->db->table('kriteria')->get()->getResultArray(),
            'normalisasi' => $this->normalisasi($data)
        ]);
    }

    public function render_laporan()
    {
        $data = $this->db->query("SELECT DISTINCT id_siswa, SUM(nilai_alt) as total_nilai, id_rank FROM `rank_detail` GROUP BY id_siswa;")->getResultArray();

        return view('admin/render_laporan', [
            'alternatif' => $this->saw($data),
            'data' => $data,
            'mapel' => $this->db->table('mata_pelajaran')->get()->getResultArray(),
            'dataSiswa' => $this->db->table('siswa')->get()->getResultArray(),
            'kriteria' => $this->db->table('kriteria')->get()->getResultArray(),
            'normalisasi' => $this->normalisasi($data)
        ]);
    }
}