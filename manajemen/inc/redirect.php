<?php
include 'inc.koneksi.php';
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$num = mysqli_query($myConnection, "select * from tb_pengguna where username='$username' and password = '$password'and status_pengguna = 'aktif' and soft_delete = 0 ");
$akun = mysqli_fetch_array($num);

session_start();
$_SESSION['username'] = $akun['username'];
$_SESSION['id'] = $akun['id_pengguna'];
$_SESSION['level'] = $akun['level_pengguna'];
$_SESSION['jabatan'] = $akun['jabatan_pengguna'];
$_SESSION['nama_akun'] = $akun['nama_pengguna'];
$_SESSION['soft_delete'] = $akun['soft_delete'];
$_SESSION['status_login'] = true;
$_SESSION["login_time_stamp"] = time();
