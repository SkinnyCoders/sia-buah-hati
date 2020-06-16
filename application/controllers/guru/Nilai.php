<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Nilai extends CI_controller
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
    }

    public function index()
    {
        $id_tahun =  getIdTahun(getTahun());
        $nip = $this->session->userdata('username');
        $data['title'] = 'Daftar Siswa Nilai';
        $data['kelas'] = $this->db->query("SELECT kelas.id_kelas, kelas.nama_kelas FROM `guru_kelas` JOIN tenaga_kependidikan AS gtk ON gtk.id_tenaga_kependidikan=guru_kelas.id_gtk JOIN kelas ON kelas.id_kelas=guru_kelas.id_kelas WHERE gtk.nip = $nip ")->result_array();
        $data['tahun_ajaran'] = $this->db->get_where('tahun_ajaran', ['id_tahun_ajaran' => getIdTahun(getTahun())])->row_array();
        getViews($data, 'v_guru/v_list_siswa_nilai');
    }

    public function get_siswa(){
        if(isset($_POST['kelas'])){
            $id_kelas = $_POST['kelas'];
            $data = $this->db->query("SELECT * FROM `siswa` JOIN kelas ON kelas.id_kelas=siswa.id_kelas WHERE siswa.id_kelas = $id_kelas")->result_array();

            echo json_encode($data);
        }
    }

    public function input($nisn){
        $data['title'] = 'Input Nilai Siswa';
        $data['siswa'] = $this->db->query("SELECT * FROM `siswa` JOIN kelas ON kelas.id_kelas=siswa.id_kelas WHERE siswa.nisn = $nisn")->row_array();
        $data['mapel'] = $this->db->query("SELECT * FROM `mapel_kelas` JOIN mata_pelajaran ON mata_pelajaran.kode_mapel=mapel_kelas.kode_mapel WHERE mapel_kelas.id_kelas = ".$data['siswa']['id_kelas'])->result_array();

        $this->form_validation->set_rules('nisn', 'NISN', 'required|trim', ['required' => '{field} tidak boleh kosong']);
       // $this->form_validation->set_rules('tugas', 'NISN', 'required|trim', ['required' => '{field} tidak boleh kosong']);

        if($this->form_validation->run() == FALSE){
            getViews($data, 'v_guru/v_input_nilai');
        }else{
            $nisn = $this->input->post('nisn');
            $kelas = $this->input->post('kelas');
            $kode_mapel = $_POST['kode_mapel'];

            $flag = true;
            for($i=0; $i<count($kode_mapel); $i++){
                $tugas = $_POST['tugas'][$i];
                $uts   = $_POST['uts'][$i];
                $uas   = $_POST['uas'][$i];

                //proses total nilai
                $total = $uts + $uas + $tugas;
                $totalNilai = $total/3;
                
                if(strpos($totalNilai,'.')){
                    //pembulatan nilai
                    $angkaDibelakangKoma = explode('.', $totalNilai);
                    if($angkaDibelakangKoma > 5){
                        $TotalNilai = ceil($totalNilai);
                    }else{
                        $TotalNilai = floor($totalNilai);
                    }
                }else{
                    $TotalNilai = $totalNilai;
                }
                
                $data = [
                    'nisn' => $nisn,
                    'id_kelas' => $kelas,
                    'id_tahun_ajaran' => getIdTahun(getTahun()),
                    'kode_mapel' => $kode_mapel[$i],
                    'nilai_harian' => $tugas,
                    'nilai_uts' => $uts,
                    'nilai_uas' => $uas,
                    'nilai_total' => $TotalNilai
                ];

                $insertNilai = $this->db->insert('nilai', $data);
                if($insertNilai){
                    $flag = true;
                }else{
                    $flag = false;
                }
            }

            if($flag){
                //cek naik kelas atau tidak
                if(isset($_POST['naik_kelas']) && $_POST['naik_kelas'] == 'on'){
                    //naik
                    //insert to table riwayat_kelas
                    $data_riwayat = [
                        'nisn' => $nisn,
                        'id_kelas' => $kelas,
                        'id_tahun_ajaran' => getIdTahun(getTahun())
                    ];
                    $insertRiwayat = $this->db->insert('riwayat_kelas', $data_riwayat);

                    if($insertRiwayat){
                        //update idkelas di siswa
                        $id_kelas_new = $kelas + 1;

                        $cekKelasbaru = $this->db->get_where('kelas', ['id_kelas' => $id_kelas_new])->num_rows();
                        if($cekKelasbaru > 0){
                            $data_kelas = [
                                'id_kelas' => $id_kelas_new
                            ];

                            $updateKelas = $this->db->update('siswa', $data_kelas, ['nisn' => $nisn]);

                            if($updateKelas){
                                $this->session->set_flashdata('msg_success', 'Selamat, Nilai berhasil diinputkan');
                                http_response_code(200);
                            }else{
                                $this->session->set_flashdata('msg_failed', 'Maaf, Nilai gagal diinputkan');
                                http_response_code(500);
                            }
                        }// else bisa masukan ke lulus
                    }
                }else{
                    //tidak
                    $this->session->set_flashdata('msg_success', 'Selamat, Nilai berhasil diinputkan');
                    http_response_code(200);
                }
            }
        }
    }

}
