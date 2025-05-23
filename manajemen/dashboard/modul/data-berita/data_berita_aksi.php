<?php
include_once 'inc/inc.koneksi.php';
include_once 'inc/inc.library.php';
if (!isset($_SESSION['status_login'])) {
    echo '<script type="text/javascript">
    window.location = "./"
    </script>';
    exit;
}

if (isset($_POST['tambahBerita'])) {
    $code2 = time() . '-' . uniqid();
    $code = strtoupper($code2);
    $created_by = $_SESSION['id'];
    $judul_berita = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['judul_berita']));
    $jenis_berita = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['jenis_berita']));
    $isi_berita = $_POST['isi_berita'];
    $slug_berita = textToSlug($judul_berita);
    // echo $judul_berita . '<br>' . $slug_berita;

    if (isset($_FILES['foto_berita']['name']) && $_FILES['foto_berita']['name'] != '') {
        $foto_berita = $_FILES['foto_berita']['name'];
        $size_foto_berita = $_FILES['foto_berita']['size'];
        $tmp_foto_berita = $_FILES['foto_berita']['tmp_name'];
        $tmp           = explode('.', $foto_berita);
        $fileExtension = strtolower(end($tmp));
        $foto_berita_name = $code . '.' . $fileExtension;
        $path_foto_berita = realpath("./..") . '/assets/img/foto-berita/' . $foto_berita_name;
        $db_foto_berita = '/foto-berita/' . $foto_berita_name;
        move_uploaded_file($tmp_foto_berita, $path_foto_berita);

        $sql = "insert into tb_berita (id_berita, judul_berita, isi_berita, slug_berita, jenis_berita, foto_berita, created_by, created_date) values ('$code', '$judul_berita', '$isi_berita', '$slug_berita', '$jenis_berita', '$db_foto_berita', '$created_by', now())";
        // echo $sql;
        $insertNews = mysqli_query($myConnection, $sql);
        if ($insertNews) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Pengumuman berhasil disimpan'})";
            echo "<script> window.location='daftarBerita'; </script>";
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Pengumuman gagal disimpan'})";
            echo "<script> window.location='daftarBerita'; </script>";
        }
    } else {
        $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Silahkan menyertakan gambar'})";
        echo "<script> window.location='daftarBerita'; </script>";
    }
} elseif (isset($_POST['ubahStatus'])) {
    $created_by = $_SESSION['id'];
    $id_berita = mysqli_escape_string($myConnection, $_POST['_token']);
    $status_headline = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['status_headline']));

    $sqlCekID = mysqli_query($myConnection, "select * from tb_berita where id_berita = '$id_berita'");
    if (mysqli_num_rows($sqlCekID) > 0) {
        $viewID = mysqli_fetch_array($sqlCekID);

        if ($status_headline == 1) {
            $ubah_headline = 0;
        } elseif ($status_headline == 0) {
            $ubah_headline = 1;
        } else {
            $ubah_headline = 0;
        }

        $sql = "update tb_berita set status_headline = '$ubah_headline' where id_berita = '$id_berita'";
        // echo $sql;

        $updateStatus = mysqli_query($myConnection, $sql);
        if ($updateStatus) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Status Berita berhasil diubah'})";
            echo "<script> window.location='daftarBerita'; </script>";
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Status Berita gagal diubah'})";
            echo "<script> window.location='daftarBerita'; </script>";
        }
    } else {
        $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
        echo "<script> window.location='daftarBerita'; </script>";
    }
} elseif (isset($_POST['ubahBerita'])) {
    $code2 = time() . '-' . uniqid();
    $code = strtoupper($code2);
    $created_by = $_SESSION['id'];
    $id_berita = mysqli_escape_string($myConnection, $_POST['_token']);
    $judul_berita = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['judul_berita']));
    $isi_berita = $_POST['isi_berita'];
    $jenis_berita = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['jenis_berita']));
    $slug_berita = textToSlug($judul_berita);

    $sqlCekID = mysqli_query($myConnection, "select * from tb_berita where id_berita = '$id_berita'");
    if (mysqli_num_rows($sqlCekID) > 0) {
        $viewID = mysqli_fetch_array($sqlCekID);

        if (isset($_FILES['foto_berita']['name']) && $_FILES['foto_berita']['name'] != '') {
            $foto_berita = $_FILES['foto_berita']['name'];
            $size_foto_berita = $_FILES['foto_berita']['size'];
            $tmp_foto_berita = $_FILES['foto_berita']['tmp_name'];
            $tmp           = explode('.', $foto_berita);
            $fileExtension = strtolower(end($tmp));
            $foto_berita_name = $code . '.' . $fileExtension;
            $path_foto_berita = realpath("./..") . '/assets/img/foto-berita/' . $foto_berita_name;
            $db_foto_berita = '/foto-berita/' . $foto_berita_name;
            move_uploaded_file($tmp_foto_berita, $path_foto_berita);


            $sql = "update tb_berita set judul_berita = '$judul_berita', isi_berita = '$isi_berita', slug_berita = '$slug_berita', jenis_berita = '$jenis_berita', foto_berita = '$db_foto_berita' where id_berita = '$id_berita'";
            // echo $sql;
            $update = mysqli_query($myConnection, $sql);
            if ($update) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Berita berhasil diubah'})";
                echo "<script> window.location='daftarBerita'; </script>";
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Berita gagal diubah'})";
                echo "<script> window.location='daftarBerita'; </script>";
            }
        } else {
            $sql = "update tb_berita set judul_berita = '$judul_berita', isi_berita = '$isi_berita', slug_berita = '$slug_berita', jenis_berita = '$jenis_berita' where id_berita = '$id_berita'";
            // echo $sql;
            $update = mysqli_query($myConnection, $sql);
            if ($update) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Berita berhasil diubah'})";
                echo "<script> window.location='daftarBerita'; </script>";
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Berita gagal diubah'})";
                echo "<script> window.location='daftarBerita'; </script>";
            }
        }
    } else {
        $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
        echo "<script> window.location='daftarBerita'; </script>";
    }
} elseif (isset($_POST['hapusBerita'])) {
    $created_by = $_SESSION['id'];
    $id_berita = mysqli_escape_string($myConnection, $_POST['_token']);
    $status_headline = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['status_headline']));

    $sqlCekID = mysqli_query($myConnection, "select * from tb_berita where id_berita = '$id_berita'");
    if (mysqli_num_rows($sqlCekID) > 0) {
        $viewID = mysqli_fetch_array($sqlCekID);

        $sql = "delete from tb_berita where id_berita = '$id_berita'";

        $del = mysqli_query($myConnection, $sql);
        if ($del) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Berita berhasil dihapus'})";
            echo "<script> window.location='daftarBerita'; </script>";
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Berita gagal dihapus'})";
            echo "<script> window.location='daftarBerita'; </script>";
        }
    } else {
        $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
        echo "<script> window.location='daftarBerita'; </script>";
    }
} else {
    echo '<script type="text/javascript">
        window.location = "./"
        </script>';
}
