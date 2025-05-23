<?php
include_once '../manajemen/inc/inc.koneksi.php';
include_once '../manajemen/inc/inc.library.php';
$actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


if (strpos($actual_link, '/berita/detail/')) {
  // echo "halaman detail berita";
  include_once 'detail_page.php';
} elseif (strpos($actual_link, '/berita/filter/')) {
  // echo "halaman detail berita";
  include_once 'filter_page.php';
} elseif (strpos($actual_link, '/berita/')) {
  // echo "halaman daftar berita";
  include_once 'daftar_page.php';;
}
