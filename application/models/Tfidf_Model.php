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

    public function getMaxdataSoal()
    {

        $query = "SELECT id_soal FROM `a_soalkunci` WHERE id_soal IN (SELECT MAX(id_soal) FROM `a_soalkunci`)";
        return $this->db->query($query)->row_array();
    }

    public function getJumlahKata($id_soal)
    {

        //$query = "SELECT sum(jumlah) FROM `a_tfidf` WHERE id_soal = '$id_soal'";
        $query = "SELECT sum(jumlah) as sum FROM `a_tfidf` WHERE id_soal = '55'";
        return $this->db->query($query)->row_array();
    }

    public function tambah_data($arr_kalimat)
    {
        $getIdSoal = $this->Tfidf_Model->getMaxdataSoal();
        $id_soal = $getIdSoal['id_soal'];
        $data = array();
        $jumlah = array_count_values($arr_kalimat);
        foreach ($jumlah as $baris => $value) {

            var_dump($baris);
            $data[] = array(
                'kata' => $baris,
                'jumlah' => $value,
                'id_soal' => $getIdSoal['id_soal'],
            );
        }
        $this->db->insert_batch('a_tfidf', $data);
        $getSumKata = $this->Tfidf_Model->getJumlahKata($id_soal);
        var_dump($getSumKata['sum']);
        die();
    }


    public function getMaxdataJawaban()
    {

        $query = "SELECT id_jawaban_siswa FROM `a_jawabansiswa` WHERE id_jawaban_siswa IN (SELECT MAX(id_jawaban_siswa) FROM `a_jawabansiswa`)";
        return $this->db->query($query)->row_array();
    }

    public function getJumlahKataJawaban($id_jawaban_siswa)
    {

        //$query = "SELECT sum(jumlah) FROM `a_tfidf` WHERE id_soal = '$id_soal'";
        $query = "SELECT sum(jumlahjawaban) as sum FROM `a_tfidf_siswa` WHERE id_jawaban_siswa = '$id_jawaban_siswa'";
        return $this->db->query($query)->row_array();
    }

    public function tambah_data_siswa($arr_kalimat)
    {
        $getIdJawaban = $this->Tfidf_Model->getMaxdataJawaban();
        $id_jawaban_siswa = $getIdJawaban['id_jawaban_siswa'];
        $data = array();
        $jumlah = array_count_values($arr_kalimat);
        foreach ($jumlah as $baris => $value) {

            var_dump($baris);
            $data[] = array(
                'kata' => $baris,
                'jumlah' => $value,
                'id_jawaban_siswa' => $getIdJawaban['id_jawaban_siswa'],
            );
        }
        $this->db->insert_batch('a_tfidf_siswa', $data);
        $getSumKata = $this->Tfidf_Model->getJumlahKataJawaban($id_jawaban_siswa);
        // var_dump($getSumKata['sum']);
        // die();
    }
}
