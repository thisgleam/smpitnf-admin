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

$title = 'Daftar Admin';

include 'layout/header.php';

$data_akun = select("SELECT * FROM akun");

if (isset($_POST['tambah'])) {
    if (create_akun($_POST) > 0) {
        $_SESSION['alert'] = [
            'message' => 'Data akun berhasil ditambahkan',
            'type' => 'success'
        ];
    } else {
        $_SESSION['alert'] = [
            'message' => 'Data akun gagal ditambahkan',
            'type' => 'danger'
        ];
    }
    header("Location: admin");
    exit();
}

if (isset($_POST['ubah'])) {
    if (update_akun($_POST) > 0) {
        $_SESSION['alert'] = [
            'message' => 'Data akun berhasil diubah',
            'type' => 'success'
        ];
    } else {
        $_SESSION['alert'] = [
            'message' => 'Data akun gagal diubah',
            'type' => 'danger'
        ];
    }
    header("Location: admin");
    exit();
}

?>

<main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0"><i class="fas fa-user-shield"></i> Data Login</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Admin
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
                                    <h3 class="card-title">Tabel Data Login</h3>
                                </div> <!-- /.card-header -->
                                <div class="card-body">
                                    <?php if (isset($_SESSION['alert'])) : ?>
                                    <div class="alert alert-<?= $_SESSION['alert']['type'] ?> alert-dismissible fade show" role="alert">
                                        <?= $_SESSION['alert']['message'] ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    <?php unset($_SESSION['alert']); ?>
                                    <?php endif; ?>
                                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle='modal' data-bs-target="#modalTambah"><i class="fas fa-plus-circle"></i> Tambah Akun</button>
                                    <table id="dokumen" class="table table-bordered table-striped mt-3" style="color: #17A2B8;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pemilik</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>Aksi</th>
                                            </tr>		
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php foreach ($data_akun as $akun) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $akun['nama']; ?></td>
                                                <td><?= $akun['email']; ?></td>
                                                <td><?= $akun['username']; ?></td>
                                                <td>Password is Hashed</td>

                                                <td width="10%" class="text-center">
                                                    <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $akun["id_akun"];?>"><i class="fas fa-edit"></i></button>

                                                    <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $akun["id_akun"];?>"><i class="fas fa-trash"></i></button>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Akun</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="mb-3">
            <label for="nama">Nama Pemilik</label>
            <input type="text" name="nama" id="nama" class="form-control" placeholder="John Doe" required>
          </div>

          <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="@gmail.com" required>
          </div>

          <div class="mb-3">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="johndoe" required>
          </div>

          <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="8 character" required minlength="8">
          </div>

          <div class="mb-3">
            <label for="level">Level</label>
            <select name="level" id="level" class="form-control" required>
              <option value="" selected disabled>Pilih Level</option>
              <option value="1">Admin</option>
              <option value="2">Guru</option>
            </select>
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

<!-- Modal Hapus -->
<?php foreach ($data_akun as $akun) : ?>
  <div class="modal fade" id="modalHapus<?= $akun["id_akun"];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-white" style="background-color: #17A2B8;">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Akun</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Yakin Ingin Menghapus Data Akun : <?= $akun['nama'];?> ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="hapus-akun?id_akun=<?= $akun['id_akun'];?>" class="btn btn-danger">Delete</a>
      </div>
      </form>
    </div>
  </div>
  </div>
<?php endforeach; ?>

<!-- Modal Ubah -->
<?php foreach($data_akun as $akun) : ?>
  <div class="modal fade" id="modalUbah<?= $akun["id_akun"];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-white" style="background-color: #17A2B8;">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Akun</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="mb-3">
            <input type="hidden" name="id_akun" value="<?= $akun["id_akun"];?>">

            <label for="nama">Nama Pemilik</label>
            <input type="text" name="nama" id="nama" class="form-control" value="<?= $akun["nama"];?>" required>
          </div>

          <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="<?= $akun["email"];?>" required>
          </div>

          <div class="mb-3">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" value="<?= $akun["username"];?>" required>
          </div>

          <div class="mb-3">
            <label for="password">Password <small>(Masukkan password baru/lama)</small></label>
            <input type="password" name="password" id="password" class="form-control" required minlength="8">
          </div>

          <div class="mb-3">
            <label for="level">Level</label>
            <select name="level" id="level" class="form-control" required>
              <?php $level = $akun['level']; ?>
              <option value="1" <?= $level == '1' ? 'selected' : null ?>>Admin</option>
              <option value="2" <?= $level == '2' ? 'selected' : null ?>>Guru</option>
            </select>
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