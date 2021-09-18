<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Home</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="col-md-12">
        <center>
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div>
                    <center>
                      <p></p>
                      <h1 style="font-family: 'Times New Roman', Times, serif;"><b>--SELAMAT DATANG <?= $this->session->userdata('username') ?>--</b></h1>
                      <h1 style="font-family: 'Times New Roman', Times, serif;"><b>di Sistem Koreksi Esai Otomatis</b></h1>
                      <h2 style="font-family: 'Times New Roman', Times, serif;"><b>SMK Muhammadiyah 2 Pagak</b></h2>
                      <p></p>
                    </center>

                  </div>

                </div>
              </div>
            </div>
          </div>
        </center>
      </div>
      <?php if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'guru') {
        if (!empty($mapel)) {
      ?>
          <!-- Info boxes -->
          <div class="row">
            <?php foreach ($mapel as $row) { ?>
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>
                      <td><?= $row['kode_kelas']; ?></td>
                    </h3>
                    <p>
                      <td><?= $row['nama_mapel']; ?></td>
                    </p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-user-graduate"></i>
                  </div>
                  <!-- <a href="<?= base_url() ?>DataSoalKunci/jenis?id=<?= $row['id_mapel']; ?>&id_tugas=<?= $row['id_tugas']; ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                  <a href="<?= base_url() ?>DataSoalKunci/jenis/<?= $row['id_tugas']; ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  <!-- <a href="<= base_url('DataSoalKunci/tambah') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
              </div>
              <!-- /.col -->
            <?php }
          } else {
            ?>

            Belum mendapatkan Penugasan

          <?php
          }

          ?>
          </div>
          <!-- /.row -->
        <?php
      } ?>

    </div>
    <!--/. container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->