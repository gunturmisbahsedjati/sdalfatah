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
$viewNama = mysqli_fetch_array(mysqli_query($myConnection, "SELECT * FROM tb_pengguna WHERE id_pengguna='$id'"));
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
    <div class="row">
        <div class="col-lg-6">
            <div class="alert alert-success">
                <h3>Halo, <?= $viewNama['nama_pengguna'] ?></h3>
                <div class="row mt">
                    <div class="col-lg-12">
                        <p>Manajemen Web Portal SD Al-Fatah Surabaya</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>