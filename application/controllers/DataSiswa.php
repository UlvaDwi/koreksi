<?php

/**
 * 
 */
class DataSiswa extends CI_Controller
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
		$this->load->model('Siswa_Model');
		$this->load->model('TahunAjaran_Model');
		$this->load->model('HistoriKelas_Model');
		$this->load->model('Jurusan_Model');
		$this->load->library('form_validation');
	}

	function index()
	{

		$data['siswa'] = $this->Siswa_Model->getAllData();
		$data['jurusan'] = $this->Jurusan_Model->getAllData();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('siswa/index', $data);
		$this->load->view('templates/footer');
	}

	public function validation_form()
	{
		if ($this->session->userdata('level') != 'admin') {
			show_404();
		}
		$this->form_validation->set_rules("id_siswa", "Kode siswa", "required");
		$this->form_validation->set_rules("nama_siswa", "Nama Siswa", "required");
		$this->form_validation->set_rules("kode_jurusan", "Kode Jurusan", "required");
		$this->form_validation->set_rules("username", "Username", "required");
		$this->form_validation->set_rules("password", "Password", "required");
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$this->Siswa_Model->tambah_data();
			$this->session->set_flashdata('flash_siswa', 'Disimpan');
			redirect('DataSiswa');
		}
	}

	public function hapus($kd)
	{
		if ($this->session->userdata('level') != 'admin') {
			show_404();
		}
		$this->Siswa_Model->hapus_data($kd);
		$this->session->set_flashdata('flash_siswa', 'Dihapus');
		redirect('DataSiswa');
	}

	public function ubah($kd)
	{
		if ($this->session->userdata('level') != 'admin') {
			show_404();
		}
		$this->form_validation->set_rules("id_siswa", "Kode siswa", "required");
		$this->form_validation->set_rules("nama_siswa", "Nama Siswa", "required");
		$this->form_validation->set_rules("kode_jurusan", "Nama jurusan", "required");
		$this->form_validation->set_rules("username", "Username", "required");
		$this->form_validation->set_rules("password", "Password", "required");
		if ($this->form_validation->run() == FALSE) {
			$data['ubah'] = $this->Siswa_Model->detail_data($kd);
			$data['jurusan'] = $this->Jurusan_Model->getAllData();
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('siswa/ubah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->Siswa_Model->ubah_data();
			$this->session->set_flashdata('flash_siswa', 'DiUbah');
			redirect('DataSiswa');
		}
	}

	// public function hapus()
	// {
	// 	if ($this->session->userdata('level') != 'admin') {
	// 		show_404();
	// 	}
	// 	$id = $this->input->post('id');
	// 	$this->Siswa_Model->hapus_data($id);
	// 	$this->session->set_flashdata('flash_siswa', 'Dihapus');
	// 	// redirect('DataMapel');
	// }

	public function checkForeign()
	{
		$data = $this->Siswa_Model->checkForeign($this->input->post('id'));
		echo json_encode($data);
	}

	// untuk mengambil data siswa untuk naik kelas
	public function listSiswaNaikKelas()
	{
		$kelas = $this->input->post('kelas');
		$jurusan = $this->input->post('jurusan');
		// $kelas = 'XI';
		// $jurusan = 'mm';
		switch ($kelas) {
			case 'X':
				$kelas = 'baru';
				break;
			case 'XI':
				$kelas = 'X';
				break;
			case 'XII':
				$kelas = 'XI';
				break;
		}
		// echo $this->TahunAjaran_Model->tahunAjaranAktif;
		// echo '<br>';
		$getData = $this->HistoriKelas_Model->siswaNaikKelas($kelas, $jurusan, $this->TahunAjaran_Model->tahunAjaranAktif);
		// echo '<pre>';
		// print_r($getData);
		// echo '</pre>';
		if ($getData['status'] == 'failed') {
			echo json_encode([
				'status' => 'failed',
				'data' => $getData['result']
			]);
		} else {
			$html = '<table class="table table-striped">';
			$html .= "<tr>";
			$html .= "<th>Check</th>";
			$html .= "<th>Nama Siswa</th>";
			$html .= "</tr>";
			foreach ($getData['result'] as $value) {
				$html .= "<tr onclick='selectRow(this)'>";
				$html .= "<td><input id='row$value->id_siswa' type='checkbox' name='siswa[]' value='$value->id_siswa'></td>";
				$html .= "<td>$value->nama_siswa</td>";
				$html .= "</tr>";
			}
			$html .= '</table>';
			echo json_encode([
				'status' => 'success',
				'data' => $html
			]);
		}
	}
}
