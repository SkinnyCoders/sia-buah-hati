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
        getAuthPegawai();
        $this->load->helper('cektahun');
    }

    public function index()
    {
        $id_tahun =  getIdTahun(getTahun());
        $data['title'] = 'Daftar Siswa';
        $total_pendaftar = $this->db->get('pendaftaran')->num_rows();
        $total_terima = $this->db->get_where('pendaftaran', ['status' => 'terima'])->num_rows();
        $total_tolak = $this->db->get_where('pendaftaran', ['status' => 'tolak'])->num_rows();
        $total_proses = $this->db->get_where('pendaftaran', ['status' => 'menunggu'])->num_rows();
        $data['total'] = [$total_pendaftar, $total_terima, $total_tolak, $total_proses];
        $data['tahun_ajaran'] = $this->db->get_where('tahun_ajaran', ['id_tahun_ajaran' => getIdTahun(getTahun())])->row_array();
        $data['siswa'] = $this->db->query("SELECT * FROM `siswa` JOIN pendaftaran ON pendaftaran.nisn=siswa.nisn JOIN tahun_ajaran ON tahun_ajaran.id_tahun_ajaran=pendaftaran.id_tahun_ajaran JOIN kelas ON kelas.id_kelas=siswa.id_kelas WHERE pendaftaran.status != 'menunggu' AND pendaftaran.id_tahun_ajaran = $id_tahun")->result_array();
        getViews($data, 'v_pegawai/v_list_siswa');
    }

    public function get_peserta(){
        $id_tahun =  getIdTahun(getTahun());

        $data = $this->db->query("SELECT pendaftaran.id_pendaftaran, siswa.nama_siswa, siswa.nisn, siswa.jenis_kelamin, pendaftaran.kode_pendaftaran FROM `pendaftaran` JOIN siswa ON siswa.nisn=pendaftaran.nisn WHERE pendaftaran.id_tahun_ajaran = $id_tahun AND pendaftaran.status = 'menunggu' ORDER BY siswa.nisn DESC")->result_array();

        echo json_encode($data);
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

    public function penerimaan(){
        if(isset($_POST['simpan'])){
            $terima = $_POST['terima'];
            $total = count($terima);

            $flag = true;
            foreach ($terima as $t) {
                $id_pendaftaran = $_POST['id_pendaftaran' . $t];

                $this->db->set('status', 'terima');
                $this->db->where('id_pendaftaran', $id_pendaftaran);
                $proses = $this->db->update('pendaftaran');

                if($proses){
                    $flag = true;
                }else{
                    $flag = false;
                }
            }

            if ($flag) {
                $this->session->set_flashdata('msg_success', 'Selamt, berhasil melakukan penerimaan peserta');
                redirect('pegawai/siswa');
            } else {
                $this->session->set_flashdata('msg_failed', 'Maaf, gagal melakukan penerimaan peserta');
                redirect('pegawai/siswa');
            }
        }elseif(isset($_POST['tolak']) && $_POST['tolak'] == 'true'){
            $terima = $_POST['terima'];
            $total = count($terima);

            $flag = true;
            foreach ($terima as $t) {
                $id_pendaftaran = $_POST['id_pendaftaran' . $t];

                $this->db->set('status', 'tolak');
                $this->db->where('id_pendaftaran', $id_pendaftaran);
                $proses = $this->db->update('pendaftaran');

                if($proses){
                    $flag = true;
                }else{
                    $flag = false;
                }
            }

            if ($flag) {
                $this->session->set_flashdata('msg_success', 'Selamt, berhasil melakukan penolakan peserta');
                redirect('pegawai/siswa');
            } else {
                $this->session->set_flashdata('msg_failed', 'Maaf, gagal melakukan penolakan peserta');
                redirect('pegawai/siswa');
            }
        }
    }

}
