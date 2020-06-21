<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_tatausaha extends CI_Model
{ 
	public function getSemester(){
		return $this->db->query("SELECT * FROM `semester` JOIN tahun_ajaran ON tahun_ajaran.id_tahun_ajaran=semester.id_tahun_pelajaran WHERE 1 ORDER BY `tanggal_mulai` DESC")->result_array();
	}
}
