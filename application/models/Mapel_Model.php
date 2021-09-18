<?php

use Svg\Tag\Group;

/**

 * 

 */

class Mapel_Model extends CI_Model

{

	public function getAllData()
	{
		return $this->db->get('a_mapel')->result();
	}

	public function getMapel()

	{
		return $this->db->query("SELECT * FROM `mapel` inner join kelas on (mapel.kelas = kelas.kelas && mapel.id_jurusan = kelas.id_jurusan) ORDER BY `mapel`.`id_mapel` ASC ")->result();
	}


	public function getDashboard($id_guru, $kode_ta)
	{
		$query = " SELECT
		a_tugasguru.id_tugas ,
		a_guru.id_user,
		a_guru.nama_guru, 
		a_mapel.id_mapel,
		a_mapel.nama_mapel, 
		a_kelas.kode_kelas,
		a_tahun_ajaran.kode_ta, 
		a_tahun_ajaran.tahun_ajaran
	FROM

						a_guru
					JOIN a_tugasguru ON
					
							a_guru.id_user = a_tugasguru.id_user
						
					
				JOIN a_mapel ON
					
						a_mapel.id_mapel = a_tugasguru.id_mapel
					
				
			JOIN a_kelas ON
				
					a_kelas.kode_kelas = a_tugasguru.kode_kelas
				
			
		JOIN a_tahun_ajaran ON
			
				a_tahun_ajaran.kode_ta = a_tugasguru.kode_ta WHERE a_guru.id_user= $id_guru && a_tahun_ajaran.kode_ta=$kode_ta
			
		";
		return $this->db->query($query)->result_array();
	}

	public function listDataMapel()

	{

		$this->db->group_by('id_mapel');

		$this->db->order_by('id_mapel', 'ASC');

		return $this->db->get('mapel')->result();
	}

	public function getAllData_jurusan()
	{
		return $this->db->get('jurusan')->result();
	}
	public function tambah_data()

	{

		$data = array(
			'id_mapel' => $this->input->post('id_mapel', true),
			'nama_mapel' => $this->input->post('nama_mapel', true)
		);

		$this->db->insert('a_mapel', $data);
	}



	public function getMapelbyKodeMapel($id_mapel)

	{

		return $this->db->get_where('a_mapel', ['id_mapel' => $id_mapel])->row('nama_mapel');
	}

	public function deleteData($id)
	{
		$this->db->where('id_mapel', $id);
		$this->db->delete('a_mapel');
	}


	public function ubah_data()

	{

		$data = array(
			'nama_mapel' => $this->input->post('nama_mapel', true)
		);
		$this->db->where('id_mapel', $this->input->post('id_mapel', true));
		$this->db->update('a_mapel', $data);
	}

	public function detail_data($id)
	{

		return $this->db->get_where('a_mapel', ['id_mapel' => $id])->row_array();
	}
}
