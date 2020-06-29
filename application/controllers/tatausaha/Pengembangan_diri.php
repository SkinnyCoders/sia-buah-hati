<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Pengembangan_diri extends CI_controller
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
            'title' => 'Daftar Pengembangan Diri',
            'ekskul' => $this->db->get('pengembangan_diri')->result_array()
    	];

    	getViews($data,'v_tatausaha/v_pengembangan_diri');
    }

    public function tambah(){
        $this->form_validation->set_rules('pengembangan', 'Pengambangan', 'trim|required|is_unique[pengembangan_diri.pengembangan_diri]');
        
        if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('msg_failed', 'Maaf, data gagal ditambahkan');
            redirect('tatausaha/pengembangan_diri');
        }else{
            $data = [
                'pengembangan_diri' => $this->input->post('pengembangan', true)
            ];

            if (insertData('pengembangan_diri', $data)) {
    			$this->session->set_flashdata('msg_success', 'Selamat, data berhasil ditambahkan');
                redirect('tatausaha/pengembangan_diri');
    		}else{
    			$this->session->set_flashdata('msg_failed', 'Maaf, data gagal ditambahkan');
                redirect('tatausaha/pengembangan_diri');
    		}
        }
    }

    public function update(){
    	if (isset($_POST['id_get_update']) && !empty($_POST['id_get_update'])) {
    		$id = $_POST['id_get_update'];

    		$data = $this->db->get_where('pengembangan_diri', ['id_pengembangan_diri' => $id])->row_array();

    		echo json_encode($data);
    	}

    	if (isset($_POST['simpan'])) {
            $data = $this->db->get_where('pengembangan_diri', ['id_pengembangan_diri' => $id])->row_array();
            if($this->input->post('pengembangan') !== $data['pengembangan_diri']){
                $unique = '|is_unique[pengembangan_diri.pengembangan_diri]';
            }else{
                $unique = '';
            }
    
            $this->form_validation->set_rules('pengembangan', 'Pengambangan', 'trim|required'.$unique);

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg_failed', 'Maaf, data gagal diperbarui');
                redirect('tatausaha/pengembangan_diri');
            }else{
                $data = [
                    'pengembangan_diri' => $this->input->post('pengembangan', true)
                ];

                if ($this->db->update('pengembangan_diri', $data, ['id_pengembangan_diri' => $this->input->post('id')])) {
                    $this->session->set_flashdata('msg_success', 'Selamat, data berhasil diperbarui');
                    redirect('tatausaha/pengembangan_diri');
                }else{
                    $this->session->set_flashdata('msg_failed', 'Maaf, data gagal diperbarui');
                    redirect('tatausaha/pengembangan_diri');
                }
            }
    	}
    }

    public function delete($id){
        $delete = $this->db->delete('pengembangan_diri', ['id_pengembangan_diri' => $id]);

        if ($delete) {
    		$this->session->set_flashdata('msg_success', 'Selamat, data berhasil dihapus');
    		http_response_code(200);
    	}else{
    		$this->session->set_flashdata('msg_failed', 'Selamat, data gagal dihapus');
    		http_response_code(404);
    	}
    }
} 