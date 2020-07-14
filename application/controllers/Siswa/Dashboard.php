<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Dashboard extends CI_controller
{
    /**
     * Constructs a new instance.
     */
    function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuthSiswa();
        $this->load->model('m_admin');
        $this->load->model('m_pengumuman');
        $this->load->model('m_siswa');
    }

    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $hari = $this->hari(date('l'));
        $nisn = $this->session->userdata('nisn');
        $data['title'] = 'Dashboard';
        $data['jadwal'] = $this->db->query("SELECT * FROM `jadwal` JOIN kelas ON kelas.id_kelas=jadwal.id_kelas JOIN mapel ON mapel.id_mapel=jadwal.id_mapel JOIN siswa ON siswa.id_kelas=jadwal.id_kelas WHERE siswa.nisn = $nisn AND jadwal.hari = '$hari'")->result_array();
        $data['pengumumans'] = $this->m_pengumuman->getPengumuman();
        $data['absensi'] = $this->m_siswa->getAbsensi($nisn, date('Y-m-d'));
        getViews($data, 'v_siswa/dashboard');
    }

    public function hari($hari){
        switch($hari){
            case 'Monday':
                $hasil = 'senin';
            break;

            case 'Tuesday':
                $hasil = 'selasa';
            break;

            case 'Wednesday':
                $hasil = 'rabu';
            break;

            case 'Thursday':
                $hasil = 'kamis';
            break;

            case 'Friday':
                $hasil = 'jumat';
            break;

            case 'Saturday':
                $hasil = 'sabtu';
            break;

            case 'Sunday':
                $hasil = 'minggu';
            break;
        }

        return $hasil;
    }

}
