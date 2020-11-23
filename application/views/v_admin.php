<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-12">
      <div class="card card-primary card-outline">
        <div class="card-body">
          <h5 class="card-title">Halo <?= $this->session->userdata('nama_user') ?></h5>
          <p class="card-text">
            Selamat Datang
          </p>
          <!-- row -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?= $masuk ?></h3>

                  <p>Total Surat Masuk</p>
                </div>
                <div class="icon">
                  <i class="fas fa-inbox"></i>
                </div>
                <a href="<?= base_url('surat_masuk') ?>" class="nav-link <?php if ($this->uri->segment(1) == 'surat_masuk') {
                                                                            echo "active";
                                                                          } ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?= $keluar ?></h3>

                  <p>Total Surat Keluar</p>
                </div>
                <div class="icon">
                  <i class="fas fa-paper-plane"></i>
                </div>
                <a href="<?= base_url('surat_keluar') ?>" class="nav-link <?php if ($this->uri->segment(1) == 'surat_keluar') {
                                                                            echo "active";
                                                                          } ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?= $keputusan ?></h3>

                  <p>Total Surat Keputusan</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-tie"></i>
                </div>
                <a href="<?= base_url('surat_keputusan') ?>" class="nav-link <?php if ($this->uri->segment(1) == 'surat_keputusan') {
                                                                                echo "active";
                                                                              } ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-primary">
                <div class="inner">
                  <h3><?= $tugas ?></h3>

                  <p>Total Surat Tugas</p>
                </div>
                <div class="icon">
                  <i class="fas fas fa-tasks"></i>
                </div>
                <a href="<?= base_url('surat_tugas') ?>" class="nav-link <?php if ($this->uri->segment(1) == 'surat_tugas') {
                                                                            echo "active";
                                                                          } ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!--./row -->

        </div>
      </div>
    </div>
  </div>
</div>