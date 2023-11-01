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
        <h3 class="card-title">Kriteria</h3>
      </div>
      <div class="card-body">
        <table id="datatables" class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Kriteria</th>
              <th>Bobot</th>
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
                  <?= $item['nama_kriteria']; ?>
                </td>
                <td>
                  <?= $item['bobot']; ?>%
                </td>
                <td>
                  <button
                    onclick="modalEdit('<?= $item['nama_kriteria']; ?>', <?= $item['bobot']; ?>, '<?= $item['id_kriteria']; ?>')"
                    class="btn btn-primary"><i class="mdi mdi-pen"></i> Edit </button>
                  <a href="<?= base_url('AdmPanel/Kriteria/' . $item['id_kriteria']); ?>" class="btn btn-danger"><i
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

<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kriteria</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('AdmPanel/Kriteria'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Nama Kriteria</label>
            <input type="text" name="nama_kriteria" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Bobot</label>
            <div class="input-group">
              <input type="number" name="bobot" id="bobot" class="form-control">
              <div class="input-group-append">
                <span class="input-group-text">%</span>
              </div>
            </div>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kriteria</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('AdmPanel/Kriteria/Edit'); ?>" method="post">
        <div class="modal-body">
          <input type="hidden" name="id" id="id_kriteria">
          <div class="form-group">
            <label for="">Nama Kriteria</label>
            <input type="text" name="nama_kriteria" class="form-control" id="nama">
          </div>
          <div class="form-group">
            <label for="">Bobot</label>
            <div class="input-group">
              <input type="number" name="bobot" id="bobot_edit" class="form-control">
              <div class="input-group-append">
                <span class="input-group-text">%</span>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Ubah</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
  var id = document.getElementById('bobot')
  var idEdit = document.getElementById('bobot_edit')
  Inputmask('99').mask(id);
  Inputmask('99').mask(idEdit);

  function modalEdit(nama = '', bobot = 0, id) {
    $('#nama').val(nama);
    $('#bobot_edit').val(bobot)
    $('#id_kriteria').val(id)
    $('#edit').modal('toggle')
  }
</script>

<?= $this->endSection(); ?>