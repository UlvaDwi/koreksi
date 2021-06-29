<?php

/**
 * 
 */
class SoalKunci_Model extends CI_Model
{
	public function getAllData()
	{
		return $this->db->get('a_soalkunci')->result();
	}

	public function tambah_data($id)
	{

		$data = array(
			'id_soal' => $id,
			'id_mapel_ujian' => $this->input->post('id_mapel_ujian', true),
			'soal' => $this->input->post('soal', true),
			'kunci_jawaban' => $this->input->post('kunci_jawaban', true),
			'skor_soal' => $this->input->post('skor_soal', true)
		);

		$this->db->insert('a_soalkunci', $data);
	}

	public function ubah_data()
	{
		$data = array(
			'id_mapel_ujian' => $this->input->post('id_mapel_ujian', true),
			'soal' => $this->input->post('soal', true),
			'kunci_jawaban' => $this->input->post('kunci_jawaban', true),
			'skor_soal' => $this->input->post('skor_soal', true)
		);
		$this->db->where('id_soal', $this->input->post('id_soal', true));
		$this->db->update('a_soalkunci', $data);
	}

	public function hapus_data($kode)
	{
		$this->db->delete('a_soalkunci', ['id_soal' => $kode]);
	}

	public function detail_data($kode)
	{
		return $this->db->get_where('a_soalkunci', ['id_soal' => $kode])->row_array();
	}
}
