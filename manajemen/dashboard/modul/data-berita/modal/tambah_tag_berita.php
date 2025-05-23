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
<form action="setPTK" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
    <div class="modal-header modal-header-tambah">
        <h5 class="modal-title"><i class="fa fa-plus"></i> Tambah Tag</h5>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <label class="form-label">Tag Berita</label>
            <input type="text" class="form-control" placeholder="Tag Berita" name="nama_jabatan" aria-describedby="defaultFormControlHelp" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" name="tambahJabatan" class="btn btn-success">Simpan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Batal</button>
    </div>
</form>