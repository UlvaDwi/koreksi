<?php
class DataSiswaNilai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model([
            'Siswa_Model',
            'PenugasanGuru_Model',
            'HistoriKelas_Model',
            'Ujian_Model',
            'TahunAjaran_Model'
        ]);
    }

    public function index($id_tugas)
    {
        // ambil data user guru
        $id_guru = $this->session->userdata('id_user');
        // // cek apakah apakah halaman yang diakses sesuai dengan id_user
        $guru = $this->PenugasanGuru_Model->getData_by(['id_tugas' => $id_tugas])->row();
        $gurutugas = $this->PenugasanGuru_Model->getViewData_by(['id_tugas' => $id_tugas])->row();
        if ($id_guru != $guru->id_user) {
            show_404();
        }
        $siswa = $this->HistoriKelas_Model->getData_by([
            'kode_kelas' => $guru->kode_kelas,
            'kode_ta' => $guru->kode_ta
        ])->result();
        $jenisUjian = $this->Ujian_Model->getData(['id_tugas' => $id_tugas])->result();
        // if (empty($jenisUjian) || empty($jenisUjian)) {
        //     return redirect('welcome');
        // }
        // untuk sidebar
        if ($this->session->userdata('level') == 'guru') {
            $id_user = $this->session->userdata('id_user');
            $kode_ta = $this->TahunAjaran_Model->tahunAjaranAktif;

            $data = [
                'menu_mapels' => $this->PenugasanGuru_Model->getViewData_by(['id_user' => $id_user, 'kode_ta' => $kode_ta])->result(),
                'mapel' => "Mapel $gurutugas->nama_mapel Kelas " . str_replace("_", " ", $gurutugas->kode_kelas)
            ];
        }
        // /sidebar


        $this->load->view('templates/header', compact('siswa', 'jenisUjian'));
        $this->load->view('templates/sidebar', $data);
        $this->load->view('SiswaNilai/index');
        $this->load->view('templates/footer');
    }
}
