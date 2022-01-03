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
						<li class="breadcrumb-item active">Data Ujian Siswa</li>
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
								<div class="col-md-2 col-12">
									<a href="<?= base_url('DataUjianSiswa/createUjian') ?>" class="btn btn-warning">Buat Ujian</a>
								</div>
							</div>
						</form>
						<table class="table">
							<thead>
								<tr>
									<th>No</th>
									<th>Mapel</th>
									<th>Ujian</th>
									<th>kelas</th>
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
										$url = base_url("DataSoalKunci/list_soal/$ujian->id_ujian");
										$text = "Lihat Soal Ujian";
										$color = 'warning';
									} elseif (strtotime('now') < strtotime($ujian->tgl_selesai)) {
										$status = 'Ujian Sedang berlangsung';
										$url = base_url("DataSoalKunci/list_soal/$ujian->id_ujian");
										$text = "Lihat Soal Ujian";
										$color = 'warning';
									} elseif (strtotime('now') > strtotime($ujian->tgl_selesai)) {
										$status = 'Ujian telah Selesai';
										$url = base_url("DataSiswaJawaban/lihatjawaban/$ujian->id_ujian");
										$text = "Lihat Hasil Ujian";
										$color = 'primary';
									} else {
										$status = 'error';
									}
								?>
									<tr>
										<td><?= $key + 1 ?></td>
										<td><?= $ujian->nama_mapel ?></td>
										<td><?= $ujian->kode_jenis ?></td>
										<td><?= $ujian->kode_kelas ?></td>
										<td><?= $ujian->nama_guru ?></td>
										<td><?= $status ?></td>
										<td><a class="btn btn-<?= $color ?>" href="<?= $url ?? '#' ?>"><?= $text ?></a></td>
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