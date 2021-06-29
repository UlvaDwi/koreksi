<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> Ubah Data Mapel</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item">Data Mapel</li>
            <li class="breadcrumb-item active">Ubah Data Mapel</li>
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
                <form action="<?= base_url('dataMapel/ubah/' . $ubah['id_mapel']) ?>" method="post" accept-charset="utf-8">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">ID Mapel</label>
                      <input type="text" class="form-control disabled" name="id_mapel" value="<?= $ubah['id_mapel'] ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Nama Mapel</label>
                      <input type="text" class="form-control" name="nama_mapel" value="<?= $ubah['nama_mapel'] ?>">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Kelas</label>
                      <select class="form-control" name="kelas">
                        <?php
                        $kelas = ['X', 'XI', 'XII'];
                        foreach ($kelas as $kls) {
                          $selected = '';
                          if ($ubah['kelas'] == $kls) {
                            $selected = 'selected';
                          } ?>
                          <option value="<?= $kls ?>" <?= $selected ?>><?= $kls ?></option>
                        <?php } ?>
                      </select>
                      <!-- <input type="text" class="form-control" name="kls" value="<?= $ubah['kelas'] ?>"> -->
                    </div>

                    <div class="form-group">
                      <label>Jurusan</label>
                      <select class="form-control" name="kode_jurusan">
                        <?php
                        foreach ($jurusan as $jur) {
                          $selected = '';
                          if ($ubah['kode_jurusan'] == $jur->kode_jurusan) {
                            $selected = 'selected';
                          } ?>
                          <option value="<?= $jur->kode_jurusan ?>" <?= $selected ?>><?= $jur->nama_jurusan ?></option>
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