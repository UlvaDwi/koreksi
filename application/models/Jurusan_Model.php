<?php

/**
 * 
 */
class Jurusan_Model extends CI_Model
{
	public function getAllData()
	{
		return $this->db->get('a_jurusan')->result();
	}

	public function tambah_data()
	{
		$data = array(
			'kode_jurusan' => $this->input->post('kode_jurusan', true),
			'nama_jurusan' => $this->input->post('nama_jurusan', true)
		);

		$this->db->insert('a_jurusan', $data);
	}

	public function ubah_data()
	{
		$data = array(
			'nama_jurusan' => $this->input->post('nama_jurusan', true)
		);
		$this->db->where('kode_jurusan', $this->input->post('kode_jurusan', true));
		$this->db->update('a_jurusan', $data);
	}

	public function hapus_data($kode)
	{
		$this->db->delete('a_jurusan', ['kode_jurusan' => $kode]);
	}

	public function detail_data($kode)
	{
		return $this->db->get_where('a_jurusan', ['kode_jurusan' => $kode])->row_array();
	}

	public function checkForeign($id)
	{
		$where = ['kode_jurusan' => $id];
		$query = $this->db->get_where('a_kelas', $where);
		if ($query->num_rows() >= 1) {
			return true;
		}
		return false;
	}
}
