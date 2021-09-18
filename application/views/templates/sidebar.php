<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="index3.html" class="brand-link">
		<img src="<?= base_url() ?>assets/dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">Sistem Koreksi</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?= base_url() ?>assets/dist/img/user1.png" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block"><?= $this->session->userdata('username') ?> </a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

				<?php if ($this->session->userdata('level') == 'admin') { ?>
					<li class="nav-item has-treeview menu-open">
						<a href="<?= base_url() ?>Welcome" class="nav-link active">
							<i class="nav-icon fas fa-th"></i>
							<p>
								Dashboard</i>
							</p>
						</a>
					</li>
					<!-- <li class="nav-item"> -->
					<!-- <a href="#" class="nav-link">
							<i class="fas fa-file-alt"></i>
							<p> Mastering <i class="right fas fa-angle-left"></i></p>
						</a> -->
					<!-- <ul class="nav nav-treeview"> -->
					<li class="nav-item">
						<a href="<?= base_url() ?>DataUser" class="nav-link ">
							<i class="fas fa-chalkboard-teacher"></i>
							<p>
								Data Guru
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url() ?>DataSiswa" class="nav-link ">
							<i class="fas fa-users"></i>
							<p>
								Data Siswa
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url() ?>DataJurusan" class="nav-link ">
							<i class="fas fa-address-card"></i>
							<p>
								Data Jurusan
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url() ?>DataKelas" class="nav-link ">
							<i class="fas fa-home"></i>
							<p>
								Data Kelas
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url() ?>DataTahunAjaran" class="nav-link ">
							<i class="fas fa-calendar-week"></i>
							<p>
								Data Tahun Ajaran
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url() ?>DataMapel" class="nav-link ">
							<i class="fas fa-book-open"></i>
							<p>
								Data Mata Pelajaran
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url() ?>DataPenugasanGuru" class="nav-link ">
							<i class="fas fa-user-edit"></i>
							<p>
								Penugasan Guru
							</p>
						</a>
					</li>



					<li class="nav-item">
						<a href="<?= base_url() ?>DataKataDasar" class="nav-link">
							<i class="fas fa-atlas"></i>
							<p>
								Kata Dasar
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url() ?>DataStopwords" class="nav-link">
							<i class="fas fa-book"></i>
							<p>
								Stopwords
							</p>
						</a>
					</li>


					<li class="nav-item">
						<a href="<?= base_url() ?>DataSoalKunci" class="nav-link">
							<i class="fas fa-question-circle"></i>
							<p>
								Soal & Kunci Jawaban
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url() ?>DataSoalKunci/indexpre" class="nav-link">
							<i class="fas fa-key"></i>
							<p>
								Preprocessing Kunci
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url() ?>DataJawabanSiswa" class="nav-link">
							<i class="fas fa-tasks"></i>
							<p>
								Jawaban Siswa
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url() ?>DataJawabanSiswa/indexpre" class="nav-link">
							<i class="fas fa-stack-exchange"></i>
							<p>
								Preprocessing Jawaban Siswa
							</p>
						</a>
					</li>
					<!--  -->
				<?php } ?>
				<!-- </ul> -->
				<!-- </li> -->
				<?php if ($this->session->userdata('level') == 'guru') { ?>

					<li class="nav-item has-treeview menu-open">
						<a href="<?= base_url() ?>Welcome" class="nav-link active">
							<i class="nav-icon fas fa-th"></i>
							<p>
								Dashboard</i>
							</p>
						</a>
					</li>
					<?php

					if (!empty($menu_mapels)) {
						foreach ($menu_mapels as $menu_mapel) {
					?>
							<!-- ------------------ -->
							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="fas fa-file-alt"></i>
									<p> <?= "$menu_mapel->nama_mapel ($menu_mapel->kode_kelas)" ?> <i class="right fas fa-angle-left"></i></p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="<?= base_url('DataSoalKunci/jenis/') . $menu_mapel->id_tugas ?>" class="nav-link ml-3">
											<i class="fas fa-users"></i>
											<p>
												Ujian
											</p>
										</a>
									</li>
									<li class="nav-item">
										<a href='<?= base_url("DataSiswaNilai/index/$menu_mapel->id_tugas") ?>' class="nav-link ml-3">
											<i class="fas fa-chalkboard-teacher"></i>
											<p>
												Daftar Siswa
											</p>
										</a>
									</li>

								</ul>
							</li>
						<?php
						}
					} else {
						?>
						<li class="nav-item">
							<a href="#" class="nav-link">
								<p>Belum mendapatkan Penugasan</p>
							</a>
						</li>
				<?php
					}
				}
				?>
				<!-- sidebar siswa -->

				<?php if ($this->session->userdata('level') == 'siswa') {
				?>
					<li class="nav-item has-treeview menu-open">
						<a href="<?= base_url() ?>Welcome" class="nav-link active">
							<i class="nav-icon fas fa-th"></i>
							<p>
								Dashboard</i>
							</p>
						</a>
					</li>
					<?php
					if (!empty($menu_mapels)) {
						foreach ($menu_mapels as $menu_mapel) {
					?>
							<!-- ------------------ -->
							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="fas fa-file-alt"></i>
									<p> <?= "$menu_mapel->nama_mapel ($menu_mapel->kode_kelas)" ?> <i class="right fas fa-angle-left"></i></p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href='<?= base_url("DataSiswaNilai/index/$menu_mapel->id_tugas") ?>' class="nav-link ml-3">
											<i class="fas fa-chalkboard-teacher"></i>
											<p>
												Daftar Siswa
											</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('DataSoalKunci/jenis/') . $menu_mapel->id_tugas ?>" class="nav-link ml-3">
											<i class="fas fa-users"></i>
											<p>
												Ujian Siswa
											</p>
										</a>
									</li>
								</ul>
							</li>
						<?php
						}
					} else {
						?>
						<li class="nav-item">
							<a href="#" class="nav-link">
								<p>Belum Ada Ujian</p>
							</a>
						</li>
				<?php
					}
				}
				?>




		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>