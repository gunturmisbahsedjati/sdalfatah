<?php
$time_start = microtime(true);
require_once './inc/inc.koneksi.php';
require_once './inc/inc.library.php';
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
                <h5><i class="fa fa-file-text-o"></i> Data Berita</h5>
            </div>
            <div class="pull-right">
                <button type="button" class="btn btn-xs btn-icon btn-info" data-toggle="modal" data-target="#addBerita">
                    <i class="fa fa-plus"></i> Tambah Berita
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
                                <th class="text-center text-nowrap align-middle">Isi</th>
                                <th class="text-center text-nowrap align-middle">Gambar</th>
                                <th class="text-center text-nowrap align-middle">Status</th>
                                <th class="text-center text-nowrap align-middle">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sqlBerita = mysqli_query($myConnection, "select * from tb_berita order by status_headline desc, created_date desc");
                            while ($viewBerita = mysqli_fetch_array($sqlBerita)) {
                                if ($viewBerita['status_headline'] == 1) {
                                    $status = 'Tampil di-Headline';
                                    $btn = 'btn-success';
                                } else {
                                    $status = 'Tidak tampil di-Headline';
                                    $btn = 'btn-danger';
                                }
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td><?= $viewBerita['judul_berita'] . '<br>Jenis Berita : <i>' . $viewBerita['jenis_berita'] . '</i>' ?></td>
                                    <td><?= singkatString($viewBerita['isi_berita'], " ....", 100) ?></td>
                                    <td width="20%"><img src="./../assets/img<?= $viewBerita['foto_berita'] ?>" class="img-fluid" width="200"></td>
                                    <td width="20%" class="text-center">
                                        <form action="setBerita" method="post">
                                            <input type="hidden" name="_token" value="<?= $viewBerita['id_berita'] ?>">
                                            <input type="hidden" name="status_headline" value="<?= $viewBerita['status_headline'] ?>">
                                            <button type="submit" name="ubahStatus" class="btn btn-xs btn-icon <?= $btn ?> me-2">
                                                <i class="fa fa-star"></i> <?= $status ?>
                                            </button>
                                        </form>
                                    </td>
                                    <td width="10%" class="text-center text-nowrap">
                                        <button type="button" class="btn btn-xs btn-icon btn-info me-2" data-toggle="modal" data-target="#editBerita" data-id="<?= $viewBerita['id_berita'] ?>">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-xs btn-icon btn-danger" data-toggle="modal" data-target="#delBerita" data-id="<?= $viewBerita['id_berita'] ?>">
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
<div class="modal fade" id="addBerita" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div id="load-add-berita" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="add-berita" id="add-berita"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="editBerita" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div id="load-edit-berita" style="display: none;">
                <div class="modals-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="edit-berita" id="edit-berita"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="delBerita" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div id="load-del-berita" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="del-berita" id="del-berita"></div>
        </div>
    </div>
</div>