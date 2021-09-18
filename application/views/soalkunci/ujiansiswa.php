<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Mapel Ujian...</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Soal</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
        <!-- NOTIFIKASI -->
        <?php

        if ($this->session->flashdata('flash_soalkunci')) { ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6>
                    <i class="icon fas fa-check"></i>
                    Data Berhasil
                    <strong>
                        <?= $this->session->flashdata('flash_soalkunci');   ?>
                    </strong>
                </h6>
            </div>
        <?php } ?>
        <!-- tambah data -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                        <h5 class="card-title">Soal </h5>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <?= validation_errors(); ?>
                                <form action="<?= base_url() ?>DataSoalKunci/validation_form" method="post" accept-charset="utf-8">
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Ini adalah Soal</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Jawaban</label>
                                            <textarea style="width: 100%; height: 200px;" type="text" class="form-control" id="exampleInputPassword1" name="jawaban"></textarea>
                                        </div>
                                        <input type="submit" name="back" class="btn btn-secondary" value="Previouse page">
                                        <input style="float: right;" type="submit" name="next" class="btn btn-primary" value="Next page">
                                    </div>

                                    <!-- /.card-body -->
                                </form>
                            </div>
                            <div class="col-md-4">
                                <?= validation_errors(); ?>
                                <form action="<?= base_url() ?>DataSoalKunci/validation_form" method="post" accept-charset="utf-8">
                                    <div class="card-body">
                                        <div class="d-flex align-content-stretch flex-wrap">
                                            <div class="order-1 p-2" style="border-style: solid; border-width: 1px; border-radius: 3px; margin: 5px;">1</div>
                                            <div class="order-1 p-2" style="border-style: solid; border-width: 1px; border-radius: 3px; margin: 5px;">1</div>
                                            <div class="order-1 p-2" style="border-style: solid; border-width: 1px; border-radius: 3px; margin: 5px;">1</div>
                                            <div class="order-1 p-2" style="border-style: solid; border-width: 1px; border-radius: 3px; margin: 5px;">1</div>

                                        </div>
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
        <!-- list data -->


        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper