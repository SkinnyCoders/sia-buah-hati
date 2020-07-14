<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Jadwal extends CI_controller
{
    /**
     * Constructs a new instance.
     */
    function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuthSiswa();
        $this->load->model('m_siswa');
    }

    public function index()
    {
        $nisn = $this->session->userdata('nisn');
        $data['title'] = 'Jadwal Pelajaran';
        $data['jadwal'] = $this->m_siswa->getJadwalSiswa($nisn);
        getViews($data, 'v_siswa/v_jadwal');
    }

    public function get_hari(){
        $nisn = $this->session->userdata('nisn');
        $data['title'] = 'Jadwal Pelajaran';
        if(isset($_POST['hari']) && !empty($_POST['hari'])){
            $hari = $_POST['hari'];
                $data['jadwal'] = $this->m_siswa->getJadwalSiswaHari($nisn, $hari);
        }else{
            //pilih hari 
            $data['jadwal'] = $this->m_siswa->getJadwalSiswa($nisn);
        }
        getViews($data, 'v_siswa/v_jadwal');

    }

}
