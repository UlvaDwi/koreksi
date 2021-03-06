<?php

/**
 * 
 */
class Siswa_Model extends CI_Model
{
	public function getAllData()
	{
		return $this->db->get('a_siswa')->result();
	}

	public function getSiswa($id_kelas, $id_ta)
	{
		return $this->db->get_where('v_histori', ['kode_kelas' => $id_kelas, 'kode_ta' => $id_ta])->result();
	}

	public function tambah_data()
	{
		$data = array(
			'id_siswa' => $this->input->post('id_siswa', true),
			'nama_siswa' => $this->input->post('nama_siswa', true),
			'kode_jurusan' => $this->input->post('kode_jurusan', true),
			'username' => $this->input->post('username', true),
			'password' => $this->input->post('password', true)
		);

		$this->db->insert('a_siswa', $data);
	}

	public function ubah_data()
	{
		$data = array(
			'nama_siswa' => $this->input->post('nama_siswa', true),
			'kode_jurusan' => $this->input->post('kode_jurusan', true),
			'username' => $this->input->post('username', true),
			'password' => $this->input->post('password', true)
		);
		$this->db->where('id_siswa', $this->input->post('id_siswa', true));
		$this->db->update('a_siswa', $data);
	}
	public function validation($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$query = $this->db->get('a_siswa');
		if ($query->num_rows() >= 1) {
			return $query->row();
		}
		return false;
	}

	public function hapus_data($kode)
	{
		$this->db->delete('a_siswa', ['id_siswa' => $kode]);
	}

	public function detail_data($kode)
	{
		return $this->db->get_where('a_siswa', ['id_siswa' => $kode])->row_array();
	}

	public function checkForeign($id)
	{
		$where = ['id_siswa' => $id];
		$query1 = $this->db->get_where('a_siswa', $where);
		$query2 = $this->db->get_where('a_kelas', $where);
		if ($query1->num_rows() >= 1 || $query2->num_rows() >= 1) {
			return true;
		}
		return false;
	}
}
