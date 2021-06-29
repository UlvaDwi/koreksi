<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Jawaban Siswa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
            <li class="breadcrumb-item active">Jawaban Siswa</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <!-- NOTIFIKASI -->
    <?php

    if ($this->session->flashdata('flash_jawabansiswa')) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6>
          <i class="icon fas fa-check"></i>
          Data Berhasil
          <strong>
            <?= $this->session->flashdata('flash_jawabansiswa');   ?>
          </strong>
        </h6>
      </div>
    <?php } ?>
    <!-- tambah data -->

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">

            <h5 class="card-title">Tambah Jawaban Siswa</h5>
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
                <form action="<?= base_url() ?>DataJawabanSiswa/validation_form" method="post" accept-charset="utf-8">
                  <div class="card-body">


                    <div class="form-group">
                      <label for="exampleInputPassword1">Id Ujian Siswa</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="id_ujian_siswa">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Id Soal</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="id_soal">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Jawaban</label>
                      <textarea type="text" class="form-control" id="exampleInputPassword1" name="jawaban"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Skor Siswa</label>
                      <input type="number" class="form-control" id="exampleInputPassword1" name="skor_siswa">
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
                    <th>Id Jawaban Siswa</th>
                    <th>Id Ujian Siswa</th>
                    <th>Id Soal</th>
                    <th>Jawaban</th>
                    <th>Skor Siswa</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($jawabansiswa as $row) { ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $row->id_jawaban_siswa ?></td>
                      <td><?= $row->id_ujian_siswa ?></td>
                      <td><?= $row->id_soal ?></td>
                      <td><?= $row->jawaban ?></td>
                      <td><?= $row->skor_siswa ?></td>

                      <td>
                        <div class="btn-group">

                          <a href="<?= base_url() ?>DataJawabanSiswa/hapus/<?= $row->id_jawaban_siswa ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Hapus</a>
                          <a href="<?= base_url() ?>DataJawabanSiswa/ubah/<?= $row->id_jawaban_siswa ?>" class="btn btn-warning">Update</a>
                        </div>
                      </td>
                    <?php
                  }
                    ?>
                    </tr>
                    <?php
                    $no++;

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