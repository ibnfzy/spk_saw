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
        return view('admin/home', [
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

        return view('admin/proses', [
            'alternatif' => $this->saw($data),
            'data' => $data,
            'mapel' => $this->db->table('mata_pelajaran')->get()->getResultArray(),
            'dataSiswa' => $this->db->table('siswa')->get()->getResultArray(),
            'kriteria' => $this->db->table('kriteria')->get()->getResultArray(),
            'normalisasi' => $this->normalisasi($data)
        ]);
    }

    public function tambah_alt()
    {
        return view('admin/alt_add', [
            'dataSiswa' => $this->db->table('siswa')->where('id_siswa', $this->request->getPost('id_siswa'))->get()->getRowArray(),
            'mapel' => $this->db->table('mata_pelajaran')->get()->getResultArray(),
            'kriteria' => $this->db->table('kriteria')->get()->getResultArray(),
        ]);
    }

    public function simpan_alt()
    {
        $this->db->table('rank')->where('id_siswa', $this->request->getPost('id_siswa'))->delete();
        $this->db->table('rank_detail')->where('id_siswa', $this->request->getPost('id_siswa'))->delete();

        $get = $this->db->table('siswa')->where('id_siswa', $this->request->getPost('id_siswa'))->get()->getRowArray();

        $this->db->table('rank')->insert([
            'id_kelas' => $get['id_kelas'],
            'id_siswa' => $get['id_siswa'],
        ]);

        $getLastRow = $this->db->table('rank')->orderBy('id_rank', 'DESC')->get()->getRowArray();

        $data = [];
        foreach ($this->request->getPost('alt') as $id_mapel => $alt) {
            foreach ($alt as $id_kriteria => $value) {
                $nilai = (int) str_replace('_', '', $value);

                $data[] = [
                    'id_rank' => $getLastRow['id_rank'],
                    'id_siswa' => $this->request->getPost('id_siswa'),
                    'id_mapel' => $id_mapel,
                    'id_kriteria' => $id_kriteria,
                    'nilai_alt' => $nilai
                ];
            }
        }

        $this->db->table('rank_detail')->insertBatch($data);

        return redirect()->to(base_url('AdmPanel/Rank'))->with('type-status', 'success')
            ->with('message', 'Data berhasil ditambahkan');
    }

    public function delete_alt($id)
    {
        $this->db->table('rank')->where('id_rank', $id)->delete();
        $this->db->table('rank_detail')->where('id_rank', $id)->delete();

        return redirect()->to(base_url('AdmPanel/Rank'))->with('type-status', 'success')
            ->with('message', 'Data berhasil dihapus');
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
            ->with('message', 'Data berhasil dihapus');
    }

    public function mapel()
    {
        return view('admin/mapel', [
            'data' => $this->db->table('mata_pelajaran')->get()->getResultArray(),
        ]);
    }

    public function mapel_add()
    {
        $rules = [
            'nama_mapel' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel/MataPelajaran'))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $this->db->table('mata_pelajaran')->insert([
            'nama_mapel' => $this->request->getPost('nama_mapel'),
        ]);

        return redirect()->to(base_url('AdmPanel/MataPelajaran'))->with('type-status', 'success')
            ->with('message', 'Data berhasil ditambahkan');
    }

    public function mapel_edit()
    {
        $rules = [
            'nama_mapel' => 'required',
            'id_mapel' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel/MataPelajaran'))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $this->db->table('mata_pelajaran')->where('id_mapel', $this->request->getPost('id_mapel'))->update([
            'nama_mapel' => $this->request->getPost('nama_mapel'),
        ]);

        return redirect()->to(base_url('AdmPanel/MataPelajaran'))->with('type-status', 'success')
            ->with('message', 'Data berhasil diubah');
    }

    public function mapel_delete($id)
    {
        $this->db->table('mata_pelajaran')->where('id_mapel', $id)->delete();

        return redirect()->to(base_url('AdmPanel/MataPelajaran'))->with('type-status', 'success')
            ->with('message', 'Data berhasil dihapus');
    }

    public function kelas()
    {
        return view('admin/kelas', [
            'data' => $this->db->table('kelas')->get()->getResultArray(),
            'dataMapel' => $this->db->table('mata_pelajaran')->get()->getResultArray(),
        ]);
    }

    public function kelas_mapel($id)
    {
        $get = $this->db->table('kelas_mapel')->where('id_kelas', $id)->get()->getResultArray();

        $data = [];

        foreach ($get as $row) {
            $kelas = $this->db->table('mata_pelajaran')->where('id_mapel', $row['id_mapel'])->get()->getRowArray();

            $data[] = [
                'id_kelas_mapel' => $row['id_kelas_mapel'],
                'nama_mapel' => $kelas['nama_mapel']
            ];
        }

        return $this->response->setJSON($data);
    }

    public function kelas_mapel_delete($id)
    {
        $this->db->table('kelas_mapel')->where('id_kelas_mapel', $id)->delete();

        return redirect()->to(base_url('AdmPanel/Kelas'))->with('type-status', 'success')
            ->with('message', 'Data berhasil dihapus');
    }

    public function kelas_mapel_add()
    {
        $rules = [
            'id_kelas' => 'required',
            'id_mapel' => 'required|is_unique[kelas_mapel.id_mapel]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel/Kelas'))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $this->db->table('kelas_mapel')->insert([
            'id_kelas' => $this->request->getPost('id_kelas'),
            'id_mapel' => $this->request->getPost('id_mapel'),
        ]);

        return redirect()->to(base_url('AdmPanel/Kelas'))->with('type-status', 'success')
            ->with('message', 'Data berhasil ditambahkan');
    }

    public function kelas_add()
    {
        $rules = [
            'nama_kelas' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel/Kelas'))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $this->db->table('kelas')->insert([
            'nama_kelas' => $this->request->getPost('nama_kelas'),
        ]);

        return redirect()->to(base_url('AdmPanel/Kelas'))->with('type-status', 'success')
            ->with('message', 'Data berhasil ditambahkan');
    }

    public function kelas_edit()
    {
        $rules = [
            'nama_kelas' => 'required',
            'id_kelas' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel/Kelas'))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $this->db->table('kelas')->where('id_kelas', $this->request->getPost('id_kelas'))->update([
            'nama_kelas' => $this->request->getPost('nama_kelas'),
        ]);

        return redirect()->to(base_url('AdmPanel/Kelas'))->with('type-status', 'success')
            ->with('message', 'Data berhasil diubah');
    }

    public function kelas_delete($id)
    {
        $this->db->table('kelas')->where('id_kelas', $id)->delete();

        return redirect()->to(base_url('AdmPanel/Kelas'))->with('type-status', 'success')
            ->with('message', 'Data berhasil dihapus');
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