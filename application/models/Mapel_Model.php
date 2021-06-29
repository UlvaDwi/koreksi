<?php

use Svg\Tag\Group;

/**

 * 

 */

class Mapel_Model extends CI_Model

{

	public function getAllData($kode_jurusan = null)
	{
		$this->db->select('id_mapel, nama_mapel, kelas, a_jurusan.nama_jurusan');
		$this->db->from('a_mapel');
		$this->db->join('a_jurusan', 'a_jurusan.kode_jurusan = a_mapel.kode_jurusan');
		if ($kode_jurusan != null) {
			$this->db->where('a_mapel.kode_jurusan', $kode_jurusan);
		}
		return $this->db->get()->result();
	}

	public function getMapel()

	{
		return $this->db->query("SELECT * FROM `mapel` inner join kelas on (mapel.kelas = kelas.kelas && mapel.id_jurusan = kelas.id_jurusan) ORDER BY `mapel`.`id_mapel` ASC ")->result();
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

		foreach ($this->input->post('chkKelas') as $valueKls) {

			foreach ($this->input->post('chkJurusan') as $valueJur) {

				$data = [

					'id_mapel' => $this->input->post('id_mapel'),

					'nama_mapel' => $this->input->post('nama_mapel'),

					'kelas' => $valueKls,

					'kode_jurusan' => $valueJur


				];

				if ($this->checkExist($this->input->post('id_mapel'), $this->input->post('kelompok_mapel'), $valueKls, $valueJur)) {

					$this->db->insert('a_mapel', $data);
				}
			}
		}
	}



	public function checkExist($id_mapel, $nama_mapel, $kelas, $id_jurusan)

	{

		$data = [

			'id_mapel' => $id_mapel,

			'kelas' => $kelas,

			'nama_mapel' => $nama_mapel,

			'kode_jurusan' => $id_jurusan

		];

		$query = $this->db->get_where('a_mapel', $data)->num_rows();

		if ($query > 0) {

			return false;
		}

		return true;
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

			'id_mapel' => $this->input->post('id_mapel', true),

			'nama_mapel' => $this->input->post('nama_mapel', true),

			'kelas' => $this->input->post('kelas', true),

			'kode_jurusan' => $this->input->post('kode_jurusan', true)

		);

		if ($this->checkExist($this->input->post('id_mapel'), $this->input->post('nama_mapel'), $this->input->post('kelas', true), $this->input->post('kode_jurusan', true))) {

			$this->db->where('id_mapel', $this->input->post('id_mapel', true));

			$this->db->update('a_mapel', $data);
		}
	}

	public function detail_data($id)
	{

		return $this->db->get_where('a_mapel', ['id_mapel' => $id])->row_array();
	}
}
