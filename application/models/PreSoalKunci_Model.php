<?php

/**
 * 
 */
class PreSoalKunci_Model extends CI_Model
{
	public function getAllData()
	{
		return $this->db->get('a_pre_soalkunci')->result();
	}

	public function tambah_data($id, $hasiltoken, $hasilfilter, $hasilstemming)
	{

		$data = array(
			'id_soal' => $id,
			'token' => $hasiltoken,
			'filter' => $hasilfilter,
			'stem' => $hasilstemming
		);

		$this->db->insert('a_pre_soalkunci', $data);
	}
}
