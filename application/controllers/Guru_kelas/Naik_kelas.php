<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Naik_kelas extends CI_controller
{
    /**
     * Constructs a new instance.
     */
    function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuthGuruKelas();
        $this->load->model('m_gtk');
        $this->load->helper('cektahun');
    }

    public function index()
    {
        $id_gtk = $this->session->userdata('id_gtk');
        $data['title'] = 'Kenaikan Kelas';
        $data['nama_kelas'] = $this->db->query("SELECT * FROM `guru_kelas` JOIN kelas ON kelas.id_kelas=guru_kelas.id_kelas WHERE `id_gtk` = $id_gtk")->row_array();
        $data['kelas'] = $this->db->get('kelas')->result_array();
        $data['siswa'] = $this->m_gtk->getSiswaNaikKelas($id_gtk);

        if($data['siswa'] == false){
            $this->session->set_flashdata('msg_failed', 'Maaf Masih Ada nilai yang belum diinputkan');
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        getViews($data, 'v_guru/v_naik_kelas');
    }

    public function proses(){
        $this->form_validation->set_rules('kelas', 'Kelas', 'required', ['required' => '{field} belum dipilih']);

        if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('msg_failed', 'Maaf Kelas Belum dipilih');
            redirect('guru_kelas/naik_kelas');
        }else{
            $nisn = $this->input->post('naik');
            $kelas = $this->input->post('kelas');
            $flag = true;

            if(!empty($nisn)){
                for($i = 0; $i<count($nisn); $i++){
                    //get kelas siswa sekarang 
                    $kelas_lama = $this->db->get_where('siswa', ['nisn' => $nisn[$i]])->row_array();
                    $kelas_lama = $kelas_lama['id_kelas'];
                    //insert ke riwayat kelas
                    $data_riwayat = [
                        'nisn' => $nisn[$i],
                        'id_kelas' => $kelas_lama,
                        'id_tahun_ajaran' => getIdTahun(getTahun())
                    ];
    
                    $insert_riwayat = $this->db->insert('riwayat_kelas', $data_riwayat);
    
                    if($insert_riwayat){  
                         //update kelas siswa
                         $data = [
                             'id_kelas' => $kelas
                         ];
    
                         $update = $this->db->update('siswa', $data, ['nisn' => $nisn[$i]]);
    
                         if($update){
                            $flag = true;
                         }else{
                             $flag = false;
                         }
                    }else{
                        $flag = false;
                    }
    
                    if($flag){
                        $this->session->set_flashdata('msg_success', 'Selamat, Berhasil Konfirmasi naik kelas');
                        redirect('guru_kelas/naik_kelas');
                    }else{
                        $this->session->set_flashdata('msg_failed', 'Maaf gagal konfirmasi naik kelas');
                        redirect('guru_kelas/naik_kelas');
                    }
                }
            }else{
                $this->session->set_flashdata('msg_failed', 'Maaf belum ada siswa yang dipilih');
                redirect('guru_kelas/naik_kelas');
            }
        }
    }

}
