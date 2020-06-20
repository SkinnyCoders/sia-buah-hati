<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Semester extends CI_controller
{

    function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuthTatausaha();
        $this->load->model('m_admin');
    }

    public function index(){
    	$data = [
            'title' => 'Daftar Semester',
            'tahun_ajaran' => $this->db->get('tahun_ajaran')->result_array()
    	];

    	getViews($data,'v_tatausaha/v_semester');
    }

    public function tambah(){
    
        $this->form_validation->set_rules('semester', 'Semester', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required|callback_cekTglMulai', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tgl_akhir', 'Tanggal Berakhir', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required', ['required' => '{field} tidak boleh kosong']);

        if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('msg_failed', 'Maaf data semester gagal disimpan');
            redirect('tatausaha/semester');
        }else{
            $data = [
                'semester' => $this->input->post('semester', true),
                'tanggal_mulai' => $this->input->post('tgl_mulai', true),
                'tanggal_akhir' => $this->input->post('tgl_akhir'),
                'id_tahun_pelajaran' => $this->input->post('tahun_ajaran', true),
            ];

            if($this->db->insert('semester', $data)){
                $this->session->set_flashdata('msg_success', 'Selamat, data semester gagal disimpan');
                redirect('tatausaha/semester');
            }else{
                $this->session->set_flashdata('msg_failed', 'Maaf data semester gagal disimpan');
                redirect('tatausaha/semester'); 
            }

        }
    }

    public function cekTglMulai($str){
        if($str > $this->input->post('tgl_akhir')){
            return false;
        }else{
            return true;
        }
    }
}