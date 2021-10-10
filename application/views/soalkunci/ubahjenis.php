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
                        <li class="breadcrumb-item">Data Jenis Ujian</li>
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
                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">Id Ujian</label>
                                            <input type="text" class="form-control disabled" name="id_ujian" value="<?= $ubah['id_ujian'] ?>" readonly>
                                        </div>
                                        <div class="form-group" hidden>
                                            <label for="exampleInputPassword1">Id Tugas</label>
                                            <input type="text" class="form-control" name="id_tugas" value="<?= $ubah['id_tugas'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nama Ujian</label>
                                            <input type="text" class="form-control" name="kode_jenis" value="<?= $ubah['kode_jenis'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Tanggal Pelaksanaan</label>
                                            <input type="datetime-local" class="form-control" name="tgl_pelaksanaan" value="<?= $ubah['tgl_pelaksanaan'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Tanggal Selesai</label>
                                            <input type="datetime-local" class="form-control" name="tgl_selesai" value="<?= $ubah['tgl_selesai'] ?>">
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