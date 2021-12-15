<?php
class DataSiswaNilai extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model([
			'Siswa_Model',
			'PenugasanGuru_Model',
			'HistoriKelas_Model',
			'Ujian_Model',
			'TahunAjaran_Model'
		]);
	}

	public function index($id_tugas)
	{
		// ambil data user guru
		$id_guru = $this->session->userdata('id_user');
		// // cek apakah apakah halaman yang diakses sesuai dengan id_user
		$guru = $this->PenugasanGuru_Model->getData_by(['id_tugas' => $id_tugas])->row();
		$gurutugas = $this->PenugasanGuru_Model->getViewData_by(['id_tugas' => $id_tugas])->row();
		if ($id_guru != $guru->id_user) {
			if ($this->session->userdata('level') != 'admin') {
				show_404();
			}
		}
		$siswa = $this->HistoriKelas_Model->getData_by([
			'kode_kelas' => $guru->kode_kelas,
			'kode_ta' => $guru->kode_ta
		])->result();
		$jenisUjian = $this->Ujian_Model->getData(['id_tugas' => $id_tugas])->result();
		$nilaiUjianSiswa = [];
		if (!empty($jenisUjian)) {
			$nilaiUjianSiswa = $this->db->from('a_ujian_siswa')->where_in('id_ujian', array_column($jenisUjian, 'id_ujian'))->get()->result();
		}

		// untuk sidebar
		if ($this->session->userdata('level') == 'guru') {
			$id_user = $this->session->userdata('id_user');
			$kode_ta = $this->TahunAjaran_Model->tahunAjaranAktif;

			$data = [
				'menu_mapels' => $this->PenugasanGuru_Model->getViewData_by(['id_user' => $id_user, 'kode_ta' => $kode_ta])->result(),
			];
		}
		$data['mapel'] = "Mapel $gurutugas->nama_mapel Kelas " . str_replace("_", " ", $gurutugas->kode_kelas);
		// /sidebar


		$this->load->view('templates/header', compact(
			'siswa',
			'jenisUjian',
			'nilaiUjianSiswa',
			'id_tugas'
		));
		$this->load->view('templates/sidebar', $data);
		$this->load->view('SiswaNilai/index');
		$this->load->view('templates/footer');
	}

	public function export($id_tugas)
	{
		// ambil data user guru
		$id_guru = $this->session->userdata('id_user');
		// // cek apakah apakah halaman yang diakses sesuai dengan id_user
		$guru = $this->PenugasanGuru_Model->getData_by(['id_tugas' => $id_tugas])->row();
		$gurutugas = $this->PenugasanGuru_Model->getViewData_by(['id_tugas' => $id_tugas])->row();
		if ($id_guru != $guru->id_user) {
			if ($this->session->userdata('level') != 'admin') {
				show_404();
			}
		}
		$siswa = $this->HistoriKelas_Model->getData_by([
			'kode_kelas' => $guru->kode_kelas,
			'kode_ta' => $guru->kode_ta
		])->result();
		$jenisUjian = $this->Ujian_Model->getData(['id_tugas' => $id_tugas])->result();
		$nilaiUjianSiswa = [];
		if (!empty($jenisUjian)) {
			$nilaiUjianSiswa = $this->db->from('a_ujian_siswa')->where_in('id_ujian', array_column($jenisUjian, 'id_ujian'))->get()->result();
		}
		$mapel = "Mapel $gurutugas->nama_mapel Kelas " . str_replace("_", " ", $gurutugas->kode_kelas);
		$this->load->view('SiswaNilai/export', compact(
			'siswa',
			'jenisUjian',
			'nilaiUjianSiswa',
			'mapel'
		));
	}
}
