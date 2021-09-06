<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Nama Siswa..</h1>
                    <h1>Kelas...</h1>
                    <h1>Mapel...</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Siswa </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Soal</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="soal" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Jawaban Siswa</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="jawabansiswa" readonly>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Jawaban Guru</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="jawabanguru" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Skor Siswa</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="skor" readonly>
            </div>

            <input type="submit" name="save" class="btn btn-primary" value="Save">
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper