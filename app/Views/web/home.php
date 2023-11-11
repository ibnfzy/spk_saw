<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>SMK MUHAMMADIYAH 2 BONTOALA MAKASSAR</title>



  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/bootstrap.css" />
  <!-- progress barstle -->
  <link rel="stylesheet" href="<?= base_url(); ?>css/css-circular-prog-bar.css">
  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
  <!-- font wesome stylesheet -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <!-- Custom styles for this template -->
  <link href="<?= base_url(); ?>css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="<?= base_url(); ?>css/responsive.css" rel="stylesheet" />




  <link rel="stylesheet" href="<?= base_url(); ?>css/css-circular-prog-bar.css">


</head>

<body>
  <div class="top_container">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="<?= base_url(''); ?>">
            <span>
              SMK MUHAMMADIYAH 2 BONTOALA MAKASSAR
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav  ">
                <li class="nav-item active">
                  <a class="nav-link" href="<?= base_url(''); ?>"> Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?= base_url('AdmPanel'); ?>"> Login Admin </a>
                </li>

                <li class="nav-item ">
                  <a class="nav-link" href="<?= base_url(); ?>"> Login Siswa </a>
                </li>

              </ul>
            </div>
        </nav>
      </div>
    </header>
    <section class="hero_section ">
      <div class="hero-container container">
        <div class="hero_detail-box">
          <h3>
            Selamat datang <br>
            di Website SMK MUHAMMADIYAH 2
          </h3>
          <h1>
            BONTOALA MAKASSAR
          </h1>
          <p>
            Website ini berfungsi sebagai perankingan siswa berprestasi
          </p>
        </div>
        <div class="hero_img-container">
          <div>
            <img src="<?= base_url(); ?>images/hero.png" alt="" class="img-fluid">
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- end header section -->

  <!-- footer section -->
  <section class="container-fluid footer_section">
    <p>
      Copyright &copy; All Rights Reserved By JULTDEV
    </p>
  </section>
  <!-- footer section -->

  <script type="text/javascript" src="<?= base_url(); ?>js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="<?= base_url(); ?>js/bootstrap.js"></script>
</body>

</html>