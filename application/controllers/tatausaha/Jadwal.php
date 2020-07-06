<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Jadwal extends CI_controller
{

    function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuthTatausaha();
        $this->load->model('m_admin');
    }

    public function index(){
    	$data = [
            'title' => 'Jadwal Guru',
            'jadwal' => $this->db->query('SELECT gtk.nuptk, gtk.nama, mapel.nama_mapel, kelas.nama_kelas, jadwal.* FROM `jadwal` JOIN tenaga_kependidikan AS gtk ON gtk.id_gtk=jadwal.id_gtk JOIN mapel ON mapel.id_mapel=jadwal.id_mapel JOIN kelas ON kelas.id_kelas=jadwal.id_kelas')->result_array()
    	];

    	getViews($data,'v_tatausaha/v_jadwal');
    }

    public function tambah(){
        $data = [
            'title' => 'Tambah Jadwal Guru',
            'guru' => $this->db->query("SELECT * FROM `tenaga_kependidikan` WHERE `hak_akses` = 'guru kelas' OR hak_akses = 'guru mapel'")->result_array(),
            'mapel' => $this->db->get('mapel')->result_array()
        ];
        
        $this->form_validation->set_rules('guru', 'Guru', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('kelas', 'Kelas', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('mapel', 'Mapel', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('jam', 'Jam Ke', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('hari', 'Hari', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('jam_akhir', 'Jam Akhir', 'required', ['required' => '{field} tidak boleh kosong']);

        if($this->form_validation->run() == FALSE){
            getViews($data,'v_tatausaha/v_add_jadwal');
        }else{
            $data = [
                'id_gtk' => $this->input->post('guru'),
                'id_kelas' => $this->input->post('kelas'),
                'id_mapel' => $this->input->post('mapel'),
                'hari' => $this->input->post('hari', true),
                'jam_ke' => $this->input->post('jam', true),
                'jam_mulai' => $this->input->post('jam_mulai'),
                'jam_akhir' => $this->input->post('jam_akhir')
            ];

            if ($this->db->insert('jadwal', $data)) {
    			$this->session->set_flashdata('msg_success', 'Selamat, data berhasil ditambahkan');
                redirect('tatausaha/jadwal');
    		}else{
    			$this->session->set_flashdata('msg_failed', 'Maaf, data gagal ditambahkan');
                redirect('tatausaha/jadwal/tambah');
    		}
        }
    }

    public function perbarui($id){
        $data = [
            'title' => 'Perbarui Jadwal Guru',
            'guru' => $this->db->query("SELECT * FROM `tenaga_kependidikan` WHERE `hak_akses` = 'guru kelas' OR hak_akses = 'guru mapel'")->result_array(),
            'jadwal' => $this->db->get_where('jadwal', ['id_jadwal' => $id])->row_array(),
            'mapel' => $this->db->get('mapel')->result_array()
        ];

        $this->form_validation->set_rules('guru', 'Guru', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('kelas', 'Kelas', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('mapel', 'Mapel', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('jam', 'Jam Ke', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('hari', 'Hari', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('jam_akhir', 'Jam Akhir', 'required', ['required' => '{field} tidak boleh kosong']);

        if($this->form_validation->run() == FALSE){
            getViews($data, 'v_tatausaha/v_edit_jadwal.php');
        }else{
            $data = [
                'id_gtk' => $this->input->post('guru'),
                'id_kelas' => $this->input->post('kelas'),
                'id_mapel' => $this->input->post('mapel'),
                'hari' => $this->input->post('hari', true),
                'jam_ke' => $this->input->post('jam', true),
                'jam_mulai' => $this->input->post('jam_mulai'),
                'jam_akhir' => $this->input->post('jam_akhir')
            ];

            if ($this->db->update('jadwal', $data, ['id_jadwal' => $id])) {
    			$this->session->set_flashdata('msg_success', 'Selamat, data berhasil ditambahkan');
                redirect('tatausaha/jadwal');
    		}else{
    			$this->session->set_flashdata('msg_failed', 'Maaf, data gagal ditambahkan');
                redirect('tatausaha/jadwal/perbarui/'.$id);
    		}
        }
    }

    public function delete($id){
        $delete = $this->db->delete('jadwal', ['id_jadwal'=> $id]);

    	if ($delete) {
    		$this->session->set_flashdata('msg_success', 'Selamat, data berhasil dihapus');
    		http_response_code(200);
    	}else{
    		$this->session->set_flashdata('msg_failed', 'Selamat, data gagal dihapus');
    		http_response_code(404);
    	}
    }

    public function get_kelas(){
        $id_mapel = $_POST['id'];
        $data = $this->db->query("SELECT mapel_kelas.id_kelas, kelas.nama_kelas FROM `mapel_kelas` JOIN kelas ON kelas.id_kelas=mapel_kelas.id_kelas WHERE mapel_kelas.id_mapel = $id_mapel")->result_array();

        echo json_encode($data);
    }

    public function get_mapel(){
        $kelas = $_POST['id'];
        $data = $this->db->query("SELECT * FROM `mapel_kelas` JOIN mapel ON mapel.id_mapel=mapel_kelas.id_mapel WHERE mapel_kelas.id_kelas = $kelas")->result_array();

        echo json_encode($data);
    }
}