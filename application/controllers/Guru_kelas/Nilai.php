<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Nilai extends CI_controller
{

    function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuthGuruKelas();
        $this->load->model('m_tatausaha');
        $this->load->helper('cektahun');
    }

    public function index(){
        $id_gtk = $this->session->userdata('id_gtk');
        $id_tahun_pelajaran = getIdTahun(getTahun());

    	$data = [
            'title' => 'Nilai Siswa',
            'mapel' => $this->db->query("SELECT * FROM `jadwal` JOIN mapel ON mapel.id_mapel=jadwal.id_mapel WHERE jadwal.id_gtk = $id_gtk GROUP BY jadwal.id_mapel")->result_array(),
            'semester' => $this->db->get_where('semester', ['id_tahun_pelajaran' => $id_tahun_pelajaran])->result_array()
        ];
        
        if(isset($_GET['semester'])){
            $data['siswa'] = $this->db->get_where('siswa', ['id_kelas' => $_GET['kelas']])->result_array();
            if (empty($data['siswa'])) {
                $this->session->set_flashdata('msg_failed', 'Maaf, Data siswa tidak ditemukan');
                redirect('guru_kelas/nilai');
            }else{
                getViews($data,'v_guru/v_list_nilai_siswa');
            }
        }else{
            getViews($data,'v_guru/v_list_nilai_siswa');
        }


        
        // if($this->form_validation->run() == FALSE){
        //     getViews($data, 'v_guru/v_list_nilai_siswa');
        // }else{
        //     $data['siswa'] = $this->db->get_where('siswa', ['id_kelas' => $this->input->post('kelas')])->result_array();

        //     if (empty($data['siswa'])) {
        //         $this->session->set_flashdata('msg_failed', 'Maaf, Data siswa tidak ditemukan');
        //         redirect('guru_kelas/nilai');
        //     }else{
        //         getViews($data,'v_guru/v_list_nilai_siswa');
        //     }
        // }

        
    }

    public function get_kelas(){
            $id_mapel = $_POST['id_mapel'];
            $id_gtk = $this->session->userdata('id_gtk');
            $data = $this->db->query("SELECT * FROM kelas WHERE EXISTS (SELECT * FROM jadwal WHERE jadwal.id_kelas=kelas.id_kelas AND jadwal.id_gtk = $id_gtk AND jadwal.id_mapel = $id_mapel )")->result_array();

            echo json_encode($data);
    }

    public function input_nilai(){
        $data = [
            'title' => 'Input Nilai Siswa',
            'semester' => $this->db->get_where('semester', ['id_semester' => $_GET['id_semester']])->row_array()
        ];

        if(isset($_GET['nisn'])){
            $data['siswa'] = $this->db->query("SELECT * FROM `siswa` JOIN kelas ON kelas.id_kelas=siswa.id_kelas WHERE `nisn` =".$_GET['nisn'])->row_array();
        }

        $this->form_validation->set_rules('tertulis_harian', 'Tertulis Harian', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tertulis_uts', 'Tertulis UTS', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tertulis_uas', 'Tertulis UAS', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tertulis_tugas', 'Tertulis Tugas', 'required', ['required' => '{field} tidak boleh kosong']);

        $this->form_validation->set_rules('lisan_harian', 'Lisan Harian', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('lisan_uts', 'Lisan UTS', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('lisan_uas', 'Lisan UAS', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('lisan_tugas', 'Lisan Tugas', 'required', ['required' => '{field} tidak boleh kosong']);

        $this->form_validation->set_rules('praktek_harian', 'Praktek Harian', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('praktek_uts', 'Praktek UTS', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('praktek_uas', 'Praktek UAS', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('praktek_tugas', 'Praktek Tugas', 'required', ['required' => '{field} tidak boleh kosong']);

        if($this->form_validation->run() == false){
            getViews($data, 'v_guru/v_input_nilai_siswa');
        }else{
            $nisn = $_GET['nisn'];
            $id_kelas = $data['siswa']['id_kelas'];
            $id_semester = $_GET['id_semester'];
            $id_mapel = $_GET['id_mapel'];

            $data_harian = [
                'nisn' => $nisn,
                'id_kelas' => $id_kelas,
                'id_semester' => $id_semester,
                'id_mapel' => $id_mapel,
                'nilai_tertulis' => $this->input->post('tertulis_harian'),
                'nilai_lisan' => $this->input->post('lisan_harian'),
                'nilai_praktek' => $this->input->post('praktek_harian')
            ];


            $data_uts = [
                'nisn' => $nisn,
                'id_kelas' => $id_kelas,
                'id_semester' => $id_semester,
                'id_mapel' => $id_mapel,
                'nilai_tertulis' => $this->input->post('tertulis_uts'),
                'nilai_lisan' => $this->input->post('lisan_uts'),
                'nilai_praktek' => $this->input->post('praktek_uts')
            ];

            $data_uas = [
                'nisn' => $nisn,
                'id_kelas' => $id_kelas,
                'id_semester' => $id_semester,
                'id_mapel' => $id_mapel,
                'nilai_tertulis' => $this->input->post('tertulis_uas'),
                'nilai_lisan' => $this->input->post('lisan_uas'),
                'nilai_praktek' => $this->input->post('praktek_uas')
            ];

            $data_tugas = [
                'nisn' => $nisn,
                'id_kelas' => $id_kelas,
                'id_semester' => $id_semester,
                'id_mapel' => $id_mapel,
                'nilai_tertulis' => $this->input->post('tertulis_tugas'),
                'nilai_lisan' => $this->input->post('lisan_tugas'),
                'nilai_praktek' => $this->input->post('praktek_tugas')
            ];

            if($this->db->insert('nilai_ulangan_harian', $data_harian) && $this->db->insert('nilai_uts', $data_uts) && $this->db->insert('nilai_uas', $data_uas) && $this->db->insert('nilai_tugas', $data_tugas)){
                $this->session->set_flashdata('msg_success', 'Data nilai berhasil diinputkan');
                redirect('guru_kelas/nilai?mapel='.$id_mapel.'&kelas='.$id_kelas.'&semester='.$id_semester);
            }else{
                $this->session->set_flashdata('msg_failed', 'Maaf, Data Nilai gagal diinputkan');
                redirect($_SERVER['PHP_SELF']);
            }
        }
        

        
    }

    public function update_nilai(){
        $data = [
            'title' => 'Perbarui Data nilai',
            'semester' => $this->db->get_where('semester', ['id_semester' => $_GET['id_semester']])->row_array(),
            'uts' => $this->db->get_where('nilai_uts', ['nisn' => $_GET['nisn']])->row_array(),
            'harian' => $this->db->get_where('nilai_ulangan_harian', ['nisn' => $_GET['nisn']])->row_array(),
            'tugas' => $this->db->get_where('nilai_tugas', ['nisn' => $_GET['nisn']])->row_array(),
            'uas' => $this->db->get_where('nilai_uas', ['nisn' => $_GET['nisn']])->row_array()
        ];

        if(isset($_GET['nisn'])){
            $data['siswa'] = $this->db->query("SELECT * FROM `siswa` JOIN kelas ON kelas.id_kelas=siswa.id_kelas WHERE `nisn` =".$_GET['nisn'])->row_array();
        }

        $this->form_validation->set_rules('tertulis_harian', 'Tertulis Harian', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tertulis_uts', 'Tertulis UTS', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tertulis_uas', 'Tertulis UAS', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tertulis_tugas', 'Tertulis Tugas', 'required', ['required' => '{field} tidak boleh kosong']);

        $this->form_validation->set_rules('lisan_harian', 'Lisan Harian', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('lisan_uts', 'Lisan UTS', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('lisan_uas', 'Lisan UAS', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('lisan_tugas', 'Lisan Tugas', 'required', ['required' => '{field} tidak boleh kosong']);

        $this->form_validation->set_rules('praktek_harian', 'Praktek Harian', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('praktek_uts', 'Praktek UTS', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('praktek_uas', 'Praktek UAS', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('praktek_tugas', 'Praktek Tugas', 'required', ['required' => '{field} tidak boleh kosong']);

        if($this->form_validation->run() == FALSE){
            getViews($data, 'v_guru/v_update_nilai_siswa');
        }else{
            $nisn = $_GET['nisn'];
            $id_kelas = $data['siswa']['id_kelas'];
            $id_semester = $_GET['id_semester'];
            $id_mapel = $_GET['id_mapel'];

            $data_harian = [
                'nisn' => $nisn,
                'id_kelas' => $id_kelas,
                'id_semester' => $id_semester,
                'id_mapel' => $id_mapel,
                'nilai_tertulis' => $this->input->post('tertulis_harian'),
                'nilai_lisan' => $this->input->post('lisan_harian'),
                'nilai_praktek' => $this->input->post('praktek_harian')
            ];


            $data_uts = [
                'nisn' => $nisn,
                'id_kelas' => $id_kelas,
                'id_semester' => $id_semester,
                'id_mapel' => $id_mapel,
                'nilai_tertulis' => $this->input->post('tertulis_uts'),
                'nilai_lisan' => $this->input->post('lisan_uts'),
                'nilai_praktek' => $this->input->post('praktek_uts')
            ];

            $data_uas = [
                'nisn' => $nisn,
                'id_kelas' => $id_kelas,
                'id_semester' => $id_semester,
                'id_mapel' => $id_mapel,
                'nilai_tertulis' => $this->input->post('tertulis_uas'),
                'nilai_lisan' => $this->input->post('lisan_uas'),
                'nilai_praktek' => $this->input->post('praktek_uas')
            ];

            $data_tugas = [
                'nisn' => $nisn,
                'id_kelas' => $id_kelas,
                'id_semester' => $id_semester,
                'id_mapel' => $id_mapel,
                'nilai_tertulis' => $this->input->post('tertulis_tugas'),
                'nilai_lisan' => $this->input->post('lisan_tugas'),
                'nilai_praktek' => $this->input->post('praktek_tugas')
            ];

            if($this->db->update('nilai_ulangan_harian', $data_harian, ['nisn' => $nisn]) && $this->db->update('nilai_uts', $data_uts, ['nisn' => $nisn]) && $this->db->update('nilai_uas', $data_uas, ['nisn' => $nisn]) && $this->db->update('nilai_tugas', $data_tugas, ['nisn' => $nisn])){
                $this->session->set_flashdata('msg_success', 'Data nilai berhasil diinputkan');
                redirect('guru_kelas/nilai?mapel='.$id_mapel.'&kelas='.$id_kelas.'&semester='.$id_semester);
            }else{
                $this->session->set_flashdata('msg_failed', 'Maaf, Data Nilai gagal diinputkan');
                redirect($_SERVER['PHP_SELF']);
            }
        }
    }
}