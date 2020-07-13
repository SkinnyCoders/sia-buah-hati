<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_gtk extends CI_Model
{ 
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cektahun');
    }


    public function getAllGtk(){
        return $this->db->get('tenaga_kependidikan')->result_array();
    }

	public function getSemester(){
		return $this->db->query("SELECT * FROM `semester` JOIN tahun_ajaran ON tahun_ajaran.id_tahun_ajaran=semester.id_tahun_pelajaran WHERE 1 ORDER BY `tanggal_mulai` DESC")->result_array();
    }
    
    public function getJadwalGtk($id_gtk){
        return $this->db->query("SELECT gtk.nuptk, gtk.nama, mapel.nama_mapel, kelas.nama_kelas, jadwal.* FROM `jadwal` JOIN tenaga_kependidikan AS gtk ON gtk.id_gtk=jadwal.id_gtk JOIN mapel ON mapel.id_mapel=jadwal.id_mapel JOIN kelas ON kelas.id_kelas=jadwal.id_kelas WHERE jadwal.id_gtk = $id_gtk")->result_array();
    }

    public function getSiswaNaikKelas($id_gtk){
        //cek nilai kkm
        //get id semester 
        $semester = $this->db->get_where('semester', ['id_tahun_pelajaran' => getIdTahun(getTahun()), 'semester' => 'genap'])->row_array();
        $semester = $semester['id_semester'];

        $siswa = $this->db->query("SELECT * FROM `siswa` JOIN guru_kelas ON guru_kelas.id_kelas=siswa.id_kelas WHERE guru_kelas.id_gtk = $id_gtk")->result_array();

        foreach($siswa AS $s){
            //ambil rata2 nilai
            $mapel = $this->db->get_where('mapel_kelas', ['id_kelas' => $s['id_kelas']])->result_array();

            foreach($mapel AS $m){
                $rata2Tugas = $this->db->query("SELECT `nilai_tertulis`, `nilai_lisan`, `nilai_praktek` FROM `nilai_tugas` WHERE `nisn`= ".$s['nisn']." AND `id_kelas` = ".$s['id_kelas']." AND `id_semester` = $semester AND `id_mapel` =".$m['id_mapel'])->row_array();

                if(!empty($rata2Tugas)){
                    //rata-rata
                    $tugas = $rata2Tugas['nilai_tertulis'] + $rata2Tugas['nilai_lisan'] + $rata2Tugas['nilai_praktek'];
                    $rataTugas = $tugas/3;
                }else{
                    return false;
                }

                $rata2Uas = $this->db->query("SELECT `nilai_tertulis`, `nilai_lisan`, `nilai_praktek` FROM `nilai_uas` WHERE `nisn`= ".$s['nisn']." AND `id_kelas` = ".$s['id_kelas']." AND `id_semester` = $semester AND `id_mapel` =".$m['id_mapel'])->row_array();

                if(!empty($rata2Uas)){
                    //rata-rata
                    $uas = $rata2Uas['nilai_tertulis'] + $rata2Tugas['nilai_lisan'] + $rata2Tugas['nilai_praktek'];
                    $rataUas = $uas/3;
                }else{
                    return false;
                }

                $rata2Uts = $this->db->query("SELECT `nilai_tertulis`, `nilai_lisan`, `nilai_praktek` FROM `nilai_uts` WHERE `nisn`= ".$s['nisn']." AND `id_kelas` = ".$s['id_kelas']." AND `id_semester` = $semester AND `id_mapel` =".$m['id_mapel'])->row_array();

                if(!empty($rata2Uts)){
                    //rata-rata
                    $uts = $rata2Uts['nilai_tertulis'] + $rata2Tugas['nilai_lisan'] + $rata2Tugas['nilai_praktek'];
                    $rataUts = $uts/3;
                }else{
                    return false;
                }

                $rata2Harian = $this->db->query("SELECT `nilai_tertulis`, `nilai_lisan`, `nilai_praktek` FROM `nilai_ulangan_harian` WHERE `nisn`= ".$s['nisn']." AND `id_kelas` = ".$s['id_kelas']." AND `id_semester` = $semester AND `id_mapel` =".$m['id_mapel'])->row_array();

                if(!empty($rata2Harian)){
                    //rata-rata
                    $harian = $rata2Harian['nilai_tertulis'] + $rata2Tugas['nilai_lisan'] + $rata2Tugas['nilai_praktek'];
                    $rataHarian = $harian/3;
                }else{
                    return false;
                }
                
                $total_rata = $rataUas+$rataUts+$rataHarian+$rataTugas;
                $total_rata = $total_rata/4;

                //bandingkan dengan kkm
                $kkm = $this->db->query("SELECT * FROM `kkm_mapel` JOIN mapel_kelas ON mapel_kelas.id_mapel_kelas=kkm_mapel.id_mapel_kelas WHERE mapel_kelas.id_kelas = ".$s['id_kelas']." AND mapel_kelas.id_mapel =".$m['id_mapel'])->row_array();

                if(!empty($kkm)){
                    if($total_rata > $kkm['kkm']){
                        $lulus = 'lulus';
                    }else{
                        $lulus = 'tidak';
                    }
                }else{
                    return false;
                }
            }

            $data[] = [
                'nisn' => $s['nisn'],
                'nama' => $s['nama_siswa'],
                'gender' => $s['jenis_kelamin'],
                'lulus' => $lulus,
                'rata' => $total_rata
            ];
        }

        return $data;
    }
}
