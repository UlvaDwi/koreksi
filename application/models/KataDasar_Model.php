<?php

/**
 * 
 */
class KataDasar_Model extends CI_Model
{
	public function getAllData()
	{
		return $this->db->get('a_katadasar')->result();
	}

	public function tambah_data()
	{
		$data = array(
			'id_katadasar' => $this->input->post('id_katadasar', true),
			'kata_katadasar' => $this->input->post('kata_katadasar', true)
		);

		$this->db->insert('a_katadasar', $data);
	}

	public function ubah_data()
	{
		$data = array(
			'kata_katadasar' => $this->input->post('kata_katadasar', true)
		);
		$this->db->where('id_katadasar', $this->input->post('id_katadasar', true));
		$this->db->update('a_katadasar', $data);
	}

	public function hapus_data($kode)
	{
		$this->db->delete('a_katadasar', ['id_katadasar' => $kode]);
	}

	public function detail_data($kode)
	{
		return $this->db->get_where('a_katadasar', ['id_katadasar' => $kode])->row_array();
	}
}
