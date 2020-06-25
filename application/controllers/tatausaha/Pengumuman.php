<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Pengumuman extends CI_controller
{
    /**
     * Constructs a new instance.
     */
    function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuthTatausaha();
        $this->load->model('m_pengumuman');
    }

    public function tambah(){
        $data['pengumuman'] = $this->m_pengumuman->getPengumuman();

        $this->form_validation->set_rules('konten', 'Isi Pengumuman', 'required|trim');

        if($this->form_validation->run() == false){
            redirect('tatausaha/dashboard');
        }else{
            if (!empty($_FILES['foto']['name'])) {
    			$file = $this->_uploadFile();
    		}else{
    			$file = null;
            }

            $data = [
                'id_gtk' => $this->input->post('id_gtk'),
                'konten' => $this->input->post('konten'),
                'gambar' => $file
            ];

            if ($this->db->insert('pengumuman', $data)) {
    			$this->session->set_flashdata('msg_success', 'Selamat, data berhasil ditambahkan');
                redirect('tatausaha/dashboard');
    		}else{
    			$this->session->set_flashdata('msg_failed', 'Maaf, data gagal ditambahkan');
                redirect('tatausaha/dashboard');
    		}
        }
    }


    private function _uploadFile()
    {
        $config['upload_path']          = './assets/img/pengumuman/';
        $config['allowed_types']        = 'jpg|png|jpeg|JPG';
        $config['encrypt_name']         = TRUE;
        $config['overwrite']            = true;
        $config['max_size']             = 2048; //2mb

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            return false;
        } else {
            return $this->upload->data('file_name');
        }
    }
}
