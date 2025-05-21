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
        <h5 class="modal-title"><i class="fa fa-plus"></i> Tambah PTK</h5>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama_ptk" aria-describedby="defaultFormControlHelp" required>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir" aria-describedby="defaultFormControlHelp" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <input class="form-control " id="tgl-lahir-ptk" placeholder="Tanggal Lahir" name="tgl_lahir" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-control" required name="jk">
                                <option value="" disabled selected>--Pilih Jenis Kelamin--</option>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">No. HP</label>
                            <input type="text" class="form-control" placeholder="Nomor HP" name="no_hp" aria-describedby="defaultFormControlHelp">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea class="form-control" name="alamat" id="" rows="5"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Jabatan</label>
                    <select class="form-control" required name="jabatan">
                        <option value="" disabled selected>--Pilih Jabatan--</option>
                        <?php
                        $sqlJabatan = mysqli_query($myConnection, "select * from tb_jabatan_ptk where soft_delete = 0");
                        while ($viewJabatan = mysqli_fetch_array($sqlJabatan)) {
                            echo  '<option value="' . $viewJabatan['id_jabatan'] . '">' . $viewJabatan['nama_jabatan'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tugas Tambahan</label>
                    <textarea class="form-control" name="tugas_tambahan" id="" rows="2"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Foto Profil</label>
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: auto; height: 150px;">
                            <img src="../assets/img/common/user.jpeg" alt="">
                        </div>
                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: auto; max-height: 150px; line-height: 20px;"></div>
                        <div>
                            <span class="btn btn-theme04 btn-file">
                                <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Foto</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                                <input type="file" name="foto_ptk" class="default">
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" name="tambahPTK" class="btn btn-success">Simpan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Batal</button>
    </div>
</form>
<script type="text/javascript">
    $(function() {
        $('#tgl-lahir-ptk').datepicker({
            uiLibrary: 'bootstrap',
            format: 'dd-mm-yyyy'
        });
    });
</script>