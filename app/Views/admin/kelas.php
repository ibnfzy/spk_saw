<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<?php $db = \Config\Database::connect(); ?>

<div class="d-grid gap-2 d-md-block mb-3">
  <button data-bs-toggle="modal" data-bs-target="#add" class="btn btn-primary shadow-lg"><i class="mdi mdi-plus"></i>
    Tambah
    Data Kelas</button>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card shadow-lg">
      <div class="card-header">
        <h3 class="card-title">Kelas</h3>
      </div>
      <div class="card-body">
        <table id="datatables" class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Kelas</th>
              <th>Jumlah Siswa</th>
              <th>AKSI</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($data as $item): ?>
            <?php
              $get = count($db->table('siswa')->where('id_kelas', $item['id_kelas'])->get()->getResultArray());
              ?>
            <tr>
              <td>
                <?= $i++; ?>
              </td>
              <td>
                <?= $item['nama_kelas']; ?>
              </td>
              <td>
                <?= $get; ?>
              </td>
              <td>
                <button onclick="editModal('<?= $item['id_kelas']; ?>', '<?= $item['nama_kelas']; ?>')"
                  class="btn btn-primary"><i class="mdi mdi-pen"></i> Edit </button>

                <a href="<?= base_url('AdmPanel/Kelas/' . $item['id_kelas']); ?>" class="btn btn-danger"><i
                    class="mdi mdi-delete"></i> Hapus</a>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kelas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('AdmPanel/Kelas'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Nama Kelas</label>
            <input type="text" class="form-control" name="nama_kelas">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kelas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('AdmPanel/Kelas/Edit'); ?>" method="post">
        <input type="hidden" name="id_kelas" id="id_kelas">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Nama Kelas</label>
            <input type="text" class="form-control" name="nama_mapel" id="nama_kelas">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
function editModal(id_kelas, nama_kelas) {
  $('#id_kelas').val(id_kelas);
  $('#nama_kelas').val(nama_kelas);
  $('#edit').modal('toggle');
}
</script>

<?= $this->endSection(); ?>