<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<div class="row">
  <div class="col-lg-12">
    <div class="card shadow-lg">
      <div class="card-header">
        <h3 class="card-title">Form Tambah Data Alternatif</h3>
      </div>
      <form action="#" method="post">
        <input type="hidden" name="id_siswa" value="<?= $dataSiswa['id_siswa']; ?>">
        <div class="card-body">
          <div class="col-6">

            <div class="form-group">
              <label for="">Siswa</label>
              <input type="text" class="form-control" readonly value="<?= $dataSiswa['nama_siswa']; ?>">
            </div>

          </div>

          <hr>

          <div class="row">
            <?php foreach ($mapel as $item): ?>
            <div class="col-md-6">
              <div class="col-sm-4">
                <h4 class="font-weight-bold">
                  <?= $item['nama_mapel']; ?>
                </h4>

                <hr>
              </div>

              <?php foreach ($kriteria as $alt): ?>
              <div class="form-group">
                <label for="">
                  <?= $alt['nama_kriteria']; ?>
                </label>
                <input type="text" class="form-control nilai"
                  name="alt[<?= $item['id_mapel'] ;?>][<?= $alt['id_kriteria'] ;?>]">
              </div>
              <?php endforeach ?>
            </div>
            <?php endforeach ?>
          </div>

        </div>
        <div class="card-footer">
          <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
inputNilai = document.getElementsByClassName('nilai');

Inputmask('999').mask(inputNilai);
</script>

<?= $this->endSection(); ?>