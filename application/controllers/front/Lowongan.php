<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Lowongan extends CI_controller
{
	public function __construct()
	{
        parent::__construct();
        $this->load->model('m_home');
    }

    public function index(){
        $data['title'] = "Lowongan";
        $data['lowongan'] = $this->m_home->getLowonganAll();
        $this->load->view('v_home/v_list_lowongan', $data);
    }

    public function detail($slug){
        $data['lowongan'] = $this->m_home->getDetailLowongan($slug);
        $data['title'] = $data['lowongan']['posisi_pekerjaan'].' - '.$data['lowongan']['perusahaan'].' | Detail Lowongan';
        
        $this->load->view('v_home/v_detail_lowongan', $data);
    }
}