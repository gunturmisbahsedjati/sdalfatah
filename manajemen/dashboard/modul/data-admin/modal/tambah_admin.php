<?php
session_start();
include_once '../../../../inc/inc.koneksi.php';
include_once '../../../../inc/inc.library.php';
if (empty($_SESSION['username'])) {
    header('location:../../../');
} else {
    $username = $_SESSION['username'];
    $id = $_SESSION['id'];
    $level = $_SESSION['level'];
    $arrayAkses = explode(",", $_SESSION['level']);
}
if (!isset($_SESSION['status_login'])) {
    echo '<script type="text/javascript">
    window.location = "./"
    </script>';
    exit;
}
?>
<form action="setUser" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
    <div class="modal-header modal-header-tambah">
        <h5 class="modal-title"><i class="fa fa-plus"></i> Tambah Pengguna</h5>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" aria-describedby="defaultFormControlHelp" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" placeholder="Username" name="user" aria-describedby="defaultFormControlHelp" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="text" class="form-control" placeholder="Password" name="pass" aria-describedby="defaultFormControlHelp" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" name="tambahUser" class="btn btn-success">Simpan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Batal</button>
    </div>
</form>