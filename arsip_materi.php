<?php

session_start();
ob_start();

if (!isset($_SESSION['login'])) {
	echo "<script>
		  document.location.href = 'login';
		  </script>";
	exit;
}
$title = 'Arsip Materi';

include 'layout/header.php';

$data_materi = select("SELECT * FROM data_materi ORDER BY id_materi DESC");

if (isset($_POST['tambah'])) {
    if (create_materi($_POST) > 0) {
        $_SESSION['alert'] = [
            'message' => 'Data materi berhasil ditambahkan',
            'type' => 'success'
        ];
    } else {
        $_SESSION['alert'] = [
            'message' => 'Data materi gagal ditambahkan',
            'type' => 'danger'
        ];
    }
    header("Location: arsip_materi");
    exit();
}

if (isset($_POST['ubah'])) {
    if (update_materi($_POST) > 0) {
        $_SESSION['alert'] = [
            'message' => 'Data materi berhasil diubah',
            'type' => 'success'
        ];
    } else {
        $_SESSION['alert'] = [
            'message' => 'Data materi gagal diubah',
            'type' => 'danger'
        ];
    }
    header("Location: arsip_materi");
    exit();
}

?>

<main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0"><i class="fas fa-book"></i> Data Materi</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Arsip Materi
                                </li>
                            </ol>
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div> <!--end::App Content Header--> <!--begin::App Content-->
            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row"> <!-- Start col -->
                        <div class="col-lg-20 connectedSortable">
                            <div class="card card-outline card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Tabel Data Materi</h3>
                                </div> <!-- /.card-header -->
                                <div class="card-body">
                                    <?php if (isset($_SESSION['alert'])) : ?>
                                    <div class="alert alert-<?= $_SESSION['alert']['type'] ?> alert-dismissible fade show" role="alert">
                                        <?= $_SESSION['alert']['message'] ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    <?php unset($_SESSION['alert']); ?>
                                    <?php endif; ?>
                                    <button type="button" class="btn btn-primary mb-1" data-bs-toggle='modal' data-bs-target="#modalTambah"><i class="fas fa-plus-circle"></i> Tambah Materi</button>
                                    <a href="https://app.getgrass.io/dashboard" class="btn btn-warning mb-1"><i class="fab fa-google-drive"></i> Akses Gdrive Materi</a>
                                    <table id="dokumen" class="table table-bordered table-striped mt-3" style="color: #17A2B8;">
                                        <thead>
                                            <tr>
                                              <th>No</th>
                                              <th>Judul</th>
                                              <th>Deskripsi</th>
                                              <th>Mata Pelajaran</th>
                                              <th>Tipe File</th>
                                              <th>Tanggal Upload</th>
                                              <th>Tanggal Diubah</th>
                                              <th>Aksi</th>
                                          </tr>		
                                        </thead>
                                        <tbody>
                                          <?php $no = 1; ?>
                                          <?php foreach ($data_materi as $materi) : ?>
                                              <tr>
                                                  <td><?= $no++; ?></td>
                                                  <td><?= $materi['judul']; ?></td>
                                                  <td><?= $materi['deskripsi']; ?></td>
                                                  <td><?= $materi['mata_pelajaran']; ?></td>
                                                  <td><?= $materi['tipe_file']; ?></td>
                                                  <td><?= date('d-m-Y | H:i:s', strtotime($materi['tanggal_upload'])); ?></td>
                                                  <td><?= date('d-m-Y | H:i:s', strtotime($materi['tanggal_diubah'])); ?></td>
                                                  <td width="15%" class="text-center">
                                                    <a href="<?= $materi['link_materi']; ?>" class="btn btn-primary mb-1"><i class="fas fa-download"></i></a>
                                                    <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $materi['id_materi'];?>"><i class="fas fa-edit"></i></button>
                                                    <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $materi["id_materi"];?>"><i class="fas fa-trash"></i></button>
                                                  </td> 
                                              </tr>
                                          <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div> <!-- /.card-body -->
                            </div> <!-- /.card -->
                        </div> <!-- /.Start col --> <!-- Start col -->
                    </div> <!-- /.row (main row) -->
                </div> <!--end::Container-->
            </div> <!--end::App Content-->
        </main> <!--end::App Main--> <!--begin::Footer-->

<!-- Modal Hapus -->
 <?php foreach ($data_materi as $materi) : ?>
  <div class="modal fade" id="modalHapus<?= $materi["id_materi"];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-white" style="background-color: #17A2B8;">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Akun</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Yakin data materi akan dihapus?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="hapus-materi?id_materi=<?= $materi['id_materi'];?>" class="btn btn-danger">Delete</a>
      </div>
      </form>
    </div>
  </div>
  </div>
<?php endforeach; ?>

<!-- Modal Ubah -->
<?php foreach($data_materi as $materi) : ?>
  <div class="modal fade" id="modalUbah<?= $materi['id_materi'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-white" style="background-color: #17A2B8;">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Materi</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="mb-3">
            <input type="hidden" id="id" name="id" value="<?= $materi['id_materi'];?>">

            <label for="judul_materi">Judul Materi</label>
            <input type="text" name="judul_materi" id="judul_materi" class="form-control" value="<?= $materi['judul'];?>" required>
          </div>

          <div class="mb-3">
            <label for="deskripsi_materi">Deskripsi Materi</label>
            <input type="text" name="deskripsi_materi" id="deskripsi_materi" class="form-control" value="<?= $materi["deskripsi"];?>" required>
          </div>

          <div class="mb-3">
            <label for="mata_pelajaran">Mata Pelajaran</label>
            <input type="text" name="mata_pelajaran" id="mata_pelajaran" class="form-control" value="<?= $materi["mata_pelajaran"];?>" required>
          </div>

          <div class="mb-3">
            <label for="link_materi">Link Materi</label>
            <input type="text" name="link_materi" id="link_materi" class="form-control" value="<?= $materi["link_materi"];?>" required>
          </div>

          <div class="mb-3">
            <label for="tipe_file">Tipe File</label>
            <input type="text" name="tipe_file" id="tipe_file" class="form-control" value="<?= $materi["tipe_file"];?>" required>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
      </div>
      </form>
    </div>
  </div>
  </div>
<?php endforeach; ?>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-white" style="background-color: #17A2B8;">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Materi</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="judul_materi">Judul Materi</label>
            <input type="text" name="judul_materi" id="judul_materi" class="form-control" placeholder="Judul" required>
          </div>

          <div class="mb-3">
            <label for="deskripsi_materi">Deskripsi Materi</label>
            <input type="text" name="deskripsi_materi" id="deskripsi_materi" class="form-control" placeholder="Deskripsi" required>
          </div>

          <div class="mb-3">
            <label for="mata_pelajaran">Mata Pelajaran</label>
            <input type="text" name="mata_pelajaran" id="mata_pelajaran" class="form-control" placeholder="IPA" required>
          </div>

          <div class="mb-3">
            <label for="link_materi">Link Materi</label>
            <input type="text" name="link_materi" id="link_materi" class="form-control" placeholder="https://...." required>
          </div>

          <div class="mb-3">
            <label for="tipe_file">Tipe File</label>
            <input type="text" name="tipe_file" id="tipe_file" class="form-control" placeholder="PDF" required>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="tambah" class="btn btn-primary" value="Upload">Tambah</button>
      </div>
      </form>
    </div>
  </div>
</div>


<?php 

include 'layout/footer.php';
ob_end_flush()

?>