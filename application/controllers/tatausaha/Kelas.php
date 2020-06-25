<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Kelas extends CI_controller
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
            'title' => 'Daftar Kelas',
            'kelas' => $this->db->get('kelas')->result_array()
    	];

    	getViews($data,'v_tatausaha/v_kelas');
    }

    public function tambah(){

        $this->form_validation->set_rules('kelas', 'Nama Kelas', 'required|trim|callback_cekKelas', ['required' => '{field} tidak boleh kosong', 'cekKelas' => '{field} sudah digunakan']);
        $this->form_validation->set_rules('tingkat', 'Tingkat Kelas', 'required|trim', ['required' => '{field} tidak boleh kosong']);

    	if ($this->form_validation->run() == FALSE) {
    		$this->session->set_flashdata('msg_failed', 'Maaf, data gagal ditambahkan');
            redirect('tatausaha/kelas');
    	}else{
    		$data = [
                'tingkat_kelas' => $this->input->post('tingkat'),
    			'nama_kelas' => $this->input->post('kelas', true)
    		];

    		if (insertData('kelas', $data)) {
    			$this->session->set_flashdata('msg_success', 'Selamat, data berhasil ditambahkan');
                redirect('tatausaha/kelas');
    		}else{
    			$this->session->set_flashdata('msg_failed', 'Maaf, data gagal ditambahkan');
                redirect('tatausaha/kelas');
    		}
    	}
    }

    public function update(){
    	if (isset($_POST['id_get_update']) && !empty($_POST['id_get_update'])) {
    		$id = $_POST['id_get_update'];

    		$data = $this->db->get_where('kelas', ['id_kelas' => $id])->row_array();

    		echo json_encode($data);
    	}

    	if (isset($_POST['simpan'])) {
            $this->form_validation->set_rules('kelas', 'Kelas', 'required|trim', ['required' => '{field} tidak boleh kosong']);
            $this->form_validation->set_rules('tingkat', 'Tingkat Kelas', 'required|trim', ['required' => '{field} tidak boleh kosong']);

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg_failed', 'Maaf, data kelas gagal diperbarui');
                redirect('tatausaha/kelas');
            }else{
                $tingkat = $this->input->post('tingkat');
                $kelas = $this->input->post('kelas', true);
                $cekKelas = $this->db->query("SELECT * FROM `kelas` WHERE `nama_kelas` = '$kelas' AND `tingkat_kelas` = $tingkat")->num_rows();

                if($cekKelas > 0){
                    $this->session->set_flashdata('msg_failed', 'Maaf, data kelas tidak diubah');
                    redirect('tatausaha/kelas');
                }

                $data = [
                    'tingkat_kelas' => $tingkat,
                    'nama_kelas' => $kelas
                ];

                if ($this->db->update('kelas', $data, ['id_kelas' => $this->input->post('id')])) {
                    $this->session->set_flashdata('msg_success', 'Selamat, data berhasil diperbarui');
                    redirect('tatausaha/kelas');
                }else{
                    $this->session->set_flashdata('msg_failed', 'Maaf, data gagal diperbarui');
                    redirect('tatausaha/kelas');
                }
            }
    	}
    }

    public function delete($id){
    	$delete = $this->db->delete('kelas', ['id_kelas'=> $id]);

    	if ($delete) {
    		$this->session->set_flashdata('msg_success', 'Selamat, data berhasil dihapus');
    		http_response_code(200);
    	}else{
    		$this->session->set_flashdata('msg_failed', 'Selamat, data gagal dihapus');
    		http_response_code(404);
    	}
    }

    public function cekKelas($kelas){
        $data = $this->db->get_where('kelas', ['nama_kelas' => $kelas])->row_array();

        if(!empty($data)){
            return false;
        }else{
            return true;
        }
    }
}