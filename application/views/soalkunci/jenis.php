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
                      <!-- <h1 style="font-family: 'Times New Roman', Times, serif;"><b>--SELAMAT DATANG <= $this->session->userdata('username') ?>--</b></h1> -->
                      <h1 style="font-family: 'Times New Roman', Times, serif;"><b>Silahkan pilih mata pelajaran</b></h1>
                      <p></p>
                    </center>

                  </div>

                </div>
              </div>
            </div>
          </div>
        </center>
      </div>
      <?php if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'guru') { ?>
        <!-- Info boxes -->
        <form action="<?= base_url() ?>DataSoalKunci/tambah" method="post" accept-charset="utf-8">
            <div class="form-group" hidden>
                <label for="exampleInputPassword1">Id</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="id_mapel_ujian" value="<?= $_GET['id']; ?>" readonly>
            </div>
            <div class="form-group" hidden>
                <label for="exampleInputPassword1">Id tugas</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="id_tugas" value="<?= $_GET['id_tugas']; ?>" readonly>
            </div>
            <div class="form-group">
            <label>Jenis Ujian</label>
            <select class="form-control" name="jenis_ujian">
                <option>--Pilih Jenis Ujian--</option>
                <?php
                foreach ($jenisujian as $row) { ?>

                <option value="<?= $row->kode_jenis ?>"><?= $row->nama_jenis ?></option>
                <?php } ?>
            </select>
            </div>
            <input type="submit" name="save" class="btn btn-primary" value="SUBMIT">
        </form>
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