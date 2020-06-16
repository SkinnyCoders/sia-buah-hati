<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('m_home');
	}

	public function index(){
		$data['title'] = "SI Alumni SMK Pancasila 7";
	
		$this->load->view('v_home/v_registrasi', $data);
	}
}