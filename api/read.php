<?php

header('Content-Type: application/json');
require '../config/app.php';

$query = select("SELECT * FROM data_dokumen");

echo json_encode(['data_dokumen' => $query]);

?>