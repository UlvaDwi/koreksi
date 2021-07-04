<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data ujian</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
            <li class="breadcrumb-item active">Data ujian</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <!-- NOTIFIKASI -->
    <?php
    if ($this->session->flashdata('flash_ujian')) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6>
          <i class="icon fas fa-check"></i>
          Data Berhasil
          <strong>
            <?= $this->session->flashdata('flash_ujian');   ?>
          </strong>
        </h6>
      </div>
    <?php } ?>
    <!-- tambah data -->
    <?php if ($this->session->userdata('level') == 'admin') { ?>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Tambah Data Ujian</h5>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <?= validation_errors(); ?>
                  <form action="<?= base_url() ?>DataUjian/validation_form" method="post" accept-charset="utf-8">
                    <div class="card-body">

                      <div class="form-group">
                        <label>Guru</label>
                        <select class="form-control" name="id_tugas">
                          <option>--Pilih Guru yang Mengajar--</option>
                          <?php
                          foreach ($penugasanguru as $row) { ?>

                            <option value="<?= $row->id_tugas ?>"><?= $row->id_tugas ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Jenis Ujian</label>
                        <br>
                        <?php
                        foreach ($jenisujian as $jur) {
                        ?>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" name="chkjenis[]" type="checkbox" id="<?= $jur->kode_jenis ?>" value="<?= $jur->kode_jenis ?>">
                            <label class="form-check-label" for="<?= $jur->kode_jenis ?>"><?= $jur->nama_jenis ?></label>
                          </div>
                        <?php } ?>
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
    <?php
    }
    ?>
    <!-- /.row -->
    <!-- list data -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <!-- card-body -->
          <div class="card-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped responsive">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>id ujian</th>
                    <th>id penugasan</th>
                    <th>Nama Ujian</th>
                    <?php if ($this->session->userdata('level') == 'admin') { ?>
                      <th>Action</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($ujian as $row) { ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $row->id_ujian ?></td>
                      <td><?= $row->id_tugas ?></td>
                      <td><?= $row->nama_jenis ?></td>
                      <?php if ($this->session->userdata('level') == 'admin') { ?>
                        <td>
                          <!-- <button data-ref="<?= base_url('DataUjian/hapus') ?>" data-id="<?= $row->id_ujian ?>" class="btn btn-danger hapus">Hapus</button> -->
                          <a href="<?= base_url() ?>DataUjian/hapus/<?= $row->id_ujian ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Hapus</a>
                          <a href="<?= base_url() ?>DataUjian/ubah/<?= $row->id_ujian ?>" class="btn btn-warning">update</a>
                        </td>
                      <?php } ?>
                    </tr>
                  <?php
                    $no++;
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card-body -->
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