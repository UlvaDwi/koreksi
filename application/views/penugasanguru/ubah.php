Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> Ubah Data Tugas Guru</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item">Data Tugas Guru</li>
            <li class="breadcrumb-item active">Ubah Data Tugas</li>
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
                <form action="" method="post" accept-charset="utf-8">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">ID Penugasan Guru</label>
                      <input type="text" class="form-control disabled" name="id_pen" value="<?= $ubah['id_tugas'] ?>" readonly>
                    </div>

                    <div class="form-group">
                      <label>Nama Guru</label>
                      <select class="form-control" name="id_gur" value="<?= $ubah['id_user'] ?>">
                        <?php
                        foreach ($guru as $gur) { ?>
                          <option value="<?= $gur->id_user ?>"><?= $gur->nama_guru ?></option>
                        <?php } ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Mapel</label>
                      <select class="form-control" name="id_map" value="<?= $ubah['id_mapel'] ?>">
                        <?php
                        foreach ($mapel as $map) { ?>
                          <option value="<?= $map->id_mapel ?>"><?= $map->nama_mapel ?></option>
                        <?php } ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Kelas</label>
                      <select class="form-control" name="id_kls" value="<?= $ubah['kode_kelas'] ?>">
                        <?php
                        foreach ($kelas as $kel) { ?>
                          <option value="<?= $kel->kode_kelas ?>"><?= $kel->kelas ?></option>
                        <?php } ?>
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