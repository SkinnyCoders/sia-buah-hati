<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Guru_mengajar extends CI_controller
{
    /**
     * Constructs a new instance.
     */
    function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuthTatausaha();
        $this->load->model('m_admin');
    }

    public function index(){
        $data = [
            'title' => 'Konfigurasi Mapel Kelas',
            'mapel' => $this->db->get('mapel')->result_array(),
            'list' => $this->db->query("SELECT GROUP_CONCAT(kelas.nama_kelas) AS kelas, mapel.nama_mapel, mapel.id_mapel FROM `mapel_kelas` JOIN mapel ON mapel.id_mapel=mapel_kelas.id_mapel JOIN kelas ON kelas.id_kelas=mapel_kelas.id_kelas GROUP BY mapel.id_mapel")->result_array(),
            'kelas_list' => $this->db->get('kelas')->result_array()
            
        ];

        $this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'required|trim', ['required' => '{field} tidak boleh kosong']);

        if($this->form_validation->run() == FALSE){
            getViews($data,'v_tatausaha/v_guru_mengajar');
        }else{
            $datakelas = $this->input->post('datakelas');
            $flag = true;
            for($i=0; $i<count($datakelas); $i++){
                $data = [
                    'id_mapel' => $this->input->post('mapel'),
                    'id_kelas' => $datakelas[$i]
                ];

                if(!$this->db->insert('mapel_kelas', $data)){
                    $flag = false;
                }
            }

            if($flag){
                $this->session->set_flashdata('msg_success', 'Selamat, data berhasil ditambahkan');
                redirect('tatausaha/mapel/mapel_kelas');
            }else{
                $this->session->set_flashdata('msg_failed', 'Maaf, data gagal ditambahkan');
                redirect('tatausaha/mapel/mapel_kelas');
            }
        }
    }
}
