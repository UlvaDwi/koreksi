<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * 
 */
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_Model');
        $this->load->model('Siswa_Model');
        $this->load->library('form_validation');
    }
    function index()
    {

        $this->load->view('login');
    }

    public function validation()
    {
        $this->form_validation->set_rules("username", "Username", "required");
        $this->form_validation->set_rules("password", "Password", "required");
        if ($this->form_validation->run() == FALSE) {
            redirect("Login");
        } else {
            $username  = $this->input->post('username', true);
            $password  = $this->input->post('password', true);
            $validation = $this->User_Model->validation($username, $password);
            $validationSiswa = $this->Siswa_Model->validation($username, $password);
            if (is_object($validation)) {
                $newdata = array(
                    'id_user'     => $validation->id_user,
                    'username'  => $validation->nama_guru,
                    'level' => $validation->level
                );
                $this->session->set_userdata($newdata);
                redirect('Welcome');
            } else if (is_object($validationSiswa)) {
                $newdata = array(
                    'id_siswa'     => $validationSiswa->id_siswa,
                    'username'  => $validationSiswa->nama_siswa,
                    'level' => 'siswa'
                );
                $this->session->set_userdata($newdata);
                redirect('Welcome');
            } else {

                redirect('Login');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Login');
    }
}
