<?php

/**
 * 
 */
class HistoriKelas_Model extends CI_Model
{
	public function siswaNaikKelas($kelas, $jurusan, $tahun_ajaran)
	{
		if ($kelas == 'baru') {
			$this->db->select('a_siswa.id_siswa, a_siswa.nama_siswa');
			$this->db->from('a_siswa');
			$this->db->where('kode_jurusan', $jurusan);
			$this->db->where('v_histori.id_siswa', null);
			$query = $this->db->join('v_histori', 'a_siswa.id_siswa = v_histori.id_siswa', 'left')->get()->result();
		} else {
			$this->db->select('a_siswa.id_siswa, a_siswa.nama_siswa');
			$this->db->from('a_siswa');
			/* 
				*note : id tahun ajaran harus urut, kalau tidak maka tidak akan muncul id tahun ajaran sebelumnya
			*/
			// akan mengecek data tahun sebelumnya
			$this->db->or_where('v_histori.kode_ta', ($tahun_ajaran - 1));
			// kalaupun tidak ada, maka akan dicarikan siswa tingkat bawah yang sejurusan
			$this->db->like('v_histori.kode_kelas', "$kelas" . "_" . $jurusan);
			$this->db->where('v_histori.id_siswa', null);
			$query = $this->db->join('v_histori', 'a_siswa.id_siswa = v_histori.id_siswa', 'left')->get()->result();
		}
		if ($query) {
			return ['status' => 'success', 'result' => $query];
		} else {
			return ['status' => 'failed', 'result' => $this->db->error()];
		}
	}

	public function tambah_data($id_siswa, $id_kelas, $id_ta)
	{
		$data = array(
			'kode_kelas' => $id_kelas,
			'id_siswa' => $id_siswa,
			'kode_ta' => $id_ta
		);
		$this->db->insert('a_histori_kelas', $data);
	}

	public function hapus_data($kd)
	{
		$this->db->delete('a_histori_kelas', ['id_histori' => $kd]);
	}
}
