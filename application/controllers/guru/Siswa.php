<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Siswa extends CI_controller
{
    /**
     * Constructs a new instance.
     */
    function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuthGuru();
        $this->load->helper('cektahun');
        $this->load->model('m_gtk');
    }

    public function index()
    {
        $id_tahun =  getIdTahun(getTahun());
        $nip = $this->session->userdata('username');
        $data['title'] = 'Daftar Siswa';
        $data['kelas'] = $this->db->query("SELECT kelas.id_kelas, kelas.nama_kelas FROM `guru_kelas` JOIN tenaga_kependidikan AS gtk ON gtk.id_tenaga_kependidikan=guru_kelas.id_gtk JOIN kelas ON kelas.id_kelas=guru_kelas.id_kelas WHERE gtk.nip = $nip ")->result_array();
        $data['tahun_ajaran'] = $this->db->get_where('tahun_ajaran', ['id_tahun_ajaran' => getIdTahun(getTahun())])->row_array();
        $data['siswa'] = $this->db->query("SELECT * FROM `siswa` JOIN kelas ON kelas.id_kelas=siswa.id_kelas WHERE siswa.id_kelas = 5")->result_array();
        getViews($data, 'v_guru/v_list_siswa');
    }

    public function detail(){
        if(isset($_POST['nisn']) && !empty($_POST['nisn'])){
            $nisn = $this->input->post('nisn');

            $siswa = $this->db->query("SELECT * FROM `siswa` JOIN kelas ON kelas.id_kelas=siswa.id_kelas WHERE siswa.nisn = $nisn")->row_array();
            if(!empty($siswa['jenis_kelamin'])){
                switch($siswa['jenis_kelamin']){
                    case 'L' :
                        $gender = 'Laki - Laki';
                    break;

                    case 'P' :
                        $gender  = 'Perempuan';
                    break;
                }
            }
            $data = [
                'nisn' => $siswa['nisn'],
                'nama' => $siswa['nama_siswa'],
                'jenis_kelamin' => $gender,
                'kelas' => $siswa['nama_kelas'],
                'tempat_lahir' => $siswa['tempat_lahir'],
                'tgl_lahir' => DateTime::createFromFormat('Y-m-d', $siswa['tanggal_lahir'])->format('d F Y'),
                'agama' => $siswa['agama'],
                'alamat' => $siswa['alamat'],
                'nama_ortu' => $siswa['nama_ortu'],
                'telepon_ortu' => $siswa['telepon_ortu'],
                'alamat_ortu' => $siswa['alamat_ortu'],
                'pekerjaan_ortu' => $siswa['pekerjaan_ortu'],
                'penghasilan' => $siswa['penghasilan_ortu']
            ];

            echo json_encode($data);
        }else{}
    }

    public function nilai($nisn){
        $data['title'] = "Detail Nilai Siswa"; 
        $data['siswa'] = $this->db->query("SELECT * FROM `siswa` JOIN kelas ON kelas.id_kelas=siswa.id_kelas WHERE siswa.nisn = $nisn")->row_array();
        $data['kelas'] = $this->m_gtk->ambilKelasSiswa($nisn);

        getViews($data, 'v_guru/v_detail_nilai');
    }

    public function get_siswa(){
        if(isset($_POST['kelas'])){
            $id_kelas = $_POST['kelas'];
            $data = $this->db->query("SELECT * FROM `siswa` JOIN kelas ON kelas.id_kelas=siswa.id_kelas JOIN pendaftaran ON pendaftaran.nisn=siswa.nisn WHERE pendaftaran.status = 'terima' AND siswa.id_kelas = $id_kelas")->result_array();

            echo json_encode($data);
        }
    }

}
