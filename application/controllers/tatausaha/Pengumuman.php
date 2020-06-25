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

    public function update(){
        if(isset($_POST['id_get_update']) && !empty($_POST['id_get_update'])){
            $id = $_POST['id_get_update'];
            $data = $this->db->get_where('pengumuman', ['id_pengumuman' => $id])->row_array();

            echo json_encode($data);
        }elseif(isset($_POST['simpan'])){
            $id = $this->input->post('id');
            $data_lama =  $this->db->get_where('pengumuman', ['id_pengumuman' => $id])->row_array();

            if (!empty($_FILES['foto']['name'])) {
                //do upload for new image
                $foto = $this->_uploadFile();

                //deleting old image
                if ($foto && $data_lama['foto'] !== null) {
                    unlink('assets/img/pengumuman/' . $data_lama['foto']);
                }
            } else {
                $foto = $data_lama['foto'];
            }

            $data = [
                'id_gtk' => $this->input->post('id_gtk'),
                'konten' => $this->input->post('konten'),
                'gambar' => $foto
            ];

            if ($this->db->update('pengumuman', $data, ['id_pengumuman' => $id])) {
    			$this->session->set_flashdata('msg_success', 'Selamat, data berhasil diperbarui');
                redirect('tatausaha/dashboard');
    		}else{
    			$this->session->set_flashdata('msg_failed', 'Maaf, data gagal diperbarui');
                redirect('tatausaha/dashboard');
    		}
        }
    }

    public function hapus($id){
        $delete = $this->db->delete('pengumuman', ['id_pengumuman' => $id]);

        if ($delete) {
    		$this->session->set_flashdata('msg_success', 'Selamat, data berhasil dihapus');
    		http_response_code(200);
    	}else{
    		$this->session->set_flashdata('msg_failed', 'Selamat, data gagal dihapus');
    		http_response_code(404);
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
