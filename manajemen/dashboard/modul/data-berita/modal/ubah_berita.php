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
            <div class="modal-header modal-header-ubah">
                <h5 class="modal-title"><i class="fa fa-edit"></i> Ubah Pengumuman</h5>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Judul Berita</label>
                    <input type="text" class="form-control" placeholder="Judul Berita" name="judul_berita" aria-describedby="defaultFormControlHelp" value="<?= $berita['judul_berita'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi Berita</label>
                    <div class="">
                        <textarea name="isi_berita" id="ubah_isi_berita"><?= $berita['isi_berita'] ?></textarea>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Berita</label>
                    <select name="jenis_berita" id="" class="form-control">
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
                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 300px; max-height: auto; line-height: 20px;"></div>
                        <div>
                            <span class="btn btn-theme04 btn-file">
                                <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Foto</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                                <input type="file" name="foto_berita" value="<?= $berita['foto_berita'] ?>" class="default">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="_token" value="<?= $berita['id_berita'] ?>">
                <button type="submit" name="ubahBerita" class="btn btn-success">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </form>
<?php }
} else {
    echo '<script type="text/javascript">
    window.location = "../"
    </script>';
} ?>