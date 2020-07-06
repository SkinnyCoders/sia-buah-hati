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
    
    public function getJadwalGtk($id_gtk){
        return $this->db->query("SELECT gtk.nuptk, gtk.nama, mapel.nama_mapel, kelas.nama_kelas, jadwal.* FROM `jadwal` JOIN tenaga_kependidikan AS gtk ON gtk.id_gtk=jadwal.id_gtk JOIN mapel ON mapel.id_mapel=jadwal.id_mapel JOIN kelas ON kelas.id_kelas=jadwal.id_kelas WHERE jadwal.id_gtk = $id_gtk")->result_array();
    }
}
