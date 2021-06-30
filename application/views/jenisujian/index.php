<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Jenis Ujian</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
            <li class="breadcrumb-item active">Data Jenis Ujian</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <!-- NOTIFIKASI -->
    <?php

    if ($this->session->flashdata('flash_jenisujian')) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6>
          <i class="icon fas fa-check"></i>
          Data Berhasil
          <strong>
            <?= $this->session->flashdata('flash_jenisujian');   ?>
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

              <h5 class="card-title">Tambah Data Jenis Ujian</h5>
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
                  <form action="<?= base_url() ?>DataJenisUjian/validation_form" method="post" accept-charset="utf-8">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Kode Jenis</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="kode_jenis">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Nama jenis</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="nama_jenis">
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
      <!-- list data -->
    <?php
    }
    ?>
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
                    <th>Kode Jenis Ujian</th>
                    <th>Nama Ujian</th>
                    <?php if ($this->session->userdata('level') == 'admin') { ?>
                      <th>Action</th>
                    <?php
                    }
                    ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($jenisujian as $row) { ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $row->kode_jenis ?></td>
                      <td><?= $row->nama_jenis ?></td>
                      <?php if ($this->session->userdata('level') == 'admin') { ?>
                        <td>
                          <div class="btn-group">
                            <!-- <button data-ref="<?= base_url('DataJenisUjian/hapus') ?>" data-id="<?= $row->kode_jenis ?>" class="btn btn-danger hapus">Hapus</button> -->
                            <a href="<?= base_url() ?>DataJenisUjian/hapus/<?= $row->kode_jenis ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Hapus</a>
                            <a href="<?= base_url() ?>DataJenisUjian/ubah/<?= $row->kode_jenis ?>" class="btn btn-warning">update</a>
                          </div>
                        </td>
                      <?php
                      }
                      ?>
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