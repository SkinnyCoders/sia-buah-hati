<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Kkm extends CI_controller
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
            'title' => 'Daftar KKM',
            'mapel' => $this->db->get('mapel')->result_array(),
            'kkm' => $this->db->query("SELECT id_kkm, kkm, nama_kelas, nama_mapel FROM `kkm_mapel` JOIN mapel_kelas ON mapel_kelas.id_mapel_kelas=kkm_mapel.id_mapel_kelas JOIN kelas ON kelas.id_kelas=mapel_kelas.id_kelas JOIN mapel ON mapel.id_mapel=mapel_kelas.id_mapel ORDER BY kelas.tingkat_kelas DESC")->result_array()
    	];

    	getViews($data,'v_tatausaha/v_kkm');
    }

    public function get_kelas(){
        if(isset($_POST['id_mapel'])){
            $id_mapel = $_POST['id_mapel'];
            $data_kelas = $this->db->query("SELECT * FROM `mapel_kelas` JOIN kelas ON kelas.id_kelas=mapel_kelas.id_kelas WHERE `id_mapel` = $id_mapel")->result_array();

            echo json_encode($data_kelas);
        }
    }

    public function tambah(){

        $this->form_validation->set_rules('kelas', 'Tingkat Kelas', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('kkm', 'KKM', 'required|trim', ['required' => '{field} tidak boleh kosong']);

    	if ($this->form_validation->run() == FALSE) {
    		$this->session->set_flashdata('msg_failed', 'Maaf, data gagal ditambahkan');
            redirect('tatausaha/kkm');
    	}else{
            $cek = $this->db->get_where('kkm_mapel', ['id_mapel_kelas' => $this->input->post('kelas')])->num_rows();

            if($cek > 0){
                $this->session->set_flashdata('msg_failed', 'Maaf, data sudah digunakan');
                redirect('tatausaha/kkm');
                return false;
            }

    		$data = [
                'id_mapel_kelas' => $this->input->post('kelas'),
    			'kkm' => $this->input->post('kkm', true)
    		];

    		if (insertData('kkm_mapel', $data)) {
    			$this->session->set_flashdata('msg_success', 'Selamat, data berhasil ditambahkan');
                redirect('tatausaha/kkm');
    		}else{
    			$this->session->set_flashdata('msg_failed', 'Maaf, data gagal ditambahkan');
                redirect('tatausaha/kkm');
    		}
    	}
    }

    public function update(){
    	if (isset($_POST['id_get_update']) && !empty($_POST['id_get_update'])) {
    		$id = $_POST['id_get_update'];

    		$data = $this->db->query("SELECT id_kkm, kkm, mapel_kelas.id_mapel_kelas, id_mapel, id_kelas FROM `kkm_mapel` JOIN mapel_kelas ON mapel_kelas.id_mapel_kelas=kkm_mapel.id_mapel_kelas WHERE id_kkm = $id")->row_array();

    		if(!empty($data)){
                echo json_encode($data);
            }else{
                $data_kosong = '';
                echo json_encode($data_kosong);
            }
    	}

    	if (isset($_POST['simpan'])) {
            $this->form_validation->set_rules('kelas', 'Kelas', 'required|trim', ['required' => '{field} tidak boleh kosong']);
            $this->form_validation->set_rules('kkm', 'KKM', 'required|trim', ['required' => '{field} tidak boleh kosong']);

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg_failed', 'Maaf, data kelas gagal diperbarui');
                redirect('tatausaha/kkm');
            }else{
                $data = [
                    'id_mapel_kelas' => $this->input->post('kelas'),
                    'kkm' => $this->input->post('kkm', true)
                ];

                if ($this->db->update('kkm_mapel', $data, ['id_kkm' => $this->input->post('id')])) {
                    $this->session->set_flashdata('msg_success', 'Selamat, data berhasil diperbarui');
                    redirect('tatausaha/kkm');
                }else{
                    $this->session->set_flashdata('msg_failed', 'Maaf, data gagal diperbarui');
                    redirect('tatausaha/kkm');
                }
            }
    	}
    }

    public function delete($id){
    	$delete = $this->db->delete('kkm_mapel', ['id_kkm'=> $id]);

    	if ($delete) {
    		$this->session->set_flashdata('msg_success', 'Selamat, data berhasil dihapus');
    		http_response_code(200);
    	}else{
    		$this->session->set_flashdata('msg_failed', 'Selamat, data gagal dihapus');
    		http_response_code(404);
    	}
    }
}