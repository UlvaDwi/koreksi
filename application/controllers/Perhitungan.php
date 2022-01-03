<?php

/**
 * 
 */
class Perhitungan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('naivebayes');
		$this->load->model('SoalKunci_Model');
		$this->load->model('JawabanSiswa_Model');
		$this->load->model('Tfidf_Model');
		$this->load->model('UjianSiswa_Model');
	}

	public function cekJawaban($id_ujian)
	{
	}

	function index($id_ujian)
	{
		// $soal = $this->SoalKunci_Model->getData(['id_ujian' => $id])->result();
		$soalKunci = $this->db->select('a_soalkunci.id_soal,id_ujian,soal,kunci_jawaban,skor_soal,id_pre_soalkunci,stem,jumlah_kata')
			->from('a_soalkunci')
			->join('a_pre_soalkunci', 'a_soalkunci.id_soal = a_pre_soalkunci.id_soal')
			->where('a_soalkunci.id_ujian', $id_ujian)
			->get()->result();
		foreach ($soalKunci as $dataSoalKunci) {
			$dataSoalKunci->preprocessing = $this->Tfidf_Model->getDataBy(['id_soal' => $dataSoalKunci->id_soal])->result();
			$jawabanSiswa = $this->JawabanSiswa_Model->getDataBy(['id_soal' => $dataSoalKunci->id_soal])->result();
			foreach ($jawabanSiswa as $dataJawabanSiswa) {
				$dataJawabanSiswa->preprocessing = $this->Tfidf_Model->getDataSiswaBy(['id_jawaban_siswa' => $dataJawabanSiswa->id_jawaban_siswa])->result();
			}
			$dataSoalKunci->jawabansiswa = $jawabanSiswa;
		}
		$hasil = $this->naivebayes->hitung($soalKunci);

		$this->updateSkorJawaban($hasil);
		$nilaiAkhir = $this->db->query("SELECT a_ujian.id_ujian,a_ujian.id_tugas,a_ujian_siswa.id_ujian_siswa, SUM(skor_siswa) as totalakhir from a_jawabansiswa 
		INNER JOIN a_ujian_siswa on a_jawabansiswa.id_ujian_siswa = a_ujian_siswa.id_ujian_siswa 
		INNER JOIN a_ujian on a_ujian.id_ujian = a_ujian_siswa.id_ujian 
		WHERE a_ujian.id_ujian = $id_ujian GROUP BY a_ujian_siswa.id_ujian_siswa")->result();
		$this->updateNilaiAkhir($nilaiAkhir);
		return redirect(base_url('DataSoalKunci/jenis/' . $nilaiAkhir[0]->id_tugas));
	}

	public function updateSkorJawaban($hasil)
	{
		foreach ($hasil as $value) {
			$this->db->where('id_jawaban_siswa', $value['id_jawaban_siswa']);
			$this->db->update('a_jawabansiswa', ['skor_siswa' => $value['hasil_akhir']]);
		}
	}

	public function updateNilaiAkhir($nilaiAkhir)
	{
		foreach ($nilaiAkhir as $value) {
			$this->db->where('id_ujian_siswa', $value->id_ujian_siswa);
			$this->db->update('a_ujian_siswa', ['nilai' => $value->totalakhir]);
		}
	}
}
