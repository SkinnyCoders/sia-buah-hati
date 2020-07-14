<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Absensi extends CI_controller
{

    function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuthGuruKelas();
        $this->load->model('m_tatausaha');
    }

    public function index(){
        $id_gtk = $this->session->userdata('id_gtk');
        $kelas = $this->db->query("SELECT `id_kelas` FROM `guru_kelas` WHERE `id_gtk` = $id_gtk")->row_array();
        $kelas = $kelas['id_kelas'];
    	$data = [
            'title' => 'Data Absensi ',
            'nama_kelas' => $this->db->get_where('kelas', ['id_kelas' => $kelas])->row_array()
        ];
        if(isset($_POST['tgl']) && !empty($_POST['tgl'])){
            if($_POST['tgl'] > date('m/d/Y')){
                $this->session->set_flashdata('msg_failed', 'Maaf, Data tanggal tidak boleh melebihi hari ini');
                redirect('guru_kelas/absensi');
            }

            $this->form_validation->set_rules('tgl','Tanggal', 'required', ['required' => '{field} tidak boleh kosong']);

            if ($this->form_validation->run() == FALSE) {
                getViews($data,'v_tatausaha/v_absensi');
            }else{
                $tanggal = DateTime::createFromFormat('m/d/Y', $this->input->post('tgl'))->format('Y-m-d');

                $data['absensi'] = $this->m_tatausaha->getDataAbsensi($kelas, $tanggal);

                if (empty($data['absensi'])) {
                    $this->session->set_flashdata('msg_failed', 'Maaf, Data siswa tidak ditemukan');
                    redirect('guru_kelas/absensi');
                }else{
                    getViews($data,'v_guru/v_absensi');
                }
            }
        }else{
            $tanggal = date('Y-m-d');

            $data['absensi'] = $this->m_tatausaha->getDataAbsensi($kelas, $tanggal);

            if (empty($data['absensi'])) {
                $this->session->set_flashdata('msg_failed', 'Maaf, Data siswa tidak ditemukan');
                redirect('guru_kelas/absensi');
            }else{
                getViews($data,'v_guru/v_absensi');
            }
        }
    }
}