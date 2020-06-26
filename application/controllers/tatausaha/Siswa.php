<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Siswa extends CI_controller
{
    function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuthTatausaha();
        $this->load->model('m_siswa');
    }

    public function index(){
        $data = [
            'title' => 'Data Siswa',
            
            'siswas' => $this->m_siswa->getAllSiswa()
        ];

        getViews($data, "v_tatausaha/v_list_siswa");
    }

    public function tambah(){
        $data = [
            'title' => 'Tambah Siswa',
            'kelas' => $this->db->get('kelas')->result_array(),
            'siswas' => $this->m_siswa->getAllSiswa()
        ];

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', ['required' => 'Nama tidak boleh kosong']);
        $this->form_validation->set_rules('nisn', 'NISN', 'trim|numeric|callback_CekNISN', ['numeric' => '{field} harus berupa angka', 'CekNISN' => '{field} sudah digunakan']);
        $this->form_validation->set_rules('telp', 'No Telp', 'numeric|trim', ['numeric' => '{field} harus berupa angka']);
        $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('kelas', 'Kelas', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('ayah', 'Nama Ayah', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('ibu', 'Nama Ibu', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|callback_cekUsername', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('password', 'Password' , 'required|callback_cekPassword', ['required' => '{field} tidak boleh kosong', 'cekPassword' => '{field} terlalu pendek']);
		$this->form_validation->set_rules('password1', 'Konfirmasi Password', 'required|matches[password]', ['required' => '{field} tidak boleh kosong', 'matches' => '{field} tidak sama']);

        if($this->form_validation->run() == FALSE){
            getViews($data, "v_tatausaha/v_add_siswa");
        }else{
            $tgl = $this->input->post('tgl_lahir', true);
            $tgl = DateTime::createFromFormat('m/d/Y', $tgl)->format('Y-m-d');

            if (!empty($_FILES['foto']['name'])) {
    			$file = $this->_uploadFile();
    		}else{
    			$file = 'default.png';
            }

            $data = [
                'nisn' => $this->input->post('nisn', true),
                'nama_siswa' => $this->input->post('nama', true),
                'jenis_kelamin' => $this->input->post('gender'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $tgl,
                'no_hp' => $this->input->post('telp'),
                'alamat' => $this->input->post('alamat'),
                'id_kelas' => $this->input->post('kelas'),
                'nama_ayah' => $this->input->post('ayah'),
                'nama_ibu' => $this->input->post('ibu'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'foto' => $file
    		];

    		if ($this->db->insert('siswa', $data)) {
    			$this->session->set_flashdata('msg_success', 'Selamat, data berhasil ditambahkan');
                redirect('tatausaha/siswa');
    		}else{
    			$this->session->set_flashdata('msg_failed', 'Maaf, data gagal ditambahkan');
                redirect('tatausaha/siswa/tambah');
    		}
        }
    }

    public function update($nisn){
        $data = [
            'title' => 'Perbarui Siswa',
            'kelas' => $this->db->get('kelas')->result_array(),
            'siswa' => $this->db->get_where('siswa', ['nisn' => $nisn])->row_array()
        ];

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', ['required' => 'Nama tidak boleh kosong']);
        $this->form_validation->set_rules('nisn', 'NISN', 'trim|numeric|callback_CekNISN', ['numeric' => '{field} harus berupa angka', 'CekNISN' => '{field} sudah digunakan']);
        $this->form_validation->set_rules('telp', 'No Telp', 'numeric|trim', ['numeric' => '{field} harus berupa angka']);
        $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('kelas', 'Kelas', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('ayah', 'Nama Ayah', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('ibu', 'Nama Ibu', 'required|trim', ['required' => '{field} tidak boleh kosong']);

        if($this->input->post('username') != $data['siswa']['username']) {
            $is_unique =  '|is_unique[siswa.username]';
         } else {
            $is_unique =  '';
         }
        $this->form_validation->set_rules('username', 'Username', 'required|trim'.$is_unique, ['required' => '{field} tidak boleh kosong']);
        
        if(!empty($this->input->post('password'))){
            $this->form_validation->set_rules('password', 'Password' , 'required|callback_cekPassword', ['required' => '{field} tidak boleh kosong', 'cekPassword' => '{field} terlalu pendek']);
		    $this->form_validation->set_rules('password1', 'Konfirmasi Password', 'required|matches[password]', ['required' => '{field} tidak boleh kosong', 'matches' => '{field} tidak sama']);
        }

        if($this->form_validation->run() == FALSE){
            getViews($data, 'v_tatausaha/v_edit_siswa');
        }else{
            if (!empty($_FILES['foto']['name'])) {
                //do upload for new image
                $foto = $this->_uploadFile();

                //deleting old image
                if ($foto && $data['siswa']['foto'] !== 'default.png') {
                    unlink('assets/img/siswa/' . $data['siswa']['foto']);
                }
            } else {
                $foto = $data['siswa']['foto'];
            }

            $tgl = $this->input->post('tgl_lahir');
            if(!empty($tgl)){
                $tgl = DateTime::createFromFormat('m/d/Y', $tgl)->format('Y-m-d');
            }

            if(!empty($this->input->post('password1'))){
                $data = [
                    'nisn' => $this->input->post('nisn', true),
                    'nama_siswa' => $this->input->post('nama', true),
                    'jenis_kelamin' => $this->input->post('gender'),
                    'tempat_lahir' => $this->input->post('tempat_lahir'),
                    'tanggal_lahir' => $tgl,
                    'no_hp' => $this->input->post('telp'),
                    'alamat' => $this->input->post('alamat'),
                    'id_kelas' => $this->input->post('kelas'),
                    'nama_ayah' => $this->input->post('ayah'),
                    'nama_ibu' => $this->input->post('ibu'),
                    'username' => $this->input->post('username'),
                    'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                    'foto' => $foto
                ];
            }else{
                $data = [
                    'nisn' => $this->input->post('nisn', true),
                    'nama_siswa' => $this->input->post('nama', true),
                    'jenis_kelamin' => $this->input->post('gender'),
                    'tempat_lahir' => $this->input->post('tempat_lahir'),
                    'tanggal_lahir' => $tgl,
                    'no_hp' => $this->input->post('telp'),
                    'alamat' => $this->input->post('alamat'),
                    'id_kelas' => $this->input->post('kelas'),
                    'nama_ayah' => $this->input->post('ayah'),
                    'nama_ibu' => $this->input->post('ibu'),
                    'username' => $this->input->post('username'),
                    'foto' => $foto
                ];
            }

            if ($this->db->update('siswa', $data, ['nisn' => $nisn])) {
                $this->session->set_flashdata('msg_success', 'Selamat, data berhasil diperbarui');
                redirect('tatausaha/siswa');
            }else{
                $this->session->set_flashdata('msg_failed', 'Maaf, data gagal diperbarui');
                redirect('tatausaha/siswa/');
            }
        }

    }
    
    public function delete($id){
    	$delete = $this->db->delete('siswa', ['nisn'=> $id]);

    	if ($delete) {
    		$this->session->set_flashdata('msg_success', 'Selamat, data berhasil dihapus');
    		http_response_code(200);
    	}else{
    		$this->session->set_flashdata('msg_failed', 'Selamat, data gagal dihapus');
    		http_response_code(404);
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

    public function CekNISN($nip)
    {
        $dataNIP = $this->db->get_where('siswa', ['nisn' => $nip])->row_array();

        if (!empty($dataNIP['nuptk']) && $this->db->get_where('siswa', ['nisn' => $nip])->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }
    
    public function CekUsername($username)
    {
        $data_username = $this->db->get_where('siswa', ['username' => $username])->row_array();
        if (!empty($data_username['username']) && $this->db->get_where('siswa', ['username' => $username])->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }

    private function _uploadFile()
    {
        $config['upload_path']          = './assets/img/siswa/';
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