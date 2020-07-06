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
        getAuthTatausaha();
        $this->load->model('m_tatausaha');
    }

    public function index(){
    	$data = [
            'title' => 'Data Absensi Perkelas',
            'kelas' => $this->db->get('kelas')->result_array()
        ];

        if(isset($_POST['tgl']) && !empty($_POST['tgl'])){
            if($_POST['tgl'] > date('m/d/Y')){
                $this->session->set_flashdata('msg_failed', 'Maaf, Data tanggal tidak boleh melebihi hari ini');
                redirect('tatausaha/absensi');
            }

            if(empty($_POST['kelas1'])){
                $this->session->set_flashdata('msg_failed', 'Maaf, Harap pilih kelas terlebih dahulu');
                redirect('tatausaha/absensi');
            }

            $this->form_validation->set_rules('kelas1','Kelas', 'required', ['required' => '{field} tidak boleh kosong']);
            $this->form_validation->set_rules('tgl','Tanggal', 'required', ['required' => '{field} tidak boleh kosong']);

            if ($this->form_validation->run() == FALSE) {
                getViews($data,'v_tatausaha/v_absensi');
            }else{
                $kelas = $this->input->post('kelas1', true);
                $tanggal = DateTime::createFromFormat('m/d/Y', $this->input->post('tgl'))->format('Y-m-d');

                $data['absensi'] = $this->m_tatausaha->getDataAbsensi($kelas, $tanggal);

                if (empty($data['absensi'])) {
                    $this->session->set_flashdata('msg_failed', 'Maaf, Data siswa tidak ditemukan');
                    redirect('tatausaha/absensi');
                }else{
                    getViews($data,'v_tatausaha/v_absensi');
                }
            }
        }else{
            $this->form_validation->set_rules('kelas','Kelas', 'required', ['required' => '{field} tidak boleh kosong']);

            if ($this->form_validation->run() == FALSE) {
                getViews($data,'v_tatausaha/v_absensi');
            }else{
                $kelas = $this->input->post('kelas', true);
                $tanggal = date('Y-m-d');

                $data['absensi'] = $this->m_tatausaha->getDataAbsensi($kelas, $tanggal);

                if (empty($data['absensi'])) {
                    $this->session->set_flashdata('msg_failed', 'Maaf, Data siswa tidak ditemukan');
                    redirect('tatausaha/absensi');
                }else{
                    getViews($data,'v_tatausaha/v_absensi');
                }
            }
        }
        
    }

    public function tambah(){
        $this->form_validation->set_rules('kelas_tambah', 'Kelas', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('siswa', 'Siswa', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('absen', 'Absen', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('ket', 'Keterangan', 'required', ['required' => '{field} tidak boleh kosong']);

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msg_failed', 'Maaf, Data absensi gagal ditambahkan');
            redirect('tatausaha/absensi');
        }else{
            //cek sudah diabsen blm
            $nisn = $this->input->post('siswa');
            $tanggal = date('Y-m-d');
            $cek = $this->db->query("SELECT * FROM `absensi` WHERE `nisn` = $nisn AND `tanggal_absen` = '$tanggal'")->num_rows();

            if ($cek > 0) {
                //sudah diabsen
                $this->session->set_flashdata('msg_failed', 'Maaf, Data siswa sudah diinputkan absensi');
                redirect('tatausaha/absensi');
            }else{
                $data = [
                    'nisn' => $nisn,
                    'tanggal_absen' => $tanggal,
                    'status' => $this->input->post('absen'),
                    'keterangan' => $this->input->post('ket')
                ];

                $insert = $this->db->insert('absensi', $data);
                if ($insert) {
                    $this->session->set_flashdata('msg_success', 'Data absensi berhasil diinputkan');
                    redirect('tatausaha/absensi');
                }else{
                    $this->session->set_flashdata('msg_failed', 'Maaf, Data Absensi gagal diinputkan');
                    redirect('tatausaha/absensi');
                }
            }
        }
    }

    public function get_siswa(){
        if (isset($_POST['id_kelas'])) {
            $id_kelas = $_POST['id_kelas'];
            $get_siswa = $this->db->get_where('siswa', ['id_kelas' => $id_kelas])->result_array();

            echo json_encode($get_siswa);
        }
    }

    public function update(){
        if(isset($_POST['nisn_update'])){
            $tanggal = $this->input->post('tanggal');
            $nisn = $this->input->post('nisn_update');
            $get = $this->db->query("SELECT * FROM `absensi` WHERE `nisn` = $nisn AND `tanggal_absen` = '$tanggal'");


            if($get->num_rows() > 0){
                $result = $get->row_array();
                //ijin
                $data = [
                    'nisn' => $result['nisn'],
                    'status' => $result['status'],
                    'tanggal' =>  $tanggal
                ];
            }else{
                //hadir
                $data = [
                    'nisn' => $this->input->post('nisn_update'),
                    'status' => 'hadir',
                    'tanggal' =>  $tanggal
                ];
            }

            echo json_encode($data);
        }

        if(isset($_POST['simpan'])){
            $nisn = $this->input->post('nisn');
            $status = $this->input->post('absensi');
            $ket = $this->input->post('keterangan');
            $tgl = $this->input->post('tanggal');

            if($status == 'hadir'){
                $update = $this->db->query("DELETE FROM absensi WHERE `nisn` = $nisn AND `tanggal_absen` = '$tgl'");
            }else{
                //cek sudah ada data blm
                $cek = $this->db->get_where('absensi', ['nisn' => $nisn, 'tanggal_absen' => $tgl])->num_rows();
                if($cek > 0){
                    $update = $this->db->query("UPDATE `absensi` SET `status`= '$status',`keterangan`= '$ket' WHERE `nisn` = $nisn AND `tanggal_absen` = '$tgl'");
                }else{
                    $data = [
                        'nisn' => $nisn,
                        'tanggal_absen' => $tgl,
                        'status' => $status,
                        'keterangan' => $ket
                    ];

                    $update = $this->db->insert('absensi', $data);
                }
            }

            if($update){
                $this->session->set_flashdata('msg_success', 'Selamat, Data berhasil diubah');
                redirect('tatausaha/absensi');
            }else{
                $this->session->set_flashdata('msg_failed', 'Maaf, Data gagal diubah');
                redirect('tatausaha/absensi');
            }
        }
    }
}