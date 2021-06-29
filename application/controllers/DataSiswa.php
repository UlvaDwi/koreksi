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
		$this->load->library('form_validation');
	}

	function index()
	{

		$data['siswa'] = $this->Siswa_Model->getAllData();
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
		$this->form_validation->set_rules("username", "Username", "required");
		$this->form_validation->set_rules("password", "Password", "required");
		if ($this->form_validation->run() == FALSE) {
			$data['ubah'] = $this->Siswa_Model->detail_data($kd);
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
}
