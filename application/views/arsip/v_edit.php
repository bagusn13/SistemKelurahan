<div class="col-md-12">
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
      echo validation_errors('<div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h5><i class="icon fas fa-ban"></i> Alert!</h5>', '</div>');

      // notifikasi gagal upload gambar
      if (isset($error_upload)) {
        echo '<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-ban"></i> Alert!</h5>' . $error_upload . '</div>';
      }

      echo form_open_multipart('arsip/edit/' . $surat->id_arsip) ?>
      <div class="form-group">
        <label>Judul Surat</label>
        <input name="judul_surat" class="form-control" placeholder="Judul Surat" value="<?= $surat->judul_surat ?>">
      </div>

      <div class="form-group">
        <label>Nomor Surat</label>
        <input name="nomor_surat" class="form-control" placeholder="Nomor Surat" value="<?= $surat->nomor_surat ?>">
      </div>

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Ubah Surat</label>
            <input name="surat" type="file" class="form-control" id="preview_gambar">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <img src="<?= base_url('assets/arsipSurat/' . $surat->surat) ?>" alt="" id="gambar_load" width="150px">
          </div>
        </div>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg">Save</button>
        <a href="<?= base_url('arsip') ?>" class="btn btn-danger btn-lg">Back</a>
      </div>

      <?php echo form_close() ?>
    </div>
    <!-- /.card-body -->
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