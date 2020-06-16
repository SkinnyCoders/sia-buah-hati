<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_admin extends CI_Model
{ 
	public function chartJurusan(){
		return $this->db->query("SELECT COUNT(nisn) AS total, jurusan.nama_jurusan FROM `alumni` JOIN jurusan ON jurusan.id_jurusan=alumni.id_jurusan GROUP BY jurusan.nama_jurusan")->result_array();
	}

	public function getGender(){
		$cowok = $this->db->get_where('alumni', ['jenis_kelamin' => 'L'])->num_rows();
		$cewek = $this->db->get_where('alumni', ['jenis_kelamin' => 'P'])->num_rows();

		return [$cowok, $cewek];
	}

	public function chartStatus(){
		$tidak = $this->db->query("SELECT alumni.nisn FROM alumni JOIN status_alumni ON status_alumni.nisn=alumni.nisn WHERE status_alumni.status = 'tidak'")->num_rows();

		$bekerja = $this->db->query("SELECT alumni.nisn FROM alumni JOIN status_alumni ON status_alumni.nisn=alumni.nisn WHERE status_alumni.status = 'bekerja'")->num_rows();

		$kuliah = $this->db->query("SELECT alumni.nisn FROM alumni JOIN status_alumni ON status_alumni.nisn=alumni.nisn WHERE status_alumni.status = 'kuliah'")->num_rows();

		$kuliah_kerja = $this->db->query("SELECT alumni.nisn FROM alumni JOIN status_alumni ON status_alumni.nisn=alumni.nisn WHERE status_alumni.status = 'bekerja kuliah'")->num_rows();

		return [$bekerja, $kuliah, $kuliah_kerja, $tidak];
	}

	public function getTotal(){
		$gtk = $this->db->get("tenaga_kependidikan")->num_rows();
		$kelas = $this->db->get("kelas")->num_rows();
		$mapel = $this->db->get("mata_pelajaran")->num_rows();
		return [$gtk, $kelas, $mapel];
	}
}
