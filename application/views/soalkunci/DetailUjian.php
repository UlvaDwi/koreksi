<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Mapel Ujian <?= $ujian->nama_mapel ?></h1>
				</div>
				<div class="col-sm-6">
					<h1 class="text-right">Total Skor Ujian : <?= $ujiansiswa->nilai ?></h1>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>


	<!-- Main content -->
	<section class="content">
		<!-- NOTIFIKASI -->

		<div>
			<div class="row">
				<?php foreach ($soal as $index => $dataSoal) : ?>
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<div class="row">
									<div class="col-6">
										<h3>Soal <span id="number"><?= $index + 1 ?></span></h3>
									</div>
									<div class="col-6">
										<h3 class="text-right">Skor Siswa : <span id="number"><?= $dataSoal->skor_siswa ?></span></h3>
									</div>
								</div>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<div class="form-group">
									<h5 id="soal"><?= $dataSoal->soal ?></h5>
									<span>Kunci Jawaban</span>
									<div class="mb-3" style="border: 2px #ACACAC solid; padding: 15px; border-radius: 10px;">
										<?= $dataSoal->kunci_jawaban ?>
									</div>
									<span>Jawaban Siswa</span>
									<div class="mb-3" style="border: 2px #ACACAC solid; padding: 15px; border-radius: 10px;">
										<?= $dataSoal->jawaban ?>
									</div>
								</div>
							</div>
							<div class="card-footer">

							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<!-- /.row -->
		<!-- list data -->


		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper
