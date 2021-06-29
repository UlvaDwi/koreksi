<?php
class User_Model extends CI_Model
{
    /* 
    * mengambil semua data rumusan
    * param : hari(null), id kelas(null)
    */
    public function getData()
    {
        return $this->db->get('a_guru')->result();
    }

    public function user_data()
    {
        echo $_SESSION['level'];
    }

    public function validation($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query =  $this->db->get('a_guru');
        if ($query->num_rows() >= 1) {
            return $query->row();
        }
    }
    /* 
    * delete semua data rumusan
    */
    public function deleteData($id)
    {
        $this->db->where('id_user', $id);
        $this->db->delete('a_guru');
    }
    /* 
    * tambah data
    */
    public function tambah_data($data)
    {
        $this->db->insert('a_guru', $data);
    }

    public function detail_data($id)
    {
        return $this->db->get_where('a_guru', ['id_user' => $id])->row_array();
    }

    public function ubah_data($id, $data)
    {
        $this->db->update('a_guru', $data, ['id_user' => $id]);
    }
}
