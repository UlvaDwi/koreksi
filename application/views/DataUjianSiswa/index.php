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
									<th>Mapel</th>
									<th>Ujian</th>
									<th>Guru</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if (empty($ujians)) : ?>
									<tr>
										<td colspan="6">Tidak ada Data Ujian</td>
									</tr>
								<?php endif; ?>
								<?php
								foreach ($ujians as $key => $ujian) :
									if (strtotime('now') < strtotime($ujian->tgl_pelaksanaan)) {
										$status = 'Ujian Belum Dimulai';
									} elseif (strtotime('now') < strtotime($ujian->tgl_selesai)) {
										$status = 'Ujian Sedang berlangsung';
									} elseif (strtotime('now') > strtotime($ujian->tgl_selesai)) {
										$status = 'Ujian telah Selesai';
										$url = base_url("DataSiswaJawaban/lihatjawaban/$ujian->id_ujian");
									} else {
										$status = 'error';
									}
								?>
									<tr>
										<th><?= $key + 1 ?></th>
										<th><?= $ujian->nama_mapel ?></th>
										<th><?= $ujian->kode_jenis ?></th>
										<th><?= $ujian->kode_kelas ?></th>
										<th><?= $status ?></th>
										<th><a class="btn btn-primary" href="<?= $url ?? '#' ?>">Lihat Hasil Ujian</a></th>
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
