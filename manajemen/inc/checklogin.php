<?php
require 'inc.koneksi.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
	$username = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['password']);
	$num = mysqli_num_rows(mysqli_query($myConnection, "select * from tb_pengguna where username='$username' and password = '$password'and status_pengguna = 'aktif' and soft_delete = 0 "));
	if ($num > 0) {
		echo 1;
	} else {
		echo 0;
	}
} else {
	echo "What are you doing?";
}
