<div class="container">
  <div class="row justify-content-center">
    <div class="col">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Data <?= $title ?></h3>
          <div class="card-tools">
            <a href="<?= base_url('surat_masuk/add') ?>" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>
              Add</a>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <?php
          // flashdata klo formnya kosong (kudu diisi)
          echo validation_errors('<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>', '</div>');

          if ($this->session->flashdata('pesan')) {
            echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fas fa-check"></i> Success!</h5>';
            echo $this->session->flashdata('pesan');
            echo '</div>';
          }
          ?>

          <table class="table table-bordered" id="example1">
            <thead class="text-center">
              <tr>
                <th>No</th>
                <th>Tanggal Arsip</th>
                <th>Dari</th>
                <th>Nomor Surat</th>
                <th>Tanggal Surat</th>
                <th>Perihal</th>
                <th>Di</th>
                <th>Keterangan</th>
                <th>Kategori</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <?php $no = 1;
              foreach ($arsip as $key => $value) { ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= date_format(date_create($value->tanggal_arsip), "d/m/Y") ?></td>
                  <td><?= $value->dari ?></td>
                  <td><?= $value->nomor_surat ?></td>
                  <td><?= date_format(date_create($value->tanggal_surat), "d/m/Y") ?></td>
                  <td><?= $value->perihal ?></td>
                  <td><?= $value->di ?></td>
                  <td><?= $value->keterangan ?></td>
                  <td><?= $value->kategori ?></td>
                  <td>
                    <button data-toggle="modal" data-target="#view<?= $value->id_surat ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i>
                    </button>

                    <a href="<?= base_url('surat_masuk/edit/' . $value->id_surat) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>

                    <button data-toggle="modal" data-target="#delete<?= $value->id_surat ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
</div>

<!-- modal delete -->
<?php foreach ($arsip as $key => $value) { ?>
  <div class="modal fade" id="delete<?= $value->id_surat ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Hapus <?= $title ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Yakin ingin menghapus arsip surat dengan nomor surat <?= $value->nomor_surat ?></p>
        </div>
        <?php
        echo form_open('surat_masuk/delete/' . $value->id_surat);
        ?>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
        <?php echo form_close(); ?>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php } ?>

<!-- modal view -->
<?php foreach ($arsip as $key => $value) { ?>
  <div class="modal fade" id="view<?= $value->id_surat ?>">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">View <?= $value->surat ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <iframe src='<?php echo base_url() ?>assets/arsipSurat/masuk/<?= $value->surat ?>' width="100%" height="600"></iframe>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php } ?>