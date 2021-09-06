<?php
class DataSiswaJawaban extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Siswa_Model');
        $this->load->model('TahunAjaran_Model');
        $this->load->model('PenugasanGuru_Model');
        $this->load->model('HistoriKelas_Model');
    }

    public function lihatjawaban($id_tugas)
    {
        // ambil data user guru
        $id_guru = $this->session->userdata('id_user');
        // // cek apakah apakah halaman yang diakses sesuai dengan id_user
        $guru = $this->PenugasanGuru_Model->getData_by(['id_tugas' => $id_tugas])->row();
        if ($id_guru != $guru->id_user) {
            show_404();
        }
        $siswa = $this->HistoriKelas_Model->getData_by([
            'kode_kelas' => $guru->kode_kelas,
            'kode_ta' => $guru->kode_ta
        ])->result();

        // untuk sidebar
        if ($this->session->userdata('level') == 'guru') {
            $id_user = $this->session->userdata('id_user');
            $kode_ta = $this->TahunAjaran_Model->tahunAjaranAktif;
            $data['menu_mapels'] = $this->PenugasanGuru_Model->getViewData_by(['id_user' => $id_user, 'kode_ta' => $kode_ta])->result();
        }
        // /sidebar


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('SiswaJawaban/index');
        $this->load->view('templates/footer');
    }
}
