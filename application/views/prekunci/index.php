<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>PREPROCESSING KUNCI JAWABAN</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
            <li class="breadcrumb-item active">preprocessing kunci jawaban</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <!-- NOTIFIKASI -->
    <?php

    if ($this->session->flashdata('flash_jurusan')) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6>
          <i class="icon fas fa-check"></i>
          Data Berhasil
          <strong>
            <?= $this->session->flashdata('flash_jurusan');   ?>
          </strong>
        </h6>
      </div>
    <?php } ?>

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
                    <th>ID SOAL</th>
                    <th>TOKENIZING</th>
                    <th>FILTERING</th>
                    <th>STEMMING</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($prekunci as $row) { ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $row->id_soal ?></td>
                      <td><?= $row->token ?></td>
                      <td><?= $row->filter ?></td>
                      <td><?= $row->stem ?></td>
                      <td><a href="btn btn-warning">Lihat</a></td>
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