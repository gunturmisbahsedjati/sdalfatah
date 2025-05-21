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
                <h5><i class="fa fa-university"></i> Data Profil PTK</h5>
            </div>
            <div class="pull-right">
                <button type="button" class="btn btn-xs btn-icon btn-info" data-toggle="modal" data-target="#addPTK">
                    <i class="fa fa-plus"></i> Tambah PTK
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
                                <th class="text-center text-nowrap align-middle">Nama</th>
                                <th class="text-center text-nowrap align-middle">Jabatan</th>
                                <th class="text-center text-nowrap align-middle">Foto</th>
                                <th class="text-center text-nowrap align-middle">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sqlAkun = mysqli_query($myConnection, "select tb_ptk.*, tb_jabatan_ptk.nama_jabatan 
                            from tb_ptk
                            left join tb_jabatan_ptk on tb_ptk.id_jabatan = tb_jabatan_ptk.id_jabatan 
                            where tb_ptk.soft_delete = 0");
                            while ($viewAkun = mysqli_fetch_array($sqlAkun)) { ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td><?= $viewAkun['nama_ptk'] ?></td>
                                    <td><?= $viewAkun['nama_jabatan'] ?></td>
                                    <td><img src="./../assets/img<?= $viewAkun['foto'] ?>" class="img-circle" width="80"></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-xs btn-icon btn-success me-2" data-toggle="modal" data-target="#detailPTK" data-id="<?= $viewAkun['id_ptk'] ?>">
                                            <i class="fa fa-search"></i>
                                        </button>
                                        <button type="button" class="btn btn-xs btn-icon btn-info me-2" data-toggle="modal" data-target="#editPTK" data-id="<?= $viewAkun['id_ptk'] ?>">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-xs btn-icon btn-danger" data-toggle="modal" data-target="#delPTK" data-id="<?= $viewAkun['id_ptk'] ?>">
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
<div class="modal fade" id="addPTK" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-add-ptk" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="add-ptk" id="add-ptk"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="detailPTK" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div id="load-detail-ptk" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="detail-ptk" id="detail-ptk"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="editPTK" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div id="load-edit-ptk" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="edit-ptk" id="edit-ptk"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="delPTK" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div id="load-del-ptk" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="del-ptk" id="del-ptk"></div>
        </div>
    </div>
</div>