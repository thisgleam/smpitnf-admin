<?php

header('Content-Type: application/json');
require '../config/app.php';

parse_str(file_get_contents('php://input'), $PUT);

$id = $PUT['id'];

$jenis_dok = $PUT['jenis_dok'];

$ruang  = $PUT['ruang'];
$lemari = $PUT['lemari'];
$rak    = $PUT['rak'];
$box    = $PUT['box'];
$map    = $PUT['map'];
$urut   = $PUT['urut'];

$no_dok          = $PUT['no_dok'];
$nama_dok        = $PUT['nama_dok'];
$tahun_ajaran    = $PUT['tahun_ajaran'];
$tanggal_dokumen = $PUT['tanggal_dokumen'];

if ($jenis_dok == null) {
    echo json_encode(['pesan' => 'Jenis dokumen tidak boleh kosong']);
    exit;
}

$query = "UPDATE data_dokumen SET jenis_dok = '$jenis_dok', ruang = '$ruang', lemari = '$lemari', rak = '$rak', box = '$box', map = '$map', urut = '$urut', no_dok = '$no_dok', nama_dok = '$nama_dok', tahun_ajaran = '$tahun_ajaran', tanggal_dok = '$tanggal_dokumen' WHERE id = $id";

mysqli_query($db, $query);

if ($query){
    echo json_encode(['pesan' => 'Data dokumen berhasil diubah']);
} else {
    echo json_encode(['pesan' => 'Data dokumen gagal diubah']);

}


?>