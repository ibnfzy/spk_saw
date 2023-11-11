<?= $this->extend('user/base'); ?>

<?= $this->section('content'); ?>

<?php $db = \Config\Database::connect(); ?>

<div class="d-grid gap-2 d-md-block mb-3">
  <a href="<?= base_url('Panel/Rank/Execute'); ?>" class="btn btn-gradient-info shadow-lg"><i
      class="mdi mdi-plus-outline"></i> Proses Ranking</a>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card shadow-lg">
      <div class="card-header">
        <h3 class="card-title">Perankingan</h3>
      </div>
      <div class="card-body">
        <table id="datatables" class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Siswa</th>
              <th>Kelas</th>
              <?php foreach ($mapel as $item): ?>
                <th>
                  <?= $item['nama_mapel']; ?>
                </th>
              <?php endforeach ?>
              <th>AKSI</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            $idRank = null;
            foreach ($data as $item): ?>
              <?php
              $get = $db->table('kelas')->where('id_kelas', $item['id_kelas'])->get()->getRowArray();
              ?>
              <tr>
                <td>
                  <?= $i++; ?>
                </td>
                <td>
                  <?= $item['nama_siswa']; ?>
                </td>
                <td>
                  <?= $get['nama_kelas'] ?? 'Kelas tidak ditemukan'; ?>
                </td>
                <?php foreach ($mapel as $d): ?>
                  <?php

                  $nilaiArr = [];
                  $isNull = true;

                  foreach ($kriteria as $f) {
                    $alt = $db->table('rank_detail')->where('id_mapel', $d['id_mapel'])->where('id_siswa', $item['id_siswa'])->where('id_kriteria', $f['id_kriteria'])->get()->getRowArray();
                    $idRank = $alt['id_rank'] ?? null;

                    $nilaiAlt = $alt['nilai_alt'] ?? 0;
                    $isNull = !isset($alt['nilai_alt']) ? true : false;

                    $nilaiArr[] = $nilaiAlt * ($f['bobot'] / 100);
                  }

                  ?>
                  <td>
                    <?= ($isNull) ? 0 : array_sum($nilaiArr); ?>
                  </td>
                <?php endforeach ?>
                <td>
                  <?php if ($idRank != null): ?>
                    <a href="<?= base_url('AdmPanel/Rank/' . $idRank); ?>" class="btn btn-danger"><i
                        class="mdi mdi-delete"></i> Hapus
                      Nilai</a>
                  <?php else: ?>
                    <a href="#" class="btn btn-danger"><i class="mdi mdi-delete"></i> Hapus
                      Nilai</a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Siswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('AdmPanel/Rank/Add'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <select name="id_siswa" id="" class="form-control">
              <?php foreach ($data as $item): ?>
                <option value="<?= $item['id_siswa']; ?>">
                  <?= $item['nama_siswa']; ?>
                </option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Proses</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>