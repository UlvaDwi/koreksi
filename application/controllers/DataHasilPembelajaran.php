<?php

/**
 * 
 */
class DataHasilPembelajaran extends CI_Controller
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
		$penugasans = $this->db->from('v_penugasan')->where('kode_ta', $this->TahunAjaran_Model->tahunAjaranAktif)->order_by('nama_guru')->get()->result();
		$data = ['penugasans' => $penugasans];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('DataHasilPembelajaran/index');
		$this->load->view('templates/footer');
	}
}
