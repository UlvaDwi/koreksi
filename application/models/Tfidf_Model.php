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


        //$hasilexplode = explode(" ", $arr_kalimat);
        //var_dump($arr_kalimat);
        //$data = array();
        foreach ($arr_kalimat as $row) {
            //$hasil = count($arr_kalimat);
            $jumlah = array_count_values($arr_kalimat);
            foreach ($jumlah as $baris) {

                var_dump($baris);
                $data = array(
                    'kata' => $row,
                    'jumlah' => $baris,
                );
            }
            //var_dump($arr_kalimat);
            var_dump($jumlah);

            $tes = array_count_values($data);
            $this->db->insert('a_tfidf', $tes);
        }
    }
}
