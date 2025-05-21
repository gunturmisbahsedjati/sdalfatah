<?php
include_once 'inc/inc.koneksi.php';
include_once 'inc/inc.library.php';
if (!isset($_SESSION['status_login'])) {
    echo '<script type="text/javascript">
    window.location = "./"
    </script>';
    exit;
}

if (isset($_POST['tambahJabatan'])) {
    $created_by = $_SESSION['id'];
    $nama_jabatan = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['nama_jabatan']));
    $sql = "insert into tb_jabatan_ptk (nama_jabatan, created_by, created_date) values ('$nama_jabatan', '$created_by', NOW())";
    // echo $sql;
    $insertAccount = mysqli_query($myConnection, $sql);
    if ($insertAccount) {
        $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Jabatan PTK berhasil ditambahkan'})";
        echo "<script> window.location='jabatanPTK'; </script>";
    } else {
        $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Jabatan PTK gagal ditambahkan'})";
        echo "<script> window.location='jabatanPTK'; </script>";
    }
} elseif (isset($_POST['ubahJabatan'])) {
    $created_by = $_SESSION['id'];
    $id_jabatan = mysqli_escape_string($myConnection, $_POST['_token']);
    $nama_jabatan = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['nama_jabatan']));
    $sqlCekID = mysqli_query($myConnection, "select * from tb_jabatan_ptk where id_jabatan = '$id_jabatan'");
    if (mysqli_num_rows($sqlCekID) > 0) {
        $updateAccount = mysqli_query($myConnection, "update tb_jabatan_ptk set nama_jabatan = '$nama_jabatan' where soft_delete = 0 and id_jabatan = '$id_jabatan'");
        if ($updateAccount) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Jabatan PTK berhasil diubah'})";
            echo "<script> window.location='jabatanPTK'; </script>";
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Jabatan PTK gagal diubah'})";
            echo "<script> window.location='jabatanPTK'; </script>";
        }
    } else {
        $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
        echo "<script> window.location='jabatanPTK'; </script>";
    }
} elseif (isset($_POST['hapusJabatan'])) {
    $created_by = $_SESSION['id'];
    $id_jabatan = mysqli_escape_string($myConnection, $_POST['_token']);
    $sqlCekID = mysqli_query($myConnection, "select * from tb_jabatan_ptk where id_jabatan = '$id_jabatan'");
    if (mysqli_num_rows($sqlCekID) > 0) {
        $deleteAccount = mysqli_query($myConnection, "delete from tb_jabatan_ptk where id_jabatan = '$id_jabatan'");
        if ($deleteAccount) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Jabatan PTK berhasil dihapus'})";
            echo "<script> window.location='jabatanPTK'; </script>";
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Jabatan PTK gagal dihapus'})";
            echo "<script> window.location='jabatanPTK'; </script>";
        }
    } else {
        $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
        echo "<script> window.location='jabatanPTK'; </script>";
    }
} elseif (isset($_POST['tambahPTK'])) {
    $code2 = time() . '-' . uniqid();
    $code = strtoupper($code2);
    $created_by = $_SESSION['id'];
    $nama_ptk = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['nama_ptk']));
    $tempat_lahir = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['tempat_lahir']));
    $tgl_lahir = substr($_POST['tgl_lahir'], 6, 4) . '-' . substr($_POST['tgl_lahir'], 3, 2) . '-' . substr($_POST['tgl_lahir'], 0, 2);
    $jk = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['jk']));
    $no_hp = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['no_hp']));
    $alamat = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['alamat']));
    $jabatan = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['jabatan']));
    $tugas_tambahan = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['tugas_tambahan']));


    if (isset($_FILES['foto_ptk']['name']) && $_FILES['foto_ptk']['name'] != '') {
        $foto_ptk = $_FILES['foto_ptk']['name'];
        $size_foto_ptk = $_FILES['foto_ptk']['size'];
        $tmp_foto_ptk = $_FILES['foto_ptk']['tmp_name'];
        $tmp           = explode('.', $foto_ptk);
        $fileExtension = strtolower(end($tmp));
        $foto_ptk_name = $code . '.' . $fileExtension;
        $path_foto_ptk = realpath("./..") . '/assets/img/foto-ptk/' . $foto_ptk_name;
        $db_foto_ptk = '/foto-ptk/' . $foto_ptk_name;
        move_uploaded_file($tmp_foto_ptk, $path_foto_ptk);
    } else {
        $db_foto_ptk = '/common/user.jpeg';
    }

    $sql = "insert into tb_ptk (id_ptk, nama_ptk, tempat_lahir, tgl_lahir, jk, no_hp, alamat, id_jabatan, tugas_tambahan, foto, created_by, created_date) values ('$code', '$nama_ptk', '$tempat_lahir', '$tgl_lahir', '$jk', '$no_hp', '$alamat', '$jabatan', '$tugas_tambahan', '$db_foto_ptk', '$created_by', NOW())";
    // echo $sql;
    $insertPTK = mysqli_query($myConnection, $sql);
    if ($insertPTK) {
        $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Jabatan PTK berhasil ditambahkan'})";
        echo "<script> window.location='daftarPTK'; </script>";
    } else {
        $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Jabatan PTK gagal ditambahkan'})";
        echo "<script> window.location='daftarPTK'; </script>";
    }
} elseif (isset($_POST['ubahPTK'])) {
    $code2 = time() . '-' . uniqid();
    $code = strtoupper($code2);
    $created_by = $_SESSION['id'];
    $id_ptk = mysqli_escape_string($myConnection, $_POST['_token']);
    $nama_ptk = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['nama_ptk']));
    $tempat_lahir = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['tempat_lahir']));
    $tgl_lahir = substr($_POST['tgl_lahir'], 6, 4) . '-' . substr($_POST['tgl_lahir'], 3, 2) . '-' . substr($_POST['tgl_lahir'], 0, 2);
    $jk = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['jk']));
    $no_hp = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['no_hp']));
    $alamat = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['alamat']));
    $jabatan = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['jabatan']));
    $tugas_tambahan = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['tugas_tambahan']));

    $sqlCekID = mysqli_query($myConnection, "select * from tb_ptk where id_ptk = '$id_ptk'");
    if (mysqli_num_rows($sqlCekID) > 0) {
        $viewID = mysqli_fetch_array($sqlCekID);

        if (isset($_FILES['foto_ptk']['name']) && $_FILES['foto_ptk']['name'] != '') {
            $foto_ptk = $_FILES['foto_ptk']['name'];
            $size_foto_ptk = $_FILES['foto_ptk']['size'];
            $tmp_foto_ptk = $_FILES['foto_ptk']['tmp_name'];
            $tmp           = explode('.', $foto_ptk);
            $fileExtension = strtolower(end($tmp));
            $foto_ptk_name = $code . '.' . $fileExtension;
            $path_foto_ptk = realpath("./..") . '/assets/img/foto-ptk/' . $foto_ptk_name;
            $db_foto_ptk = '/foto-ptk/' . $foto_ptk_name;
            move_uploaded_file($tmp_foto_ptk, $path_foto_ptk);
        } else {
            $db_foto_ptk = $viewID['foto'];
        }

        $sql = "update tb_ptk set nama_ptk = '$nama_ptk', tempat_lahir = '$tempat_lahir', tgl_lahir = '$tgl_lahir', jk = '$jk', no_hp = '$no_hp', alamat = '$alamat', id_jabatan = '$jabatan', tugas_tambahan = '$tugas_tambahan', foto = '$db_foto_ptk' where id_ptk = '$id_ptk'";
        // echo $sql;

        $updatePTK = mysqli_query($myConnection, $sql);
        if ($updatePTK) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Jabatan PTK berhasil diubah'})";
            echo "<script> window.location='daftarPTK'; </script>";
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Jabatan PTK gagal diubah'})";
            echo "<script> window.location='daftarPTK'; </script>";
        }
    } else {
        $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
        echo "<script> window.location='daftarPTK'; </script>";
    }
} elseif (isset($_POST['hapusPTK'])) {
    $code2 = time() . '-' . uniqid();
    $code = strtoupper($code2);
    $created_by = $_SESSION['id'];
    $id_ptk = mysqli_escape_string($myConnection, $_POST['_token']);
    $sqlCekID = mysqli_query($myConnection, "select * from tb_ptk where id_ptk = '$id_ptk'");
    if (mysqli_num_rows($sqlCekID) > 0) {
        $viewID = mysqli_fetch_array($sqlCekID);

        $sql = "update tb_ptk set soft_delete = 1 where id_ptk = '$id_ptk'";
        // echo $sql;

        $delPTK = mysqli_query($myConnection, $sql);
        if ($delPTK) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Jabatan PTK berhasil dihapus'})";
            echo "<script> window.location='daftarPTK'; </script>";
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Jabatan PTK gagal dihapus'})";
            echo "<script> window.location='daftarPTK'; </script>";
        }
    } else {
        $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
        echo "<script> window.location='daftarPTK'; </script>";
    }
} else {
    echo '<script type="text/javascript">
        window.location = "./"
        </script>';
}
