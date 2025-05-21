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
}
if (!isset($_SESSION['status_login'])) {
    echo '<script type="text/javascript">
    window.location = "./"
    </script>';
    exit;
}
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = mysqli_query($myConnection, "select * from tb_pengguna where soft_delete = 0 and id_pengguna = '$id'");
    if (mysqli_num_rows($sql) > 0) {
        $user = mysqli_fetch_array($sql); ?>
        <form action="setUser" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-header modal-header-ubah">
                <h5 class="modal-title"><i class="fa fa-edit"></i> Ubah Pengguna</h5>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" value="<?= $user['nama_pengguna'] ?>" aria-describedby="defaultFormControlHelp" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" placeholder="Username" name="user" value="<?= $user['username'] ?>" aria-describedby="defaultFormControlHelp" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="text" class="form-control" placeholder="Password" name="pass" disabled value="*********" aria-describedby="defaultFormControlHelp" required>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="_token" value="<?= $user['id_pengguna'] ?>">
                <button type="submit" name="ubahUser" class="btn btn-success">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </form>
    <?php } else { ?>
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Error</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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