<?php

/**
 * 
 */
class DataSoalKunci extends CI_Controller
{
	private $arraykatadasar = array();
	private $arraytoken = array();
	private $arrayfiltered = array();
	private $arraystemmed = array();

	private $number = 1;
	private $id_soal = null;
	private $soal = null;
	private $jawaban = null;
	private $id_ujian = null;
	private $id_ujian_siswa = null;


	public function __construct()
	{
		parent::__construct();
		$this->load->model([
			'SoalKunci_Model',
			'Tfidf_Model',
			'Mapel_Model',
			'PreSoalKunci_Model',
			'JenisUjian_Model',
			'Ujian_Model',
			'PenugasanGuru_Model',
			'TahunAjaran_Model',
			'UjianSiswa_Model',
			'HistoriKelas_Model',
			'JawabanSiswa_Model'
		]);
		$this->load->library('form_validation');

		// get first question
		// $this->
	}
	function indexpre()
	{
		$data['prekunci'] = $this->PreSoalKunci_Model->getAllData();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('prekunci/index', $data);
		$this->load->view('templates/footer');
	}

	function index()
	{
		$kode_ta = $this->TahunAjaran_Model->tahunAjaranAktif;
		$id_guru = $this->session->userdata('id_user');
		$data['mapel'] = $this->Mapel_Model->getDashboard($id_guru, $kode_ta);
		// untuk sidebar
		if ($this->session->userdata('level') == 'guru') {
			$id_user = $this->session->userdata('id_user');
			$kode_ta = $this->TahunAjaran_Model->tahunAjaranAktif;
			$data['menu_mapels'] = $this->PenugasanGuru_Model->getViewData_by(['id_user' => $id_user, 'kode_ta' => $kode_ta])->result();
		}
		// /sidebar
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('soalkunci/index');
		$this->load->view('templates/footer');
	}

	public function tampilUjian($id_ujian)
	{
		$this->id_ujian = $id_ujian;
		$data['soal'] = $this->SoalKunci_Model->getData();

		$kode_ta = $this->TahunAjaran_Model->tahunAjaranAktif;

		if ($this->session->userdata('level') == 'siswa') {
			$id_user = $this->session->userdata('id_siswa');
			$kode_kelas = $this->HistoriKelas_Model->getData_by(['id_siswa' => $id_user, 'kode_ta' => $kode_ta])->row('kode_kelas');
			$kode_ta = $this->TahunAjaran_Model->tahunAjaranAktif;
			$data['menu_mapels'] = $this->PenugasanGuru_Model->getViewData_by(['kode_kelas' => $kode_kelas, 'kode_ta' => $kode_ta])->result();
		}
		$data['ujian'] = $this->PenugasanGuru_Model->getViewPenugasanUjian_by(['id_ujian' => $id_ujian])->row();
		$data['ujianSiswa'] =  $this->UjianSiswa_Model->getData(['id_ujian' => $id_ujian, 'a_siswa.id_siswa' => $id_user])->row();

		if ($this->session->userdata('level') == 'guru') {
			$id_user = $this->session->userdata('id_user');
			$data['mapel'] = $this->Mapel_Model->getDashboard($id_user, $kode_ta);
			$data['menu_mapels'] = $this->PenugasanGuru_Model->getViewData_by(['id_user' => $id_user, 'kode_ta' => $kode_ta])->result();
		} elseif ($this->session->userdata('level') == 'siswa') {
			$id_user = $this->session->userdata('id_siswa');
			$kode_kelas = $this->HistoriKelas_Model->getData_by(['id_siswa' => $id_user, 'kode_ta' => $kode_ta])->row('kode_kelas');
			$data['menu_mapels'] = $this->PenugasanGuru_Model->getUjianSiswa(['v_penugasan.kode_kelas' => $kode_kelas, 'v_penugasan.kode_ta' => $kode_ta]);
		}
		// /sidebar
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('soalkunci/ujian');
		$this->load->view('templates/footer');
	}

	public function listUjian($idTugas)
	{
		$this->db->join('a_ujian_siswa', 'a_ujian_siswa.id_ujian = v_penugasanujian.id_ujian');
		$this->db->where('v_penugasanujian.id_tugas', $idTugas);
		$this->db->where('a_ujian_siswa.id_siswa', $this->session->userdata('id_siswa'));
		$this->db->select('v_penugasanujian.*, a_ujian_siswa.nilai, a_ujian_siswa.status');
		$data['ujians'] = $this->db->get('v_penugasanujian')->result();
		$kode_ta = $this->TahunAjaran_Model->tahunAjaranAktif;

		if ($this->session->userdata('level') == 'guru') {
			$id_user = $this->session->userdata('id_user');
			$data['mapel'] = $this->Mapel_Model->getDashboard($id_user, $kode_ta);
			$data['menu_mapels'] = $this->PenugasanGuru_Model->getViewData_by(['id_user' => $id_user, 'kode_ta' => $kode_ta])->result();
		} elseif ($this->session->userdata('level') == 'siswa') {
			$id_user = $this->session->userdata('id_siswa');
			$kode_kelas = $this->HistoriKelas_Model->getData_by(['id_siswa' => $id_user, 'kode_ta' => $kode_ta])->row('kode_kelas');
			$data['menu_mapels'] = $this->PenugasanGuru_Model->getUjianSiswa(['v_penugasan.kode_kelas' => $kode_kelas, 'v_penugasan.kode_ta' => $kode_ta]);
		}
		// /sidebar
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('soalkunci/listujian');
		$this->load->view('templates/footer');
	}


