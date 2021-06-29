<?php

/**
 * 
 */
class DataKataDasar extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('KataDasar_Model');
		$this->load->library('form_validation');
	}

	function index()
	{

		$data['katadasar'] = $this->KataDasar_Model->getAllData();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('katadasar/index', $data);
		$this->load->view('templates/footer');
	}

	public function validation_form()
	{

		// $this->form_validation->set_rules("id_katadasar", "Kode katadasar", "required|is_unique[a_katadasar.kode_katadasar]|max_length[20]");
		$this->form_validation->set_rules("kata_katadasar", "Kata katadasar", "required|is_unique[a_katadasar.kata_katadasar]");
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$this->KataDasar_Model->tambah_data();
			$this->session->set_flashdata('flash_katadasar', 'Disimpan');
			redirect('DataKataDasar');
		}
	}

	public function hapus($kd)
	{

		$this->KataDasar_Model->hapus_data($kd);
		$this->session->set_flashdata('flash_katadasar', 'Dihapus');
		redirect('DataKataDasar');
	}

	public function ubah($kd)
	{

		$this->form_validation->set_rules("id_katadasar", "Kode katadasar", "required|max_length[20]");
		$this->form_validation->set_rules("kata_katadasar", "Nama katadasar", "required");
		if ($this->form_validation->run() == FALSE) {
			$data['ubah'] = $this->KataDasar_Model->detail_data($kd);
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('katadasar/ubah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->KataDasar_Model->ubah_data();
			$this->session->set_flashdata('flash_katadasar', 'DiUbah');
			redirect('DataKataDasar');
		}
	}
}
