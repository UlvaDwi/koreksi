<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Ujian Siswa</h1>
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="get" action="<?= base_url('DataUjianSiswa') ?>">
                            <div class="row">
                                <div class="form-group col-md-9 col-10">
                                    <select name="select_kelas" class="form-control">
                                        <option value="">Semua Kelas</option>
                                        <?php foreach ($kelas as $item) : ?>
                                            <option value="<?= $item->kode_kelas ?>" <?= ($k === $item->kode_kelas) ? 'selected' :  '' ?>><?= str_replace("_", " ", $item->kode_kelas) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-1 col-2">
                                    <button class="btn btn-primary" type="submit">Cari</button>
                                </div>
                            </div>
                        </form>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mapel</th>
                                    <th>kelas</th>
                                    <th>Guru</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($penugasan)) : ?>
                                    <tr>
                                        <td colspan="6">Tidak ada Data Penugasan</td>
                                    </tr>
                                <?php endif; ?>
                                <?php foreach ($penugasan as $key => $dataPenugasan) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $dataPenugasan->nama_mapel ?></td>
                                        <td><?= $dataPenugasan->kode_kelas ?></td>
                                        <td><?= $dataPenugasan->nama_guru ?></td>
                                        <td>
                                            <a class="btn btn-primary" href="<?= base_url('DataSoalKunci/jenis/' . $dataPenugasan->id_tugas) ?>">Buat Ujian</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
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