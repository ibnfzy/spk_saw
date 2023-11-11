<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<div class="row">
  <div class="col-lg-12">
    <div class="card shadow-lg">
      <div class="card-header">
        <h3 class="card-title">Laporan Hasil Perankingan</h3>
      </div>
      <div class="card-body">
        <form action="#" method="post">

          <div class="mb-3">
            <label for="kelas">Pilih Kelas</label>
            <select name="kelas" id="kelas" class="form-control">
              <?php foreach ($data as $item): ?>
                <option value="<?= $item['id_kelas']; ?>">
                  <?= $item['nama_kelas']; ?>
                </option>
              <?php endforeach ?>
            </select>
          </div>

          <button type="submit" class="btn btn-gradient-info">Download</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>