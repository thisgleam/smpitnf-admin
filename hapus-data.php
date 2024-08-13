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

$id = (int)$_GET['id'];

if (delete_data($id) > 0) {
    $_SESSION['alert'] = [
        'message' => 'Data dokumen berhasil dihapus',
        'type' => 'success'
    ];
} else {
    $_SESSION['alert'] = [
        'message' => 'Data dokumen gagal dihapus',
        'type' => 'danger'
    ];
}

header("Location: data_dokumen");
exit();
?>