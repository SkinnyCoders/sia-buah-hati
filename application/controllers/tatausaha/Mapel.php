<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Mapel extends CI_controller
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
            'title' => 'Daftar Mata Pelajaran',
            'mapels' => $this->db->get('mapel')->result_array()
    	];

    	getViews($data,'v_tatausaha/v_mapel');
    }

    public function tambah(){

        $this->form_validation->set_rules('mapel', 'Nama Mapel', 'required|trim', ['required' => '{field} tidak boleh kosong']);

    	if ($this->form_validation->run() == FALSE) {
    		$this->session->set_flashdata('msg_failed', 'Maaf, data gagal ditambahkan');
            redirect('tatausaha/mapel');
    	}else{
    		$data = [
                'nama_mapel' => $this->input->post('mapel', true)
    		];

    		if (insertData('mapel', $data)) {
    			$this->session->set_flashdata('msg_success', 'Selamat, data berhasil ditambahkan');
                redirect('tatausaha/mapel');
    		}else{
    			$this->session->set_flashdata('msg_failed', 'Maaf, data gagal ditambahkan');
                redirect('tatausaha/mapel');
    		}
    	}
    }

    public function update(){
    	if (isset($_POST['id_get_update']) && !empty($_POST['id_get_update'])) {
    		$id = $_POST['id_get_update'];

    		$data = $this->db->get_where('mapel', ['id_mapel' => $id])->row_array();

    		echo json_encode($data);
    	}

    	if (isset($_POST['simpan'])) {
    
            $this->form_validation->set_rules('mapel', 'Nama Mapel', 'required|trim', ['required' => '{field} tidak boleh kosong']);

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg_failed', 'Maaf, data kelas gagal diperbarui');
                redirect('tatausaha/mapel');
            }else{
                $data = [
                    'nama_mapel' => $this->input->post('mapel', true)
                ];

                if ($this->db->update('mapel', $data, ['id_mapel' => $this->input->post('id')])) {
                    $this->session->set_flashdata('msg_success', 'Selamat, data berhasil diperbarui');
                    redirect('tatausaha/mapel');
                }else{
                    $this->session->set_flashdata('msg_failed', 'Maaf, data gagal diperbarui');
                    redirect('tatausaha/mapel');
                }
            }
    	}
    }

    public function mapel_kelas(){
        $data = [
            'title' => 'Konfigurasi Mapel Kelas',
            'mapel' => $this->db->get('mata_pelajaran')->result_array(),
            'list' => $this->db->query("SELECT GROUP_CONCAT(kelas.nama_kelas) AS kelas, mapel.nama_mapel, mapel.kode_mapel FROM `mapel_kelas` JOIN mata_pelajaran AS mapel ON mapel.kode_mapel=mapel_kelas.kode_mapel JOIN kelas ON kelas.id_kelas=mapel_kelas.id_kelas GROUP BY mapel.kode_mapel")->result_array(),
            'kelas_list' => $this->db->get('kelas')->result_array()
            
        ];

        $this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'required|trim', ['required' => '{field} tidak boleh kosong']);

        if($this->form_validation->run() == FALSE){
            getViews($data,'v_admin/v_mapel_kelas');
        }else{
            $datakelas = $this->input->post('datakelas');
            $flag = true;
            for($i=0; $i<count($datakelas); $i++){
                $data = [
                    'kode_mapel' => $this->input->post('mapel'),
                    'id_kelas' => $datakelas[$i]
                ];

                if(!$this->db->insert('mapel_kelas', $data)){
                    $flag = false;
                }
            }

            if($flag){
                $this->session->set_flashdata('msg_success', 'Selamat, data berhasil ditambahkan');
                redirect('admin/mapel/mapel_kelas');
            }else{
                $this->session->set_flashdata('msg_failed', 'Maaf, data gagal ditambahkan');
                redirect('admin/mapel/mapel_kelas');
            }
        }
    }

    public function update_mapel_kelas(){
        if(isset($_POST['id_get_update'])){
            $id_kode_mapel = $_POST['id_get_update'];

            $data = $this->db->get_where('mapel_kelas', ['kode_mapel' => $id_kode_mapel])->result_array();

            foreach($data AS $d){
                $id_kelas[] = $d['id_kelas'];
            }

            $datafinal = [
                'id_kelas' => $id_kelas,
                'kode_mapel' => $data[0]['kode_mapel']
            ];

            echo json_encode($datafinal);
        }elseif(isset($_POST['kode_mapel']) && !empty($_POST['kode_mapel'])){
            $kode_mapel =  $this->input->post('kode_mapel');

            $delete = $this->db->delete('mapel_kelas', ['kode_mapel' => $kode_mapel]);

            if($delete){
                $datakelas = $this->input->post('kelas');
                $flag = true;
                for($i=0; $i<count($datakelas); $i++){
                    $data = [
                        'kode_mapel' => $this->input->post('kode_mapel'),
                        'id_kelas' => $datakelas[$i]
                    ];

                    if(!$this->db->insert('mapel_kelas', $data)){
                        $flag = false;
                    }
                }

                if($flag){
                    $this->session->set_flashdata('msg_success', 'Selamat, data berhasil diperbaharui');
                    redirect('admin/mapel/mapel_kelas');
                }else{
                    $this->session->set_flashdata('msg_failed', 'Maaf, data gagal diperbaharui');
                    redirect('admin/mapel/mapel_kelas');
                }
            }else{
                $this->session->set_flashdata('msg_failed', 'Maaf, data gagal diperbaharui');
                redirect('admin/mapel/mapel_kelas');
            }
            
            
        }
    }

    public function delete_konfigurasi($id){
    	$delete = $this->db->delete('mapel_kelas', ['kode_mapel'=> $id]);

    	if ($delete) {
    		$this->session->set_flashdata('msg_success', 'Selamat, data berhasil dihapus');
    		http_response_code(200);
    	}else{
    		$this->session->set_flashdata('msg_failed', 'Selamat, data gagal dihapus');
    		http_response_code(404);
    	}
    }

    public function delete($id){
    	$delete = $this->db->delete('mapel', ['id_mapel'=> $id]);

    	if ($delete) {
    		$this->session->set_flashdata('msg_success', 'Selamat, data berhasil dihapus');
    		http_response_code(200);
    	}else{
    		$this->session->set_flashdata('msg_failed', 'Selamat, data gagal dihapus');
    		http_response_code(404);
    	}
    }
}