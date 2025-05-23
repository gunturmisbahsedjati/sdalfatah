<?php
include_once '../manajemen/inc/inc.koneksi.php';
include_once '../manajemen/inc/inc.library.php';
$actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


if (strpos($actual_link, '/pengumuman/detail/')) {
  // echo "halaman detail pengumuman";
  include_once 'detail_page.php';
} elseif (strpos($actual_link, '/pengumuman/')) {
  // echo "halaman daftar pengumuman";
  include_once 'daftar_page.php';;
}
