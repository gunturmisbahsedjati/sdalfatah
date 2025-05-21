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
    $sql = mysqli_query($myConnection, "select tb_ptk.*, tb_jabatan_ptk.nama_jabatan 
                            from tb_ptk
                            left join tb_jabatan_ptk on tb_ptk.id_jabatan = tb_jabatan_ptk.id_jabatan 
                            where tb_jabatan_ptk.soft_delete = 0 and id_ptk = '$id'");
    if (mysqli_num_rows($sql) > 0) {
        $ptk = mysqli_fetch_array($sql);
        if ($ptk['tgl_lahir'] == '' || $ptk['tgl_lahir'] == '0000-00-00') {
            $tgl_lahir = '';
        } else {
            $tgl_lahir = $ptk['tgl_lahir'];
        }
?>
        <form action="setPTK" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-header modal-header-hapus">
                <h5 class="modal-title"><i class="fa fa-trash-o"></i> Hapus Data PTK</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" value="<?= $ptk['nama_ptk'] ?>" readonly>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" value="<?= $ptk['tempat_lahir'] ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input class="form-control " value="<?= Indonesia2Tgl($tgl_lahir) ?>" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <?php
                                    if ($ptk['jk'] == 'L') {
                                        echo '<input class="form-control " value="Laki-Laki" readonly />';
                                    } elseif ($ptk['jk'] == 'P') {
                                        echo '<input class="form-control " value="Perempuan" readonly />';
                                    } else {
                                        echo '<input class="form-control " value="-" readonly />';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">No. HP</label>
                                    <input type="text" class="form-control" value="<?= $ptk['no_hp'] ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" rows="5" readonly><?= $ptk['alamat'] ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Jabatan</label>
                            <input type="text" class="form-control" value="<?= $ptk['nama_jabatan'] ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tugas Tambahan</label>
                            <textarea class="form-control" rows="2" readonly><?= $ptk['tugas_tambahan'] ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto Profil</label>
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: auto; height: 150px;">
                                    <img src="../assets/img<?= $ptk['foto'] ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="_token" value="<?= $ptk['id_ptk'] ?>">
                <button type="submit" name="hapusPTK" class="btn btn-success">Hapus</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Tutup</button>
            </div>
        </form>
    <?php } else { ?>
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Error</h3>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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