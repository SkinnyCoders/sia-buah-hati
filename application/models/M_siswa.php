<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_siswa extends CI_Model
{ 
    public function getAllSiswa(){
        $this->db->select('*');
        $this->db->from('siswa');
        $this->db->join('kelas', 'kelas.id_kelas=siswa.id_kelas');
        return $this->db->get()->result_array();
    }

	public function getSemester(){
		return $this->db->query("SELECT * FROM `semester` JOIN tahun_ajaran ON tahun_ajaran.id_tahun_ajaran=semester.id_tahun_pelajaran WHERE 1 ORDER BY `tanggal_mulai` DESC")->result_array();
	}
}
