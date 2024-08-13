<?php

session_start();

if (!isset($_SESSION['login'])) {
	echo "<script>
		  document.location.href = 'login';
		  </script>";
	exit;
}

include 'config/app.php';

$id_materi = (int)$_GET['id_materi'];

if (delete_materi($id_materi) > 0) {
    $_SESSION['alert'] = [
        'message' => 'Data materi berhasil dihapus',
        'type' => 'success'
    ];
} else {
    $_SESSION['alert'] = [
        'message' => 'Data materi gagal dihapus',
        'type' => 'danger'
    ];
}

header("Location: arsip_materi");
exit();
?>