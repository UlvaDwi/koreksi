<div class="content-wrapper m-0 p-5">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Mapel Ujian <?= $ujian->nama_mapel ?></h1>
				</div>
				<!-- <div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
						<li class="breadcrumb-item active">Data Soal</li>
					</ol>
				</div> -->
			</div>
		</div><!-- /.container-fluid -->
	</section>


	<!-- Main content -->
	<section class="content">
		<!-- NOTIFIKASI -->
		<?php

		if ($this->session->flashdata('flash_soalkunci')) { ?>
			<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h6>
					<i class="icon fas fa-check"></i>
					Data Berhasil
					<strong>
						<?= $this->session->flashdata('flash_soalkunci');   ?>
					</strong>
				</h6>
			</div>
		<?php } ?>
		<!-- tambah data -->
		<div>
			<div class="row">
				<div class="col-9">
					<div class="card">
						<div class="card-header">
							<div class="text-right">
								<span id="jam"></span> Jam <span id="menit"></span> Menit <span id="detik"></span> Detik
							</div>
						</div>
						<div class="card-header">
							<h3>Soal <span id="number">...</span></h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<div class="form-group">
								<h5 id="soal">...</h5>
								<textarea id="jawaban" class="form-control" data-id="" rows="3"></textarea>
							</div>
						</div>
						<!-- <div class="card-footer">
							<a class="btn btn-default float-left"><i class="fas fa-arrow-circle-left"></i> Sebelumnya</a>
							<a class="btn btn-default float-right">Selanjutnya <i class="fas fa-arrow-circle-right"></i></a>
						</div> -->
					</div>
				</div>
				<div class="col-3">
					<div class="card">
						<div class="card-header">
							<h3>List Soal</h3>
						</div>
						<div class="card-body">
							<div id="listnumber"></div>
						</div>
						<div class="card-footer">
							<button type="button" onclick="selesai()" class="btn btn-primary">Selesai Ujian</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /.row -->
		<!-- list data -->


		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper