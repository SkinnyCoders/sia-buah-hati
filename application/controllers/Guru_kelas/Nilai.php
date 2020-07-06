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

        $this->form_validation->set_rules('kelas', 'Kelas', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('semester', 'Semester', 'required', ['required' => '{field} tidak boleh kosong']);  
        
        if($this->form_validation->run() == FALSE){
            getViews($data, 'v_guru/v_list_nilai_siswa');
        }else{
            $data['siswa'] = $this->db->get_where('siswa', ['id_kelas' => $this->input->post('kelas')])->result_array();

            if (empty($data['siswa'])) {
                $this->session->set_flashdata('msg_failed', 'Maaf, Data siswa tidak ditemukan');
                redirect('guru_kelas/nilai');
            }else{
                getViews($data,'v_guru/v_list_nilai_siswa');
            }
        }

        
    }

    public function get_kelas(){
            $id_mapel = $_POST['id_mapel'];
            $id_gtk = $this->session->userdata('id_gtk');
            $data = $this->db->query("SELECT * FROM kelas WHERE EXISTS (SELECT * FROM jadwal WHERE jadwal.id_kelas=kelas.id_kelas AND jadwal.id_gtk = $id_gtk AND jadwal.id_mapel = $id_mapel )")->result_array();

            echo json_encode($data);
    }
}