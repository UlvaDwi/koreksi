<?php
class UjianSiswa_Model extends CI_Model
{
    public function store(array $data)
    {
        $this->db->insert('a_ujian_siswa', $data);
    }

    public function destroy(array $where)
    {
        $this->db->where($where);
        $this->db->delete('a_ujian_siswa');
    }
}
