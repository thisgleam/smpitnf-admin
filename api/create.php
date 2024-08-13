<?php

header('Content-Type: application/json');
require '../config/app.php';

$nama= $_POST['jenis_dok'];

$jenis_dok = $_POST['jenis_dok'];

$ruang  = $_POST['ruang'];
$lemari = $_POST['lemari'];
$rak    = $_POST['rak'];
$box    = $_POST['box'];
$map    = $_POST['map'];
$urut   = $_POST['urut'];

$no_dok          = $_POST['no_dok'];
$nama_dok        = $_POST['nama_dok'];
$tahun_ajaran    = $_POST['tahun_ajaran'];
$tanggal_dokumen = $_POST['tanggal_dokumen'];

if ($jenis_dok == null) {
    echo json_encode(['pesan' => 'Jenis dokumen tidak boleh kosong']);
    exit;
}

$query = "INSERT INTO data_dokumen VALUES(null, '$jenis_dok', '$ruang', '$lemari', '$rak', '$box', '$map', '$urut', '$no_dok', '$nama_dok', '$tahun_ajaran', '$tanggal_dokumen', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP())";

mysqli_query($db, $query);

if ($query){
    echo json_encode(['pesan' => 'Data dokumen berhasil ditambahkan']);
} else {
    echo json_encode(['pesan' => 'Data dokumen gagal ditambahkan']);

}


?>