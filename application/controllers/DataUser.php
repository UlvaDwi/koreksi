<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * 
 */
class DataUser extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // if (!$this->session->has_userdata('id_user')) {
        //     redirect('Login');
        // }
        // if ($this->session->userdata('level') != 'admin') {
        //     show_404();
        // }

        $this->load->model('User_Model');
        $this->load->library('form_validation');
    }
    function index()
    {
        $data['user'] = $this->User_Model->getData();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function validation_form()
    {
        $this->form_validation->set_rules("id_user", "NIK", "required");
        $this->form_validation->set_rules("nama_guru", "nama guru", "required");
        $this->form_validation->set_rules("username", "username", "required");
        $this->form_validation->set_rules("password", "Password", "required");
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = [
                'id_user' => $this->input->post('id_user'),
                'nama_guru' => $this->input->post('nama_guru'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'level' => $this->input->post('level')
            ];
            $this->User_Model->tambah_data($data);
            $this->session->set_flashdata('flash_user', 'Disimpan');
            redirect('DataUser');
        }
    }

    public function hapus($id)
    {
        $this->User_Model->deleteData($id);
        $this->session->set_flashdata('flash_user', 'Dihapus');
        redirect('DataUser');
    }

    public function ubah($id)
    {
        $this->form_validation->set_rules("nama_guru", "Nama ", "required");
        $this->form_validation->set_rules("username", "Nama Jurusan", "required");
        $this->form_validation->set_rules("password", "Password", "required");
        if ($this->form_validation->run() == FALSE) {
            $data['ubah'] = $this->User_Model->detail_data($id);
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('user/ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama_guru' => $this->input->post('nama_guru'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'level' => $this->input->post('level')
            ];
            $this->User_Model->ubah_data($id, $data);
            $this->session->set_flashdata('flash_user', 'DiUbah');
            redirect('DataUser');
        }
    }

    public function akun()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('user/resetPassword');
        $this->load->view('templates/footer');
    }

    public function resetPassword()
    {
        switch ($this->session->userdata('level')) {
            case 'admin':
                $this->User_Model->ubah_data($this->session->userdata('id_user'), ['password' => $this->input->post('password')]);
                break;
            case 'guru':
                $this->User_Model->ubah_data($this->session->userdata('id_user'), ['password' => $this->input->post('password')]);
                break;
            case 'siswa':
                $this->db->where('id_siswa', $this->session->userdata('id_siswa'));
                $this->db->update('a_siswa', ['password' => $this->input->post('password')]);
                break;
        }
        $this->session->set_flashdata('flash_user', 'DiUbah');
        redirect('DataUser/akun');
    }
}
