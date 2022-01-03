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
		$this->load->model('Kelas_Model');
		$this->load->model('TahunAjaran_Model');
		$this->load->library('form_validation');
	}

	function index()
	{
		$data['k'] = null;
		if ($this->input->get('select_kelas') !== '' && $this->input->get('select_kelas') !== null) {
			$ujians = $this->db->from('v_penugasanujian')
				->where('kode_ta', $this->TahunAjaran_Model->tahunAjaranAktif)
				->where('kode_kelas', $this->input->get('select_kelas'))
				->get()
				->result();
			$data['k'] = $this->input->get('select_kelas');
		} else {
			$ujians = $this->db->from('v_penugasanujian')
				->where('kode_ta', $this->TahunAjaran_Model->tahunAjaranAktif)
				->get()
				->result();
		}
		$data['kelas'] = $this->Kelas_Model->getAllData();
		$data['ujians'] = $ujians;
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('DataUjianSiswa/index');
		$this->load->view('templates/footer');
	}

	public function createUjian()
	{
		$data['k'] = null;
		if ($this->input->get('select_kelas') !== '' && $this->input->get('select_kelas') !== null) {
			$penugasan = $this->db->from('v_penugasan')
				->where('kode_ta', $this->TahunAjaran_Model->tahunAjaranAktif)
				->where('kode_kelas', $this->input->get('select_kelas'))
				->get()
				->result();
			$data['k'] = $this->input->get('select_kelas');
		} else {
			$penugasan = $this->db->from('v_penugasan')
				->where('kode_ta', $this->TahunAjaran_Model->tahunAjaranAktif)
				->get()
				->result();
		}
		$data['kelas'] = $this->Kelas_Model->getAllData();
		$data['penugasan'] = $penugasan;
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('penugasanguru/list_penugasan_guru');
		$this->load->view('templates/footer');
	}
}
