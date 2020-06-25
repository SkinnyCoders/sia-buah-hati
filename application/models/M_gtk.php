<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_gtk extends CI_Model
{ 
    public function getAllGtk(){
        return $this->db->get('tenaga_kependidikan')->result_array();
    }

	public function getSemester(){
		return $this->db->query("SELECT * FROM `semester` JOIN tahun_ajaran ON tahun_ajaran.id_tahun_ajaran=semester.id_tahun_pelajaran WHERE 1 ORDER BY `tanggal_mulai` DESC")->result_array();
	}
}
