<?php

/**
 * 
 */
class Ujian_Model extends CI_Model
{
	public function getData(array $where = [])
	{
		// if (!empty($where)) {
		// 	$this->db->where($where);
		// }
		return $this->db->get_where('a_ujian', $where);
	}
	// public function getAllData()
	// {
	// 	$this->db->select('id_ujian, a_jenisujian.kode_jenis, nama_jenis, a_tugasguru.id_tugas');
	// 	$this->db->from('a_ujian');
	// 	$this->db->join('a_jenisujian', 'a_jenisujian.kode_jenis = a_ujian.kode_jenis');
	// 	$this->db->join('a_tugasguru', 'a_tugasguru.id_tugas = a_ujian.id_tugas');

	// 	return $this->db->get()->result();
	// }


	public function tambah_data()
	{
		// foreach ($this->input->post('chkjenis') as $valueKls) {
		$data = [
			'id_tugas' => $this->input->post('id_tugas'),
			'kode_jenis' => $this->input->post('kode_jenis'),
			'tgl_pelaksanaan' => $this->input->post('tgl_pelaksanaan'),
			'tgl_selesai' => $this->input->post('tgl_selesai'),
			'durasi' => $this->input->post('durasi')
		];
		$this->db->insert('a_ujian', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
		// }
	}
	public function ubah_data()
	{
		$data = array(
			'id_ujian' => $this->input->post('id_ujian'),
			'id_tugas' => $this->input->post('id_tugas'),
			'kode_jenis' => $this->input->post('kode_jenis'),
			'tgl_pelaksanaan' => $this->input->post('tgl_pelaksanaan'),
			'tgl_selesai' => $this->input->post('tgl_selesai'),
			'durasi' => $this->input->post('durasi')
		);
		$this->db->where('id_ujian', $this->input->post('id_ujian', true));
		$this->db->update('a_ujian', $data);
	}

	public function hapus_data($kd)
	{
		$this->db->delete('a_ujian', ['id_ujian' => $kd]);
	}

	public function detail_data($kd)
	{
		return $this->db->get_where('a_ujian', ['id_ujian' => $kd])->row_array();
	}
}
