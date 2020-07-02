<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Tenaga_kependidikan extends CI_controller
{

    function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuthTatausaha();
        $this->load->model('m_gtk');
    }

    public function index(){
    	$data = [
            'title' => 'Daftar Tenaga Kependidikan',
            'gtk' => $this->m_gtk->getAllGtk()
    	];

    	getViews($data,'v_tatausaha/v_guru');
    }

    public function tambah(){
        $data = [
            'title' => 'Tambah Tenaga Kependidikan'
        ];

    	$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', ['required' => 'Nama tidak boleh kosong']);
        $this->form_validation->set_rules('nuptk', 'NUPTK', 'trim|numeric|callback_CekNUPTK', ['numeric' => '{field} harus berupa angka', 'CekNUPTK' => '{field} sudah digunakan']);
        $this->form_validation->set_rules('sk', 'NO SK', 'trim|numeric|callback_CekSK', ['numeric' => '{field} harus berupa angka', 'CekSK' => '{field} sudah digunakan']);
        $this->form_validation->set_rules('telp', 'No Telp', 'numeric|trim', ['numeric' => '{field} harus berupa angka']);
        $this->form_validation->set_rules('jenjang', 'Jenjang Pendidikan', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tamat_pendidikan', 'Tamat Pendidikan', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('status', 'Status GTK', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('agama', 'Agama', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|callback_cekUsername', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('password', 'Password' , 'required|callback_cekPassword', ['required' => '{field} tidak boleh kosong', 'cekPassword' => '{field} terlalu pendek']);
		$this->form_validation->set_rules('password1', 'Konfirmasi Password', 'required|matches[password]', ['required' => '{field} tidak boleh kosong', 'matches' => '{field} tidak sama']);

    	if ($this->form_validation->run() == FALSE) {
    		getViews($data,'v_tatausaha/v_add_guru');
    	}else{
            $tgl = $this->input->post('tgl_lahir', true);
            $tgl = DateTime::createFromFormat('m/d/Y', $tgl)->format('Y-m-d');
            $tamat = DateTime::createFromFormat('m/d/Y', $this->input->post('tamat_pendidikan'))->format('Y-m-d');

            if (!empty($_FILES['foto']['name'])) {
    			$file = $this->_uploadFile();
    		}else{
    			$file = 'default.png';
            }
            
    		$data = [
                'nama' => $this->input->post('nama', true),
                'jenis_kelamin' => $this->input->post('gender', true),
                'tempat_lahir' => $this->input->post('tempat_lahir', true),
                'tanggal_lahir' => $tgl,
                'nuptk' => $this->input->post('nuptk', true),
                'tamat_pendidikan' => $tamat,
                'pendidikan_terakhir' => $this->input->post('jenjang', true),
                'telepon' => $this->input->post('telp', true),
                'agama' => $this->input->post('agama', true),
                'alamat' => $this->input->post('alamat', true),
                'no_sk' => $this->input->post('sk', true),
                'jabatan' => $this->input->post('status', true),
                'username' => $this->input->post('username', true),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'foto' => $file,
                'hak_akses' => $this->input->post('status', true)
    		];

    		if ($this->db->insert('tenaga_kependidikan', $data)) {
    			$this->session->set_flashdata('msg_success', 'Selamat, data berhasil ditambahkan');
                redirect('tatausaha/tenaga_kependidikan');
    		}else{
    			$this->session->set_flashdata('msg_failed', 'Maaf, data gagal ditambahkan');
                redirect('tatausaha/tenaga_kependidikan/tambah');
    		}
    	}
    }

    public function update(){
        $id = $this->uri->segment(4);

        //cek valid id
        if($this->db->get_where('tenaga_kependidikan', ['id_gtk' => $id])->num_rows() == 0){
            $this->session->set_flashdata('msg_failed', 'Maaf, data tidak cocok');
            redirect('tatausaha/tenaga_kependidikan');
        }else{
            $data = [
                'title' => 'Perbarui Tenaga Kependidikan',
                'gtk' => $this->db->get_where('tenaga_kependidikan', ['id_gtk' => $id])->row_array()
            ];
            
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', ['required' => 'Nama tidak boleh kosong']);
            $this->form_validation->set_rules('nuptk', 'NUPTK', 'trim|numeric', ['numeric' => '{field} harus berupa angka']);
            $this->form_validation->set_rules('sk', 'NO SK', 'trim|numeric', ['numeric' => '{field} harus berupa angka']);
            $this->form_validation->set_rules('telp', 'No Telp', 'numeric|trim', ['numeric' => '{field} harus berupa angka']);
            $this->form_validation->set_rules('jenjang', 'Jenjang Pendidikan', 'required|trim', ['required' => '{field} tidak boleh kosong']);
            $this->form_validation->set_rules('tamat_pendidikan', 'Tamat Pendidikan', 'required|trim', ['required' => '{field} tidak boleh kosong']);
            $this->form_validation->set_rules('status', 'Status GTK', 'required|trim', ['required' => '{field} tidak boleh kosong']);
            $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required|trim', ['required' => '{field} tidak boleh kosong']);
            $this->form_validation->set_rules('agama', 'Agama', 'required|trim', ['required' => '{field} tidak boleh kosong']);
            $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim', ['required' => '{field} tidak boleh kosong']);
            $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', ['required' => '{field} tidak boleh kosong']);
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => '{field} tidak boleh kosong']);

            if(isset($_POST['status']) && $_POST['status'] !== 'guru mapel'){
                $this->form_validation->set_rules('username', 'Username', 'required|trim', ['required' => '{field} tidak boleh kosong']);
                if(!empty($this->input->post('password'))){
                    $this->form_validation->set_rules('password', 'Password' , 'required|callback_cekPassword', ['required' => '{field} tidak boleh kosong', 'cekPassword' => '{field} terlalu pendek']);
                    $this->form_validation->set_rules('password1', 'Konfirmasi Password', 'required|matches[password]', ['required' => '{field} tidak boleh kosong', 'matches' => '{field} tidak sama']);
                }
            }

            if ($this->form_validation->run() == FALSE) {
                getViews($data,'v_tatausaha/v_edit_guru');
            }else{

                if (!empty($_FILES['foto']['name'])) {
                    //do upload for new image
                    $foto = $this->_uploadFile();

                    //deleting old image
                    if ($foto && $data['gtk']['foto'] !== 'default.png') {
                        unlink('assets/img/user/' . $data['gtk']['foto']);
                    }
                } else {
                    $foto = $data['gtk']['foto'];
                }

                $tgl = $this->input->post('tgl_lahir');
                if(!empty($tgl)){
                    $tgl = DateTime::createFromFormat('m/d/Y', $tgl)->format('Y-m-d');
                }
                $tamat = DateTime::createFromFormat('m/d/Y', $this->input->post('tamat_pendidikan'))->format('Y-m-d');

                if(!empty($this->input->post('password1'))){
                    $data = [
                        'nama' => $this->input->post('nama', true),
                        'jenis_kelamin' => $this->input->post('gender', true),
                        'tempat_lahir' => $this->input->post('tempat_lahir', true),
                        'tanggal_lahir' => $tgl,
                        'nuptk' => $this->input->post('nuptk', true),
                        'tamat_pendidikan' => $tamat,
                        'pendidikan_terakhir' => $this->input->post('jenjang', true),
                        'telepon' => $this->input->post('telp', true),
                        'agama' => $this->input->post('agama', true),
                        'alamat' => $this->input->post('alamat', true),
                        'no_sk' => $this->input->post('sk', true),
                        'jabatan' => $this->input->post('status', true),
                        'username' => $this->input->post('username', true),
                        'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                        'foto' => $foto,
                        'hak_akses' => $this->input->post('status', true)
                    ];
                }else{
                    $data = [
                        'nama' => $this->input->post('nama', true),
                        'jenis_kelamin' => $this->input->post('gender', true),
                        'tempat_lahir' => $this->input->post('tempat_lahir', true),
                        'tanggal_lahir' => $tgl,
                        'nuptk' => $this->input->post('nuptk', true),
                        'tamat_pendidikan' => $tamat,
                        'pendidikan_terakhir' => $this->input->post('jenjang', true),
                        'telepon' => $this->input->post('telp', true),
                        'agama' => $this->input->post('agama', true),
                        'alamat' => $this->input->post('alamat', true),
                        'no_sk' => $this->input->post('sk', true),
                        'jabatan' => $this->input->post('status', true),
                        'username' => $this->input->post('username', true),
                        'foto' => $foto,
                        'hak_akses' => $this->input->post('status', true)
                    ];
                }

                if ($this->db->update('tenaga_kependidikan', $data, ['id_gtk' => $id])) {
                    $this->session->set_flashdata('msg_success', 'Selamat, data berhasil diperbarui');
                    redirect('tatausaha/tenaga_kependidikan');
                }else{
                    $this->session->set_flashdata('msg_failed', 'Maaf, data gagal diperbarui');
                    redirect('tatausaha/tenaga_kependidikan');
                }
            }
        }
    }

    public function delete($id){
    	$delete = $this->db->delete('tenaga_kependidikan', ['id_gtk'=> $id]);

    	if ($delete) {
    		$this->session->set_flashdata('msg_success', 'Selamat, data berhasil dihapus');
    		http_response_code(200);
    	}else{
    		$this->session->set_flashdata('msg_failed', 'Selamat, data gagal dihapus');
    		http_response_code(404);
    	}
    }

    public function guru_kelas(){
        $data = [
            'title' => 'Konfigurasi Guru Kelas',
            'gurus' => $this->db->get_where('tenaga_kependidikan', ['hak_akses' => 'guru kelas'])->result_array(),
            'kelas_list' => $this->db->get('kelas')->result_array(),
            'list' => $this->db->query("SELECT guru_kelas.id_guru_kelas, guru.id_gtk, guru.nama, guru.nuptk, GROUP_CONCAT(kelas.nama_kelas) AS kelas FROM `guru_kelas` JOIN tenaga_kependidikan AS guru ON guru.id_gtk=guru_kelas.id_gtk JOIN kelas ON kelas.id_kelas=guru_kelas.id_kelas GROUP BY guru.id_gtk")->result_array()
        ];

        $this->form_validation->set_rules('guru', 'Guru', 'required|trim', ['required' => '{field} tidak boleh kosong']);

        if($this->form_validation->run() == FALSE){
            getViews($data,'v_tatausaha/v_guru_kelas');
        }else{
            $kelas = $this->input->post('kelas');
            $flag = true;
            for($i=0; $i<count($kelas); $i++){
                $data = [
                    'id_gtk' => $this->input->post('guru'),
                    'id_kelas' => $kelas[$i]
                ];

                if(!$this->db->insert('guru_kelas', $data)){
                    $flag = false;
                }
            }

            if($flag){
                $this->session->set_flashdata('msg_success', 'Selamat, data berhasil disimpan');
                redirect('tatausaha/tenaga_kependidikan/guru_kelas');
            }else{
                $this->session->set_flashdata('msg_failed', 'Maaf, data gagal disimpan');
                redirect('tatausaha/tenaga_kependidikan/guru_kelas');
            }
        }
        
    }

    public function update_guru_kelas(){
        if(isset($_POST['id_get_update'])){
            $data_kelas = $this->db->get_where('guru_kelas', ['id_gtk' => $this->input->post('id_get_update')])->result_array();

            foreach($data_kelas AS $kelas){
                $id_kelas[] = $kelas['id_kelas'];
            }

            $data = [
                'id_gtk' => $data_kelas[0]['id_gtk'],
                'id_kelas' => $id_kelas
            ];

            echo json_encode($data);
        }elseif(isset($_POST['perbarui'])){
            $delete = $this->db->delete('guru_kelas', ['id_gtk' => $this->input->post('id_gtk')]);

            if($delete){
                $kelas = $this->input->post('kelas');
                $flag = true;
                for($i=0; $i<count($kelas); $i++){
                    $data = [
                        'id_gtk' => $this->input->post('id_gtk'),
                        'id_kelas' => $kelas[$i]
                    ];
    
                    if(!$this->db->insert('guru_kelas', $data)){
                        $flag = false;
                    }
                }
    
                if($flag){
                    $this->session->set_flashdata('msg_success', 'Selamat, data berhasil diperbarui');
                    redirect('tatausaha/tenaga_kependidikan/guru_kelas');
                }else{
                    $this->session->set_flashdata('msg_failed', 'Maaf, data gagal diperbarui');
                    redirect('tatausaha/tenaga_kependidikan/guru_kelas');
                }
            }else{
                $this->session->set_flashdata('msg_failed', 'Maaf, data gagal diperbarui');
                redirect('tatausaha/tenaga_kependidikan/guru_kelas');
            }
        }
    }

    public function cekPassword($str){
		$cek = strlen($str);
		if ($cek <= 6) {
			return false;
		}else{
			return true;
		}
    }

    public function CekNUPTK($nip)
    {
        $dataNIP = $this->db->get_where('tenaga_kependidikan', ['nuptk' => $nip])->row_array();

        if (!empty($dataNIP['nuptk']) && $this->db->get_where('tenaga_kependidikan', ['nuptk' => $nip])->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function CekSK($nik)
    {
        $dataNIK = $this->db->get_where('tenaga_kependidikan', ['no_sk' => $nik])->row_array();
        if (!empty($dataNIK['no_sk']) && $this->db->get_where('tenaga_kependidikan', ['no_sk' => $nik])->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }
    
    public function CekUsername($username)
    {
        $data_username = $this->db->get_where('tenaga_kependidikan', ['username' => $username])->row_array();
        if (!empty($data_username['username']) && $this->db->get_where('tenaga_kependidikan', ['username' => $username])->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }

    private function _uploadFile()
    {
        $config['upload_path']          = './assets/img/user/';
        $config['allowed_types']        = 'jpg|png';
        $config['encrypt_name']         = TRUE;
        $config['overwrite']            = true;
        $config['max_size']             = 2048; //2mb

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            return false;
        } else {
            return $this->upload->data('file_name');
        }
    }

}