<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<div class="d-grid gap-2 d-md-block mb-3">
  <a href="#" class="btn btn-gradient-primary shadow-lg"><i class="mdi mdi-plus"></i> Tambah
    Data</a>
  <a href="#" class="btn btn-gradient-info shadow-lg"><i class="mdi mdi-plus-outline"></i> Proses Ranking</a>
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
              <th>MAPEL 1</th>
              <th>MAPEL 2</th>
              <th>AKSI</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Agung</td>
              <td>Agung</td>
              <td>34</td>
              <td>60</td>
              <td>
                <a href="#" class="btn btn-info"><i class="mdi mdi-pen"></i> Edit </a>
                <a href="#" class="btn btn-danger"><i class="mdi mdi-delete"></i> Hapus</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>