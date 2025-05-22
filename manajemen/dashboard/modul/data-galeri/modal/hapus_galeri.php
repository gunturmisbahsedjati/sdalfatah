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
    $sql = mysqli_query($myConnection, "select * from tb_galeri where id_galeri = '$id'");
    if (mysqli_num_rows($sql) > 0) {
        $gambar = mysqli_fetch_array($sql);
?>
        <form action="setGaleri" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-header modal-header-hapus">
                <h5 class="modal-title"><i class="fa fa-trash"></i> Hapus Gambar</h5>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Judul Gambar</label>
                    <input type="text" class="form-control" placeholder="Judul Gambar" value="<?= $gambar['alt_galeri'] ?>" name="alt_galeri" aria-describedby="defaultFormControlHelp" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: 300px; height: auto;">
                            <img src="../assets/img/<?= $gambar['foto_galeri'] ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="_token" value="<?= $gambar['id_galeri'] ?>">
                <button type="submit" name="hapusGambar" class="btn btn-success">Hapus</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </form>
    <?php } else { ?>
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Error</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h2 class="text-center">Data Tidak Ditemukan</h2>
        </div>
<?php }
} else {
    echo '<script type="text/javascript">
    window.location = "../"
    </script>';
} ?>