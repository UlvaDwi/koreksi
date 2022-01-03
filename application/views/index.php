<div style="background-image: url(assets/dist/img/bgweb.png);  background-repeat: no-repeat; background-size: cover;
" class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"></a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <?php if ($this->session->userdata('level') == 'admin') : ?>
          <div class="col-3">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                  <td><?= $jumlahSiswa ?></td>
                </h3>
                <p>
                  <td>Jumlah Siswa</td>
                </p>
              </div>
              <div class="icon">
                <i class="fas fa-user-graduate"></i>
              </div>
              <a href="<?= base_url('DataSiswa/') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-3">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>
                  <td><?= $jumlahGuru ?></td>
                </h3>
                <p>
                  <td>Jumlah Guru</td>
                </p>
              </div>
              <div class="icon">
                <i class="fas fa-user-tie"></i>
              </div>
              <a href="<?= base_url('DataUser/') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-3">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>
                  <td><?= $jumlahMapel ?></td>
                </h3>
                <p>
                  <td>Jumlah Mapel</td>
                </p>
              </div>
              <div class="icon">
                <i class="fas fa-book"></i>
              </div>
              <a href="<?= base_url('DataMapel/') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-3">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>
                  <td><?= $jumlahUjian ?></td>
                </h3>
                <p>
                  <td>Jumlah Ujian</td>
                </p>
              </div>
              <div class="icon">
                <i class="fas fa-star"></i>
              </div>
              <a href="<?= base_url('DataUjianSiswa/') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php elseif ($this->session->userdata('level') == 'guru') :
          if (!empty($mapel)) {
            foreach ($mapel as $row) { ?>
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>
                      <?= $row['kode_kelas']; ?>
                    </h3>
                    <p>
                      <?= $row['nama_mapel']; ?>
                    </p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-user-graduate"></i>
                  </div>
                  <a href="<?= base_url() ?>DataSoalKunci/jenis/<?= $row['id_tugas']; ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- /.col -->
            <?php }
          } else { ?>
            Belum mendapatkan Penugasan
            <?php }
        elseif ($this->session->userdata('level') == 'siswa') :
          if (!empty($menu_mapels)) {
            foreach ($menu_mapels as $row) { ?>

              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>
                      <?= $row->kode_kelas; ?>
                    </h3>
                    <p>
                      <?= $row->nama_mapel; ?>
                    </p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-user-graduate"></i>
                  </div>
                  <a href="<?= base_url() ?>DataSoalKunci/jenis/<?= $row->id_tugas; ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            <?php }
          } else { ?>
            Belum ada Mapel
        <?php }
        endif; ?>
      </div>
      <!-- /.row -->
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