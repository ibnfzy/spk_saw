<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<div class="d-grid gap-2 d-md-block mb-3">
  <button class="btn btn-primary shadow-lg" data-bs-toggle="modal" data-bs-target="#add"><i class="mdi mdi-plus"></i>
    Tambah
    Data</button>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card shadow-lg">
      <div class="card-header">
        <h3 class="card-title">Mata Pelajaran</h3>
      </div>
      <div class="card-body">
        <table id="datatables" class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Mata Pelajaran</th>
              <th>AKSI</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($data as $item): ?>
            <tr>
              <td>
                <?= $i++; ?>
              </td>
              <td>
                <?= $item['nama_mapel']; ?>
              </td>
              <td>
                <button onclick="editModal('<?= $item['id_mapel']; ?>', '<?= $item['nama_mapel']; ?>')"
                  class="btn btn-primary"><i class="mdi mdi-pen"></i> Edit </button>
                <a href="<?= base_url('AdmPanel/MataPelajaran/' . $item['id_mapel']); ?>" class="btn btn-danger"><i
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Mata Pelajaran</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('AdmPanel/MataPelajaran'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Nama Mata Pelajaran</label>
            <input type="text" class="form-control" name="nama_mapel">
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Mata Pelajaran</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('AdmPanel/MataPelajaran/Edit'); ?>" method="post">
        <input type="hidden" name="id_mapel" id="id_mapel">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Nama Mata Pelajaran</label>
            <input type="text" class="form-control" name="nama_mapel" id="nama_mapel">
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
function editModal(id_mapel, nama_mapel) {
  $('#id_mapel').val(id_mapel);
  $('#nama_mapel').val(nama_mapel);
  $('#edit').modal('toggle');
}
</script>

<?= $this->endSection(); ?>