	// public function isiJawabanSiswa($id_ujian, $id_ujian_siswa)
	// {
	// 	$soal = $this->db->select('id_soal')->from('a_soalkunci')->where('id_ujian', $id_ujian)->get()->result();
	// 	foreach ($soal as $value) {
	// 		$data[] =  [
	// 			'id_soal' => $value->id_soal,
	// 			'id_ujian_siswa' => $id_ujian_siswa,
	// 			'jawaban' => '',
	// 		];
	// 	}
	// 	$this->db->insert('a_jawabansiswa', $data);
	// }

	public function tampilSoal($id_ujian)
	{
		$ujian = $this->UjianSiswa_Model->getData(['id_ujian' => $id_ujian, 'a_siswa.id_siswa' => $this->session->userdata('id_siswa')])->row();
		if (empty($ujian)) {
			$this->UjianSiswa_Model->store([
				'id_ujian' => $id_ujian,
				'id_siswa' => $this->session->userdata('id_siswa')
			]);
			$ujian = $this->UjianSiswa_Model->getData(['id_ujian' => $id_ujian, 'a_siswa.id_siswa' => $this->session->userdata('id_siswa')])->row();
		}


		$data['soal'] = $this->SoalKunci_Model->getData();

		$kode_ta = $this->TahunAjaran_Model->tahunAjaranAktif;
		if ($this->session->userdata('level') == 'siswa') {
			$id_user = $this->session->userdata('id_siswa');
			$kode_kelas = $this->HistoriKelas_Model->getData_by(['id_siswa' => $id_user, 'kode_ta' => $kode_ta])->row('kode_kelas');
			$kode_ta = $this->TahunAjaran_Model->tahunAjaranAktif;
			$data['menu_mapels'] = $this->PenugasanGuru_Model->getViewData_by(['kode_kelas' => $kode_kelas, 'kode_ta' => $kode_ta])->result();
		}
		$data['ujian'] = $penugasanUjian = $this->PenugasanGuru_Model->getViewPenugasanUjian_by(['id_ujian' => $id_ujian])->row();
		$data['id_ujian_siswa'] = $ujian->id_ujian_siswa;
		$data['id_ujian'] = $id_ujian;
		date_default_timezone_set("Asia/Jakarta");
		$now = date_create();
		$pelaksanaan = date_create($penugasanUjian->tgl_pelaksanaan);
		$selesai = date_create($penugasanUjian->tgl_selesai);
		$mulai = date_diff($now, $pelaksanaan)->format("%R");
		$selesai = date_diff($now, $selesai)->format("%R");
		// inisialisasi id pertama soal
		$data['idSoalPertama'] = $this->SoalKunci_Model->getData(['id_ujian' =>  $id_ujian])->row('id_soal');
		if ($mulai == '+' || $selesai == '-') {
			return redirect("DataSoalKunci/tampilujian/$id_ujian");
		} else if ($ujian->status == 'selesai') {
			show_404();
		} else {
			// /sidebar
			$this->load->view('templates/header');
			// $this->load->view('templates/sidebar');
			$this->load->view('soalkunci/soalUjian',  $data);
			$this->load->view('templates/footer');
		}
	}

	// public function time()
	// {
	// 	$tanggal_start = $this->input->post('tgl_pelaksanaan');
	// 	$waktu_start = $this->input->post('durasi');
	// 	$s = strtotime("$waktu_start $tanggal_start");
	// 	$start = array('waktu' => date('Y:m:d H:i:s', $s));
	// 	$result = $this->mcountdown->time($start);
	// 	if ($result == true) {
	// 		redirect(site_url('countdown/lihat_countdown'));
	// 	} else {
	// 		redirect(site_url());
	// 	}
	// }

	public function getSoal()
	{
		$id_soal = $this->input->post('id_soal');
		if ($id_soal) {
			$soal = $this->SoalKunci_Model->getData(['id_soal' => $id_soal])->row();
		} else if ($this->input->post('id_ujian')) {
			$soal = $this->SoalKunci_Model->getData(['id_ujian' => $this->input->post('id_ujian')])->row();
			$id_soal = $soal->id_soal;
		}
		$jawaban = $this->JawabanSiswa_Model->getDataBy([
			'id_soal' => $id_soal,
			'id_ujian_siswa' => $this->input->post('id_ujian_siswa')
		])->row('jawaban');
		$data = [
			'soal' => $soal->soal,
			'id' => $soal->id_soal,
			'jawaban' => $jawaban,
		];
		echo json_encode($data);
	}

	public function getListSoal()
	{
		$id_ujian = $this->input->post('id_ujian');
		$soal = $this->SoalKunci_Model->getData(['id_ujian' => $id_ujian])->result();
		$data = "";
		foreach ($soal as $key => $value) {
			$no = $key + 1;
			$jawaban = $this->JawabanSiswa_Model->getDataBy([
				'id_soal' => $value->id_soal,
				'id_ujian_siswa' => $this->input->post('id_ujian_siswa')
			])->row('jawaban');
			$btnType = ($jawaban) ? 'btn-success' : 'btn-default';
			$data .= "<button onclick='getSoal($value->id_soal, $no)' class='m-1 btn $btnType col-2'>$no</button>";
		}
		echo json_encode($data);
	}

	public function selesaiUjian()
	{
		$update = $this->UjianSiswa_Model->update(['id_ujian_siswa' => $this->input->post('id_ujian_siswa')], ['status' => 'selesai']);
		$response = ['status' => 'sucess', 'message' => 'updated'];
		echo json_encode($response);
	}

