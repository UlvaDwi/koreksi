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
						<form method="get" action="<?= base_url('DataHasilPembelajaran') ?>">
							<div class="row">
								<div class="form-group col-md-10 col-12">
									<select name="select_kelas" class="form-control">
										<option value="">Semua Kelas</option>
										<?php foreach ($kelas as $item) : ?>
											<option value="<?= $item->kode_kelas ?>" <?= ($k === $item->kode_kelas) ? 'selected' :  '' ?>><?= str_replace("_", " ", $item->kode_kelas) ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="col-md-2 col-12">
									<button class="btn btn-primary" type="submit">Cari</button>
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
										<td><?= $penugasan->nama_guru ?></td>
										<td><?= str_replace("_", ' ', $penugasan->kode_kelas)  ?></td>
										<td><?= $penugasan->nama_mapel ?></td>
										<td><a class="btn btn-primary" href="<?= base_url("DataSiswaNilai/index/$penugasan->id_tugas") ?>">Lihat Hasil Pembelajaran</a></td>
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