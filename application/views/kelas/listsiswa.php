<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?= "Data Siswa Kelas " . $kelas['kelas'] . " " . $kelas['nama_kelas'] . " jurusan " . $kelas['kode_jurusan'] ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
            <li class="breadcrumb-item active">Data Siswa</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <!-- NOTIFIKASI -->
    <?php
    if ($this->session->flashdata('flash_kelas')) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6>
          <i class="icon fas fa-check"></i>
          Data Berhasil
          <strong>
            <?= $this->session->flashdata('flash_kelas');   ?>
          </strong>
        </h6>
      </div>
    <?php } ?>
    <!-- tambah data -->
    <?php if ($this->session->userdata('level') == 'admin') { ?>
      <div class="d-flex justify-content-end mb-3 pr-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#listSiswa">
          Masukkan siswa
        </button>
      </div>
    <?php
    }
    ?>
    <!-- /.row -->
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
                    <th>Nama Siswa</th>
                    <?php if ($this->session->userdata('level') == 'admin') { ?>
                      <th>Action</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // if ($siswa) {
                  //   # code...
                  // }
                  $no = 1;
                  // foreach ($siswa as $row) { 
                  ?>
                  <tr>
                    <td>no</td>
                    <td>nama siswa</td>
                    <?php if ($this->session->userdata('level') == 'admin') { ?>
                      <td>
                        <a class="btn btn-danger" href="<?= base_url() ?>" onclick="return confirm('yakin ?')">Hapus</a>
                      </td>
                    <?php } ?>
                  </tr>
                  <?php
                  //   $no++;
                  // }
                  ?>
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
<!-- /.content-wrapper -->


<!-- modal -->

<!-- Modal -->
<div class="modal fade" id="listSiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Insert <?= "Data Siswa Kelas " . $kelas['kelas'] . " " . $kelas['nama_kelas'] . " jurusan " . $kelas['kode_jurusan'] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="listSiswa" action="post">

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" form="listSiswa" class="btn btn-primary" disabled>Save changes</button>
      </div>
    </div>
  </div>
</div>