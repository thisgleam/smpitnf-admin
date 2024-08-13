<?php

function select($query)
{
  global $db;

  $result = mysqli_query($db, $query);
  $rows = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

//CREATE
function create_data($post)
{
  global $db;

  $jenis_dok = strip_tags($post['jenis_dok']);

  $ruang  = strip_tags($post['ruang']);
  $lemari = strip_tags($post['lemari']);
  $rak    = strip_tags($post['rak']);
  $box    = strip_tags($post['box']);
  $map    = strip_tags($post['map']);
  $urut   = strip_tags($post['urut']);

  $no_dok          = strip_tags($post['no_dok']);
  $nama_dok        = strip_tags($post['nama_dok']);
  $tahun_ajaran    = strip_tags($post['tahun_ajaran']);
  $tanggal_dokumen = strip_tags($post['tanggal_dokumen']);



  $query = "INSERT INTO data_dokumen VALUES(null, '$jenis_dok', '$ruang', '$lemari', '$rak', '$box', '$map', '$urut', '$no_dok', '$nama_dok', '$tahun_ajaran', '$tanggal_dokumen', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP())";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}

//CREATE
function create_materi($post)
{
  global $db;

  $judul = strip_tags($post['judul_materi']);

  $desc  = strip_tags($post['deskripsi_materi']);
  $mapel = strip_tags($post['mata_pelajaran']);
  $link    = strip_tags($post['link_materi']);
  $tipe    = strip_tags($post['tipe_file']);

  $query = "INSERT INTO data_materi VALUES(null, '$judul', '$desc', '$mapel', '$link', '$tipe', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP())";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}

//CREATE
function create_akun($post)
{
  global $db;

  $nama = strip_tags($post['nama']);
  $email  = strip_tags($post['email']);
  $username = strip_tags($post['username']);
  $password    = strip_tags($post['password']);
  $level    = strip_tags($post['level']);

  $password = password_hash($password, PASSWORD_DEFAULT);

  $query = "INSERT INTO akun VALUES(null, '$nama', '$email', '$username', '$password', '$level', CURRENT_TIMESTAMP())";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}

//UPDATE
function update_data($post)
{
  global $db;

  $id = strip_tags($post['id']);

  $jenis_dok = strip_tags($post['jenis_dok']);

  $ruang  = strip_tags($post['ruang']);
  $lemari = strip_tags($post['lemari']);
  $rak    = strip_tags($post['rak']);
  $box    = strip_tags($post['box']);
  $map    = strip_tags($post['map']);
  $urut   = strip_tags($post['urut']);

  $no_dok          = strip_tags($post['no_dok']);
  $nama_dok        = strip_tags($post['nama_dok']);
  $tahun_ajaran    = strip_tags($post['tahun_ajaran']);
  $tanggal_dokumen = strip_tags($post['tanggal_dokumen']);


  $query = "UPDATE data_dokumen SET jenis_dok = '$jenis_dok', ruang = '$ruang', lemari = '$lemari', rak = '$rak', box = '$box', map = '$map', urut = '$urut', no_dok = '$no_dok', nama_dok = '$nama_dok', tahun_ajaran = '$tahun_ajaran', tanggal_dok = '$tanggal_dokumen' WHERE id = $id";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}

//UPDATE
function update_materi($post)
{
  global $db;

  $id = strip_tags($post['id']);

  $judul = strip_tags($post['judul_materi']);

  $desc  = strip_tags($post['deskripsi_materi']);
  $mapel = strip_tags($post['mata_pelajaran']);
  $link  = strip_tags($post['link_materi']);
  $tipe  = strip_tags($post['tipe_file']);

  $query = "UPDATE data_materi SET id_materi = '$id', judul = '$judul', deskripsi = '$desc', mata_pelajaran = '$mapel', link_materi = '$link', tipe_file = '$tipe' WHERE id_materi = $id";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}

//UPDATE
function update_akun($post)
{
  global $db;

  $id_akun  = strip_tags($post['id_akun']);
  $nama     = strip_tags($post['nama']);
  $email    = strip_tags($post['email']);
  $username = strip_tags($post['username']);
  $password = strip_tags($post['password']);
  $level    = strip_tags($post['level']);

  $password = password_hash($password, PASSWORD_DEFAULT);

  $query = "UPDATE akun SET nama = '$nama', email = '$email', username = '$username', password = '$password', level = '$level' WHERE id_akun = $id_akun";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}

//DELETE
function delete_data($id)
{
  global $db;

  $query = "DELETE FROM data_dokumen WHERE id = $id";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}

//DELETE
function delete_materi($id_materi)
{
  global $db;

  $query = "DELETE FROM data_materi WHERE id_materi = $id_materi";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}

//DELETE
function delete_akun($id_akun)
{
  global $db;

  $query = "DELETE FROM akun WHERE id_akun = $id_akun";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}


?>