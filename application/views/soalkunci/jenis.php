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
            <li class="breadcrumb-item active">Ujian Siswa </li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <?php if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'guru') { ?>
        <!-- Info boxes -->
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">

                <form action="<?= base_url("DataSoalKunci/storeUjian/" . $this->uri->segment(3)) ?>" method="post" accept-charset="utf-8">

                  <div class="form-group" hidden>
                    <label for="exampleInputPassword1">Id tugas</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="id_tugas" value="<?= $this->uri->segment(3) ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nama Ujian</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="kode_jenis" required />
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tanggal Pengerjaan</label>
                    <input type="datetime-local" class="form-control" id="exampleInputPassword1" name="tgl_pelaksanaan" required />
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tanggal Selesai</label>
                    <input type="datetime-local" class="form-control" id="exampleInputPassword1" name="tgl_selesai">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Durasi</label>
                    <input type="time" class="form-control" id="exampleInputPassword1" name="durasi">
                  </div>
                  <input type="submit" name="save" class="btn btn-primary" value="Simpan">

                </form>
              </div>
            </div>
            <hr>
            <table class="table table-bordered table-striped responsive">
              <tr>
                <th>No</th>
                <th>Nama Ujian</th>
                <th>Tanggal Pengerjaan</th>
                <th>Tanggal Selesai</th>
                <th>Durasi</th>
                <th>Action</th>
              </tr>
              <?php
              foreach ($ujians as $key => $ujian) : ?>
                <tr>
                  <td><?= $key + 1 ?></td>
                  <td><?= $ujian->kode_jenis ?></td>
                  <td><?= $ujian->tgl_pelaksanaan ?></td>
                  <td><?= $ujian->tgl_selesai ?></td>
                  <td><?= $ujian->durasi ?></td>
                  <td>
                    <a href="<?= base_url("DataSoalKunci/tambah/$ujian->id_ujian") ?>" class="btn btn-success">Buat Soal</a>
                    <a href="<?= base_url("DataSoalKunci/ubahjenis/$ujian->id_ujian") ?>" class="btn btn-secondary">Update Ujian</a>
                    <a href="<?= base_url("DataUjian/hapus/$ujian->id_ujian") ?>" class="btn btn-danger">Hapus Ujian</a>
                    <a href="<?= base_url("DataSiswaJawaban/lihatjawaban/$ujian->id_ujian") ?>" class="btn btn-warning">Lihat Ujian Siswa</a>
                  </td>
                </tr>
              <?php endforeach; ?>
              <?php if (empty($ujians)) : ?>
                <tr>
                  <td colspan="3">Belum Ada Data Ujian</td>
                </tr>
              <?php endif; ?>
            </table>
          </div>
        </div>
        <!-- /.row -->
      <?php } ?>


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