	function jenis($id_tugas)
	{
		// $id_tugas = $_GET['id_tugas'];
		// ambil data user guru
		$id_guru = $this->session->userdata('id_user');
		// cek apakah apakah halaman yang diakses sesuai dengan id_user
		$tempIdGuru = $this->PenugasanGuru_Model->getData_by(['id_tugas' => $id_tugas])->row('id_user');
		$guru = $this->PenugasanGuru_Model->getViewData_by(['id_tugas' => $id_tugas])->row();

		if ($id_guru != $tempIdGuru) {
			if ($this->session->userdata('level') != 'admin') {
				show_404();
			}
		}
		$data = [
			'ujians' => $this->Ujian_Model->getData(['id_tugas' => $id_tugas])->result(),
			'mapel' => "Mapel $guru->nama_mapel Kelas " . str_replace("_", " ", $guru->kode_kelas),
			'menu_mapels' => []
		];

		// untuk sidebar
		if ($this->session->userdata('level') == 'guru') {
			$id_user = $this->session->userdata('id_user');
			$kode_ta = $this->TahunAjaran_Model->tahunAjaranAktif;
			$data['menu_mapels'] = $this->PenugasanGuru_Model->getViewData_by(['id_user' => $id_user, 'kode_ta' => $kode_ta])->result();
		}
		// /sidebar

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('soalkunci/jenis');
		$this->load->view('templates/footer');
	}

	public function storeUjian($id_tugas)
	{
		$id_ujian = $this->Ujian_Model->tambah_data();
		$penugasan = $this->PenugasanGuru_Model->getViewPenugasanUjian_by(['id_ujian' => $id_ujian])->row();
		$siswa = $this->HistoriKelas_Model->getData_by([
			'kode_kelas' => $penugasan->kode_kelas,
			'kode_ta' => $penugasan->kode_ta
		])->result();
		foreach ($siswa as $valueSiswa) {
			$this->UjianSiswa_Model->store([
				'id_ujian' => $id_ujian,
				'id_siswa' => $valueSiswa->id_siswa,
				'nilai' => null
			]);
		}

		return redirect("DataSoalKunci/jenis/$id_tugas");
	}

	function tambah($id_ujian)
	{
		$ujian = $this->Ujian_Model->getData(['id_ujian' => $id_ujian])->row();
		$penugasan = $this->PenugasanGuru_Model->getData_by(['id_tugas' => $ujian->id_tugas])->row();

		$id_mapel =  $penugasan->id_mapel;
		$id_tugas =  $ujian->id_tugas;
		$jenis_ujian =  $ujian->kode_jenis;

		$data['ubah'] = $this->SoalKunci_Model->detail_data_mapel($id_mapel);
		$data['ujian'] = $this->SoalKunci_Model->getDataUjian($id_tugas, $jenis_ujian);

		$id_ujian = $data['ujian']['id_ujian'];

		$data['soalkunci'] = $this->SoalKunci_Model->getAllData($id_ujian);
		$data['id_ujian'] = $id_ujian;

		// untuk sidebar
		if ($this->session->userdata('level') == 'guru') {
			$id_user = $this->session->userdata('id_user');
			$kode_ta = $this->TahunAjaran_Model->tahunAjaranAktif;
			$data['menu_mapels'] = $this->PenugasanGuru_Model->getViewData_by(['id_user' => $id_user, 'kode_ta' => $kode_ta])->result();
		}
		// /sidebar
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('soalkunci/tambah');
		$this->load->view('templates/footer');
	}

