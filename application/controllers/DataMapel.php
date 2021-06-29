<?php

/**
 * 
 */
class DataMapel extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('id_user')) {
			redirect('Login');
		}
		$this->load->model('Mapel_Model');
		$this->load->model('Jurusan_Model');
		$this->load->library('form_validation');
	}

	function index()
	{
		// tampil list mapel
		$data['mapel'] = $this->Mapel_Model->getAllData();
		// untuk dropdown
		$data['jurusan'] = $this->Jurusan_Model->getAllData();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('mapel/index', $data);
		$this->load->view('templates/footer');
	}


	public function validation_form()
	{
		$this->Mapel_Model->tambah_data();
		$this->session->set_flashdata('flash_mapel', 'Disimpan');
		redirect('DataMapel');
	}

	public function hapus($id)
	{
		$this->Mapel_Model->deleteData($id);
		$this->session->set_flashdata('flash_mapel', 'Dihapus');
		redirect('DataMapel');
	}

	public function checkForeign()
	{
		$data = $this->Mapel_Model->checkForeign($this->input->post('id'));
		echo json_encode($data);
	}

	public function ubah($id_map)
	{
		// $this->form_validation->set_rules("id_map", "ID Mapel", "required|max_length[5]");
		$this->form_validation->set_rules("id_mapel", "id mapel", "required");
		$this->form_validation->set_rules("nama_mapel", "nama Mapel", "required");
		$this->form_validation->set_rules("kelas", "Kelas", "required");
		$this->form_validation->set_rules("kode_jurusan", "Jurusan", "required");

		if ($this->form_validation->run() == FALSE) {
			$data['ubah'] = $this->Mapel_Model->detail_data($id_map);
			$data['jurusan'] = $this->Jurusan_Model->getAllData();
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('mapel/ubah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->Mapel_Model->ubah_data();
			$this->session->set_flashdata('flash_mapel', 'DiUbah');
			redirect('DataMapel');
		}
	}
}
