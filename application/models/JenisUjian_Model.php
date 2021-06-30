<?php

/**
 * 
 */
class JenisUjian_Model extends CI_Model
{
	public function getAllData()
	{
		return $this->db->get('a_jenisujian')->result();
	}

	public function tambah_data()
	{
		$data = array(
			'kode_jenis' => $this->input->post('kode_jenis', true),
			'nama_jenis' => $this->input->post('nama_jenis', true)
		);

		$this->db->insert('a_jenisujian', $data);
	}

	public function ubah_data()
	{
		$data = array(
			'nama_jenis' => $this->input->post('nama_jenis', true)
		);
		$this->db->where('kode_jenis', $this->input->post('kode_jenis', true));
		$this->db->update('a_jenisujian', $data);
	}

	public function hapus_data($kode)
	{
		$this->db->delete('a_jenisujian', ['kode_jenis' => $kode]);
	}

	public function detail_data($kode)
	{
		return $this->db->get_where('a_jenisujian', ['kode_jenis' => $kode])->row_array();
	}

	public function checkForeign($id)
	{
		$where = ['kode_jenis' => $id];
		$query = $this->db->get_where('a_kelas', $where);
		if ($query->num_rows() >= 1) {
			return true;
		}
		return false;
	}
}
