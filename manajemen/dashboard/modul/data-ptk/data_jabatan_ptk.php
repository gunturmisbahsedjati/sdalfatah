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
                <h5><i class="fa fa-university"></i> Data Jabatan PTK</h5>
            </div>
            <div class="pull-right">
                <button type="button" class="btn btn-xs btn-icon btn-info" data-toggle="modal" data-target="#addJabatan">
                    <i class="fa fa-plus"></i> Tambah Jabatan
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
                                <th class="text-center text-nowrap align-middle">Nama Jabatan PTK</th>
                                <th class="text-center text-nowrap align-middle">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sqlAkun = mysqli_query($myConnection, "select * from tb_jabatan_ptk where soft_delete = 0");
                            while ($viewAkun = mysqli_fetch_array($sqlAkun)) { ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td><?= $viewAkun['nama_jabatan'] ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-xs btn-icon btn-info me-2" data-toggle="modal" data-target="#editJabatan" data-id="<?= $viewAkun['id_jabatan'] ?>">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-xs btn-icon btn-danger" data-toggle="modal" data-target="#delJabatan" data-id="<?= $viewAkun['id_jabatan'] ?>">
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
<div class="modal fade" id="addJabatan" tabindex="-1" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div id="load-add-jabatan" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="add-jabatan" id="add-jabatan"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="editJabatan" tabindex="-1" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div id="load-edit-jabatan" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="edit-jabatan" id="edit-jabatan"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="delJabatan" tabindex="-1" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div id="load-del-jabatan" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="del-jabatan" id="del-jabatan"></div>
        </div>
    </div>
</div>