<?php

/**
 * 
 */
class PreJawabanSiswa_Model extends CI_Model
{
	public function getAllData()
	{
		return $this->db->get('a_pre_jawabansiswa')->result();
	}

	public function tambah_data($idJawabanSiswa, $hasiltoken, $hasilfilter, $hasilstemming)
	{
		$data = array(
			'id_jawaban_siswa' => $idJawabanSiswa,
			'token' => $hasiltoken,
			'filter' => $hasilfilter,
			'stem' => $hasilstemming
		);

		$this->db->insert('a_pre_jawabansiswa', $data);
	}
}
