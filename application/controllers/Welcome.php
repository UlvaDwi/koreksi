<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('TahunAjaran_Model');
		if ($this->session->userdata('level') == 'guru') {
			$this->load->model('PenugasanGuru_Model');
		}
	}

	public function index()
	{
		$data = [
			'menu_mapels' => []
		];
		if ($this->session->userdata('level') == 'guru') {
			$id_user = $this->session->userdata('id_user');
			$kode_ta = $this->TahunAjaran_Model->tahunAjaranAktif;
			$data['menu_mapels'] = $this->PenugasanGuru_Model->getViewData_by(['id_user' => $id_user, 'kode_ta' => $kode_ta])->result();
		}
		$this->load->view("templates/header", $data);
		$this->load->view("templates/sidebar");
		$this->load->view("index.php");
		$this->load->view("templates/footer");
	}
}
