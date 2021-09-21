<?php

/**
 * 
 */
class JawabanSiswa_Model extends CI_Model
{
	public function getAllData()
	{
		return $this->db->get('a_jawabansiswa')->result();
	}

	public function getDataBy(array $where)
	{
		return $this->db->get_where('a_jawabansiswa', $where);
	}

	// update/insert
	public function upsert(array $data)
	{
		$where = [
			'id_soal' => $data['id_soal'],
			'id_ujian_siswa' => $data['id_ujian_siswa']
		];
		$jawaban = $this->getDataBy($where)->row();
		if (empty($jawaban)) {
			$this->db->insert('a_jawabansiswa', $data);
		} else {
			$this->db->update('a_jawabansiswa', [
				'jawaban' => $data['jawaban']
			], $where);
		}
	}

	public function tambah_data()
	{
		# code...
	}

	public function ubah_data()
	{
		$data = array(
			'id_ujian_siswa' => $this->input->post('id_ujian_siswa', true),
			'id_soal' => $this->input->post('id_soal', true),
			'jawaban' => $this->input->post('jawaban', true),
			'skor_Siswa' => $this->input->post('skor_siswa', true)
		);
		$this->db->where('id_jawaban_siswa', $this->input->post('id_jawaban_siswa', true));
		$this->db->update('a_jawabansiswa', $data);
	}

	public function hapus_data($kode)
	{
		$this->db->delete('a_jawabansiswa', ['id_jawaban_siswa' => $kode]);
	}

	public function detail_data($kode)
	{
		return $this->db->get_where('a_jawabansiswa', ['id_jawaban_siswa' => $kode])->row_array();
	}
}
