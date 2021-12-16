<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Data Hasil Pembelajaran Guru</h1>
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
						<form class="form-inline">
							<div class="form-group">
								<div class="form-group">
									<label for="">Pilih Kelas</label>
									<select class="form-control">
										<option>Pilik Kelas</option>
									</select>
								</div>
							</div>
						</form>
						<table class="table">
							<thead>
								<tr>
									<th>No</th>
									<th>Guru</th>
									<th>Kelas</th>
									<th>Mapel</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($penugasans as $key => $penugasan) : ?>
									<tr>
										<th><?= $key + 1 ?></th>
										<th><?= $penugasan->nama_guru ?></th>
										<th><?= $penugasan->kode_kelas ?></th>
										<th><?= $penugasan->nama_mapel ?></th>
										<th><a class="btn btn-primary" href="<?= base_url("DataSiswaNilai/index/$penugasan->id_tugas") ?>">Lihat Hasil Pembelajaran</a></th>
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
