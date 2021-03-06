<?php
class UjianSiswa_Model extends CI_Model
{
	public function getData(array $where = [])
	{
		$this->db->order_by('nama_siswa', 'asc');
		$this->db->join('a_siswa', 'a_siswa.id_siswa =  a_ujian_siswa.id_siswa');
		return $this->db->get_where('a_ujian_siswa', $where);
	}

	public function store(array $data)
	{
		$this->db->insert('a_ujian_siswa', $data);
	}

	public function destroy(array $where)
	{
		$this->db->where($where);
		$this->db->delete('a_ujian_siswa');
	}

	public function update(array $where, $data)
	{
		$this->db->update('a_ujian_siswa', $data, $where);
	}
}
