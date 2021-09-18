<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?= $mapel ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
            <li class="breadcrumb-item active">Jawaban Siswa </li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <!-- NOTIFIKASI -->



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
                    <th>Nama Siswa</th>
                    <th>Total Nilai</th>

                    <?php
                    $no = 1;
                    foreach ($soal as $item) { ?>
                      <th><?= "Q" . $no++ ?></th>
                    <?php } ?>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($siswa as $row) { ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $row->nama_siswa ?></td>
                      <th>Total Nilai</th>
                      <?php
                      $no = 1;
                      foreach ($soal as $item) { ?>
                        <th><?= "Q" . $no++ ?></th>
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