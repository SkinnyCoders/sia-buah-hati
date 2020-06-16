<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Event extends CI_controller
{
	public function __construct()
	{
        parent::__construct();
        $this->load->model('m_home');
    }

    public function index(){
        $data['title'] = "Event";
        $data['event'] = $this->m_home->getEventAll();
        $this->load->view('v_home/v_list_event', $data);
    }

    public function detail($slug){
        $data['event'] = $this->m_home->getDetailEvent($slug);
        $data['title'] = $data['event']['judul_event'].' | Detail Event';
        
        $this->load->view('v_home/v_detail_event', $data);
    }
}