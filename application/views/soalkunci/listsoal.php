<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= "$nama_ujian->kode_jenis $nama_ujian->nama_mapel " . str_replace("_", " ",  $nama_ujian->kode_kelas) ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data List Soal</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- list data -->
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
                                        <!-- <th>Id Soal</th> -->
                                        <!-- <th>Mapel Ujian</th> -->
                                        <th>Soal</th>
                                        <th>Kunci Jawaban</th>
                                        <th>Skor Soal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($soalkunci as $key => $row) { ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $row['soal'] ?></td>
                                            <td><?= $row['kunci_jawaban'] ?></td>
                                            <td><?= $row['skor_soal'] ?></td>

                                        <?php
                                    }
                                        ?>
                                        </tr>
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