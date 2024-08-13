<?php

header('Content-Type: application/json');
require '../config/app.php';

parse_str(file_get_contents('php://input'), $PUT);

$id = $delete['id'];

$query = "DELETE FROM data_dokumen WHERE id = $id";

mysqli_query($db, $query);

if ($query){
    echo json_encode(['pesan' => 'Data dokumen berhasil dihapus']);
} else {
    echo json_encode(['pesan' => 'Data dokumen gagal dihapus']);

}


?>