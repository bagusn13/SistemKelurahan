<div class="container">
  <div class="row justify-content-center">
    <div class="col">
      <!-- general form elements disabled -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title"><?= $title ?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <!-- multipart di pake klo ada upload gambar -->
          <?php
          // notifikasi form kosong
          echo validation_errors('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fas fa-ban"></i> Alert!</h5>', '</div>');

          // notifikasi gagal upload gambar
          if (isset($error_upload)) {
            echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fas fa-ban"></i> Alert!</h5>' . $error_upload . '</div>';
          }

          echo form_open_multipart('surat_tugas/edit/' . $arsip->id_surat)
          ?>
          <div class="form-group">
            <label>Tentang</label>
            <input name="tentang" class="form-control" placeholder="Tentang" value="<?= $arsip->tentang ?>">
          </div>
          <div class="form-group">
            <label>Ubah Surat</label>
            <input name="surat" type="file" class="form-control" id="preview_gambar">
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
            <a href="<?= base_url('surat_tugas') ?>" class="btn btn-danger btn-lg">Kembali</a>
          </div>

          <?php echo form_close() ?>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </div>
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