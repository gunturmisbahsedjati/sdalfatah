<?php
include_once '../manajemen/inc/inc.koneksi.php';
$viewSejarah = mysqli_fetch_array(mysqli_query($myConnection, "select sejarah, foto_sejarah from tb_profil_sekolah where id_profil = 1"));
$title = "Sejarah Sekolah";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $title ?> | SD AL-FATAH Surabaya | Official Website</title>
  <meta content="" name="description">

  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/sd.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css?rev=<?= time() ?>" rel="stylesheet">

  <!-- =======================================================
  * Template Name: FlexStart - v1.4.0
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <!-- <div class="cr cr-bottom cr-right cr-sticky cr-red">Dev Mode</div> -->
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <img src="../assets/img/logo-oke.png" alt="">
        <!-- <span>FlexStart</span> -->
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="../">Home</a></li>
          <li class="dropdown"><a href="#"><span>Profil</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="../sejarah">Sejarah</a></li>
              <li><a href="../visimisi">Visi dan Misi</a></li>
              <li><a href="../ptk">Kepala Sekolah, Guru dan Staf</a></li>
            </ul>
          </li>
          <li><a class="nav-link" href="../galeri">Galeri</a></li>
          <li><a class="nav-link" href="../#recent-blog-pengumuman">Pengumuman</a></li>
          <li class="dropdown"><a href="#"><span>Berita</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="../berita/filter/sekolah">Berita Sekolah</a></li>
              <li><a href="../berita/filter/prestasi">Berita Prestasi</a></li>
            </ul>
          </li>
          <li><a class="getstarted " href="#">PPDB</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->


  <main id="main">
    <section class="breadcrumbs" style="margin-top: 6em;">
      <div class="container">
        <ol>
          <li><a href="../">Home</a></li>
          <li><?= $title ?></li>
        </ol>
        <h2><?= $title ?></h2>
      </div>
    </section>
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="entries">

          <article class="entry entry-single">

            <div class="entry-img">
              <img src="../assets/img/<?= $viewSejarah['foto_sejarah'] ?>" alt="" class="img-fluid">
            </div>

            <h2 class="entry-title">
              <a href="#">SD AL-FATAH SURABAYA</a>
            </h2>
            <div class="entry-content">
              <?php
              // echo '<pre>';
              echo ($viewSejarah['sejarah']);
              // echo nl2br(htmlspecialchars($viewSejarah['sejarah']));
              // echo '</pre>';
              ?>
            </div>

          </article>
        </div>
      </div>
    </section>


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">



    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 col-md-12 footer-info">
            <a href="index.html" class="logo d-flex align-items-center">
              <img src="../assets/img/logo-oke.png" alt="">
              <!-- <span>FlexStart</span> -->
            </a>
            <p>&copy; <?= date('Y') ?> SD Al-Fatah Surabaya</p>
            <div class="social-links mt-3">
              <a href="https://www.tiktok.com/@sdalfatahsurabayafullday" target="_blank" class="tiktok"><i class="bi bi-tiktok"></i></a>
              <a href="https://www.youtube.com/@SDAL-FATAHSURABAYA" target="_blank" class="youtube"><i class="bi bi-youtube"></i></a>
              <a href="https://www.instagram.com/sdalfatahsurabaya" target="_blank" class="instagram"><i class="bi bi-instagram bx bxl-instagram"></i></a>
            </div>
          </div>



          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Hubungi Kami</h4>
            <p>Dukuh Karangan Gg.Golongan<br>Kelurahan Babatan<br>Kecamatan Wiyung<br>Kota Surabaya<br><br>
              <strong>Telepon:</strong> (031)7533478<br>
              <strong>Email:</strong> sdalfatahsurabaya@gmail.com<br>
            </p>

          </div>

          <div class="col-lg-2 col-12 footer-links">
            <h4>Tentang Kami</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#" class="fw-bold">Profil Kami</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#" class="fw-bold">Berita Sekolah</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#" class="fw-bold">Prestasi</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#" class="fw-bold">Pengumuman</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#" class="fw-bold">Galeri</a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>


  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/purecounter/purecounter.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>


</body>

</html>