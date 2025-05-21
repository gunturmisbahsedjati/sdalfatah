<?php
include_once 'inc/inc.koneksi.php';
include_once 'inc/inc.library.php';
if (!isset($_SESSION['status_login'])) {
    echo '<script type="text/javascript">
    window.location = "./"
    </script>';
    exit;
}

if (isset($_POST['tambahUser'])) {
    $code2 = time() . '-' . uniqid();
    $code = strtoupper($code2);
    $created_by = $_SESSION['id'];
    $nama = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['nama']));
    $password = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['pass']));
    $username = htmlspecialchars(mysqli_escape_string($myConnection, trim($_POST['user'])));
    $sqlCekUsernama = mysqli_query($myConnection, "select * from tb_pengguna where username = '$username' and password = '$password' and soft_delete = 0");
    if (mysqli_num_rows($sqlCekUsernama) > 0) {
        $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Username telah terpakai'})";
        echo "<script> window.location='userList'; </script>";
    } else {
        $sql = "insert into tb_pengguna (id_pengguna, username, password, nama_pengguna, status_pengguna, created_by, created_date) values ('$code', '$username', '$password', '$nama', 'aktif', '$created_by', NOW())";
        // echo $sql;
        $insertAccount = mysqli_query($myConnection, $sql);
        if ($insertAccount) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Pengguna berhasil ditambahkan'})";
            echo "<script> window.location='userList'; </script>";
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Pengguna gagal ditambahkan'})";
            echo "<script> window.location='userList'; </script>";
        }
    }
} elseif (isset($_POST['ubahUser'])) {
    $created_by = $_SESSION['id'];
    $id_pengguna = mysqli_escape_string($myConnection, $_POST['_token']);
    $nama = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['nama']));
    $username = htmlspecialchars(mysqli_escape_string($myConnection, trim($_POST['user'])));
    $sqlCekID = mysqli_query($myConnection, "select * from tb_pengguna where id_pengguna = '$id_pengguna'");
    if (mysqli_num_rows($sqlCekID) > 0) {
        if ($id_pengguna == '1234567890') {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
            echo "<script> window.location='userList'; </script>";
        } else {
            $updateAccount = mysqli_query($myConnection, "update tb_pengguna set nama_pengguna = '$nama', username = '$username' where soft_delete = 0 and id_pengguna = '$id_pengguna'");
            if ($updateAccount) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Pengguna berhasil diubah'})";
                echo "<script> window.location='userList'; </script>";
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Pengguna gagal diubah'})";
                echo "<script> window.location='userList'; </script>";
            }
        }
    } else {
        $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
        echo "<script> window.location='userList'; </script>";
    }
} elseif (isset($_POST['hapusUser'])) {
    $created_by = $_SESSION['id'];
    $id_pengguna = mysqli_escape_string($myConnection, $_POST['_token']);
    $sqlCekID = mysqli_query($myConnection, "select * from tb_pengguna where id_pengguna = '$id_pengguna'");
    if (mysqli_num_rows($sqlCekID) > 0) {
        $deleteAccount = mysqli_query($myConnection, "update tb_pengguna set soft_delete = '1' where soft_delete = 0 and id_pengguna = '$id_pengguna'");
        if ($deleteAccount) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Pengguna berhasil dihapus'})";
            echo "<script> window.location='userList'; </script>";
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Pengguna gagal dihapus'})";
            echo "<script> window.location='userList'; </script>";
        }
    } else {
        $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
        echo "<script> window.location='userList'; </script>";
    }
} elseif (isset($_POST['updatePassManagemenet'])) {
    $id_manajemen = mysqli_escape_string($myConnection, ($_POST['_token']));
    echo $id_manajemen;
    $sql = mysqli_query($myConnection, "select pass_manajemen from akun_manajemen where id_manajemen = '$id_manajemen' and soft_delete = 0");
    if (mysqli_num_rows($sql) > 0) {
        $cekPass = mysqli_fetch_array($sql);
        $old_pass = mysqli_escape_string($myConnection, ($_POST['old_pass']));
        $new_pass = mysqli_escape_string($myConnection, ($_POST['new_pass']));
        $conf_new_pass = mysqli_escape_string($myConnection, ($_POST['conf_new_pass']));
        $url = mysqli_escape_string($myConnection, $_POST['_url']);
        if ($old_pass == $cekPass['pass_manajemen']) {
            if ($new_pass == $conf_new_pass) {
                $change = mysqli_query($myConnection, "update akun_manajemen set pass_manajemen = '$new_pass' where user_manajemen = '$username' ");
                if ($change) {
                    $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Kata sandi berhasil diubah'})";
                    echo "<script> window.location='$url'; </script>";
                } else {
                    $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Kata sandi gagal diubah'})";
                    echo "<script> window.location='$url'; </script>";
                }
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Sandi baru dan Konfirmasi sandi baru tidak cocok'})";
                echo "<script> window.location='$url'; </script>";
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Kata sandi lama tidak cocok'})";
            echo "<script> window.location='$url'; </script>";
        }
    } else {
        $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection Detected'})";
        echo "<script> window.location='./'; </script>";
    }
} else {
    echo '<script type="text/javascript">
        window.location = "userlist"
        </script>';
}
