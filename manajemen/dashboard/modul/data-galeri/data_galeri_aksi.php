<?php
include_once 'inc/inc.koneksi.php';
include_once 'inc/inc.library.php';
if (!isset($_SESSION['status_login'])) {
    echo '<script type="text/javascript">
    window.location = "./"
    </script>';
    exit;
}

if (isset($_POST['tambahGambar'])) {
    $code2 = time() . '-' . uniqid();
    $code = strtoupper($code2);
    $created_by = $_SESSION['id'];
    $alt_galeri = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['alt_galeri']));

    if (isset($_FILES['foto_galeri']['name']) && $_FILES['foto_galeri']['name'] != '') {
        $foto_galeri = $_FILES['foto_galeri']['name'];
        $size_foto_galeri = $_FILES['foto_galeri']['size'];
        $tmp_foto_galeri = $_FILES['foto_galeri']['tmp_name'];
        $tmp           = explode('.', $foto_galeri);
        $fileExtension = strtolower(end($tmp));
        $foto_galeri_name = $code . '.' . $fileExtension;
        $path_foto_galeri = realpath("./..") . '/assets/img/foto-galeri/' . $foto_galeri_name;
        $db_foto_galeri = '/foto-galeri/' . $foto_galeri_name;
        move_uploaded_file($tmp_foto_galeri, $path_foto_galeri);

        $sql = "insert into tb_galeri (id_galeri, foto_galeri, alt_galeri, created_by, created_date) values ('$code', '$db_foto_galeri', '$alt_galeri', '$created_by', NOW())";
        // echo $sql;
        $insertPTK = mysqli_query($myConnection, $sql);
        if ($insertPTK) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Gambar berhasil disimpan'})";
            echo "<script> window.location='daftarGaleri'; </script>";
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Gambar gagal disimpan'})";
            echo "<script> window.location='daftarGaleri'; </script>";
        }
    } else {
        $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Silahkan menyertakan gambar'})";
        echo "<script> window.location='daftarGaleri'; </script>";
    }
} elseif (isset($_POST['ubahStatus'])) {
    $created_by = $_SESSION['id'];
    $id_galeri = mysqli_escape_string($myConnection, $_POST['_token']);
    $status_headline = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['status_headline']));

    $sqlCekID = mysqli_query($myConnection, "select * from tb_galeri where id_galeri = '$id_galeri'");
    if (mysqli_num_rows($sqlCekID) > 0) {
        $viewID = mysqli_fetch_array($sqlCekID);

        if ($status_headline == 1) {
            $ubah_headline = 0;
        } elseif ($status_headline == 0) {
            $ubah_headline = 1;
        } else {
            $ubah_headline = 0;
        }

        $sql = "update tb_galeri set status_headline = '$ubah_headline' where id_galeri = '$id_galeri'";
        // echo $sql;

        $updateGambar = mysqli_query($myConnection, $sql);
        if ($updateGambar) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Status Gambar berhasil diubah'})";
            echo "<script> window.location='daftarGaleri'; </script>";
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Status Gambar gagal diubah'})";
            echo "<script> window.location='daftarGaleri'; </script>";
        }
    } else {
        $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
        echo "<script> window.location='daftarGaleri'; </script>";
    }
} elseif (isset($_POST['ubahGambar'])) {
    $code2 = time() . '-' . uniqid();
    $code = strtoupper($code2);
    $created_by = $_SESSION['id'];
    $id_galeri = mysqli_escape_string($myConnection, $_POST['_token']);
    $alt_galeri = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['alt_galeri']));

    $sqlCekID = mysqli_query($myConnection, "select * from tb_galeri where id_galeri = '$id_galeri'");
    if (mysqli_num_rows($sqlCekID) > 0) {
        $viewID = mysqli_fetch_array($sqlCekID);

        if (isset($_FILES['foto_galeri']['name']) && $_FILES['foto_galeri']['name'] != '') {
            $foto_galeri = $_FILES['foto_galeri']['name'];
            $size_foto_galeri = $_FILES['foto_galeri']['size'];
            $tmp_foto_galeri = $_FILES['foto_galeri']['tmp_name'];
            $tmp           = explode('.', $foto_galeri);
            $fileExtension = strtolower(end($tmp));
            $foto_galeri_name = $code . '.' . $fileExtension;
            $path_foto_galeri = realpath("./..") . '/assets/img/foto-galeri/' . $foto_galeri_name;
            $db_foto_galeri = '/foto-galeri/' . $foto_galeri_name;
            move_uploaded_file($tmp_foto_galeri, $path_foto_galeri);

            $sql = "update tb_galeri set alt_galeri = '$alt_galeri', foto_galeri = '$db_foto_galeri' where id_galeri = '$id_galeri'";
            // echo $sql;
            $update = mysqli_query($myConnection, $sql);
            if ($update) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Gambar berhasil diubah'})";
                echo "<script> window.location='daftarGaleri'; </script>";
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Gambar gagal diubah'})";
                echo "<script> window.location='daftarGaleri'; </script>";
            }
        } else {
            $sql = "update tb_galeri set alt_galeri = '$alt_galeri' where id_galeri = '$id_galeri'";
            // echo $sql;
            $update = mysqli_query($myConnection, $sql);
            if ($update) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Gambar berhasil diubah'})";
                echo "<script> window.location='daftarGaleri'; </script>";
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Gambar gagal diubah'})";
                echo "<script> window.location='daftarGaleri'; </script>";
            }
        }
    } else {
        $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
        echo "<script> window.location='daftarGaleri'; </script>";
    }
} elseif (isset($_POST['hapusGambar'])) {
    $created_by = $_SESSION['id'];
    $id_galeri = mysqli_escape_string($myConnection, $_POST['_token']);
    $status_headline = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['status_headline']));

    $sqlCekID = mysqli_query($myConnection, "select * from tb_galeri where id_galeri = '$id_galeri'");
    if (mysqli_num_rows($sqlCekID) > 0) {
        $viewID = mysqli_fetch_array($sqlCekID);

        $sql = "delete from tb_galeri where id_galeri = '$id_galeri'";

        $updateGambar = mysqli_query($myConnection, $sql);
        if ($updateGambar) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Gambar berhasil dihapus'})";
            echo "<script> window.location='daftarGaleri'; </script>";
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Gambar gagal dihapus'})";
            echo "<script> window.location='daftarGaleri'; </script>";
        }
    } else {
        $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
        echo "<script> window.location='daftarGaleri'; </script>";
    }
} else {
    echo '<script type="text/javascript">
        window.location = "./"
        </script>';
}
