<?php
$do = explode("/", $_REQUEST['do']);
$opsi = $do[0];

define('PUB_DIR', dirname(__FILE__) . '/');

switch ($opsi) {
    case 'home':
        require_once(PUB_DIR . 'modul/home/home.php');
        break;

    case 'userList':
        require_once(PUB_DIR . 'modul/data-admin/data_admin.php');
        break;
    case 'setUser':
        require_once(PUB_DIR . 'modul/data-admin/data-admin-aksi.php');
        break;
    case 'profilSekolah':
        require_once(PUB_DIR . 'modul/profil-sekolah/data_profil_sekolah.php');
        break;
    case 'setProfilSekolah':
        require_once(PUB_DIR . 'modul/profil-sekolah/data_profil_sekolah-aksi.php');
        break;
    case 'jabatanPTK':
        require_once(PUB_DIR . 'modul/data-ptk/data_jabatan_ptk.php');
        break;
    case 'daftarPTK':
        require_once(PUB_DIR . 'modul/data-ptk/data_ptk.php');
        break;
    case 'setPTK':
        require_once(PUB_DIR . 'modul/data-ptk/data_ptk_aksi.php');
        break;
    case 'daftarGaleri':
        require_once(PUB_DIR . 'modul/data-galeri/data_galeri.php');
        break;
    case 'setGaleri':
        require_once(PUB_DIR . 'modul/data-galeri/data_galeri_aksi.php');
        break;


    default:
        require_once(PUB_DIR . 'modul/home/home.php');
}
