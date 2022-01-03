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
		$this->load->model('Kelas_Model');
	}

	function index()
	{
		// $ujians = $this->db->from('v_penugasanujian')->where('kode_kelas', $this->search)->get()->result();
		$data['k'] = null;
		if ($this->input->get('select_kelas') !== '' && $this->input->get('select_kelas') !== null) {
			$data['k'] = $this->input->get('select_kelas');
			$penugasans = $this->db->from('v_penugasan')
				->where('kode_ta', $this->TahunAjaran_Model->tahunAjaranAktif)
				->where('kode_kelas', $this->input->get('select_kelas'))
				->order_by('nama_guru')
				->get()
				->result();
		} else {
			$penugasans = $this->db->from('v_penugasan')
				->where('kode_ta', $this->TahunAjaran_Model->tahunAjaranAktif)
				->order_by('nama_guru')
				->get()
				->result();
		}
		$data['penugasans'] = $penugasans;
		$data['kelas'] = $this->Kelas_Model->getAllData();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('DataHasilPembelajaran/index');
		$this->load->view('templates/footer');
	}
}
