<?php

/**
 * 
 */
class Tfidf_Model extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('a_tfidf')->result();
    }

    public function tambah_data($arr_kalimat)
    {
        $data = array();
            $jumlah = array_count_values($arr_kalimat);
            foreach ($jumlah as $baris=>$value) {

                var_dump($baris);
                $data[] = array(
                    'kata' => $baris,
                    'jumlah' => $value,
                );
        }
        return $this->db->insert_batch('a_tfidf', $data);
    }
}
