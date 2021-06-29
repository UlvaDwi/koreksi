<?php

/**
 * 
 */
class Kelas_Model extends CI_Model
{
	public function getAllData($kode_jurusan = null)
	{
		$this->db->select('kode_kelas, kelas, a_jurusan.nama_jurusan, nama_kelas, a_kelas.kode_jurusan');
		$this->db->from('a_kelas');
		$this->db->join('a_jurusan', 'a_jurusan.kode_jurusan = a_kelas.kode_jurusan');
		if ($kode_jurusan != null) {
			$this->db->where('a_kelas.kode_jurusan', $kode_jurusan);
		}
		return $this->db->get()->result();
	}

	public function getAllDatabyKelas($kode_kelas = null)
	{
		$this->db->select('kode_kelas, kelas, a_jurusan.nama_jurusan, nama_kelas');
		$this->db->from('a_kelas');
		$this->db->join('a_jurusan', 'a_jurusan.kode_jurusan = a_kelas.kode_jurusan');
		if ($kode_kelas != null) {
			$this->db->where('a_kelas.kode_kelas', $kode_kelas);
		}
		return $this->db->get()->result();
	}

	public function getAllData_jurusan()
	{
		return $this->db->get('a_jurusan')->result();
	}

	public function tambah_data()
	{
		$data = array(
			'kode_kelas' => $this->input->post('kelas') . "_" . $this->input->post('kd_jur') . "_" . $this->input->post('nm_kelas'),
			'kelas' => $this->input->post('kelas'),
			'kode_jurusan' => $this->input->post('kd_jur'),
			'nama_kelas' => $this->input->post('nm_kelas')
		);
		$this->db->insert('a_kelas', $data);
	}
	public function ubah_data()
	{
		$data = array(
			'kode_kelas' => $this->input->post('kelas') . "_" . $this->input->post('kd_jur') . "_" . $this->input->post('nm_kelas'),
			'kelas' => $this->input->post('kelas'),
			'kode_jurusan' => $this->input->post('kd_jur'),
			'nama_kelas' => $this->input->post('nm_kelas')
		);
		$this->db->where('kode_kelas', $this->input->post('kd_kelas', true));
		$this->db->update('a_kelas', $data);
	}

	public function hapus_data($kd)
	{
		$this->db->delete('a_kelas', ['kode_kelas' => $kd]);
	}

	public function detail_data($kd)
	{
		return $this->db->get_where('a_kelas', ['kode_kelas' => $kd])->row_array();
	}
}
