<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Mapel... Kelas...</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
            <li class="breadcrumb-item active">Data Siswa </li>
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
                    <?php foreach ($jenisUjian as $valueJenisUjian) : ?>
                      <th><?= $valueJenisUjian->kode_jenis ?></th>
                    <?php endforeach; ?>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($siswa as $row) { ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $row->nama_siswa ?></td>
                      <?php foreach ($jenisUjian as $valueJenisUjian) : ?>
                        <th><?= $valueJenisUjian->kode_jenis ?></th>
                      <?php endforeach; ?>

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