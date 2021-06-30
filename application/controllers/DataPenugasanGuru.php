<?php

/**
 * 
 */
class DataPenugasanGuru extends CI_Controller
{
	public $ta;
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('id_user')) {
			redirect('Login');
		}
		$this->load->model('PenugasanGuru_Model');
		$this->load->model('User_Model');
		$this->load->model('Mapel_Model');
		$this->load->model('Kelas_Model');
		$this->load->model('Jurusan_Model');
		$this->load->library('form_validation');
	}
	function index()
	{
		// tampil list penugasan guru
		$data['tugas_guru'] = $this->PenugasanGuru_Model->getAllData();
		$data['listGuru'] = $this->User_Model->getData();
		$data['listMapel'] = $this->PenugasanGuru_Model->listDataMapelyangKosong();
		$data['kelas'] = $this->Kelas_Model->getAllData();
		$data['jurusan'] = $this->Jurusan_Model->getAllData();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('penugasanguru/index', $data);
		$this->load->view('templates/footer');
	}

	public function getDataKelas()
	{
		$data = $this->PenugasanGuru_Model->dataKelasByKodeMapel($this->input->post('id_mapel'));
		// echo json_encode($data);
		$html = '<form action="' . base_url('DataPenugasanGuru/tambah') . '" method="POST">';
		$html .= '<input type="hidden" value="' . count($data) . '" name="jml_data">';
		foreach ($data as $value) {
			$html .= '<div class="form-group">';
			$html .= '<label for="exampleFormControlInput1">' . $value->kelas . ' ' . $value->id_jurusan . ' ' . $value->nama_kelas . '</label>';
			if ($value->id_user == null) {
				$html .= '<input type="text" value="' . $value->kode_kelas . '" name="kode_kelas[]">';
				$html .= '<input type="text" value="' . $value->id_mapel . '" name="id_mapel[]">';
				// $html .= '<input type="text" value="' . $value->kode_mapel . '" name="kode_mapel[]">';
			}
			// $html .= '<select name="guru[]" class="form-control" disabled >';
			$html .= ($value->id_user == null) ? '<select name="guru[]" class="form-control">' : '<select name="guru[]" class="form-control" disabled >';
			$html .= ($value->id_user != null) ? '<option selected="selected">Pilih Guru</option>' : '';
			if ($value->id_user == null) {
				$html .= '<option selected="selected">Pilih Guru</option>';
				foreach ($this->Guru_Model->getAllData() as $datalistGuru) :
					$selected = ($value->id_user == $datalistGuru->id_user) ? '' : 'selected';
					$html .= '<option value="' . $datalistGuru->id_user . '"' . $selected . ' >' . $datalistGuru->nama_guru . '</option>';
				endforeach;
			} else {
				# code...
			}
			$html .= '</select>';
			$html .= '</div>';
		}
		$html .= '<input type="submit" class="btn btn-success" value="Simpan">';
		$html .= '</form>';
		echo $html;
	}

	function tampilan_tambah($id_mapel)
	{
		// tampil list penugasan guru
		$data['kodeMapel'] = $id_mapel;
		$data['dataMapel'] = $this->PenugasanGuru_Model->dataKelasByKodeMapel($id_mapel);
		$data['guru'] = $this->User_Model->getData();
		$data['nama_mapel'] = $this->Mapel_Model->getMapelbyKodeMapel($id_mapel);

		if (empty($data['dataMapel'])) {
			redirect('DataPenugasanGuru');
		}
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('penugasanguru/tambah_data', $data);
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$this->PenugasanGuru_Model->tambah_data();
		$this->session->set_flashdata('flash_penugasanguru', 'Disimpan');
		redirect('DataPenugasanGuru');
	}

	// public function validation_form()
	// {
	// 	$this->PenugasanGuru_Model->tambah_data();
	// 	$this->session->set_flashdata('flash_penugasanguru', 'Disimpan');
	// 	redirect('DataPenugasanGuru/tampilan_tambah');
	// }

	public function hapus()
	{
		$this->PenugasanGuru_Model->hapus_data($this->input->post('id_tugas'));
	}

	public function ubah($id_pen)
	{
		$this->form_validation->set_rules("id_pen", "ID Penugasan Guru", "required|max_length[5]");
		$this->form_validation->set_rules("id_gur", "Nama Guru", "required");
		$this->form_validation->set_rules("id_map", "Mapel", "required");
		$this->form_validation->set_rules("id_kls", "Kelas", "required");
		if ($this->form_validation->run() == FALSE) {
			$data['ubah'] = $this->PenugasanGuru_Model->detail_data($id_pen);
			$data['guru'] = $this->Guru_Model->getAllData();
			$data['mapel'] = $this->Mapel_Model->getAllData();
			$data['kelas'] = $this->Kelas_Model->getAllData();
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('penugasanguru/ubah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->PenugasanGuru_Model->ubah_data();
			$this->session->set_flashdata('flash_penugasanguru', 'DiUbah');
			redirect('DataPenugasanGuru');
		}
	}
}
