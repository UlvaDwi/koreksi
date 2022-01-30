<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> Ubah Data </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
            <li class="breadcrumb-item">Data soal</li>
            <li class="breadcrumb-item active">Ubah Data</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- tambah data -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Ubah Data</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <?= validation_errors(); ?>
                <form action="" method="post" accept-charset="utf-8">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Id Soal</label>
                      <input type="text" class="form-control disabled" name="id_soal" value="<?= $ubah['id_soal'] ?>" readonly>
                    </div>
                    <!-- <div class="form-group" hidden>
                      <label for="exampleInputPassword1">Id Mapel Ujian</label>
                      <input type="text" class="form-control" name="id_mapel_ujian" value="<?= $ubah['id_mapel_ujian'] ?>">
                    </div> -->
                    <div class="form-group">
                      <label for="exampleInputPassword1">Soal</label>
                      <textarea type="text" class="form-control" name="soal"><?= $ubah['soal'] ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Kunci Jawaban</label>
                      <textarea type="text" class="form-control" name="kunci_jawaban"><?= $ubah['kunci_jawaban'] ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Skor Soal</label>
                      <input type="text" class="form-control" name="skor_soal" value="<?= $ubah['skor_soal'] ?>">
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
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper