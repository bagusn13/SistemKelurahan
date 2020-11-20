<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?= base_url('admin') ?>" class="brand-link">
    <img src="<?= base_url() ?>assets/image/logo_dki.png" alt="AdminLTE Logo" class="brand-image-xs" style="opacity: .8">

    <span class="brand-text font-weight-light ml-1">Kelurahan Batu Ampar</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= base_url() ?>assets/image/user_(1).png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?= $this->session->userdata('nama_user') ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?= base_url() ?>admin" class="nav-link <?php if ($this->uri->segment(1) == 'admin') {
                                                              echo "active";
                                                            } ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url() ?>user" class="nav-link <?php if ($this->uri->segment(1) == 'user') {
                                                            echo "active";
                                                          } ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>
              User
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>

        <!-- <li class="nav-item">
          <a href="<?= base_url('arsip') ?>" class="nav-link <?php if ($this->uri->segment(1) == 'arsip') {
                                                                echo "active";
                                                              } ?>">
            <i class="nav-icon fas fa-cubes"></i>
            <p>
              Arsip Surat

            </p>
          </a>
        </li> -->

        <li class="nav-item">
          <a href="<?= base_url('surat_keputusan') ?>" class="nav-link <?php if ($this->uri->segment(1) == 'surat_keputusan') {
                                                                          echo "active";
                                                                        } ?>">
            <i class="nav-icon fas fa-user-tie"></i>
            <p>
              Surat Keputusan
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url('surat_tugas') ?>" class="nav-link <?php if ($this->uri->segment(1) == 'surat_tugas') {
                                                                      echo "active";
                                                                    } ?>">
            <i class="nav-icon fas fa-tasks"></i>
            <p>
              Surat Tugas
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url('surat_masuk') ?>" class="nav-link <?php if ($this->uri->segment(1) == 'surat_masuk') {
                                                                      echo "active";
                                                                    } ?>">
            <i class="nav-icon fas fa-inbox"></i>
            <p>
              Surat Masuk
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url('surat_keluar') ?>" class="nav-link <?php if ($this->uri->segment(1) == 'surat_keluar') {
                                                                      echo "active";
                                                                    } ?>">
            <i class="nav-icon fas fa-paper-plane"></i>
            <p>
              Surat Keluar
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url() ?>auth/logout_user" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Logout
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row justify-content-center mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?= $title ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>admin">Home</a></li>
            <li class="breadcrumb-item active"><?= $title ?></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">