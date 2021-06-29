<?php

/**
 * 
 */
class Stopwords_Model extends CI_Model
{
	public function getAllData()
	{
		return $this->db->get('a_stopwords')->result();
	}

	public function tambah_data()
	{
		$data = array(
			'id_stopwords' => $this->input->post('id_stopwords', true),
			'kata_stopwords' => $this->input->post('kata_stopwords', true)
		);

		$this->db->insert('a_stopwords', $data);
	}

	public function ubah_data()
	{
		$data = array(
			'kata_stopwords' => $this->input->post('kata_stopwords', true)
		);
		$this->db->where('id_stopwords', $this->input->post('id_stopwords', true));
		$this->db->update('a_stopwords', $data);
	}

	public function hapus_data($kode)
	{
		$this->db->delete('a_stopwords', ['id_stopwords' => $kode]);
	}

	public function detail_data($kode)
	{
		return $this->db->get_where('a_stopwords', ['id_stopwords' => $kode])->row_array();
	}
}
