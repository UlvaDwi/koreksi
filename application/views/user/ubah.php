Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> Ubah Data Guru</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
            <li class="breadcrumb-item">Data Guru</li>
            <li class="breadcrumb-item active">Ubah Data Guru</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- tambah data -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Ubah Data</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <?= validation_errors(); ?>
                <form action="<?= base_url('DataUser/ubah/') . $ubah->id_user ?>" method="post" accept-charset="utf-8">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="id_user">ID Guru</label>
                      <input type="text" class="form-control disable" id="id_user" name="id_user" value="<?= $ubah->id_user ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="nama_guru">Nama Guru</label>
                      <input type="text" class="form-control" id="nama_guru" name="nama_guru" value="<?= $ubah->nama_guru ?>">
                    </div>
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control" id="username" name="username" value="<?= $ubah->username ?>">
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="text" class="form-control" id="password" name="password" value="<?= $ubah->password ?>">
                    </div>
                    <div class="form-group">
                      <label for="level">Admin</label>
                      <select class="form-control" name="level">
                        <?php
                        if ($ubah->level == 'admin') {
                          echo "<option value = 'admin' selected>Admin</option>
                          <option value ='guru'>Guru</option>";
                        } else {
                          echo "<option value = 'admin' >Admin</option>
                          <option value ='guru' selected>Guru</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save">
                  </div>
                  <!-- /.card-body -->
                </form>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- ./card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper