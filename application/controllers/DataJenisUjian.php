<?php

/**
 * 
 */
class DataJenisUjian extends CI_Controller
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
		$this->load->model('JenisUjian_Model');
		$this->load->library('form_validation');
	}

	function index()
	{

		$data['jenisujian'] = $this->JenisUjian_Model->getAllData();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('jenisujian/index', $data);
		$this->load->view('templates/footer');
	}

	public function validation_form()
	{
		if ($this->session->userdata('level') != 'admin') {
			show_404();
		}
		$this->form_validation->set_rules("kode_jenis", "Kode ", "required");
		$this->form_validation->set_rules("nama_jenis", "Nama ", "required");
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$this->JenisUjian_Model->tambah_data();
			$this->session->set_flashdata('flash_jenisujian', 'Disimpan');
			redirect('DataJenisUjian');
		}
	}

	// public function hapus($kd)
	// {
	// 	if ($this->session->userdata('level') != 'admin') {
	// 		show_404();
	// 	}
	// 	$this->JenisUjian_Model->hapus_data($kd);
	// 	$this->session->set_flashdata('flash_jenisujian', 'Dihapus');
	// 	redirect('DataJenisUjian');
	// }

	public function ubah($kd)
	{
		if ($this->session->userdata('level') != 'admin') {
			show_404();
		}
		$this->form_validation->set_rules("kode_jenis", "Kode ", "required");
		$this->form_validation->set_rules("nama_jenis", "Nama ", "required");
		if ($this->form_validation->run() == FALSE) {
			$data['ubah'] = $this->JenisUjian_Model->detail_data($kd);
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('jenisujian/ubah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->JenisUjian_Model->ubah_data();
			$this->session->set_flashdata('flash_jenisujian', 'DiUbah');
			redirect('DataJenisUjian');
		}
	}

	public function hapus($id)
	{
		// if ($this->session->userdata('level') != 'admin') {
		// 	show_404();
		// }

		$this->JenisUjian_Model->hapus_data($id);
		$this->session->set_flashdata('flash_mapel', 'Dihapus');
		redirect('DataSoalKunci/jenis');
	}

	public function checkForeign()
	{
		$data = $this->JenisUjian_Model->checkForeign($this->input->post('id'));
		echo json_encode($data);
	}
}
