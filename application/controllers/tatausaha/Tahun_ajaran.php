<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Tahun_ajaran extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuthTatausaha();

        //load whatever you want bitch!!
        $this->load->model('m_tahun_ajaran');
    }

    public function index()
    {
        $data['tahun_ajaran'] = $this->m_tahun_ajaran->getAll();

        $this->form_validation->set_rules('tahun1', 'Tahun Awal', 'required|trim');
        $this->form_validation->set_rules('tahun2', 'Tahun Akhir', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tahun Ajaran';

            getViews($data, 'v_tatausaha/v_tahun_ajaran');
        } else {
            //insert new data
            $tahun1 = $this->input->post('tahun1', true);
            $tahun2 = $this->input->post('tahun2', true);

            if ($tahun2 > $tahun1 + 1) {
                $this->session->set_flashdata('msg_failed', 'Tahun Akhir tidak boleh lebih dari satu tahun!');
                redirect('tatausaha/tahun_ajaran');
                return false;
            }

            if ($tahun1 >= $tahun2) {
                $this->session->set_flashdata('msg_failed', 'Tahun Akhir tidak boleh kurang atau sama dengan tahun awal!');
                redirect('tatausaha/tahun_ajaran');
                return false;
            }

            for ($i = 0; $i < count($data['tahun_ajaran']); $i++) {
                if ($data['tahun_ajaran'][$i]['tahun_mulai'] == $tahun1 && $data['tahun_ajaran'][$i]['tahun_akhir'] == $tahun2) {
                    $this->session->set_flashdata('msg_failed', 'Tahun Ajaran sudah ada!');
                    redirect('tatausaha/tahun_ajaran');
                    return false;
                }
            }

            $data = [
                'tahun_mulai' => $tahun1,
                'tahun_akhir' => $tahun2
            ];

            if ($this->m_tahun_ajaran->addTahun($data)) {
                $this->session->set_flashdata('msg_success', 'Selamat, data tahun ajaran berhasil ditambahkan');
                redirect('tatausaha/tahun_ajaran');
            } else {
                $this->session->set_flashdata('msg_failed', 'Maaf, data tahun ajaran gagal ditambahkan');
                redirect('tatausaha/tahun_ajaran');
            }
        }
    }

    public function update()
    {
        //getting data for update
        if (isset($_POST['id_get_update']) && !empty($_POST['id_get_update'])) {
            $id_tahunAjaran = $_POST['id_get_update'];

            $tahunAjaran = $this->db->get_where('tahun_ajaran', ['id_tahun_ajaran' => $id_tahunAjaran])->row_array();

            echo json_encode($tahunAjaran);
        }

        if (isset($_POST['simpan'])) {
            $id = $_POST['id'];

            $this->form_validation->set_rules('tahun1', 'Tahun Awal', 'required|trim');
            $this->form_validation->set_rules('tahun2', 'Tahun Akhir', 'required|trim');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg_failed', 'Maaf, Data tahun ajaran gagal diperbarui');
                redirect('tatausaha/tahun_ajaran');
            } else {

                $tahun1 = $this->input->post('tahun1', true);
                $tahun2 = $this->input->post('tahun2', true);

                if ($tahun2 > $tahun1 + 1) {
                    $this->session->set_flashdata('msg_failed', 'Tahun Akhir tidak boleh lebih dari satu tahun!');
                    redirect('tatausaha/tahun_ajaran');
                    return false;
                }

                if ($tahun1 >= $tahun2) {
                    $this->session->set_flashdata('msg_failed', 'Tahun Akhir tidak boleh kurang atau sama dengan tahun awal!');
                    redirect('tatausaha/tahun_ajaran');
                    return false;
                }

                $data = [
                    'tahun_mulai' => $tahun1,
                    'tahun_akhir' => $tahun2
                ];

                if ($this->db->update('tahun_ajaran', $data, ['id_tahun_ajaran' => $id])) {
                    $this->session->set_flashdata('msg_success', 'Selamat, Data tahun ajaran berhasil diperbarui');
                    redirect('tatausaha/tahun_ajaran');
                } else {
                    $this->session->set_flashdata('msg_failed', 'Maaf, Data tahun ajaran gagal diperbarui');
                    redirect('tatausaha/tahun_ajaran');
                }
            }
        }
    }

    public function delete($id)
    {
        $delete = $this->db->delete('tahun_ajaran', ['id_tahun_ajaran' => $id]);

        if ($delete) {
            $this->session->set_flashdata('msg_success', 'Selamat, Data tahun ajaran berhasil dihapus');
            http_response_code(200);
        } else {
            $this->session->set_flashdata('msg_failed', 'Maaf, Data tahun ajaran gagal dihapus');
            http_response_code(404);
        }
    }

    public function periode_daftar(){
        $cek_is_active = $this->db->get_where('tahun_ajaran', ['is_active' => 'true'])->num_rows();
        if($cek_is_active > 0){
            //update
            $this->form_validation->set_rules('periode', 'Periode Pendaftaran', 'required');
            if($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('msg_failed', 'Maaf, Harap pilih tahun ajaran');
                redirect('admin/tahun_ajaran');
            }else{
                $this->db->query("UPDATE `tahun_ajaran` SET `is_active`='false'");

                $id_tahun = $this->input->post('periode');
                $update = $this->db->query("UPDATE `tahun_ajaran` SET `is_active`='true' WHERE `id_tahun_ajaran` = $id_tahun");
                if($update){
                    $this->session->set_flashdata('msg_success', 'Selamat, periode pendaftaran berhasil di ubah');
                    redirect('admin/tahun_ajaran');
                }else{
                    $this->session->set_flashdata('msg_failed', 'Maaf, periode pendaftaran gagal di ubah');
                    redirect('admin/tahun_ajaran');
                }
            }
        }else{
            //set default
            date_default_timezone_set('Asia/Jakarta');
        	if (date('m') > '06') {
        		$tahun_now = date('Y');
        	}else{
        		$tahun_now = date('Y')-1;
            }

            $data = [
                'is_active' => 'true'
            ];
            
            $this->db->update('tahun_ajaran', $data, ['tahun_mulai' => $tahun_now]);
        }
    }
}
