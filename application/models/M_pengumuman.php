<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class M_pengumuman extends CI_Model
{

    public function getPengumuman(){
        return $this->db->query("SELECT `id_pengumuman`,`tanggal`, `konten`, `gambar`, gtk.nama, gtk.foto FROM `pengumuman` JOIN tenaga_kependidikan AS gtk ON gtk.id_gtk=pengumuman.id_gtk ORDER BY tanggal DESC")->result_array();
    }
}