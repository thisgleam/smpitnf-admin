<?php

session_start();

if (!isset($_SESSION['login'])) {
	echo "<script>
		  document.location.href = 'login';
		  </script>";
	exit;
}

if (($_SESSION['level'] != 1)) {
	echo "<script>
		  document.location.href = 'arsip_materi';
		  </script>";
	exit;
}

include 'config/app.php';

$id_akun = (int)$_GET['id_akun'];

if (delete_akun($id_akun) > 0) {
    $_SESSION['alert'] = [
        'message' => 'Data akun berhasil dihapus',
        'type' => 'success'
    ];
} else {
    $_SESSION['alert'] = [
        'message' => 'Data akun gagal dihapus',
        'type' => 'danger'
    ];
}

header("Location: admin");
exit();
?>