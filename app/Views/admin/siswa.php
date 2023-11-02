<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<?php $db = \Config\Database::connect(); ?>

<div class="d-grid gap-2 d-md-block mb-3">
  <button class="btn btn-primary shadow-lg" data-bs-toggle="modal" data-bs-target="#add"><i class="mdi mdi-plus"></i>
    Tambah
    Data</button>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card shadow-lg">
      <div class="card-header">
        <h3 class="card-title">Siswa</h3>
      </div>
      <div class="card-body">
        <table id="datatables" class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Siswa</th>
              <th>Kelas</th>
              <th>AKSI</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($data as $item):
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
                  <?= $get['nama_kelas'] ?? 'Kelas Tidak Ditemukan'; ?>
                </td>
                <td>
                  <button
                    onclick="editModal('<?= $item['id_kelas']; ?>', '<?= $item['nama_siswa']; ?>', '<?= $item['username']; ?>', '<?= $item['id_siswa']; ?>')"
                    class="btn btn-primary"><i class="mdi mdi-pen"></i> Edit </button>
                  <button onclick="passwordModal('<?= $item['id_siswa']; ?>')" class="btn btn-info"><i
                      class="mdi mdi-key"></i> Ubah Password </button>
                  <a href="<?= base_url('AdmPanel/Siswa/' . $item['id_siswa']); ?>" class="btn btn-danger"><i
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Siswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('AdmPanel/Siswa'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Pilih Kelas</label>
            <select name="id_kelas" id="id_kelas" class="form-control">
              <?php foreach ($kelas as $item): ?>
                <option value="<?= $item['id_kelas']; ?>">
                  <?= $item['nama_kelas']; ?>
                </option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label for="">Nama Siswa</label>
            <input type="text" class="form-control" name="nama_siswa">
          </div>
          <div class="form-group">
            <label for="">Username</label>
            <input type="text" class="form-control" name="username">
          </div>
          <div class="form-group">
            <label for="">Password</label>
            <input type="password" class="form-control" name="password">
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Siswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('AdmPanel/Siswa/Edit'); ?>" method="post">
        <input type="hidden" name="username_old" id="username_old">
        <input type="hidden" name="id_siswa" id="id_siswa">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Pilih Kelas</label>
            <select name="id_kelas" id="id_kelas" class="form-control">
              <?php foreach ($kelas as $item): ?>
                <option id="<?= $item['id_kelas']; ?>" value="<?= $item['id_kelas']; ?>">
                  <?= $item['nama_kelas']; ?>
                </option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label for="">Nama Siswa</label>
            <input type="text" class="form-control" name="nama_siswa" id="nama_siswa">
          </div>
          <div class="form-group">
            <label for="">Username</label>
            <input type="text" class="form-control" name="username" id="username">
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

<div class="modal fade" id="password_update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('AdmPanel/Siswa/Pwd'); ?>" method="post">
        <input type="hidden" name="username_old" id="username_old">
        <input type="hidden" name="id_siswa" id="id_siswa">
        <div class="modal-body">
          <input type="hidden" name="id_siswa" id="id_siswa">
          <div class="form-group">
            <label for="">Password Baru</label>
            <input type="password" class="form-control" name="password" id="password">
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
  function editModal(id_kelas, nama_siswa, username, id_siswa) {
    $('#' + id_kelas).attr('selected');
    $('#username').val(username);
    $('#username_old').val(username);
    $('#id_siswa').val(id_siswa);
    $('#nama_siswa').val(nama_siswa);
    $('#edit').modal('toggle');
  }

  function passwordModal(id_siswa) {
    $('#id_siswa').val(id_siswa);
    $('#password_update').modal('toggle');
  }
</script>

<?= $this->endSection(); ?>