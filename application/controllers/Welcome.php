<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('TahunAjaran_Model');

		$this->load->model('PenugasanGuru_Model');

		$this->load->model('HistoriKelas_Model');
		$this->load->model('Mapel_Model');
	}

	public function index()
	{



		$data = [
			'menu_mapels' => []
		];
		$kode_ta = $this->TahunAjaran_Model->tahunAjaranAktif;
		if ($this->session->userdata('level') == 'guru') {
			$id_user = $this->session->userdata('id_user');
			$data['mapel'] = $this->Mapel_Model->getDashboard($id_user, $kode_ta);
			$data['menu_mapels'] = $this->PenugasanGuru_Model->getViewData_by(['id_user' => $id_user, 'kode_ta' => $kode_ta])->result();
		} elseif ($this->session->userdata('level') == 'siswa') {
			$id_user = $this->session->userdata('id_siswa');
			$kode_kelas = $this->HistoriKelas_Model->getData_by(['id_siswa' => $id_user, 'kode_ta' => $kode_ta])->row('kode_kelas');
			$data['menu_mapels'] = $this->PenugasanGuru_Model->getViewData_by(['kode_kelas' => $kode_kelas, 'kode_ta' => $kode_ta])->result();
		}

		$this->load->view("templates/header", $data);
		$this->load->view("templates/sidebar");
		$this->load->view("index.php");
		$this->load->view("templates/footer");
	}
}
