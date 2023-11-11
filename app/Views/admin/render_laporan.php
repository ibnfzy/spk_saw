<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<?php $db = \Config\Database::connect(); ?>

<div class="row">
  <div class="col-lg-12">
    <div class="card shadow-lg">
      <div class="card-header">
        <h3 class="card-title">
          Proses Perankingan
        </h3>
      </div>

      <div class="card-body">
        <h5>Data Alternatif</h5>
        <table id="alternatif" class="table table-bordered">
          <thead>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <?php foreach ($mapel as $item): ?>
              <th>
                <?= $item['nama_mapel']; ?>
              </th>
            <?php endforeach ?>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($dataSiswa as $siswa): ?>
              <?php
              $get = $db->table('kelas')->where('id_kelas', $siswa['id_kelas'])->get()->getRowArray();
              ?>
              <tr>
                <td>
                  <?= $i++; ?>
                </td>
                <td>
                  <?= $siswa['nama_siswa']; ?>
                </td>
                <td>
                  <?= $get['nama_kelas'] ?? 'Kelas tidak ditemukan'; ?>
                </td>
                <?php foreach ($mapel as $d): ?>
                  <?php

                  $nilaiArr = [];
                  $isNull = true;

                  foreach ($kriteria as $f) {
                    $alt = $db->table('rank_detail')->where('id_mapel', $d['id_mapel'])->where('id_siswa', $siswa['id_siswa'])->where('id_kriteria', $f['id_kriteria'])->get()->getRowArray();
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
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>

        <hr>

        <h5>Data Normalisasi</h5>
        <table id="normalisasi" class="table table-bordered">
          <thead>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Total Nilai</th>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($normalisasi as $k):
              $getSiswa = $db->table('siswa')->where('id_siswa', $k['id_siswa'])->get()->getRowArray();
              $getKelas = $db->table('kelas')->where('id_kelas', $getSiswa['id_kelas'])->get()->getRowArray();
              ?>
              <tr>
                <td>
                  <?= $i++; ?>
                </td>
                <td>
                  <?= $getSiswa['nama_siswa']; ?>
                </td>
                <td>
                  <?= $getKelas['nama_kelas'] ?? 'Kelas Tidak Ditemukan'; ?>
                </td>
                <td>
                  <?= $k['total']; ?>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>

        <hr>

        <h5>Proses Perankingan</h5>
        <table id="ranking" class="table table-bordered">
          <thead>
            <th>Rank</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Total Nilai</th>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($alternatif as $m):
              $getSiswa = $db->table('siswa')->where('id_siswa', $m['id_siswa'])->get()->getRowArray();
              $getKelas = $db->table('kelas')->where('id_kelas', $getSiswa['id_kelas'])->get()->getRowArray();
              ?>
              <tr>
                <td>
                  <?= $i++; ?>
                </td>
                <td>
                  <?= $getSiswa['nama_siswa']; ?>
                </td>
                <td>
                  <?= $getKelas['nama_kelas'] ?? 'Kelas Tidak Ditemukan'; ?>
                </td>
                <td>
                  <?= $m['total']; ?>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
  $(document).ready(function () {
    const d = new Date()
    const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
      "Oktober",
      "November", "December"
    ];
    let month = months[d.getMonth()];
    let fulldate = d.getDate() + ' ' + month + ' ' + d.getFullYear();
    var doc = new jspdf.jsPDF();

    doc.setFontSize(17)
    doc.text('LAPORAN HASIL PERANKINGAN SISWA', 110, 10, 'center');
    doc.text('SMK MUHAMMADIYAH 2 BONTOALA MAKASSAR', 110, 15, 'center');

    doc.autoTable({
      html: '#alternatif',
      margin: {
        top: 30
      },
      autoPaging: 'text',
      cellWidth: 'auto'
    })

    var finalY = doc.lastAutoTable.finalY

    doc.autoTable({
      html: '#normalisasi',
      margin: {
        top: 30
      },
      autoPaging: 'text',
      cellWidth: 'auto',
    })

    doc.autoTable({
      html: '#ranking',
      margin: {
        top: 30
      },
      autoPaging: 'text',
      cellWidth: 'auto',
    })

    var string = doc.output('datauristring', 'laporan.pdf');
    var iframe = "<iframe width='100%' height='100%' src='" + string + "'></iframe>"
    window.document.open();
    window.document.write(iframe);
    window.document.close();
  });
</script>
<?= $this->endSection(); ?>