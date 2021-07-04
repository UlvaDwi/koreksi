<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Penugasan Guru</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Data Penugasan Guru</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- NOTIFIKASI -->
    <?php
    if ($this->session->flashdata('flash_penugasanguru')) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6>
          <i class="icon fas fa-check"></i>
          Data
          <strong>
            <?= $this->session->flashdata('flash_penugasanguru');   ?>
          </strong>
        </h6>
      </div>
    <?php } ?>
    <!-- <?php
          if (empty($jurusan)) {
            echo '<div class="alert alert-danger alert-dismissible">';
            echo '<button type="button" class="close" data-dismiss="alert";aria-hidden="true">×</button>';
            echo '<h5><i class="fas fa-times"></i> Alert!</h5>';
            echo 'Data Jurusan Belum Terisi';
            echo '</div>';
          }
          if (empty($kelas)) {
            echo '<div class="alert alert-danger alert-dismissible">';
            echo '<button type="button" class="close" data-dismiss="alert";aria-hidden="true">×</button>';
            echo '<h5><i class="fas fa-times"></i> Alert!</h5>';
            echo 'Data Kelas Belum Terisi';
            echo '</div>';
          }
          if (empty($listGuru)) {
            echo '<div class="alert alert-danger alert-dismissible">';
            echo '<button type="button" class="close" data-dismiss="alert";aria-hidden="true">×</button>';
            echo '<h5><i class="fas fa-times"></i> Alert!</h5>';
            echo 'Data Guru Belum Terisi';
            echo '</div>';
          }
          if (empty($listMapel)) {
            echo '<div class="alert alert-danger alert-dismissible">';
            echo '<button type="button" class="close" data-dismiss="alert";aria-hidden="true">×</button>';
            echo '<h5><i class="fas fa-times"></i> Alert!</h5>';
            echo 'Data Mapel Belum Terisi';
            echo '</div>';
          }
          ?> -->

    <!-- input penugasan guru -->
    <div class="row">
      <div class="col-12">
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Tambah Penugasan Guru</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <tr>
                <th>No</th>
                <th>Nama Guru</th>
                <th>Action</th>
              </tr>
              <?php
              $no = 1;
              foreach ($listGuru as $ValuelistGuru) : ?>
                <tr>
                  <td><?= $no ?></td>
                  <td><?= $ValuelistGuru->nama_guru ?></td>
                  <td>
                    <a href="<?= base_url('DataPenugasanGuru/tampilan_tambah/' . $ValuelistGuru->id_user) ?>"><button class="btn btn-success">Lihat Guru Pengajar</button></a>
                  </td>
                </tr>
              <?php
                $no++;
              endforeach; ?>
            </table>
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>


  </section>
  <!-- /.content -->
</div>
<!--  /.content-wrapper -->


<!-- Modal Penambahan Guru -->
<div class="modal fade" id="TugasGuru">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="form"></div>
      </div>
    </div>
  </div>
</div>