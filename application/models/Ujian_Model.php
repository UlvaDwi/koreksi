<?php

/**
 * 
 */
class Ujian_Model extends CI_Model
{
	public function getAllData($id_tugas = null)
	{
		$this->db->select('id_ujian, a_tugasguru.id_tugas, nama_ujian');
		$this->db->from('a_ujian');
		$this->db->join('a_tugasguru', 'a_tugasguru.id_tugas = a_ujian.id_tugas');
		if ($id_tugas != null) {
			$this->db->where('a_ujian.id_tugas', $id_tugas);
		}
		return $this->db->get()->result();
	}

	// public function getAllDatabyKelas($kode_kelas = null)
	// {
	// 	$this->db->select('kode_kelas, kelas, a_jurusan.nama_jurusan, nama_kelas');
	// 	$this->db->from('a_kelas');
	// 	$this->db->join('a_jurusan', 'a_jurusan.kode_jurusan = a_kelas.kode_jurusan');
	// 	if ($kode_kelas != null) {
	// 		$this->db->where('a_kelas.kode_kelas', $kode_kelas);
	// 	}
	// 	return $this->db->get()->result();
	// }

	public function getAllData_jurusan()
	{
		return $this->db->get('a_tugasguru')->result();
	}

	public function tambah_data()
	{
		$data = array(
			'id_ujian' => $this->input->post('id_ujian'),
			'id_tugas' => $this->input->post('id_tugas'),
			'nama_ujian' => $this->input->post('nama_ujian')
		);
		$this->db->insert('a_ujian', $data);
	}
	public function ubah_data()
	{
		$data = array(
			'id_ujian' => $this->input->post('id_ujian'),
			'id_tugas' => $this->input->post('id_tugas'),
			'nama_ujian' => $this->input->post('nama_ujian')
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
