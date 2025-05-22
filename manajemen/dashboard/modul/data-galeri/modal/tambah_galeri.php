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
<form action="setGaleri" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
    <div class="modal-header modal-header-tambah">
        <h5 class="modal-title"><i class="fa fa-plus"></i> Tambah Gambar</h5>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <label class="form-label">Judul Gambar</label>
            <input type="text" class="form-control" placeholder="Judul Gambar" name="alt_galeri" aria-describedby="defaultFormControlHelp" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Gambar</label>
            <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new thumbnail" style="width: 300px; height: auto;">
                    <img src="../assets/img/common/placeholder.png" alt="">
                </div>
                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 300px; max-height: auto; line-height: 20px;"></div>
                <div>
                    <span class="btn btn-theme04 btn-file">
                        <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Foto</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                        <input type="file" name="foto_galeri" class="default">
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" name="tambahGambar" class="btn btn-success">Simpan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Batal</button>
    </div>
</form>