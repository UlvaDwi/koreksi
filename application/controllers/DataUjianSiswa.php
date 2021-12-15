<?php

/**
 * 
 */
class DataUjianSiswa extends CI_Controller
{
	public $search = null;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('JawabanSiswa_Model');
		$this->load->model('PreJawabanSiswa_Model');
		$this->load->model('Tfidf_Model');
		$this->load->model('TahunAjaran_Model');
		$this->load->library('form_validation');
	}

	function index()
	{
		// $ujians = $this->db->from('v_penugasanujian')->where('kode_kelas', $this->search)->get()->result();
		$ujians = $this->db->from('v_penugasanujian')->where('kode_ta', $this->TahunAjaran_Model->tahunAjaranAktif)->get()->result();
		$data = ['ujians' => $ujians];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('DataUjianSiswa/index');
		$this->load->view('templates/footer');
	}
}
