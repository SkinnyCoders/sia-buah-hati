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
        $this->load->model('m_tatausaha');
    }

    public function index(){
    	$data = [
            'title' => 'Daftar Semester',
            'tahun_ajaran' => $this->db->get('tahun_ajaran')->result_array(),
            'semesters' => $this->m_tatausaha->getSemester()
    	];

    	getViews($data,'v_tatausaha/v_semester');
    }

    public function tambah(){
    
        $this->form_validation->set_rules('semester', 'Semester', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tgl_akhir', 'Tanggal Berakhir', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required', ['required' => '{field} tidak boleh kosong']);

        if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('msg_failed', 'Maaf data semester gagal disimpan');
            redirect('tatausaha/semester');
        }else{
            if($this->input->post('tgl_mulai') > $this->input->post('tgl_akhir')){
                $this->session->set_flashdata('msg_failed', 'Maaf data semester gagal disimpan');
                redirect('tatausaha/semester');
                return false;
            }

            $tgl_mulai = DateTime::createFromFormat('m/d/Y', $this->input->post('tgl_mulai'))->format('Y-m-d');
            $tgl_akhir = DateTime::createFromFormat('m/d/Y', $this->input->post('tgl_akhir'))->format('Y-m-d');

            $data = [
                'semester' => $this->input->post('semester', true),
                'tanggal_mulai' => $tgl_mulai,
                'tanggal_akhir' => $tgl_akhir,
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

    public function update(){
    	if (isset($_POST['id_get_update']) && !empty($_POST['id_get_update'])) {
    		$id = $_POST['id_get_update'];

            $data = $this->db->get_where('semester', ['id_semester' => $id])->row_array();
            
            $tgl_mulai = DateTime::createFromFormat('Y-m-d', $data['tanggal_mulai'])->format('m/d/Y');
            $tgl_akhir = DateTime::createFromFormat('Y-m-d', $data['tanggal_akhir'])->format('m/d/Y');

            $data_semester = [
                'id' => $data['id_semester'],
                'semester' => $data['semester'],
                'tanggal_mulai' => $tgl_mulai,
                'tanggal_akhir' => $tgl_akhir,
                'tahun_ajaran' => $data['id_tahun_pelajaran']
            ];

    		echo json_encode($data_semester);
    	}

    	if (isset($_POST['simpan'])) {
    
            $this->form_validation->set_rules('semester', 'Semester', 'required', ['required' => '{field} tidak boleh kosong']);
            $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required', ['required' => '{field} tidak boleh kosong']);
            $this->form_validation->set_rules('tgl_akhir', 'Tanggal Berakhir', 'required', ['required' => '{field} tidak boleh kosong']);
            $this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required', ['required' => '{field} tidak boleh kosong']);

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg_failed', 'Maaf, data semester gagal diperbarui');
                redirect('tatausaha/semester');
            }else{

                if($this->input->post('tgl_mulai') > $this->input->post('tgl_akhir')){
                    $this->session->set_flashdata('msg_failed', 'Maaf data semester gagal diperbarui');
                    redirect('tatausaha/semester');
                    return false;
                }
    
                $tgl_mulai = DateTime::createFromFormat('m/d/Y', $this->input->post('tgl_mulai'))->format('Y-m-d');
                $tgl_akhir = DateTime::createFromFormat('m/d/Y', $this->input->post('tgl_akhir'))->format('Y-m-d');


                $data = [
                    'semester' => $this->input->post('semester', true),
                    'tanggal_mulai' => $tgl_mulai,
                    'tanggal_akhir' => $tgl_akhir,
                    'id_tahun_pelajaran' => $this->input->post('tahun_ajaran', true),
                ];

                if ($this->db->update('semester', $data, ['id_semester' => $this->input->post('id')])) {
                    $this->session->set_flashdata('msg_success', 'Selamat, data berhasil diperbarui');
                    redirect('tatausaha/semester');
                }else{
                    $this->session->set_flashdata('msg_failed', 'Maaf, data gagal diperbarui');
                    redirect('tatausaha/semester');
                }
            }
    	}
    }

    public function delete($id){
        $delete = $this->db->delete('semester', ['id_semester' => $id]);

        if($delete){
            $this->session->set_flashdata('msg_success', 'Selamat, data berhasil dihapus');
    		http_response_code(200);
        }else{
            $this->session->set_flashdata('msg_failed', 'Selamat, data gagal dihapus');
    		http_response_code(404);
        }
    }
}