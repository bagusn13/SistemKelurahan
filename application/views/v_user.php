<div class="col-md-12">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Data User</h3>

      <div class="card-tools">
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
            <th>Nama User</th>
            <th>Username</th>
            <th>Password</th>
            <th>Level</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <?php $no = 1;
          foreach ($user as $key => $value) { ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $value->nama_user ?></td>
              <td><?= $value->username ?></td>
              <td><?= ($value->password) ?></td>
              <td><?php
                  if ($value->level_user == 1) {
                    echo '<span class="badge bg-primary">Admin</span>';
                  } else {
                    echo '<span class="badge bg-success">User</span>';
                  }
                  ?></td>
              <td>
                <button data-toggle="modal" data-target="#edit<?= $value->id_user ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                <button data-toggle="modal" data-target="#delete<?= $value->id_user ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>

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

<!-- modal add -->
<div class="modal fade" id="add">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
        echo form_open('user/add');
        ?>
        <div class="card-body">
          <div class="form-group">
            <label for="nama_user">Nama User</label>
            <input type="text" name="nama_user" class="form-control" id="nama_user" placeholder="Nama User" required>
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
          </div>
          <div class="form-group">
            <label for="level_user">Level</label>
            <select class="form-control" name="level_user" id="level_user">
              <option value="1" selected>Admin</option>
              <option value="2">User</option>
            </select>
          </div>
        </div>
        <!-- /.card-body -->
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

<!-- modal edit -->
<?php foreach ($user as $key => $value) { ?>
  <div class="modal fade" id="edit<?= $value->id_user ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit User</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php
          echo form_open('user/edit/' . $value->id_user);
          ?>

          <div class="card-body">
            <div class="callout callout-info">
              <h5>Note!</h5>

              <p>Jika tidak ingin mengganti password, maka kosongkan saja</p>
            </div>
            <div class="form-group">
              <label for="nama_user">Nama User</label>
              <input type="text" name="nama_user" value="<?= $value->nama_user ?>" class="form-control" id="nama_user" placeholder="Nama User" required>
            </div>
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="username" value="<?= $value->username ?> " class=" form-control" id="username" placeholder="Username" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div class="form-group">
              <label for="level_user">Level</label>
              <select class="form-control" name="level_user" id="level_user">
                <option value="1" <?php if ($value->level_user == 1) {
                                    echo 'selected';
                                  } ?>>Admin</option>
                <option value="2" <?php if ($value->level_user == 2) {
                                    echo 'selected';
                                  } ?>>User</option>
              </select>
            </div>
          </div>
          <!-- /.card-body -->
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

<!-- modal delete -->
<?php foreach ($user as $key => $value) { ?>
  <div class="modal fade" id="delete<?= $value->id_user ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Hapus User</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Yakin ingin menghapus user dengan nama <?= $value->nama_user ?></p>
        </div>
        <?php
        echo form_open('user/delete/' . $value->id_user);
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