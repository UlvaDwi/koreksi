
<?php

/**
 * 
 */
class DataUjian extends CI_Controller
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
		$this->load->model([
			'JenisUjian_Model',
			'UjianSiswa_Model',
			'Ujian_Model',
			'PenugasanGuru_Model'
		]);
		$this->load->library('form_validation');
	}
	function index()
	{

		$data['ujian'] = $this->Ujian_Model->getAllData();
		$data['penugasanguru'] = $this->PenugasanGuru_Model->getAllData();
		$data['jenisujian'] = $this->JenisUjian_Model->getAllData();
		// untuk dropdown


		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('ujian/index', $data);
		$this->load->view('templates/footer');
	}


	public function validation_form()
	{
		if ($this->session->userdata('level') != 'admin') {
			show_404();
		}

		$this->form_validation->set_rules("id_tugas", "id tugas");
		$this->form_validation->set_rules("kode_jenis", "Nama ujian");
		$this->form_validation->set_rules("tgl_pelaksanaan", "tanggal pelaksanaan");
		$this->form_validation->set_rules("tgl_selesai", "Tanggal selesai");
		$this->form_validation->set_rules("durasi", "Durasi");
		if (!$this->form_validation->run()) {
			$this->index();
		} else {
			$this->Ujian_Model->tambah_data();
			$this->session->set_flashdata('flash_ujian', 'Disimpan');
			redirect('DataUjian');
		}
	}

	public function check_select_jurusan()
	{
		if ($this->input->post('id_tugas') == '--Pilih Guru --') {
			$this->form_validation->set_message('check_select_jurusan', 'pilih guru yang benar!!!!!!');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function check_select_jenis()
	{
		if ($this->input->post('kode_jenis') == '--Pilih Jenis Ujian --') {
			$this->form_validation->set_message('check_select_jenis', 'pilih jenis ujian yang benar!!!!!!');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function hapus($kd)
	{

		$id_tugas = $this->Ujian_Model->getData(['id_ujian' => $kd])->row('id_tugas');
		$this->UjianSiswa_Model->destroy(['id_ujian' => $kd]);
		$this->Ujian_Model->hapus_data($kd);
		$this->session->set_flashdata('flash_ujian', 'Dihapus');
		redirect("DataSoalKunci/jenis/$id_tugas");
	}

	public function ubah($id)
	{
		if ($this->session->userdata('level') != 'admin') {
			show_404();
		}

		$this->form_validation->set_rules("id_tugas", "tugas", "required");
		$this->form_validation->set_rules("kode_jenis", "Nama Ujian", "required");
		if ($this->form_validation->run() == FALSE) {
			$data['penugasanguru'] = $this->PenugasanGuru_Model->getAllData();
			$data['ubah'] = $this->Ujian_Model->detail_data($id);
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('ujian/ubah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->Ujian_Model->ubah_data();
			$this->session->set_flashdata('flash_ujian', 'DiUbah');
			redirect('DataUjian');
		}
	}
	// public function hapus()
	// {
	// 	if ($this->session->userdata('level') != 'admin') {
	// 		show_404();
	// 	}
	// 	$id = $this->input->post('id');
	// 	$this->Ujian_Model->hapus_data($id);
	// 	$this->session->set_flashdata('flash_ujian', 'Dihapus');
	// redirect('DataMapel');
	// }

	// public function checkForeign()
	// {
	// 	$data = $this->Ujian_Model->checkForeign($this->input->post('id'));
	// 	echo json_encode($data);
	// }
}
