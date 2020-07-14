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

    public function getJadwalSiswa($nisn){
        return $this->db->query("SELECT mapel.nama_mapel, kelas.nama_kelas, jadwal.* FROM `jadwal` JOIN mapel ON mapel.id_mapel=jadwal.id_mapel JOIN kelas ON kelas.id_kelas=jadwal.id_kelas JOIN siswa ON siswa.id_kelas=jadwal.id_kelas WHERE siswa.nisn = $nisn")->result_array();
    }

    public function getJadwalSiswaHari($nisn, $hari){
        return $this->db->query("SELECT mapel.nama_mapel, kelas.nama_kelas, jadwal.* FROM `jadwal` JOIN mapel ON mapel.id_mapel=jadwal.id_mapel JOIN kelas ON kelas.id_kelas=jadwal.id_kelas JOIN siswa ON siswa.id_kelas=jadwal.id_kelas WHERE siswa.nisn = $nisn AND jadwal.hari= '$hari'")->result_array();
    }
    
    public function getAbsensi($nisn, $date){
		$siswa_ijin = $this->db->query("SELECT absensi.*, siswa.nisn, siswa.nama_siswa FROM `absensi` JOIN siswa ON siswa.nisn=absensi.nisn WHERE siswa.nisn = $nisn AND absensi.tanggal_absen = '$date'")->result_array();
		$siswa_hadir = $this->db->query("SELECT * FROM siswa WHERE siswa.nisn = $nisn AND NOT EXISTS (SELECT * FROM absensi WHERE absensi.nisn=siswa.nisn AND absensi.tanggal_absen = '$date')")->result_array();
		$kelas = $this->db->query("SELECT * FROM `kelas` JOIN siswa ON siswa.id_kelas=kelas.id_kelas WHERE siswa.nisn = $nisn")->row_array();

		if(!empty($siswa_hadir)){
			foreach($siswa_hadir AS $hadir){
				$data_hadir[] = [
					'nisn' => $hadir['nisn'],
					'nama' => $hadir['nama_siswa'],
					'kelas' => $kelas['nama_kelas'],
					'tanggal' => $date,
					'absen' => 'hadir',
					'keterangan' => ''
				];
			}
		}else{
			$data_hadir = [];
		}

		if(!empty($siswa_ijin)){
			foreach($siswa_ijin AS $ijin){
				$data_ijin[] = [
					'nisn' => $ijin['nisn'],
					'nama' => $ijin['nama_siswa'],
					'kelas' => $kelas['nama_kelas'],
					'tanggal' => $date,
					'absen' => $ijin['status'],
					'keterangan' => $ijin['keterangan']
				];
			}
		}else{
			$data_ijin = [];
		}

		$data_merge = array_merge($data_ijin, $data_hadir);
		arsort($data_merge);

		return $data_merge;
    }
}
