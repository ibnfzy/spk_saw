<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a style="font-weight: bolder;" class="navbar-brand brand-logo" href="<?= base_url('AdmPanel') ?>"> Siswa Panel</a>
    <a class="navbar-brand brand-logo-mini" href="<?= base_url() ?>"><img
        src="<?= base_url() ?>assets/images/logo-mini.svg" alt="logo" /></a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-stretch">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
    </button>
    <ul class="navbar-nav navbar-nav-right">

      <li class="nav-item nav-logout d-none d-lg-block">
        <a class="nav-link" href="<?= base_url('Destroy'); ?>">
          <i class="mdi mdi-logout"></i> Keluar
        </a>
      </li>

    </ul>
  </div>
</nav>