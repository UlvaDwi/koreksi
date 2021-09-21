<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Mapel Ujian <?= $ujian->nama_mapel ?></h1>
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
					<td>Action</td>
				</tr>
				<tr>
					<td><?= $ujian->kode_jenis ?></td>
					<td><a class="btn btn-primary" href="<?= base_url("DataSoalKunci/tampilSoal/$ujian->id_ujian") ?>">mulai Ujian</a></td>
				</tr>
			</table>
		</div>
		<!-- /.row -->
		<!-- list data -->


		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper
