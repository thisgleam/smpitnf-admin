<?php

session_start();
ob_start();

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

$title = 'Arsip Akreditas';

include 'layout/header.php';

$data_dok = select("SELECT * FROM data_dokumen ORDER BY id DESC");

if (isset($_POST['tambah'])) {
    if (create_data($_POST) > 0) {
        $_SESSION['alert'] = [
            'message' => 'Data dokumen berhasil ditambahkan',
            'type' => 'success'
        ];
    } else {
        $_SESSION['alert'] = [
            'message' => 'Data dokumen gagal ditambahkan',
            'type' => 'danger'
        ];
    }
    
    header("Location: data_dokumen");
    exit();
}

if (isset($_POST['ubah'])) {
    if (update_data($_POST) > 0) {
        $_SESSION['alert'] = [
            'message' => 'Data dokumen berhasil diubah',
            'type' => 'success'
        ];
    } else {
        $_SESSION['alert'] = [
            'message' => 'Data dokumen gagal diubah',
            'type' => 'danger'
        ];
    }
    header("Location: data_dokumen");
    exit();
}

?>

<main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0"><i class="fas fa-folder"></i> Data Dokumen</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Arsip Dokumen
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
                                    <h3 class="card-title">Tabel Data Dokumen</h3>
                                </div> <!-- /.card-header -->
                                <div class="card-body">
                                    <?php if (isset($_SESSION['alert'])) : ?>
                                    <div class="alert alert-<?= $_SESSION['alert']['type'] ?> alert-dismissible fade show" role="alert">
                                        <?= $_SESSION['alert']['message'] ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    <?php unset($_SESSION['alert']); ?>
                                    <?php endif; ?>
                                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle='modal' data-bs-target="#modalTambah"><i class="fas fa-plus-circle"></i> Tambah Data</button>
                                    <table id="dokumen" class="table table-bordered table-striped mt-3" style="color: #17A2B8;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Jenis Dokumen</th>
                                                <th>Lokasi Ruangan | Lemari | Rak | Box | Map | Urut</th>
                                                <th>Nomor Dok</th>
                                                <th>Nama Dok</th>
                                                <th>Tahun Ajaran</th>
                                                <th>Tanggal Dokumen</th>
                                                <th>Tanggal Upload</th>
                                                <th>Tanggal Diubah</th>
                                                <th>Aksi</th>
                                            </tr>	
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php foreach ($data_dok as $dokumen) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $dokumen['jenis_dok']; ?></td>
                                                <td><?= $dokumen['ruang'], ' | ', $dokumen['lemari'], ' | ', $dokumen['rak'], ' | ', $dokumen['box'], ' | ', $dokumen['map'], ' | ', $dokumen['urut']; ?></td>
                                                <td><?= $dokumen['no_dok']; ?></td>
                                                <td><?= $dokumen['nama_dok']; ?></td>
                                                <td><?= $dokumen['tahun_ajaran']; ?></td>
                                                <td><?= $dokumen['tanggal_dok']; ?></td>
                                                <td><?= date('d-m-Y | H:i:s', strtotime($dokumen['tanggal_upload'])); ?></td>
                                                <td><?= date('d-m-Y | H:i:s', strtotime($dokumen['tanggal_diubah'])); ?></td>
                                                <td width="10%" class="text-center">
                                                    <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $dokumen["id"];?>"><i class="fas fa-edit"></i></button>
                                                    <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $dokumen["id"];?>"><i class="fas fa-trash"></i></button>
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


