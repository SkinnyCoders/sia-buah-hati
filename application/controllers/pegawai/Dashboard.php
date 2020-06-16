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
        getAuthPegawai();
        $this->load->model('m_admin');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Pegawai';
        $total_pendaftar = $this->db->get('pendaftaran')->num_rows();
        $total_terima = $this->db->get_where('pendaftaran', ['status' => 'terima'])->num_rows();
        $total_tolak = $this->db->get_where('pendaftaran', ['status' => 'tolak'])->num_rows();
        $total_proses = $this->db->get_where('pendaftaran', ['status' => 'menunggu'])->num_rows();
        $data['total'] = [$total_pendaftar, $total_terima, $total_tolak, $total_proses];
        getViews($data, 'v_pegawai/dashboard');
    }

}
