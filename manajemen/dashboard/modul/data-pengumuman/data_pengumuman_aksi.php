<?php
include_once 'inc/inc.koneksi.php';
include_once 'inc/inc.library.php';
if (!isset($_SESSION['status_login'])) {
    echo '<script type="text/javascript">
    window.location = "./"
    </script>';
    exit;
}

if (isset($_POST['tambahPengumuman'])) {
    $code2 = time() . '-' . uniqid();
    $code = strtoupper($code2);
    $created_by = $_SESSION['id'];
    $judul_pengumuman = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['judul_pengumuman']));
    $isi_pengumuman = $_POST['isi_pengumuman'];
    $slug_pengumuman = textToSlug($judul_pengumuman);
    // echo $judul_pengumuman . '<br>' . $slug_pengumuman;

    if (isset($_FILES['foto_pengumuman']['name']) && $_FILES['foto_pengumuman']['name'] != '') {
        $foto_pengumuman = $_FILES['foto_pengumuman']['name'];
        $size_foto_pengumuman = $_FILES['foto_pengumuman']['size'];
        $tmp_foto_pengumuman = $_FILES['foto_pengumuman']['tmp_name'];
        $tmp           = explode('.', $foto_pengumuman);
        $fileExtension = strtolower(end($tmp));
        $foto_pengumuman_name = $code . '.' . $fileExtension;
        $path_foto_pengumuman = realpath("./..") . '/assets/img/foto-pengumuman/' . $foto_pengumuman_name;
        $db_foto_pengumuman = '/foto-pengumuman/' . $foto_pengumuman_name;
        move_uploaded_file($tmp_foto_pengumuman, $path_foto_pengumuman);

        $sql = "insert into tb_pengumuman (id_pengumuman, judul_pengumuman, isi_pengumuman, slug_pengumuman, foto_pengumuman, created_by, created_date) values ('$code', '$judul_pengumuman', '$isi_pengumuman', '$slug_pengumuman', '$db_foto_pengumuman', '$created_by', now())";
        // echo $sql;
        $insertPTK = mysqli_query($myConnection, $sql);
        if ($insertPTK) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Pengumuman berhasil disimpan'})";
            echo "<script> window.location='daftarPengumuman'; </script>";
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Pengumuman gagal disimpan'})";
            echo "<script> window.location='daftarPengumuman'; </script>";
        }
    } else {
        $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Silahkan menyertakan gambar'})";
        echo "<script> window.location='daftarPengumuman'; </script>";
    }
} elseif (isset($_POST['ubahStatus'])) {
    $created_by = $_SESSION['id'];
    $id_pengumuman = mysqli_escape_string($myConnection, $_POST['_token']);
    $status_headline = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['status_headline']));

    $sqlCekID = mysqli_query($myConnection, "select * from tb_pengumuman where id_pengumuman = '$id_pengumuman'");
    if (mysqli_num_rows($sqlCekID) > 0) {
        $viewID = mysqli_fetch_array($sqlCekID);

        if ($status_headline == 1) {
            $ubah_headline = 0;
        } elseif ($status_headline == 0) {
            $ubah_headline = 1;
        } else {
            $ubah_headline = 0;
        }

        $sql = "update tb_pengumuman set status_headline = '$ubah_headline' where id_pengumuman = '$id_pengumuman'";
        // echo $sql;

        $updateGambar = mysqli_query($myConnection, $sql);
        if ($updateGambar) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Status Gambar berhasil diubah'})";
            echo "<script> window.location='daftarPengumuman'; </script>";
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Status Gambar gagal diubah'})";
            echo "<script> window.location='daftarPengumuman'; </script>";
        }
    } else {
        $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
        echo "<script> window.location='daftarPengumuman'; </script>";
    }
} elseif (isset($_POST['ubahPengumuman'])) {
    $code2 = time() . '-' . uniqid();
    $code = strtoupper($code2);
    $created_by = $_SESSION['id'];
    $id_pengumuman = mysqli_escape_string($myConnection, $_POST['_token']);
    $judul_pengumuman = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['judul_pengumuman']));
    $isi_pengumuman = $_POST['isi_pengumuman'];
    $slug_pengumuman = textToSlug($judul_pengumuman);

    $sqlCekID = mysqli_query($myConnection, "select * from tb_pengumuman where id_pengumuman = '$id_pengumuman'");
    if (mysqli_num_rows($sqlCekID) > 0) {
        $viewID = mysqli_fetch_array($sqlCekID);

        if (isset($_FILES['foto_pengumuman']['name']) && $_FILES['foto_pengumuman']['name'] != '') {
            $foto_pengumuman = $_FILES['foto_pengumuman']['name'];
            $size_foto_pengumuman = $_FILES['foto_pengumuman']['size'];
            $tmp_foto_pengumuman = $_FILES['foto_pengumuman']['tmp_name'];
            $tmp           = explode('.', $foto_pengumuman);
            $fileExtension = strtolower(end($tmp));
            $foto_pengumuman_name = $code . '.' . $fileExtension;
            $path_foto_pengumuman = realpath("./..") . '/assets/img/foto-pengumuman/' . $foto_pengumuman_name;
            $db_foto_pengumuman = '/foto-pengumuman/' . $foto_pengumuman_name;
            move_uploaded_file($tmp_foto_pengumuman, $path_foto_pengumuman);


            $sql = "update tb_pengumuman set judul_pengumuman = '$judul_pengumuman', isi_pengumuman = '$isi_pengumuman', slug_pengumuman = '$slug_pengumuman', foto_pengumuman = '$db_foto_pengumuman' where id_pengumuman = '$id_pengumuman'";
            // echo $sql;
            $update = mysqli_query($myConnection, $sql);
            if ($update) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Pengumuman berhasil diubah'})";
                echo "<script> window.location='daftarPengumuman'; </script>";
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Pengumuman gagal diubah'})";
                echo "<script> window.location='daftarPengumuman'; </script>";
            }
        } else {
            $sql = "update tb_pengumuman set judul_pengumuman = '$judul_pengumuman', isi_pengumuman = '$isi_pengumuman', slug_pengumuman = '$slug_pengumuman' where id_pengumuman = '$id_pengumuman'";
            // echo $sql;
            $update = mysqli_query($myConnection, $sql);
            if ($update) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Pengumuman berhasil diubah'})";
                echo "<script> window.location='daftarPengumuman'; </script>";
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Pengumuman gagal diubah'})";
                echo "<script> window.location='daftarPengumuman'; </script>";
            }
        }
    } else {
        $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
        echo "<script> window.location='daftarPengumuman'; </script>";
    }
} elseif (isset($_POST['hapusPengumuman'])) {
    $created_by = $_SESSION['id'];
    $id_pengumuman = mysqli_escape_string($myConnection, $_POST['_token']);
    $status_headline = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['status_headline']));

    $sqlCekID = mysqli_query($myConnection, "select * from tb_pengumuman where id_pengumuman = '$id_pengumuman'");
    if (mysqli_num_rows($sqlCekID) > 0) {
        $viewID = mysqli_fetch_array($sqlCekID);

        $sql = "delete from tb_pengumuman where id_pengumuman = '$id_pengumuman'";

        $updateGambar = mysqli_query($myConnection, $sql);
        if ($updateGambar) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Pengumuman berhasil dihapus'})";
            echo "<script> window.location='daftarPengumuman'; </script>";
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Pengumuman gagal dihapus'})";
            echo "<script> window.location='daftarPengumuman'; </script>";
        }
    } else {
        $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
        echo "<script> window.location='daftarPengumuman'; </script>";
    }
} else {
    echo '<script type="text/javascript">
        window.location = "./"
        </script>';
}
