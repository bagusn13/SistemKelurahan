<div class="col-md-12">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Data <?= $title ?></h3>
      <div class="card-tools">
        <!-- <a href="<?= base_url('arsip/add') ?>" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>
          Add</a> -->

        <button data-toggle="modal" data-target="#add" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>
          Add</button>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <?php
      // flashdata klo formnya kosong (kudu diisi)
      echo validation_errors('<div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>', '</div>');

      if ($this->session->flashdata('pesan')) {
        echo '<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Success!</h5>';
        echo $this->session->flashdata('pesan');
        echo '</div>';
      }
      ?>
      <table class="table table-bordered" id="example1">
        <thead class="text-center">
          <tr>
            <th>No</th>
            <th>Judul Surat</th>
            <th>Nomor Surat</th>
            <th>Tanggal Arsip</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <?php $no = 1;
          foreach ($arsip as $key => $value) { ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $value->judul_surat ?></td>
              <td><?= $value->nomor_surat ?></td>
              <td><?= $value->created_at ?></td>
              <td>
                <button data-toggle="modal" data-target="#view<?= $value->id_arsip ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i>
                </button>

                <!-- <a href="<?= base_url('arsip/edit/' . $value->id_arsip) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a> -->

                <button data-toggle="modal" data-target="#edit<?= $value->id_arsip ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>

                <button data-toggle="modal" data-target="#delete<?= $value->id_arsip ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
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




<!-- modal delete -->
<?php foreach ($arsip as $key => $value) { ?>
  <div class="modal fade" id="delete<?= $value->id_arsip ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Hapus <?= $title ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Yakin ingin menghapus arsip surat dengan judul surat <?= $value->judul_surat ?></p>
        </div>
        <?php
        echo form_open('arsip/delete/' . $value->id_arsip);
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
  <div class="modal fade" id="view<?= $value->id_arsip ?>">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">View <?= $value->surat ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <iframe src='http://localhost/sistemkelurahan/assets/arsipSurat/<?= $value->surat ?>' width="100%" height="600"></iframe>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php } ?>

<!-- modal edit -->
<?php foreach ($arsip as $key => $value) { ?>
  <div class="modal fade" id="edit<?= $value->id_arsip ?>">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit <?= $value->judul_surat ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php
          // notifikasi form kosong
          echo validation_errors('<div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-ban"></i> Alert!</h5>', '</div>');

          // notifikasi gagal upload gambar
          if (isset($error_upload)) {
            echo '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Alert!</h5>' . $error_upload . '</div>';
          }
          echo form_open_multipart('arsip/edit/' . $value->id_arsip)
          ?>
          <div class="form-group">
            <label>Judul Surat</label>
            <input name="judul_surat" class="form-control" placeholder="Judul Surat" value="<?= $value->judul_surat ?>" required>
          </div>

          <div class="form-group">
            <label>Nomor Surat</label>
            <input name="nomor_surat" class="form-control" placeholder="Nomor Surat" value="<?= $value->nomor_surat ?>" required>
          </div>


          <div class="form-group">
            <label>Ubah Surat</label>
            <input name="surat" type="file" class="form-control" id="preview_gambar">
          </div>

          <iframe src='http://localhost/sistemkelurahan/assets/arsipSurat/<?= $value->surat ?>' width="100%" height="600"></iframe>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        <?php
        echo form_close();
        ?>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php } ?>

<!-- modal add -->
<div class="modal fade" id="add">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Arsip</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
        // notifikasi form kosong
        echo validation_errors('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fas fa-ban"></i> Alert!</h5>', '</div>');

        // notifikasi gagal upload gambar
        if (isset($error_upload)) {
          echo '<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-ban"></i> Alert!</h5>' . $error_upload . '</div>';
        }

        echo form_open_multipart('arsip/add') ?>
        <div class="form-group">
          <label>Judul Surat</label>
          <input name="judul_surat" class="form-control" placeholder="Judul Surat" value="<?= set_value('judul_surat') ?>" required>
        </div>

        <div class="form-group">
          <label>Nomor Surat</label>
          <input name="nomor_surat" class="form-control" placeholder="Nomor Surat" value="<?= set_value('nomor_surat') ?>" required>
        </div>

        <div class="row">
          <div class="col-sm">
            <div class="form-group">
              <label>Surat</label>
              <input name="surat" type="file" class="form-control" id="preview_gambar" required>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      <?php
      echo form_close();
      ?>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script>
  function bacaGambar(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#gambar_load').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  $("#preview_gambar").change(function() {
    bacaGambar(this)
  });
</script>