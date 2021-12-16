<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><?= $ujian->kode_jenis ?></h1>
					<h1><?= $mapel ?></h1>
				</div>
				<div class="col-sm-6 text-right">
					<h3 class="text-muted">Tanggal Pelaksanaan: <br><?= $ujian->tgl_pelaksanaan ?></h3>
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
					<!-- card-body -->
					<div class="card-body">
						<a href="<?= base_url("DataSiswaJawaban/export/$ujian->id_ujian") ?>" class="btn btn-success float-right mb-3">Export</a>
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped responsive">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Siswa</th>
										<th>Detail Ujian</th>
										<th>Total Nilai</th>
										<?php
										$no = 1;
										foreach ($soal as $item) { ?>
											<th><?= "Q" . $no++ ?></th>
										<?php } ?>

									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($siswa as $row) { ?>
										<tr>
											<td><?= $no ?></td>
											<td><?= $row->nama_siswa ?></td>
											<td>
												<a class="btn btn-default" href="<?= base_url("DataSoalKunci/detailUjian/$ujian->id_ujian/$row->id_siswa") ?>">
													Detail Ujian
												</a>
											</td>
											<td><?= $row->nilai ?></td>
											<?php foreach ($row->jawabanSiswa as $dataJawaban) : ?>
												<td><?= $dataJawaban->skor_siswa ?></td>
											<?php endforeach; ?>
										</tr>
									<?php
										$no++;
									}
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
<!-- /.content-wrapper
