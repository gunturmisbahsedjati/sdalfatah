<?php
include_once 'inc/inc.koneksi.php';
include_once 'inc/inc.library.php';
if (!isset($_SESSION['status_login'])) {
    echo '<script type="text/javascript">
    window.location = "./"
    </script>';
    exit;
}

if (isset($_POST['simpanSejarah'])) {
    $code2 = time() . '-' . uniqid();
    $code = strtoupper($code2);
    $created_by = $_SESSION['id'];
    $teks_sejarah = $_POST['teks_sejarah'];

    if (isset($_FILES['foto_sejarah']['name']) && $_FILES['foto_sejarah']['name'] != '') {
        $foto_sejarah = $_FILES['foto_sejarah']['name'];
        $size_foto_sejarah = $_FILES['foto_sejarah']['size'];
        $tmp_foto_sejarah = $_FILES['foto_sejarah']['tmp_name'];
        $tmp           = explode('.', $foto_sejarah);
        $fileExtension = strtolower(end($tmp));
        $foto_sejarah_name = $code . '.' . $fileExtension;
        $path_foto_sejarah = realpath("./..") . '/assets/img/foto-sejarah/' . $foto_sejarah_name;
        $sql = "update tb_profil_sekolah set sejarah = '$teks_sejarah', foto_sejarah = '/foto-sejarah/$foto_sejarah_name' where id_profil = 1";
        // echo $sql;
        $updateSejarah = mysqli_query($myConnection, $sql);
        if ($updateSejarah) {
            move_uploaded_file($tmp_foto_sejarah, $path_foto_sejarah);
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Sejarah berhasil diupdate'})";
            echo "<script> window.location='profilSekolah'; </script>";
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Sejarah gagal diupdate'})";
            echo "<script> window.location='profilSekolah'; </script>";
        }
    } else {
        $sql = "update tb_profil_sekolah set sejarah = '$teks_sejarah' where id_profil = 1";
        // echo $sql;
        $updateSejarah = mysqli_query($myConnection, $sql);
        if ($updateSejarah) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Sejarah berhasil diupdate'})";
            echo "<script> window.location='profilSekolah'; </script>";
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Sejarah gagal diupdate'})";
            echo "<script> window.location='profilSekolah'; </script>";
        }
    }
} elseif (isset($_POST['simpanVisiMisi'])) {
    $code2 = time() . '-' . uniqid();
    $code = strtoupper($code2);
    $created_by = $_SESSION['id'];
    $teks_visimisi = $_POST['teks_visimisi'];

    if (isset($_FILES['foto_visimisi']['name']) && $_FILES['foto_visimisi']['name'] != '') {
        $foto_visimisi = $_FILES['foto_visimisi']['name'];
        $size_foto_visimisi = $_FILES['foto_visimisi']['size'];
        $tmp_foto_visimisi = $_FILES['foto_visimisi']['tmp_name'];
        $tmp           = explode('.', $foto_visimisi);
        $fileExtension = strtolower(end($tmp));
        $foto_visimisi_name = $code . '.' . $fileExtension;
        $path_foto_visimisi = realpath("./..") . '/assets/img/foto-sejarah/' . $foto_visimisi_name;
        $sql = "update tb_profil_sekolah set visimisi = '$teks_visimisi', foto_visimisi = '/foto-sejarah/$foto_visimisi_name' where id_profil = 1";
        // echo $sql;
        $updateVisiMisi = mysqli_query($myConnection, $sql);
        if ($updateVisiMisi) {
            move_uploaded_file($tmp_foto_visimisi, $path_foto_visimisi);
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Visi Misi berhasil diupdate'})";
            echo "<script> window.location='profilSekolah'; </script>";
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Visi Misi gagal diupdate'})";
            echo "<script> window.location='profilSekolah'; </script>";
        }
    } else {
        $sql = "update tb_profil_sekolah set visimisi = '$teks_visimisi' where id_profil = 1";
        // echo $sql;
        $updateVisiMisi = mysqli_query($myConnection, $sql);
        if ($updateVisiMisi) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Visi Misi berhasil diupdate'})";
            echo "<script> window.location='profilSekolah'; </script>";
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Visi Misi gagal diupdate'})";
            echo "<script> window.location='profilSekolah'; </script>";
        }
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
