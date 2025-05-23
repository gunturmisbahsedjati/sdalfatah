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
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = mysqli_query($myConnection, "select * from tb_pengumuman where id_pengumuman = '$id'");
    if (mysqli_num_rows($sql) > 0) {
        $pengumuman = mysqli_fetch_array($sql);
?>
        <form action="setPengumuman" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-header modal-header-hapus">
                <h5 class="modal-title"><i class="fa fa-trash-o"></i> Hapus Pengumuman</h5>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Judul Pengumuman</label>
                    <input type="text" class="form-control" aria-describedby="defaultFormControlHelp" value="<?= $pengumuman['judul_pengumuman'] ?>" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi Pengumuman</label>
                    <div class="">
                        <textarea id="hapus_isi_pengumuman"><?= $pengumuman['isi_pengumuman'] ?></textarea>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: 300px; height: auto;">
                            <img src="../assets/img<?= $pengumuman['foto_pengumuman'] ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="_token" value="<?= $pengumuman['id_pengumuman'] ?>">
                <button type="submit" name="hapusPengumuman" class="btn btn-success">Hapus</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </form>
<?php }
} else {
    echo '<script type="text/javascript">
    window.location = "../"
    </script>';
} ?>