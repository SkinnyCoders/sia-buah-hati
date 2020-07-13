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
        getAuthGuruKelas();
        $this->load->model('m_admin');
        $this->load->model('m_pengumuman');
    }

    public function index()
    {
        $hari = $this->hari(date('l'));
        $data['title'] = 'Dashboard Guru Kelas';
        $id_gtk = $this->session->userdata('id_gtk');
        $data['pengumumans'] = $this->m_pengumuman->getPengumuman();
        $data['jadwal'] = $this->db->query("SELECT * FROM `jadwal` JOIN mapel ON mapel.id_mapel=jadwal.id_mapel JOIN kelas ON kelas.id_kelas=jadwal.id_kelas WHERE jadwal.id_gtk = $id_gtk AND jadwal.hari = '$hari'")->result_array();
        getViews($data, 'v_guru/dashboard');
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
