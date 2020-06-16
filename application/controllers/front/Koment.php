<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Koment extends CI_controller
{
	public function __construct()
	{
        parent::__construct();
        $this->load->model('m_home');
    }

    public function kirim(){
        if ($this->session->userdata('is_login') !== 'punten') {
            $this->session->set_flashdata('msg_failed', 'Maaf, Harus login terlebih dahulu!');
            redirect('/');
            return false;
        }else{
            switch($this->session->userdata('nama_role')){
                case 'Admin' :
                    $author = $this->session->userdata('username');
                    $oleh = 'admin';
                    $id_parent =  $this->input->post('komentar_id');
                    $komen = $this->input->post('komentar');
                break;
    
                case 'Alumni' :
                    $author = $this->session->userdata('nisn');
                    $oleh = 'alumni';
                    $id_parent =  $this->input->post('komentar_id');
                    $komen = $this->input->post('komentar');
                break;
            }
    
            $data = [
                'id_parent_komentar' => $id_parent,
                'komentar' => $komen,
                'author' => $author,
                'komentar_oleh' => $oleh
            ];
    
            if($this->db->insert('komentar', $data)){
                $id_komentar = $this->db->query("SELECT `id_komentar` FROM `komentar` ORDER BY `id_komentar` DESC LIMIT 1")->row_array();
                $id_komentar = $id_komentar['id_komentar'];
                //insert kategori
                $data_kategori = [
                    'id_berita' => $this->input->post('id_berita'),
                    'kategori' => $this->input->post('kategori'),
                    'id_komentar' => $id_komentar
                ];
    
                if($this->db->insert('kategori_komentar', $data_kategori)){
                    echo json_encode(['success' => 'Sukses']);
                }else{
                    http_response_code(500);
                }
            }else{
                http_response_code(500);
            }
        }
    }

    public function ambil(){
        $id_berita = $_POST['id_berita'];
        $kategori = $_POST['kategori'];

        $koment1 = $this->db->query("SELECT komentar.*, alumni.nama, alumni.foto FROM `komentar` JOIN kategori_komentar ON kategori_komentar.id_komentar=komentar.id_komentar JOIN alumni ON alumni.nisn=komentar.author WHERE kategori_komentar.id_berita = $id_berita AND kategori_komentar.kategori = '$kategori' AND komentar.id_parent_komentar = 0 ORDER BY komentar.`id_komentar` DESC")->result_array();

        $koment2 = $this->db->query("SELECT komentar.*, admin.nama, admin.foto FROM `komentar` JOIN kategori_komentar ON kategori_komentar.id_komentar=komentar.id_komentar JOIN admin ON admin.username=komentar.author WHERE kategori_komentar.id_berita = $id_berita AND kategori_komentar.kategori = '$kategori' AND komentar.id_parent_komentar = 0 ORDER BY komentar.`id_komentar` DESC")->result_array();

        // function sort_by_col(&$src_array, $kolom, $arah = SORT_ASC) {
        //     $urut = array();
        //     foreach ($src_array as $k => $v) {
        //         $urut[$k] = $v[$kolom];
        //     }
        //     array_multisort($urut, $arah, $src_array);
        // }

        $koment = array_merge($koment1, $koment2);
        $this->sort_by_col($koment, 'tanggal', SORT_DESC);

        $output = '';
        foreach($koment AS $k){
            $tgl = DateTime::createFromFormat('Y-m-d H:i:s', $k['tanggal'])->format('d F Y');
            $waktu = DateTime::createFromFormat('Y-m-d H:i:s', $k['tanggal'])->format('H:i');
            $output .= '<div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="user-panel d-flex">
                    <div class="image">
                        <img src="'.base_url('assets/img/user/'.$k['foto'].'').'" style="width:70px; height:70px;" class="rounded-circle elevation-2 mt-2" alt="User Image">
                    </div>
                    <div class="info">
                        <h5 class="text-nowrap d-block ml-3 mt-1 text-header text-black">'.$k['nama'].' <span><small class="text-muted">~ '.$tgl.' at '.$waktu.'</small></span></h5>
                        
                        <small class="d-block ml-3 mt-1 text-muted text-black">'.$k['komentar'].'</small>
                    </div>
                </div>
                <button type="button" class="ampas btn btn-sm btn-success float-right mb-2" onclick="balas('.$k["id_komentar"].');" id="'.$k["id_komentar"].'">Balas</button>
            </div>
        </div>';
        $margin = 0;
        $output .= $this->reply($k["id_komentar"], $margin);
        }

        echo json_encode([$output]);
    }

    public function reply($id_komen, $margin = 0){
        $parent1 = $this->db->query("SELECT komentar.*, alumni.nama, alumni.foto FROM `komentar` JOIN kategori_komentar ON kategori_komentar.id_komentar=komentar.id_komentar JOIN alumni ON alumni.nisn=komentar.author WHERE  komentar.id_parent_komentar = $id_komen ORDER BY komentar.`id_komentar` DESC")->result_array();

        $parent2 = $this->db->query("SELECT komentar.*, admin.nama, admin.foto FROM `komentar` JOIN kategori_komentar ON kategori_komentar.id_komentar=komentar.id_komentar JOIN admin ON admin.username=komentar.author WHERE komentar.id_parent_komentar = $id_komen ORDER BY komentar.`id_komentar` DESC")->result_array();

        $parent = array_merge($parent1, $parent2);
        $this->sort_by_col($parent, 'tanggal', SORT_DESC);

        $row = count($parent);
        $reply_koment = $parent;

        if($id_komen == 0){
            $margin = 0;
        }else{
            $margin = $margin + 40;
        }

        if($row > 0){
            $output = '';
            foreach($reply_koment AS $r){
                $output .= '<div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="user-panel pb-3 d-flex" style="margin-left : '.$margin.'px;">
                        <div class="image">
                            <img src="'.base_url('assets/img/user/'.$r['foto'].'').'" style="width:70px; height:70px;" class="rounded-circle elevation-2 mt-2" alt="User Image">
                        </div>
                        <div class="info">
                            <h5 class="text-nowrap d-block ml-3 mt-1 text-header text-black">'.$r['nama'].' <span><small class="text-muted">~ 20 juni 2020 at 15:30</small></span></h5>
                            
                            <small class="d-block ml-3 mt-1 text-muted text-black">'.$r['komentar'].'</small>
    
                            
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-success float-right mb-2 balas" onclick="balas('.$r["id_komentar"].');" id="'.$r["id_komentar"].'">Balas</button>
                </div>
            </div>';
            $output .= $this->reply($r["id_komentar"], $margin);
            }

            return $output;
        }
    }

    public function sort_by_col(&$src_array, $kolom, $arah = SORT_ASC) {
        $urut = array();
        foreach ($src_array as $k => $v) {
            $urut[$k] = $v[$kolom];
        }
        array_multisort($urut, $arah, $src_array);
    }
}