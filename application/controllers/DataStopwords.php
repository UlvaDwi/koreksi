<?php

/**
 * 
 */
class DataStopwords extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Stopwords_Model');
		$this->load->library('form_validation');
	}

	function index()
	{

		$data['stopwords'] = $this->Stopwords_Model->getAllData();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('stopwords/index', $data);
		$this->load->view('templates/footer');
	}

	public function validation_form()
	{

		// $this->form_validation->set_rules("id_stopwords", "Kode stopwords", "required|is_unique[a_stopwords.kode_stopwords]|max_length[20]");
		$this->form_validation->set_rules("kata_stopwords", "Kata stopwords", "required|is_unique[a_stopwords.kata_stopwords]");
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$this->Stopwords_Model->tambah_data();
			$this->session->set_flashdata('flash_stopwords', 'Disimpan');
			redirect('DataStopwords');
		}
	}

	public function hapus($kd)
	{

		$this->Stopwords_Model->hapus_data($kd);
		$this->session->set_flashdata('flash_stopwords', 'Dihapus');
		redirect('DataStopwords');
	}

	public function ubah($kd)
	{

		$this->form_validation->set_rules("id_stopwords", "Kode stopwords", "required|max_length[20]");
		$this->form_validation->set_rules("kata_stopwords", "Nama stopwords", "required");
		if ($this->form_validation->run() == FALSE) {
			$data['ubah'] = $this->Stopwords_Model->detail_data($kd);
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('stopwords/ubah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->Stopwords_Model->ubah_data();
			$this->session->set_flashdata('flash_stopwords', 'DiUbah');
			redirect('DataStopwords');
		}
	}
}
