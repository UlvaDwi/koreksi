<?php

/**
 * 
 */
class PenugasanGuru_Model extends CI_Model
{
	public function getAllDataJoin()
	{
		$this->db->select('id_tugas, a_guru.id_user, a_mapel.id_mapel, a_kelas.kode_kelas');
		$this->db->from('a_tugasguru');
		$this->db->join('a_guru', 'a_guru.id_user = a_tugasguru.id_user');
		$this->db->join('a_mapel', 'a_mapel.id_mapel = a_tugasguru.id_mapel');
		$this->db->join('a_kelas', 'a_kelas.kode_kelas = a_tugasguru.kode_kelas');
		return $this->db->get()->result();
	}



	public function getDatatugasByidGuru($id_user, $kode_kelas)
	{
		$this->db->select('*, guru.code_color');
		$this->db->from('a_tugasguru');
		$this->db->join('mapel', 'a_tugasguru.id_mapel = mapel.id_mapel');
		$this->db->join('guru', 'guru.id_user = a_tugasguru.id_user');
		$this->db->where('a_tugasguru.id_user', $id_user);
		$this->db->where('a_tugasguru.kode_kelas', $kode_kelas);

		return $this->db->get()->result();
	}



	public function getAllData()
	{
		return $this->db->get('a_tugasguru')->result();
	}

	public function getAllDataBykode_kelas($kode_kelas)
	{
		return $this->db->query("SELECT  a_mapel.nama_mapel from a_tugasguru left join a_mapel on a_tugasguru.id_mapel = a_mapel.id_mapel where a_tugasguru.kode_kelas= '" . $kode_kelas . "' GROUP by id_tugas")->result();
	}



	public function tambah_data()
	{

		echo $jumlah = count($this->input->post('guru'));
		$kode_kelas = $this->input->post('kode_kelas');
		$id_mapel = $this->input->post('id_mapel');
		$id_user = $this->input->post('guru');
		print_r($id_user);
		echo '<br>';
		for ($i = 0; $i < $jumlah; $i++) {
			if ($id_user[$i] != 'Pilih Guru') {
				$data = array(
					'id_tugas' => $id_user[$i] . '-' . $id_mapel[$i] . '-' . $kode_kelas[$i],
					'id_user' => $id_user[$i],
					'id_mapel' => $id_mapel[$i],
					'kode_kelas' => $kode_kelas[$i]
				);
				print_r($data);
				echo '<br>';
				$this->db->insert('a_tugasguru', $data);
			}
		}
	}

	public function ubah_data()
	{
		$data = array(
			'id_user' => $this->input->post('id_gur', true),
			'id_mapel' => $this->input->post('id_map', true),
			'kode_kelas' => $this->input->post('id_kls', true)
		);
		$this->db->where('id_tugas', $this->input->post('id_pen', true));
		$this->db->update('a_tugasguru', $data);
	}

	public function hapus_data($id)
	{
		$this->db->delete('a_tugasguru', ['id_tugas' => $id]);
	}

	public function detail_data($id, $id_ta)
	{
		$this->db->join('a_mapel', 'a_tugasguru.id_mapel = a_mapel.id_mapel');
		return $this->db->get_where('a_tugasguru', ['id_tugas' => $id, 'a_tugasguru.id_ta' => $id_ta])->row_array();
	}

	public function dataKelasByKodeMapel($id_mapel)
	{
		return $this->db->query("SELECT a_mapel.*, a_kelas.*, a_tugasguru.id_tugas, a_tugasguru.id_user  FROM `a_mapel` INNER join a_kelas on (a_mapel.kelas = a_kelas.kelas && a_mapel.kode_jurusan = a_kelas.kode_jurusan)  LEFT JOIN a_tugasguru on (a_kelas.kode_kelas = a_tugasguru.kode_kelas && a_mapel.id_mapel = a_tugasguru.id_mapel) WHERE a_mapel.nama_mapel = '$id_mapel'   ORDER BY `a_kelas`.`kode_jurusan` ASC, `a_kelas`.`kelas` ASC, `a_kelas`.`nama_kelas` ASC")->result();
	}


	public function listDataMapelyangKosong()
	{
		return $this->db->query("SELECT a_mapel.id_mapel, a_mapel.nama_mapel, sum(case when a_tugasguru.id_tugas IS NULL then 1 else 0 end) AS jumlah_kosong FROM `a_mapel` INNER join a_kelas on (a_mapel.kelas = a_kelas.kelas && a_mapel.kode_jurusan = a_kelas.kode_jurusan) LEFT JOIN a_tugasguru on (a_kelas.kode_kelas = a_tugasguru.kode_kelas && a_mapel.id_mapel = a_tugasguru.id_mapel) GROUP by nama_mapel ORDER BY a_mapel.nama_mapel ASC")->result();
	}

	public function hapusDosa()
	{
		return $this->db->query("SELECT * FROM `a_tugasguru` LEFT JOIN a_mapel ON a_tugasguru.id_mapel = a_mapel.id_mapel ORDER BY `a_mapel`.`id_mapel` ASC ")->result();
	}

	public function DataKelasYgDiajarGuru($id_user)
	{
		return $this->db->query("SELECT * FROM `a_tugasguru` WHERE id_user='$id_user' GROUP BY kode_kelas")->result();
	}
}
