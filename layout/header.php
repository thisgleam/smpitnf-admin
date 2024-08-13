<?php

include "config/app.php";

$data_akun = select("SELECT * FROM akun ORDER BY id_akun DESC");

?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="SMPIT NURUL FIKRI">
    <meta name="author" content="thisgleam">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="dist/css/adminlte.css"><!--end::Required Plugin(AdminLTE)-->
    <link rel="shortcut icon" href="./layout/image/smpit-nf.png" type="image/x-icon">
    <link rel="stylesheet" href="./layout/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title><?= $title ?></title>
    <script>
  (function () {
    const storedTheme = localStorage.getItem('theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    if (storedTheme === 'dark' || (!storedTheme && prefersDark)) {
      document.documentElement.setAttribute('data-bs-theme', 'dark');
    } else {
      document.documentElement.setAttribute('data-bs-theme', 'light');
    }
  })();
</script>

</head> <!--end::Head--> <!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i class="bi bi-list"></i> </a> </li>
                </ul> <!--end::Start Navbar Links--> <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto"> <!--begin::Fullscreen Toggle-->
                    <li class="nav-item"> <a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i> </a> </li> <!--end::Fullscreen Toggle--> <!--begin::User Menu Dropdown-->
                    <li class="nav-item dropdown"> <button class="btn btn-link nav-link py-2 px-0 px-lg-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" data-bs-display="static"> <span class="theme-icon-active"> <i class="my-1"></i> </span> <span class="d-lg-none ms-2" id="bd-theme-text">Toggle theme</span> </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme-text" style="--bs-dropdown-min-width: 8rem;">
                            <li> <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="light" aria-pressed="false"> <i class="bi bi-sun-fill me-2"></i>
                                Light
                                <i class="bi bi-check-lg ms-auto d-none"></i> </button> 
                            </li>
                            <li> <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false"> <i class="bi bi-moon-fill me-2"></i>
                                Dark
                                <i class="bi bi-check-lg ms-auto d-none"></i> </button> 
                            </li>
                            <li> <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto" aria-pressed="true"> <i class="bi bi-circle-fill-half-stroke me-2"></i>
                                Auto
                                <i class="bi bi-check-lg ms-auto d-none"></i> </button>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> <img src="layout/image/user.jpg" class="user-image rounded-circle shadow" alt="User Image"> <span class="d-none d-md-inline"><?= $_SESSION['nama'];?></span> </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <!--begin::User Image-->
                            <li class="user-header text-bg-primary"> <img src="layout/image/user.jpg" class="rounded-circle shadow" alt="User Image">
                                <p>
                                    <?= $_SESSION['nama'];?>
                                    <small>Member since 
                                    <?php foreach ($data_akun as $akun) : ?>
                                    <?php endforeach; ?>
                                    <?= date('d-m-Y | H:i:s', strtotime($akun['created'])); ?>
                                    </small>
                                </p>
                            </li> <!--end::User Image--> <!--begin::Menu Body-->
                        </ul>
                    </li> <!--end::User Menu Dropdown-->
                    <a href="logout" class="btn btn-warning btn-icon-split">
                        <span class="icon text-white-50">
                        <i class="nav-icon fas fa-sign-out-alt text-black"></i>
                        </span>
                        <span class="brand-text font-weight-light text-black text-uppercase"><b>Sign Out</b></span>
                    </a>
                </ul> <!--end::End Navbar Links-->
            </div> <!--end::Container-->
        </nav> <!--end::Header--> <!--begin::Sidebar-->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme=""> <!--begin::Sidebar Brand-->
            <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="dashboard" class="brand-link"> <!--begin::Brand Image--> <img src="./layout/image/smpit-nf.png" alt="SMPITNF LOGO" class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--> <span class="brand-text fw-light">SMPIT NURUL FIKRI</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2"> <!--begin::Sidebar Menu-->
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                        <li class="nav-item"> <a href="dashboard" class="nav-link"> <i class="nav-icon fa-solid fa-house"></i>
                                <p><b>DASHBOARD</b></p>
                            </a> 
                        </li>
                        <li class="nav-header"><b>Daftar Menu</b></li>
                        <?php if ($_SESSION['level'] == 1):?>
                        <li class="nav-item"> <a href="admin" class="nav-link"> <i class="nav-icon fas fa-user-shield"></i>
                                <p>Admin</p>
                            </a> 
                        </li>
                        <li class="nav-item"> <a href="backup" class="nav-link"> <i class="nav-icon fa-solid fa-database"></i>
                                <p>Backup Database</p>
                            </a> 
                        </li>
                        <li class="nav-item"> <a href="data_dokumen" class="nav-link"> <i class="nav-icon fas fa-folder"></i>
                                <p>Arsip Akreditas</p>
                        </a> </li>
                        <?php endif;?>
                        <li class="nav-item"> <a href="arsip_materi" class="nav-link"> <i class="nav-icon fas fa-book"></i>
                                <p>Arsip Materi</p>
                            </a> </li>
                        <li class="nav-item"> <a href="logout" class="nav-link"> <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Sign Out</p>
                            </a> 
                        </li>
                    </ul> <!--end::Sidebar Menu-->
                </nav>
            </div> <!--end::Sidebar Wrapper-->
        </aside> <!--end::Sidebar--> <!--begin::App Main-->