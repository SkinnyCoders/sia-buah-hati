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
        getAuthGuruKelas();
        $this->load->model('m_gtk');
    }

    public function index()
    {
        $id_gtk = $this->session->userdata('id_gtk');
        $data['title'] = 'Jadwal Mengajar';
        $data['jadwal'] = $this->m_gtk->getJadwalGtk($id_gtk);
        getViews($data, 'v_guru/v_jadwal');
    }

}