<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-white" style="background-color: #17A2B8;">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Materi</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
            <div class="d-flex gap-5">
  				<div class="mb-3">
					<label for="ruang" class="form-label">Ruang</label>
					<input type="text" class="form-control" id="ruang" name="ruang"  placeholder="Ruang" required>
				</div>
  				<div class="mb-3">
					<label for="lemari" class="form-label">Lemari</label>
					<input type="text" class="form-control" id="lemari" name="lemari" placeholder="Lemari" required>
				</div>
  				<div class="mb-3">
					<label for="rak" class="form-label">Rak</label>
					<input type="text" class="form-control" id="rak" name="rak" placeholder="Rak" required>
				</div>
  			</div>
			<div class="d-flex gap-5">
  				<div class="mb-3">
					<label for="box" class="form-label">Box</label>
					<input type="text" class="form-control" id="box" name="box" placeholder="Box" required>
				</div>
				<div class="mb-3">
					<label for="map" class="form-label">Map</label>
					<input type="text" class="form-control" id="map" name="map" placeholder="Map" required>
				</div>
				<div class="mb-3">
					<label for="urut" class="form-label">Urut</label>
					<input type="text" class="form-control" id="urut" name="urut" placeholder="Urut" required>
				</div>
  			</div>
			<div class="mb-3">
				<label for="jenis_dok" class="form-label">Jenis Dokumen</label>
				<input type="text" class="form-control" id="jenis_dok" name="jenis_dok" placeholder="Ijazah" required>
			</div>
			<div class="mb-3">
				<label for="no_dok" class="form-label">No Dokumen</label>
				<input type="number" class="form-control" id="no_dok" name="no_dok" placeholder="001" required>
			</div>
			<div class="mb-3">
				<label for="nama_dok" class="form-label">Nama Dokumen</label>
				<input type="text" class="form-control" id="nama_dok" name="nama_dok" placeholder="Nama Dokumen" required>
			</div>
			<div class="mb-3">
				<label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
				<input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran"  placeholder="2024/2025" required>
			</div>
			<div class="mb-3">
				<label for="tanggal_dokumen" class="form-label">Tanggal Dokumen</label>
				<input type="text" class="form-control" id="tanggal_dokumen" name="tanggal_dokumen" placeholder="dd-mm-yyyy" required>
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php foreach ($data_dok as $dokumen) : ?>
  <div class="modal fade" id="modalHapus<?= $dokumen["id"];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-white" style="background-color: #17A2B8;">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Akun</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Yakin data dokumen akan dihapus?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="hapus-data?id=<?= $dokumen['id'];?>" class="btn btn-danger">Delete</a>
      </div>
      </form>
    </div>
  </div>
  </div>
<?php endforeach; ?>

<?php foreach($data_dok as $dokumen) : ?>
  <div class="modal fade" id="modalUbah<?= $dokumen['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-white" style="background-color: #17A2B8;">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
			<input type="hidden" id="id" name="id" value="<?= $dokumen['id'];?>">
            <div class="d-flex gap-5">
  				<div class="mb-3">
					<label for="ruang" class="form-label">Ruang</label>
					<input type="text" class="form-control" id="ruang" name="ruang" value="<?= $dokumen['ruang'];?>" placeholder="Ruang" required>
				</div>
  				<div class="mb-3">
					<label for="lemari" class="form-label">Lemari</label>
					<input type="text" class="form-control" id="lemari" name="lemari" value="<?= $dokumen['lemari'];?>" placeholder="Lemari" required>
				</div>
  				<div class="mb-3">
					<label for="rak" class="form-label">Rak</label>
					<input type="text" class="form-control" id="rak" name="rak" value="<?= $dokumen['rak'];?>" placeholder="Rak" required>
				</div>
  			</div>
			<div class="d-flex gap-5">
  				<div class="mb-3">
					<label for="box" class="form-label">Box</label>
					<input type="text" class="form-control" id="box" name="box" value="<?= $dokumen['box'];?>" placeholder="Box" required>
				</div>
				<div class="mb-3">
					<label for="map" class="form-label">Map</label>
					<input type="text" class="form-control" id="map" name="map" value="<?= $dokumen['map'];?>" placeholder="Map" required>
				</div>
				<div class="mb-3">
					<label for="urut" class="form-label">Urut</label>
					<input type="text" class="form-control" id="urut" name="urut" value="<?= $dokumen['urut'];?>" placeholder="Urut" required>
				</div>
  			</div>
			<div class="mb-3">
				<label for="jenis_dok" class="form-label">Jenis Dokumen</label>
				<input type="text" class="form-control" id="jenis_dok" name="jenis_dok" value="<?= $dokumen['jenis_dok'];?>" placeholder="Ijazah" required>
			</div>
			<div class="mb-3">
				<label for="no_dok" class="form-label">No Dokumen</label>
				<input type="number" class="form-control" id="no_dok" name="no_dok" value="<?= $dokumen['no_dok'];?>"  required>
			</div>
			<div class="mb-3">
				<label for="nama_dok" class="form-label">Nama Dokumen</label>
				<input type="text" class="form-control" id="nama_dok" name="nama_dok" value="<?= $dokumen['nama_dok'];?>" placeholder="Nama Dokumen" required>
			</div>
			<div class="mb-3">
				<label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
				<input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" value="<?= $dokumen['tahun_ajaran'];?>" placeholder="2024/2025" required>
			</div>
			<div class="mb-3">
				<label for="tanggal_dokumen" class="form-label">Tanggal Dokumen</label>
				<input type="text" class="form-control" id="tanggal_dokumen" name="tanggal_dokumen" value="<?= $dokumen['tanggal_dok'];?>" placeholder="dd-mm-yyyy" required>
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

<?php 

include 'layout/footer.php';
ob_end_flush()

?>