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
        <div class="panel-heading">
            <div class="pull-left">
                <h5><i class="fa fa-image"></i> Data Galeri</h5>
            </div>
            <div class="pull-right">
                <button type="button" class="btn btn-xs btn-icon btn-info" data-toggle="modal" data-target="#addImage">
                    <i class="fa fa-plus"></i> Tambah Galeri
                </button>
            </div>
            <br>
        </div>
        <div class="panel-body">
            <div class="task-content">
                <div class="table-responsive">
                    <table id="member_table" class="table table-bordered table-hover" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center text-nowrap align-middle">No.</th>
                                <th class="text-center text-nowrap align-middle">Judul</th>
                                <th class="text-center text-nowrap align-middle">Gambar</th>
                                <th class="text-center text-nowrap align-middle">Status</th>
                                <th class="text-center text-nowrap align-middle">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sqlImage = mysqli_query($myConnection, "select * from tb_galeri order by id_galeri, status_headline desc");
                            while ($viewImage = mysqli_fetch_array($sqlImage)) {
                                if ($viewImage['status_headline'] == 1) {
                                    $status = 'Tampil di-Headline';
                                    $btn = 'btn-success';
                                } else {
                                    $status = 'Tidak tampil di-Headline';
                                    $btn = 'btn-danger';
                                }
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td><?= $viewImage['alt_galeri'] ?></td>
                                    <td><img src="./../assets/img<?= $viewImage['foto_galeri'] ?>" class="img-fluid" width="200"></td>
                                    <td class="text-center">
                                        <form action="setGaleri" method="post">
                                            <input type="hidden" name="_token" value="<?= $viewImage['id_galeri'] ?>">
                                            <input type="hidden" name="status_headline" value="<?= $viewImage['status_headline'] ?>">
                                            <button type="submit" name="ubahStatus" class="btn btn-xs btn-icon <?= $btn ?> me-2">
                                                <i class="fa fa-star"></i> <?= $status ?>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-center text-nowrap">

                                        <button type="button" class="btn btn-xs btn-icon btn-info me-2" data-toggle="modal" data-target="#editImage" data-id="<?= $viewImage['id_galeri'] ?>">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-xs btn-icon btn-danger" data-toggle="modal" data-target="#delImage" data-id="<?= $viewImage['id_galeri'] ?>">
                                            <i class="fa fa-trash-o "></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class=" add-task-row">
                <?= "Process took " . number_format(microtime(true) - $time_start, 2) . " seconds."; ?>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="addImage" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div id="load-add-image" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="add-image" id="add-image"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="editImage" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div id="load-edit-image" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="edit-image" id="edit-image"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="delImage" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div id="load-del-image" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="del-image" id="del-image"></div>
        </div>
    </div>
</div>