	public function validation_form()
	{
		$this->form_validation->set_rules("id_ujian", "id mapel ujian", "required");
		$this->form_validation->set_rules("soal", "soal", "required");
		$this->form_validation->set_rules("kunci_jawaban", "kunci_jawaban", "required");
		$this->form_validation->set_rules("skor_soal", "skor soal", "required");

		$kuncijawaban = $this->input->post('kunci_jawaban');

		$query = $this->db->query('select *from a_soalkunci order by id_soal desc');
		if ($query->num_rows() == 0) {
			$id = 1;
		} else {
			$id = $query->row('id_soal') + 1;
		}

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$this->SoalKunci_Model->tambah_data($id);

			$hasiltoken = $this->tokenizing($kuncijawaban);

			$hasilfilter = $this->filtering($hasiltoken);

			$hasilstemming = $this->stemming($hasilfilter);

			$arr_kalimat = explode(" ", $hasilstemming);
			$jumlah_kata = $this->Tfidf_Model->tambah_data($arr_kalimat);
			$this->PreSoalKunci_Model->tambah_data($id, $hasiltoken, $hasilfilter, $hasilstemming, $jumlah_kata);

			// var_dump($arr_kalimat);
			// die();
			$this->session->set_flashdata('flash_soalkunci', 'Disimpan');
			redirect('DataSoalKunci/tambah/' . $this->input->post('id_ujian'));
		}
	}
	//hapus soal
	public function hapus($kd)
	{
		$id_ujian = $this->SoalKunci_Model->getData(['id_soal' => $kd])->row('id_ujian');
		$this->SoalKunci_Model->hapus_data($kd);
		$this->session->set_flashdata('flash_soalkunci', 'Dihapus');
		redirect("DataSoalKunci/tambah/$id_ujian");
	}


	public function ubah($kd, $id_ujian)
	{

		$this->form_validation->set_rules("id_soal", "id soal", "required");
		// $this->form_validation->set_rules("id_mapel_ujian", "id mapel ujian", "required");
		$this->form_validation->set_rules("soal", "soal", "required");
		$this->form_validation->set_rules("kunci_jawaban", "kunci_jawaban", "required");
		$this->form_validation->set_rules("skor_soal", "skor soal", "required");

		// untuk sidebar
		if ($this->session->userdata('level') == 'guru') {
			$id_user = $this->session->userdata('id_user');
			$kode_ta = $this->TahunAjaran_Model->tahunAjaranAktif;
			$data['menu_mapels'] = $this->PenugasanGuru_Model->getViewData_by(['id_user' => $id_user, 'kode_ta' => $kode_ta])->result();
		}
		// /sidebar

		if ($this->form_validation->run() == FALSE) {
			$data['ubah'] = $this->SoalKunci_Model->detail_data($kd);
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('soalkunci/ubah');
			$this->load->view('templates/footer');
		} else {
			$idsoal = $this->input->post('id_soal', true);
			$kuncijawaban = $this->input->post('kunci_jawaban');

			$data = array(
				'soal' => $this->input->post('soal', true),
				'kunci_jawaban' => $kuncijawaban,
				'skor_soal' => $this->input->post('skor_soal', true)
			);

			$hasiltoken = $this->tokenizing($kuncijawaban);
			$hasilfilter = $this->filtering($hasiltoken);
			$hasilstemming = $this->stemming($hasilfilter);

			$arr_kalimat = explode(" ", $hasilstemming);

			// ubah data soal kunci 
			$this->SoalKunci_Model->ubah_data($data);

			// delete data tfidf
			$this->db->delete('a_tfidf', ['id_soal' => $idsoal]);

			// tambah data tfidf	
			$jumlah_kata = $this->Tfidf_Model->ubah_data($arr_kalimat, $idsoal);

			// ubah data presoalkunci
			$this->PreSoalKunci_Model->ubah_data($idsoal, $hasiltoken, $hasilfilter, $hasilstemming, $jumlah_kata);


			$this->session->set_flashdata('flash_soalkunci', 'DiUbah');
			redirect("DataSoalKunci/tambah/$id_ujian");
		}
	}
	public function ubahjenis($kd)
	{
		$this->form_validation->set_rules("id_ujian", "id ujian", "required");
		$this->form_validation->set_rules("id_tugas", "id_tugas", "required");
		$this->form_validation->set_rules("kode_jenis", "kode_jenis", "required");
		$this->form_validation->set_rules("tgl_pelaksanaan", "tanggal pelaksanaan", "required");
		$this->form_validation->set_rules("tgl_selesai", "tanggal selesai", "required");

		// untuk sidebar
		if ($this->session->userdata('level') == 'guru') {
			$id_user = $this->session->userdata('id_user');
			$kode_ta = $this->TahunAjaran_Model->tahunAjaranAktif;
			$data['menu_mapels'] = $this->PenugasanGuru_Model->getViewData_by(['id_user' => $id_user, 'kode_ta' => $kode_ta])->result();
		}
		// /sidebar

		$data['ubah'] = $this->Ujian_Model->detail_data($kd);
		$id_tugas = $data['ubah']['id_tugas'];
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('soalkunci/ubahjenis');
			$this->load->view('templates/footer');
		} else {
			$this->Ujian_Model->ubah_data();
			$this->session->set_flashdata('flash_soalkunci', 'DiUbah');
			redirect("DataSoalKunci/jenis/$id_tugas");
		}
	}

	/*------------TOKENIZING------------*/
	public function tokenizing()
	{
		$kunci_jawaban = $this->input->post('kunci_jawaban');
		$lowercase = strtolower($kunci_jawaban);
		$tokens = preg_replace('/[^A-Za-z0-9\  ]/', '', $lowercase);
		// $tokens = preg_replace('/\s+/', ' ', $lowercase);
		// $tokens = preg_replace('/[^a-z]/', ' ', $tokens);
		//$tokens = preg_replace('/[^a-zA-Z0-9]+/',' ', $tokens);
		return $tokens;
	}

	/*------------FILTERING------------*/
	public function filtering($hasiltoken)
	{

		//ubah string ke array
		$this->arraytoken = explode(" ", $hasiltoken);

		//ambil stop words dan diubah ke array
		$this->db = $this->load->database('default', TRUE);
		$this->db->select('kata_stopwords');

		$this->db->from('a_stopwords');
		$arraystopwords = $this->db->get()->result_array();

		//ubah ke associative array
		$arraystopwords = array_column($arraystopwords, 'kata_stopwords');

		//bandingkan dua array
		$this->arrayfiltered = array_diff($this->arraytoken, $arraystopwords);

		//ubah hasil filter ke string
		$hasilfilter = implode(" ", $this->arrayfiltered);

		return $hasilfilter;
	}


	/*------------STEMMING------------*/
	public function stemming($hasilfilter)
	{

		//ubah string ke array
		$this->arrayfiltered = explode(" ", $hasilfilter);

		//ambil katadasar words dan diubah ke array
		$this->db->select('kata_katadasar');
		$this->db->from('a_katadasar');
		$arraykatdas = $this->db->get()->result_array();

		//ubah ke associative array
		$this->arraykatadasar = array_column($arraykatdas, 'kata_katadasar');

		//looping
		foreach ($this->arrayfiltered as $kataawal) {
			$term = $kataawal;

			if (strlen($term) <= 3) { //jangan stem kata pendek (di bawah tiga huruf)
				array_push($this->arraystemmed, $term);
				continue;
			}

			$cekterm = $this->cekterm($term);
			if ($cekterm == true) {
				array_push($this->arraystemmed, $term);
				continue;
			} else {

				if (preg_match('/\-/', $term)) { //stem untuk kata ulang
					$split = explode("-", $term);
					$katasatu = $split[0];
					$katadua = $split[1];

					if ($katasatu == $katadua) {
						$term = $katasatu;
						array_push($this->arraystemmed, $term);
						continue;
					} else {
						$katasatu = $this->cek_reduplikasi($katasatu);
						$katadua = $this->cek_reduplikasi($katadua);
						if ($katasatu == $katadua) {
							array_push($this->arraystemmed, $katasatu);
						} else {
							array_push($this->arraystemmed, $katasatu);
							array_push($this->arraystemmed, $katadua);
						}
						continue;
					}
				}

				$term = $this->del_inf_suff($term);
				$cekterm = $this->cekterm($term);
				if ($cekterm == true) {
					array_push($this->arraystemmed, $term);
					continue;
				}

				$term = $this->del_der_suff($term);
				$cekterm = $this->cekterm($term);
				if ($cekterm == true) {
					array_push($this->arraystemmed, $term);
					continue;
				}

				$term = $this->del_der_pre($term);
				$cekterm = $this->cekterm($term);
				if ($cekterm == true) {
					array_push($this->arraystemmed, $term);
					continue;
				}

				//jika setelah dipotong semua awalan dan akhiran tetap tidak ada
				//maka kata awal dimasukkan ke array hasil stem
				array_push($this->arraystemmed, $kataawal);
			}
		}

		$hasilstemming = implode(" ", $this->arraystemmed);
		return $hasilstemming;
	}


	/*------------ALGORITMA NAZIEF ADRIANI------------*/

	//cek apakah term ada di tabel kata dasar
	public function cekterm($term)
	{
		if (in_array($term, $this->arraykatadasar)) {
			return true;
		} else {
			return false;
		}
	}

	//hilangkan inflection suffix ("-lah","-kah", "-ku", "-mu", atau "-nya")
	public function del_inf_suff($term)
	{
		$thisterm = $term;
		if (preg_match('/([km]u|nya|[kl]ah|pun)\z/i', $term)) {
			$__term = preg_replace('/([km]u|nya|[kl]ah|pun)\z/i', '', $term);
			if (preg_match('/([klt]ah|pun)\z/i', $term)) {
				if (preg_match('/([km]u|nya)\z/i', $__term)) {
					$__term__ = preg_replace('/([km]u|nya)\z/i', '', $__term);
					return $__term__;
				}
			}
			return $__term;
		}
		return $thisterm;
	}

	//cek kombinasi awalan dan akhiran yang dilarang
	public function cek_restr_presuff($term)
	{

		// be- dan -i
		if (preg_match('/^(be)[[:alpha:]]+(i)\z/i', $term)) {
			return true;
		}

		// di- dan -an
		if (preg_match('/^(di)[[:alpha:]]+(an)\z/i', $term)) {
			return true;
		}

		// ke- dan -i |-kan
		if (preg_match('/^(ke)[[:alpha:]]+(i|kan)\z/i', $term)) {
			return true;
		}

		// me- dan -an
		if (preg_match('/^(me)[[:alpha:]]+(an)\z/i', $term)) {
			return true;
		}

		// se- dan -i |-kan
		if (preg_match('/^(se)[[:alpha:]]+(i|kan)\z/i', $term)) {
			return true;
		}

		return false;
	}


	//hilangkan derivation suffix ("-i","-an" atau "-kan")
	public function del_der_suff($term)
	{
		$thisterm = $term;

		//hilangkan akhiran "an"|"i"
		if (preg_match('/(i|an)\z/i', $term)) {
			$__term = preg_replace('/(i|an)\z/i', '', $term);
			if ($this->cekterm($__term)) {
				return $__term;
			}
		}

		//hilangkan akhiran "-kan"
		if (preg_match('/(kan)\z/i', $term)) {
			$__term = preg_replace('/(kan)\z/i', '', $term);
			if ($this->cekterm($__term)) {
				return $__term;
			}
		}
		//jika ada kombinasi awalan dan akhiran yang dilarang, return kata awal
		if ($this->cek_restr_presuff($term)) {
			return $term;
		}
		return $thisterm;
	}

	//hilangkan derivation prefix
	public function del_der_pre($term)
	{
		$thisterm = $term;
		if (strlen($thisterm) >= 5) { //jumlah huruf minimal dari kata yang akan dipotong prefiksnya adalah 5 

			//jika "di-", "ke-" atau "se-"
			if (preg_match('/^(di|[ks]e)/', $term)) {
				$__term = preg_replace('/^(di|[ks]e)/', '', $term);
				if ($this->cekterm($__term)) {
					return $__term;
				}
				$__term__ = $this->del_der_suff($__term);
				if ($this->cekterm($__term__)) {
					return $__term__;
				}
			}

			//jika "diper-"
			if (preg_match('/^(diper)/', $term)) {
				$__term = preg_replace('/^(diper)/', '', $term);
				if ($this->cekterm($__term)) {
					return $__term;
				}
				$__term__ = $this->del_der_suff($__term);
				if ($this->cekterm($__term__)) {
					return $__term__;
				}
				//jika setelah "diper-" ada "r" luluh, ditambahkan "r" kembali di depan kata | diperingkas" -> "ringkas"
				$__term = preg_replace('/^(diper)/', 'r', $term);
				if ($this->cekterm($__term)) {
					return $__term;
				}
				$__term__ + $this->del_der_suff($__term);
				if ($this->cekterm($__term__)) {
					return $__term__;
				}
			}


			//awalan "be-" "me-", "pe-" atau "te-"
			if (preg_match('/^([btmp]e)/', $term)) {

				//awalan "be-"
				if (preg_match('/^(be)/', $term)) {

					//jika "ber-"
					if (preg_match('/^(ber)[aiueo]/', $term)) { //ATURAN 1 berV | ber-V
						$__term = preg_replace('/^(ber)/', '', $term);
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
						//jika setelah "ber-" ada "r"  luluh, ditambahkan "r" kembali di depan kata | "berakit" -> "rakit"
						$__term = preg_replace('/^(ber)/', 'r', $term); //ATURAN 1 berV.. > ber-V.. | be-rV..
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "ber-" diikuti huruf konsonan selain "r" dan huruf apa saja lalu partikel selain "er"
					if (preg_match('/^(ber)[^aiueor][a-z](?!er)/', $term)) {
						$__term = preg_replace('/^(ber)/', '', $term); //ATURAN 2 berCAP.. > ber-CAP.. di mana C!='r' & P!='er'
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "ber-" diikuti huruf selain "r" dan partikel "er" lalu huruf vokal
					if (preg_match('/^(ber)[^r][a-z]er[aiueo]/', $term)) {
						$__term = preg_replace('/^(ber)/', '', $term); //ATURAN 3 berCAerV.. | ber-CAerV.. di mana C!='r'
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "belajar"
					if (preg_match('/\b(belajar)\b/', $term)) {
						$__term = preg_replace('/^(bel)/', '', $term); //ATURAN 4 belajar > bel-ajar
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "ber-" diikuti huruf selain "r","l" dan partikel "er" lalu huruf konsonan
					if (preg_match('/^(be)[^rl]er[^aiueo]/', $term)) {
						$__term = preg_replace('/^(be)/', '', $term); //ATURAN 5 beC1erC2.. > be-C1erC2.. di mana C1!='r' | 'l'
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}
				}

				//awalan "te-"
				if (preg_match('/^(te)/', $term)) {

					//jika "ter-" diikuti huruf vokal
					if (preg_match('/^(ter)[aiueo]/', $term)) {
						$__term = preg_replace('/^(ter)/', '', $term); //ATURAN 6 terV.. > ter-V |te-rV
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
						//jika setelah "ter-" ada "r"  luluh, ditambahkan "r" kembali di depan kata | "terawat" -> "rawat"
						$__term = preg_replace('/^(ter)/', 'r', $term);
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "ter-" diikuti huruf konsonan selain "r" dan partikel "er" lalu huruf vokal
					if (preg_match('/^(ter)[^aiueor]er[aiueo]/', $term)) {
						$__term = preg_replace('/^(ter)/', '', $term); //ATURAN 7 terCerV.. > ter-CerV.. di mana C!='r'
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "ter-" diikuti huruf selain "r" dan partikel selain "er"
					if (preg_match('/^(ter)[^r](?!er)/', $term)) {
						$__term = preg_replace('/^(ter)/', '', $term); //ATURAN 8 terCP.. > ter-CP.. di mana C!='r' & P!='er'
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "te-" diikuti huruf konsonan selain "r" dan partikel "er" lalu huruf konsonan
					if (preg_match('/^(te)[^aiueor]er[^aiueo]/', $term)) {
						$__term = preg_replace('/^(te)/', '', $term); //ATURAN 9 teC1erC2.. > te-C1erC2.. di mana C!='r'
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "te-" diikuti huruf konsonan selain "r" dan partikel "er" lalu huruf konsonan
					if (preg_match('/^(te)[^aiueor]er[^aiueo]/', $term)) {
						$__term = preg_replace('/^(ter)/', '', $term); //ATURAN 34 terC1erC2.. > ter-C1erC2.. di mana C!='r'
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}
				}

				//awalan "me-"
				if (preg_match('/^(me)/', $term)) {

					//jika "me-" diikuti huruf "l","r","w","y" dan huruf vokal
					if (preg_match('/^(me)[lrwy][aiueo]/', $term)) {
						$__term = preg_replace('/^(me)/', '', $term); //ATURAN 10 me{l|r|w|y}V.. > me-{l|r|w|y}V..
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "mem-" diikuti huruf "b","f","v"
					if (preg_match('/^(mem)[bfv]/', $term)) {
						$__term = preg_replace('/^(mem)/', '', $term); //ATURAN 11 mem{b|f|v}.. > mem-{b|f|v}..
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "mempe-"
					if (preg_match('/^(mempe)[lr]/', $term)) {
						$__term = preg_replace('/^(mempe)[lr]/', '', $term); //ATURAN 12 mempe{l|r}.. > mempe{l|r}-..
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}

						//jika setelah "memper-" ada "r"  luluh, ditambahkan "r" kembali di depan kata | "memperumit" -> "rumit"
						$__term = preg_replace('/^(memper)/', 'r', $term);
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "mem-" diikuti oleh huruf vokal atau huruf "r"
					if (preg_match('/^(mem)[aiueor]/', $term)) {
						$__term = preg_replace('/^(me)/', '', $term); //ATURAN 13 mem{rV|V}.. > me-m{rV|V}.. | me-p{rV|V}..
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
						//jika setelah "mem-" ada "p"  luluh, ditambahkan "p" kembali di depan kata | "memutar" -> "putar"
						$__term = preg_replace('/^(mem)/', 'p', $term);
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					// jika "men-" diikuti huruf "c","j","d","z"
					if (preg_match('/^(men)[cdjsz]/', $term)) {
						$__term = preg_replace('/^(men)/', '', $term); //ATURAN 14 men{c|d|j|s|z}.. > men-{c|d|j|s|z}..
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "men-" diikuti oleh huruf vokal
					if (preg_match('/^(men)[aiueo]/', $term)) {
						$__term = preg_replace('/^(me)/', '', $term); //ATURAN 15 menV.. > me-nV | me-tV ..
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}

						//jika setelah "men-" ada "t"  luluh, ditambahkan "t" kembali di depan kata | "menarik" -> "tarik"
						$__term = preg_replace('/^(men)/', 't', $term);
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					// jika "meng-" diikuti huruf "g","h","q"
					if (preg_match('/^(meng)[ghq]/', $term)) {
						$__term = preg_replace('/^(meng)/', '', $term); //ATURAN 16 meng{g|h|q}.. > meng-{g|h|q}..
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					// jika "meng-" diikuti huruf vokal				
					if (preg_match('/^(meng)[aiueo]/', $term)) {
						$__term = preg_replace('/^(meng)/', '', $term); //ATURAN 17 mengV.. > meng-V.. |meng-kV..
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}

						//jika setelah "meng-" ada "k"  luluh, ditambahkan "k" kembali di depan kata | "mengikis" -> "kikis"
						$__term = preg_replace('/^(meng)/', 'k', $term);
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "meny-" diikuti huruf vokal
					if (preg_match('/^(meny)[aiueo]/', $term)) {
						$__term = preg_replace('/^(meny)/', 's', $term); //ATURAN 18 menyV.. > meny-sV..
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "memp-" diikuti huruf vokal apapun selain "e"
					if (preg_match('/^(memp)[aiuo]/', $term)) {
						$__term = preg_replace('/^(mem)/', '', $term); //ATURAN 19 mempA.. > mem-pA di mana A!='e'..
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}
				}

				//awalan "pe-"
				if (preg_match('/^(pe)/', $term)) {

					//jika "pe-" diikuti huruf "w","y" atau huruf vokal
					if (preg_match('/^(pe)[wy][aiueo]/', $term)) {
						$__term = preg_replace('/^(pe)/', '', $term); //ATURAN 20 pe{w|y|}V.. > pe-{w|y}V..
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "per-" diikuti huruf vokal
					if (preg_match('/^(per)[aiueo]/', $term)) {
						$__term = preg_replace('/^(per)/', '', $term); //ATURAN 21 perV.. > per-V | pe-rV..
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}

						//jika setelah "per-" ada "r"  luluh, ditambahkan "r" kembali di depan kata | "perantau" -> "rantau"
						$__term = preg_replace('/^(per)/', 'r', $term);
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "per-" diikuti huruf konsonan selain "r" dan huruf apapun lalu partikel selain "er"
					if (preg_match('/^(per)[^aiueor]+[a-z]+(?!er)/', $term)) {
						$__term = preg_replace('/^(per)/', '', $term); //ATURAN 22 perCAP.. > per-CAP di mana C!="r" & P!="er"
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "per-" diikuti huruf konsonan selain "r" dan huruf apapun lalu partikel selain "er"
					if (preg_match('/^(per)[^aiueor][a-z]er[aiueo]/', $term)) {
						$__term = preg_replace('/^(per)/', '', $term); //ATURAN 23 perCAerV.. > per-CAerV di mana C!="r"
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "pem-" diikuti "r"huruf vokal atau huruf vokal
					if (preg_match('/^pemr?[aiueo]/', $term)) {
						$__term = preg_replace('/^(pe)/', '', $term); //ATURAN 25 pem{rV|V}.. > pe-m{rV|V}.. | pe-p{rV|V}..
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}

						//jika setelah "pem-" ada "p"  luluh, ditambahkan "p" kembali di depan kata | "pemprakarsa" -> "prakarsa"
						$__term = preg_replace('/^(pem)/', 'p', $term);
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "pem-" diikuti huruf "b","v" atau huruf vokal
					if (preg_match('/^(pem)[bfaiueo]/', $term)) {
						$__term = preg_replace('/^(pem)/', '', $term); //ATURAN 24 pem{b|f|V}.. > pem-{b|f|V}..
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "pen-" diikuti huruf "c","d","j","z"
					if (preg_match('/^(pen)[cdjsz]/', $term)) {
						$__term = preg_replace('/^(pen)/', '', $term); //ATURAN 26 pen{c|d|j|z}.. > pen-{c|d|j|z}..
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "pen-" diikuti huruf vokal
					if (preg_match('/^(pen)[aiueo]/', $term)) {
						$__term = preg_replace('/^(pe)/', '', $term); //ATURAN 27 penV.. > pe-nV.. | pe-tV..
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}

						//jika setelah "pen-" ada "t"  luluh, ditambahkan "t" kembali di depan kata | "penonton" -> "tonton"
						$__term = preg_replace('/^(pen)/', 't', $term);
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "peng-" diikuti huruf konsonan
					if (preg_match('/^(peng)[^aiueo]/', $term)) {
						$__term = preg_replace('/^(peng)/', '', $term); //ATURAN 28 pengC.. > peng-C..
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "peng-" diikuti huruf vokal
					if (preg_match('/^(peng)[aiueo]/', $term)) {
						if (preg_match('/^(peng)[e]/', $term)) {
							$__term = preg_replace('/^(penge)/', '', $term);
							if ($this->cekterm($__term)) {
								return $__term;
							}
							$__term__ = $this->del_der_suff($__term);
							if ($this->cekterm($__term__)) {
								return $__term__;
							}
						}
						$__term = preg_replace('/^(peng)/', '', $term);  //ATURAN 29 pengV.. > peng-V.. | peng-kV.. | pengV- jika V="e"
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}

						//jika setelah "peng-" ada "k"  luluh, ditambahkan "k" kembali di depan kata | "pengawal" -> "kawal"
						$__term = preg_replace('/^(peng)/', 'k', $term);
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "peny-" diikuti huruf vokal
					if (preg_match('/^(peny)[aiueo]/', $term)) {
						$__term = preg_replace('/^(peny)/', 's', $term); //ATURAN 30 penyV.. > peny-sV..
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "pel-" diikuti huruf vokal & jika "pelajar"
					if (preg_match('/^(pel)[aiueo]/', $term)) {
						if (preg_match('/\b(pelajar)\b/', $term)) {
							$__term = preg_replace('/^(pel)/', '', $term); //ATURAN 31 pelV.. > pe-lV.. kecuali pelajar > pel-ajar
							if ($this->cekterm($__term)) {
								return $__term;
							}
							$__term__ = $this->del_der_suff($__term);
							if ($this->cekterm($__term__)) {
								return $__term__;
							}
						}

						$__term = preg_replace('/^(pe)/', '', $term);
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "pe-" diikuti konsonan selain "r","w","y","l","m","n" dan partikel "er" lalu huruf vokal
					if (preg_match('/^(pe)[^aiueorwylmn]er[aiueo]/', $term)) {
						$__term = preg_replace('/^(per)/', '', $term); //ATURAN 32 peCerV.. > per-erV.. di mana C!= {r|w|y|l|m|n}
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "pe-" diikuti konsonan selain "r","w","y","l","m","n" dan partikel selain "er"
					if (preg_match('/^(pe)[^aiueorwylmn](?!er)/', $term)) {
						$__term = preg_replace('/^(pe)/', '', $term); //ATURAN 33 peCP.. > pe-CP.. di mana P!= "er"
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}

					//jika "pe-" diikuti konsonan selain "r","w","y","l","m","n" dan partikel selain "er"
					if (preg_match('/^(pe)[^aiueorwylmn]er[^aiueo]/', $term)) {
						$__term = preg_replace('/^(pe)/', '', $term); //ATURAN 35 peC1erC2.. > pe-CP.. di mana C1!= {r|w|y|l|m|n}
						if ($this->cekterm($__term)) {
							return $__term;
						}
						$__term__ = $this->del_der_suff($__term);
						if ($this->cekterm($__term__)) {
							return $__term__;
						}
					}
				}
			}
			//cek ada tidaknya awalan di-, ke-, se-, te-, be-, me- atau pe-
			if (preg_match('/^(di|[kstbmp]e)/', $term) == false) {
				return $term;
			}
		}

		return $thisterm;
	}

	//aturan tambahan untuk kata ulang
	public function cek_reduplikasi($kata)
	{
		$term = $this->del_inf_suff($kata);
		$cekterm = $this->cekterm($term);
		if ($cekterm == true) {
			return $term;
		}

		$term = $this->del_der_suff($term);
		$cekterm = $this->cekterm($term);
		if ($cekterm == true) {
			return $term;
		}

		$term = $this->del_der_pre($term);
		$cekterm = $this->cekterm($term);
		if ($cekterm == true) {
			return $term;
		}
		return $kata;
	}
	public function detailUjian($id_ujian, $id_siswa = null)
	{
		$this->load->library('naivebayes');
		// untuk sidebar
		if ($this->session->userdata('level') == 'guru') {
			$id_user = $this->session->userdata('id_user');
			$kode_ta = $this->TahunAjaran_Model->tahunAjaranAktif;
			$data['menu_mapels'] = $this->PenugasanGuru_Model->getViewData_by(['id_user' => $id_user, 'kode_ta' => $kode_ta])->result();
		}
		// /sidebar

		if ($this->session->userdata('level') == 'siswa') {
			$id_siswa = $this->session->userdata('id_siswa');
		}
		$data['ujiansiswa'] = $this->UjianSiswa_Model->getData(['id_ujian' => $id_ujian, 'a_ujian_siswa.id_siswa' => $id_siswa])->row();
		// print_r($data['ujiansiswa']);
		$data['ujian'] = $this->db->get_where('v_penugasanujian', ['id_ujian' => $id_ujian])->row();
		$data['soal'] = $this->db->select('a_soalkunci.*,a_jawabansiswa.*,a_pre_jawabansiswa.token as token_siswa,a_pre_jawabansiswa.filter as filter_siswa,a_pre_jawabansiswa.stem as stem_siswa,a_pre_soalkunci.token as token_guru,a_pre_soalkunci.filter as filter_guru,a_pre_soalkunci.stem as stem_guru, a_pre_soalkunci.jumlah_kata')
			->from('a_jawabansiswa')
			->join('a_soalkunci', 'a_soalkunci.id_soal=a_jawabansiswa.id_soal')
			->join('a_pre_jawabansiswa', 'a_jawabansiswa.id_jawaban_siswa=a_pre_jawabansiswa.id_jawaban_siswa')
			->join('a_pre_soalkunci', 'a_soalkunci.id_soal=a_pre_soalkunci.id_soal')
			->where(['a_jawabansiswa.id_ujian_siswa' => $data['ujiansiswa']->id_ujian_siswa])->get()->result();


		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('soalkunci/detailUjian');
		$this->load->view('templates/footer');
	}

	public function list_soal($id_ujian)
	{
		$data['nama_ujian'] = $this->db->get_where('v_penugasanujian', ['id_ujian' => $id_ujian])->row();
		$data['soalkunci'] = $this->SoalKunci_Model->getAllData($id_ujian);
		// untuk sidebar
		if ($this->session->userdata('level') == 'guru') {
			$id_user = $this->session->userdata('id_user');
			$kode_ta = $this->TahunAjaran_Model->tahunAjaranAktif;
			$data['menu_mapels'] = $this->PenugasanGuru_Model->getViewData_by(['id_user' => $id_user, 'kode_ta' => $kode_ta])->result();
		}
		// /sidebar
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('soalkunci/listsoal');
		$this->load->view('templates/footer');
	}
}
