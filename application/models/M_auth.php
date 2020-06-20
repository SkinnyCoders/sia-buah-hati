<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class M_auth extends CI_Model
{

    public function cekUserTatausaha($email){
        $this->db->select('*');
        $this->db->from('tenaga_kependidikan');
        $this->db->where('username', $email);
        return $this->db->get()->row_array();
    }

    public function cekUserGuru($email){
        $this->db->select('*');
        $this->db->from('tenaga_kependidikan');
        $this->db->where('nip', $email);
        $this->db->where('hak_akses', 'guru');
        return $this->db->get()->row_array();
    }

    public function cekUserPegawai($email){
        $this->db->select('*');
        $this->db->from('tenaga_kependidikan');
        $this->db->where('nip', $email);
        $this->db->where('hak_akses', 'pegawai');
        return $this->db->get()->row_array();
    }

    public function updateStatus($id, $status){
    	//update login status
        $this->db->set('login_status', $status);
        $this->db->where('id_pengguna',$id);
        return $this->db->update('pengguna');
    }
}