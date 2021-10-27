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
					<td>Mulai Ujian</td>
					<td>Batas Ujian</td>
					<td>Durasi Ujian</td>
					<td>Nilai</td>
					<td>Status</td>
					<td>Action</td>
				</tr>
				<tr>
					<td><?= $ujian->kode_jenis ?></td>
					<td><?= $ujian->tgl_pelaksanaan ?></td>
					<td><?= $ujian->tgl_selesai ?></td>
					<td><?= $ujian->durasi ?></td>
					<td><?= $ujianSiswa->nilai ?? '0'  ?></td>
					<td><?= $ujianSiswa->status ?? 'Belum Ujian' ?></td>
					<?php
					$disabled  = null;
					$textButton  = "Mulai Ujian";
					date_default_timezone_set("Asia/Jakarta");
					$now = date_create();
					$pelaksanaan = date_create($ujian->tgl_pelaksanaan);
					$selesai = date_create($ujian->tgl_selesai);
					$mulai = date_diff($now, $pelaksanaan)->format("%R");
					$selesai = date_diff($now, $selesai)->format("%R");
					if ($mulai == '+' || $selesai == '-' || $ujianSiswa->status == 'selesai') {
						$disabled = 'disabled';
					}
					?>

					<td>
						<a class="btn btn-primary <?= $disabled ?>" href="<?= base_url("DataSoalKunci/tampilSoal/$ujian->id_ujian") ?>">
							<?= $textButton ?>
						</a>
					</td>
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
