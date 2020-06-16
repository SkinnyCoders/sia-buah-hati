<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_users extends CI_Model
{
    public function addUser($data)
    {
        return $this->db->insert('admin', $data);
    }

    public function cekUser($username)
    {
        return $this->db->get_where('admin', ['username' => $username])->num_rows();
    }

    public function getAllUser()
    {
        $this->db->select('id_pengguna, nama_pengguna, foto_pengguna, email_pengguna, jenis_kelamin, tgl_registrasi, nama_role');
        $this->db->from('pengguna');
        $this->db->join('role', 'role.id_role = pengguna.id_role');
        return $this->db->get()->result_array();
    }

    public function getUser($id)
    {
        return $this->db->get_where('admin', ['username' => $id])->result_array();
    }

    public function updateUser($data, $id)
    {
        $this->db->where('username', $id);
        return $this->db->update('admin', $data);
    }
}
