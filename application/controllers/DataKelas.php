
<?php

/**
 * 
 */
class DataKelas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('id_user')) {
			redirect('Login');
		}
		if ($this->session->userdata('level') == 'siswa') {
			show_404();
		}
		$this->load->model('Kelas_Model');
		$this->load->model('Jurusan_Model');
		$this->load->model('TahunAjaran_Model');
		$this->load->model('HistoriKelas_Model');
		$this->load->model('Siswa_Model');
		$this->load->library('form_validation');
	}
	function index()
	{
		// tampil list kelas
		$data['kelas'] = $this->Kelas_Model->getAllData();
		// untuk dropdown
		$data['jurusan'] = $this->Jurusan_Model->getAllData();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('kelas/index', $data);
		$this->load->view('templates/footer');
	}


	public function validation_form()
	{
		if ($this->session->userdata('level') != 'admin') {
			show_404();
		}
		$this->form_validation->set_rules("kelas", "Kelas", "callback_check_select_kelas");
		$this->form_validation->set_rules("kode_jurusan", "Kode jurusan", "callback_check_select_jurusan");
		$this->form_validation->set_rules("nama_kelas", "Nama Kelas", "callback_check_select_nama_kelas");

		if (!$this->form_validation->run()) {
			$this->index();
		} else {
			$this->Kelas_Model->tambah_data();
			$this->session->set_flashdata('flash_kelas', 'Disimpan');
			redirect('DataKelas');
		}
	}
	public function check_select_kelas()
	{
		if ($this->input->post('kelas') == '--Pilih Kelas--') {
			$this->form_validation->set_message('check_select_kelas', 'pilih KELAS yang benar!!!!!!');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function check_select_jurusan()
	{
		if ($this->input->post('kd_jur') == '--Pilih Jurusan--') {
			$this->form_validation->set_message('check_select_jurusan', 'pilih JURUSAN yang benar!!!!!!');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function check_select_nama_kelas()
	{
		if ($this->input->post('nm_kelas') == '--Pilih Nama Kelas--') {
			$this->form_validation->set_message('check_select_nama_kelas', 'pilih NAMA KELAS yang benar!!!!!!');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function hapus($kd)
	{
		if ($this->session->userdata('level') != 'admin') {
			show_404();
		}
		$this->Kelas_Model->hapus_data($kd);
		$this->session->set_flashdata('flash_kelas', 'Dihapus');
		redirect('DataKelas');
	}

	public function ubah($id)
	{
		if ($this->session->userdata('level') != 'admin') {
			show_404();
		}
		$this->form_validation->set_rules("kd_kls", "Kode Kelas", "max_length[10]");
		$this->form_validation->set_rules("kelas", "Kelas", "required|max_length[5]");
		$this->form_validation->set_rules("kd_jur", "Nama Jurusan", "required");
		$this->form_validation->set_rules("nm_kelas", "Nama Kelas", "required");
		if ($this->form_validation->run() == FALSE) {
			$data['jurusan'] = $this->Jurusan_Model->getAllData();
			$data['ubah'] = $this->Kelas_Model->detail_data($id);
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('Kelas/ubah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->Kelas_Model->ubah_data();
			$this->session->set_flashdata('flash_kelas', 'DiUbah');
			redirect('DataKelas');
		}
	}
	// public function hapus()
	// {
	// 	if ($this->session->userdata('level') != 'admin') {
	// 		show_404();
	// 	}
	// 	$id = $this->input->post('id');
	// 	$this->Kelas_Model->hapus_data($id);
	// 	$this->session->set_flashdata('flash_kelas', 'Dihapus');
	// redirect('DataMapel');
	// }

	// public function checkForeign()
	// {
	// 	$data = $this->Kelas_Model->checkForeign($this->input->post('id'));
	// 	echo json_encode($data);
	// }


	// histori
	// menampilkan data kelas per siswa
	public function siswa($id_kelas)
	{
		// tampil list kelas
		$data['kelas'] = $this->Kelas_Model->detail_data($id_kelas);
		$data['siswa'] = $this->Siswa_Model->getSiswa($id_kelas, $this->TahunAjaran_Model->tahunAjaranAktif);
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('kelas/listsiswa', $data);
		$this->load->view('templates/footer');
	}

	public function hapusHistoriKelasSiswa($id_histori, $id_kelas)
	{
		$this->HistoriKelas_Model->hapus_data($id_histori);
		redirect("DataKelas/siswa/$id_kelas");
	}

	public function InsertKelasSiswa($id_kelas)
	{
		$siswa = $this->input->post('siswa');
		foreach ($siswa as $id_siswa) {
			$this->HistoriKelas_Model->tambah_data($id_siswa, $id_kelas, $this->TahunAjaran_Model->tahunAjaranAktif);
		}
		redirect("DataKelas/siswa/$id_kelas");
	}
}
