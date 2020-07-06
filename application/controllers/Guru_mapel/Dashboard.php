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
        getAuthGuruMapel();
        $this->load->model('m_admin');
        $this->load->model('m_pengumuman');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Guru Kelas';
        $data['pengumumans'] = $this->m_pengumuman->getPengumuman();
        getViews($data, 'v_guru/dashboard');
    }

}
