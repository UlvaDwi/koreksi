<?php
class DataSiswaJawaban extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model([
			'Siswa_Model',
			'TahunAjaran_Model',
			'PenugasanGuru_Model',
			'HistoriKelas_Model',
			'SoalKunci_Model',
			'Ujian_Model',
			'UjianSiswa_Model',
			'JawabanSiswa_Model'
		]);
	}

	public function lihatjawaban($id_ujian)
	{
		$ujian = $this->Ujian_Model->getData(['id_ujian' => $id_ujian])->row();
		// ambil data user guru
		$id_guru = $this->session->userdata('id_user');
		// cek apakah apakah halaman yang diakses sesuai dengan id_user
		$guru = $this->PenugasanGuru_Model->getViewData_by(['id_tugas' => $ujian->id_tugas])->row();
		if ($id_guru != $guru->id_user) {
			if ($this->session->userdata('level') != 'admin') {
				show_404();
			}
		}
		$siswa = $this->UjianSiswa_Model->getData(['id_ujian' => $id_ujian])->result();
		foreach ($siswa as $dataSiswa) {
			$jawabanSiswa = $this->JawabanSiswa_Model->getDataBy(['id_ujian_siswa' => $dataSiswa->id_ujian_siswa])->result();
			$dataSiswa->jawabanSiswa = $jawabanSiswa;
		}
		$data = [
			'siswa' => $siswa,
			'soal'  => $this->SoalKunci_Model->getData(['id_ujian' => $id_ujian])->result(),
			'mapel' => "Mapel $guru->nama_mapel Kelas " . str_replace("_", " ", $guru->kode_kelas),
			'ujian' => $ujian
		];

		// untuk sidebar
		if ($this->session->userdata('level') == 'guru') {
			$id_user = $this->session->userdata('id_user');
			$kode_ta = $this->TahunAjaran_Model->tahunAjaranAktif;
			$data['menu_mapels'] = $this->PenugasanGuru_Model->getViewData_by(['id_user' => $id_user, 'kode_ta' => $kode_ta])->result();
		}
		// /sidebar
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('SiswaJawaban/index');
		$this->load->view('templates/footer');
	}

	public function export($id_ujian)
	{
		$ujian = $this->Ujian_Model->getData(['id_ujian' => $id_ujian])->row();
		// ambil data user guru
		$id_guru = $this->session->userdata('id_user');
		// cek apakah apakah halaman yang diakses sesuai dengan id_user
		$guru = $this->PenugasanGuru_Model->getViewData_by(['id_tugas' => $ujian->id_tugas])->row();
		if ($id_guru != $guru->id_user) {
			if ($this->session->userdata('level') != 'admin') {
				show_404();
			}
		}
		$siswa = $this->UjianSiswa_Model->getData(['id_ujian' => $id_ujian])->result();
		foreach ($siswa as $dataSiswa) {
			$jawabanSiswa = $this->JawabanSiswa_Model->getDataBy(['id_ujian_siswa' => $dataSiswa->id_ujian_siswa])->result();
			$dataSiswa->jawabanSiswa = $jawabanSiswa;
		}
		$data = [
			'siswa' => $siswa,
			'soal'  => $this->SoalKunci_Model->getData(['id_ujian' => $id_ujian])->result(),
			'mapel' => "Mapel $guru->nama_mapel Kelas " . str_replace("_", " ", $guru->kode_kelas),
			'ujian' => $ujian
		];
		$this->load->view('SiswaJawaban/export', $data);
	}
}
