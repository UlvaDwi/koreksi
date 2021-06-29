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
                    Data Berhasil
                    <strong>
                        <?= $this->session->flashdata('flash_penugasanguru');   ?>
                    </strong>
                </h6>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Penugasan Guru Mapel : <br> <b> <?= $nama_mapel ?></b></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('DataPenugasanGuru/tambah') ?>" method="POST">
                            <input type="hidden" value="<?= count($dataMapel) ?>" name="jml_data">
                            <input type="hidden" value="<?= $kodeMapel ?>" name="id_mapel">
                            <?php
                            $data = 0;
                            foreach ($dataMapel as $value) { ?>
                                <div class="form-group" data-group='<?= $data ?>'>
                                    <label for="exampleFormControlInput1"><?= $value->kelas ?> <?= $value->kode_jurusan ?> <?= $value->nama_kelas ?></label>
                                    <?php if ($value->id_user == null) { ?>
                                        <input type="hidden" value="<?= $value->kode_kelas ?>" name="kode_kelas[]">
                                        <input type="hidden" value="<?= $value->id_mapel ?>" name="id_mapel[]">
                                    <?php } else { ?>
                                        <input type="hidden" class="form-kelas" value="<?= $value->kode_kelas ?>" name="kode_kelas[]" disabled>
                                        <input type="hidden" class="form-mapel" value="<?= $value->id_mapel ?>" name="id_mapel[]" disabled>

                                    <?php } ?>
                                    <?php if ($value->id_user == null) { ?>
                                        <div class="row">
                                            <div class="col-10">
                                                <select name="guru[]" class="form-control">
                                                    <option selected="selected">Pilih Guru</option>
                                                    <?php foreach ($guru as $datalistGuru) : ?>
                                                        <option value="<?= $datalistGuru->id_user ?>"><?= $datalistGuru->nama_guru ?> </option>;
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="row">
                                            <div class="col-10">
                                                <select name="guru[]" class="form-control select-guru" disabled>
                                                    <?php foreach ($guru as $datalistGuru) :
                                                        $selected = ($value->id_user == $datalistGuru->id_user) ? 'selected' : ''; ?>
                                                        <option value="<?= $datalistGuru->id_user ?>" <?= $selected ?>><?= $datalistGuru->nama_guru ?> </option>;
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <div class="btn btn-danger hapus-data" data-idtugas="<?= $value->id_tugas ?>" data-group="<?= $data ?>">hapus</div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php
                                $data++;
                            } ?>
                            <input type="submit" class="btn btn-success" value="Simpan">
                        </form>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!--  /.content-wrapper -->