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

    public function ambilKelasSiswa($nisn){
        //kelas sekarang
        $kelas_sekarang = $this->db->query("SELECT `id_kelas` FROM `siswa` WHERE `nisn` = $nisn")->row_array();

        //riwayat kelas 
        $riwayat = $this->db->query("SELECT GROUP_CONCAT(id_kelas) AS kelas FROM `riwayat_kelas` WHERE `nisn` = $nisn");
        $kelas_riwayat = $riwayat->row_array();
        $kelas_riwayat = $kelas_riwayat['kelas'];

        if($riwayat->num_rows() > 0){
           $kelas = explode(',', $kelas_riwayat);

           array_push($kelas, $kelas_sekarang['id_kelas']);
        }else{
            $kelas = array_push($kelas_sekarang, $kelas_riwayat);
        }

        return array_filter($kelas);
    }
}
