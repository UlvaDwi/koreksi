<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Penugasan Guru : <?= $guru->nama_guru ?></h1>
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
                        <h3 class="card-title">Tambah Penugasan Guru </b></h3>
                        <div class="card-tools">
                            <div class="btn btn-primary btn-sm float-right add_button">Tambah Tugas</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('DataPenugasanGuru/tambah/' . $this->uri->segment(3)) ?>" method="POST">

                            <!-- select mapel -->
                            <div class="row input_penugasan">
                                <div class="form-group col-6">
                                    <label for="mapel">Mapel</label>
                                    <select class="form-control" name="mapel[]" id="mapel">
                                        <?php
                                        foreach ($mapel as $valueMapel) { ?>
                                            <option value="<?= $valueMapel->id_mapel ?>"><?= $valueMapel->nama_mapel ?></option>
                                        <?php  }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="kelas">Kelas</label>
                                    <select class="form-control" name="kelas[]" id="kelas">
                                        <?php
                                        foreach ($kelas as $valuekelas) { ?>
                                            <option value="<?= $valuekelas->kode_kelas ?>"><?= "$valuekelas->kelas $valuekelas->kode_jurusan $valuekelas->nama_kelas" ?></option>
                                        <?php  }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="field_wrapper">
                            </div>


                            <input type="submit" class="btn btn-success" value="Simpan">
                        </form>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- input penugasan guru -->
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Tugas Guru</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>No</th>
                                <th>Mapel</th>
                                <th>Kelas</th>
                                <th>Action</th>

                            </tr>
                            <?php
                            $no = 1;
                            foreach ($tugas_guru as $row) { ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row->id_mapel ?></td>
                                    <td><?= $row->kode_kelas ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>DataPenugasanGuru/hapus/<?= $row->id_tugas ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            } ?>
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