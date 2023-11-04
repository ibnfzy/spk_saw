<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<div class="row">
  <div class="col-lg-12">
    <div class="card shadow-lg">
      <div class="card-header">
        <h3 class="card-title">Form Tambah Data Alternatif</h3>
      </div>
      <form action="#" method="post">
        <div class="card-body">
          <div class="col-6">

            <div class="form-group">
              <label for="">Pilih Siswa</label>
              <select name="id_siswa" id="id_siswa" class="form-control">
                <?php foreach ($siswa as $item): ?>
                <option value="<?= $item['id_siswa']; ?>">
                  <?= $item['nama_siswa']; ?>
                </option>
                <?php endforeach ?>
              </select>
            </div>

          </div>

          <hr>
        </div>
        <div class="card-footer">
          <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>