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
    $sql = mysqli_query($myConnection, "select * from tb_berita where id_berita = '$id'");
    if (mysqli_num_rows($sql) > 0) {
        $berita = mysqli_fetch_array($sql);
?>
        <form action="setBerita" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-header modal-header-hapus">
                <h5 class="modal-title"><i class="fa fa-trash-o"></i> Hapus Berita</h5>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Judul Berita</label>
                    <input type="text" class="form-control" aria-describedby="defaultFormControlHelp" value="<?= $berita['judul_berita'] ?>" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi Berita</label>
                    <div class="">
                        <textarea id="hapus_isi_berita"><?= $berita['isi_berita'] ?></textarea>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Berita</label>
                    <select name="jenis_berita" id="" class="form-control" disabled>
                        <?php
                        if ($berita['jenis_berita'] == 'sekolah') {
                            echo ' <option value="sekolah" selected>Sekolah</option>
                                    <option value="prestasi">Prestasi</option>';
                        } elseif ($berita['jenis_berita'] == 'prestasi') {
                            echo ' <option value="sekolah">Sekolah</option>
                                    <option value="prestasi" selected>Prestasi</option>';
                        } else {
                            echo ' <option value="" disabled selected>--Pilih Jenis Berita--</option>
                                    <option value="sekolah">Sekolah</option>
                                    <option value="prestasi">Prestasi</option>';
                        }
                        ?>

                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: 300px; height: auto;">
                            <img src="../assets/img<?= $berita['foto_berita'] ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="_token" value="<?= $berita['id_berita'] ?>">
                <button type="submit" name="hapusBerita" class="btn btn-success">Hapus</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </form>
<?php }
} else {
    echo '<script type="text/javascript">
    window.location = "../"
    </script>';
} ?>