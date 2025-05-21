<?php
$time_start = microtime(true);
require_once './inc/inc.koneksi.php';
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
if (isset($_SESSION['alert'])) : ?>
    <script>
        let Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        })
        <?php
        echo $_SESSION['alert'];
        unset($_SESSION['alert']);
        ?>
    </script>
<?php endif ?>
<div class="mt-4">
    <section class="task-panel tasks-widget">
        <div class="task-content">
            <div class="row content-panel">
                <div class="panel-heading">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active">
                            <a class="bg-info" data-toggle="tab" href="#overview" aria-expanded="true">Sejarah</a>
                        </li>
                        <li class="">
                            <a class="bg-info" data-toggle="tab" href="#contact" aria-expanded="false">Visi dan Misi</a>
                        </li>
                    </ul>
                </div>
                <!-- /panel-heading -->
                <div class="panel-body">
                    <div class="tab-content">
                        <div id="overview" class="tab-pane active">
                            <form action="setProfilSekolah" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
                                <?php
                                $viewSejarah = mysqli_fetch_array(mysqli_query($myConnection, "select sejarah, foto_sejarah from tb_profil_sekolah"));
                                ?>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label class="control-label"><strong>Sejarah Sekolah</strong></label>
                                            <div class="">
                                                <!-- <textarea class="form-control" rows="15" name="" id=""><?= $viewSejarah['sejarah'] ?></textarea> -->
                                                <textarea id="teks_sejarah" name="teks_sejarah"><?= $viewSejarah['sejarah'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label class="control-label"><strong>Gambar Sekolah</strong></label>
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-new thumbnail" style="width: 300px; height: auto;">
                                                    <img src="../assets/img/<?= $viewSejarah['foto_sejarah'] ?>" alt="">
                                                </div>
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 300px; max-height: auto; line-height: 20px;"></div>
                                                <div>
                                                    <span class="btn btn-theme03 btn-file">
                                                        <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Gambar</span>
                                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                                                        <input type="file" name="foto_sejarah" value="<?= $viewSejarah['foto_sejarah'] ?>" class="default">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="form-group pull-right">
                                    <button type="submit" name="simpanSejarah" class="btn btn-success">Simpan</button>
                                </div>
                            </form>
                        </div>
                        <!-- /tab-pane -->
                        <div id="contact" class="tab-pane">
                            <form action="setProfilSekolah" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
                                <?php
                                $viewVisiMisi = mysqli_fetch_array(mysqli_query($myConnection, "select visimisi, foto_visimisi from tb_profil_sekolah"));
                                ?>
                                <div class="row" style="margin-top: -3em;">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label class="control-label"><strong>Visi dan Misi Sekolah</strong></label>
                                            <div class="">
                                                <textarea name="teks_visimisi" id="teks_visimisi"><?= $viewVisiMisi['visimisi'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label class="control-label"><strong>Gambar Sekolah</strong></label>
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-new thumbnail" style="width: 300px; height: auto;">
                                                    <img src="../assets/img/<?= $viewVisiMisi['foto_visimisi'] ?>" alt="">
                                                </div>
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 300px; max-height: auto; line-height: 20px;"></div>
                                                <div>
                                                    <span class="btn btn-theme03 btn-file">
                                                        <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Gambar</span>
                                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                                                        <input type="file" name="foto_visimisi" value="<?= $viewVisiMisi['foto_visimisi'] ?>" class="default">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="form-group pull-right">
                                    <button type="submit" name="simpanVisiMisi" class="btn btn-success">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /tab-content -->
                </div>
                <!-- /panel-body -->
            </div>
        </div>

    </section>
</div>
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div id="load-add-user" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="add-user" id="add-user"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div id="load-edit-user" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="edit-user" id="edit-user"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="delUser" tabindex="-1" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div id="load-del-user" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="del-user" id="del-user"></div>
        </div>
    </div>
</div>