<?php
define('SITE_ROOT', realpath(dirname(__FILE__)));
session_start();
include './inc/inc.koneksi.php';
if (!isset($_SESSION['username'])) {
  header('location:./login');
} else {
  $username = $_SESSION['username'];
  $username = $_SESSION['username'];
  $id = $_SESSION['id'];
  $level = $_SESSION['level'];
  $jabatan = $_SESSION['jabatan'];
  if (time() - $_SESSION["login_time_stamp"] > 57600) {
    session_unset();
    session_destroy();
    header("location:./login");
  }
}

if (!isset($_SESSION['status_login'])) {
  header('location:./login');
  exit;
}

$cek_status_akun = mysqli_num_rows(mysqli_query($myConnection, "select * from tb_pengguna where username='$username' and id_pengguna = '$id' and level_pengguna = '$level' and jabatan_pengguna = '$jabatan' and status_pengguna = 'aktif' and soft_delete = 0 "));
if ($cek_status_akun == 0) {
  session_destroy();
  header("location:./login");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="keyword" content="">
  <title>Dashboard Web Portal | SD Al-Fatah Surabaya</title>

  <!-- Favicons -->
  <link href="img/sd.png" rel="icon">
  <link href="img/sd.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-fileupload/bootstrap-fileupload.css" />
  <!-- Custom styles for this template -->
  <link href="css/style.css?_rev=<?= time() ?>" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="lib/sweetalert/sweetalert2.css">
  <script src="lib/sweetalert/sweetalert2.js"></script>
  <link href="lib/datatables/dataTables.bootstrap4.css" rel="stylesheet" />

</head>

<!-- <body> -->

<body style="margin:0;" onload="loadingPage()">
  <section id="container">
    <?php
    include_once 'dashboard/header.php';
    include_once 'dashboard/sidebar.php';
    ?>
    <section id="main-content">
      <section class="wrapper">
        <div class="lds-spinner" id="loader">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
        </div>
        <div style="display:none;" id="content">
          <!-- <div> -->
          <?php
          include_once 'dashboard/routes.php';
          ?>
        </div>
      </section>
    </section>
    <noscript>
      <div style="background:#333;opacity:0.8;filter:alpha(opacity=80);width:100%;height:100%;position:fixed;top:0px;z-index:1099;"></div>
      <div style="background:#000;width:70%;margin:0% 15%;;position:fixed;top:20%;z-index:1100;text-align:center;padding:4%;color:#fff;">
        <p>We're sorry but this web doesn't work properly without JavaScript enabled. Please enable it to continue.</p>
      </div>
    </noscript>
  </section>
  <script src="lib/jquery/jquery.min.js"></script>

  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="lib/jquery.sparkline.js"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js?_rev=<?= time() ?>"></script>
  <!--script for this page-->
  <script src="lib/jquery-ui-1.9.2.custom.min.js"></script>
  <script type="text/javascript" src="lib/bootstrap-fileupload/bootstrap-fileupload.js"></script>
  <script src="lib/datatables/jquery.dataTables.js"></script>
  <script src="lib/datatables/dataTables.bootstrap4.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
  <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
  <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</body>

</html>