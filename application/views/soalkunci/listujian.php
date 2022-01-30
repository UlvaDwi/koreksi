<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <?php if (empty($ujians)) {  ?>
        <h3>Tidak ada Data Ujian</h3>
    <?php } else { ?>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Mapel <?= $ujians[0]->nama_mapel ?></h1>
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
            <div class="row">
                <table class="table table-striped mx-5 table-bordered">
                    <tr>
                        <td>Ujian</td>
                        <td>Mulai Ujian</td>
                        <td>Batas Ujian</td>
                        <td>Durasi Ujian</td>
                        <td>Nilai</td>
                        <td>Status</td>
                        <td>Action</td>
                    </tr>
                    <?php
                    if (empty($ujians)) { ?>
                        <tr>
                            <td colspan="7">Tidak ada data ujian</td>
                        </tr>
                    <?php }
                    foreach ($ujians as $ujian) { ?>
                        <tr>
                            <td><?= $ujian->kode_jenis ?></td>
                            <td><?= $ujian->tgl_pelaksanaan ?></td>
                            <td><?= $ujian->tgl_selesai ?></td>
                            <td><?= $ujian->durasi ?></td>
                            <td><?= $ujian->nilai ?? '0'  ?></td>
                            <td><?= $ujian->status ?? 'Belum Ujian' ?></td>
                            <?php
                            $disabled  = null;
                            $textButton  = "Mulai Ujian";
                            date_default_timezone_set("Asia/Jakarta");
                            $now = date_create();
                            $pelaksanaan = date_create($ujian->tgl_pelaksanaan);
                            $selesai = date_create($ujian->tgl_selesai);
                            $mulai = date_diff($now, $pelaksanaan)->format("%R");
                            $selesai = date_diff($now, $selesai)->format("%R");
                            if ($mulai == '+' || $selesai == '-' || $ujian->status == 'selesai') {
                                $disabled = 'disabled';
                            }
                            ?>
                            <td>
                                <?php if ($ujian->status == 'selesai') { ?>
                                    <a class="btn btn-default" href="<?= base_url("DataSoalKunci/detailUjian/$ujian->id_ujian") ?>">
                                        Detail Ujian
                                    </a>
                                <?php } else { ?>
                                    <a class="btn btn-primary <?= $disabled ?>" href="<?= base_url("DataSoalKunci/tampilSoal/$ujian->id_ujian") ?>">
                                        <?= $textButton ?>
                                    </a>

                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <!-- /.row -->
            <!-- list data -->


            <!-- /.row -->
        </section>
    <?php } ?>


    <!-- /.content -->
</div>
<!-- /.content-wrapper -->