<?php 
/**
 * 
 */
class Setting extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function profil(){
		$username = $this->session->userdata('username');

		$data = [
			'title' => 'Setting Akun',
			'data_admin' => $this->db->get_where('tenaga_kependidikan', ['nip' => $username])->row_array()
		];

		$this->form_validation->set_rules('nip', 'NIP', 'required|trim|callback_cekNIP', ['required' => '{field} tidak boleh kosong', 'cekEmail' => '{field} sudah digunakan']);

		if ($this->form_validation->run() == FALSE) {
			getViews($data, 'v_guru/v_setting_profil');
		}else{
			if (!empty($_FILES['foto']['name'])) {
				$gambar = $this->_uploadFile();
			}else{
				$gambar = $data['data_admin']['foto'];
			}

			$data = [
				'foto' => $gambar,
				'nip' => $this->input->post('nip', true)
			];

			$update = $this->db->update('tenaga_kependidikan', $data, ['nip' => $username]);

			if ($update) {
				$this->session->set_flashdata('msg_success', 'Selamat, Data berhasil diperbarui');
                redirect('front/auth/logout');
			}else{
				$this->session->set_flashdata('msg_failed', 'Maaf, Data gagal diperbarui');
                redirect('pegawai/setting/profil');
			}
		}
		
	}

	public function password(){
		$nisn = $this->session->userdata('username');

		$data = [
			'title' => 'Perbarui Password'
		];

		$this->form_validation->set_rules('pass1', 'Password Baru', 'required', ['required' => '{field} tidak boleh kosong']);
		$this->form_validation->set_rules('pass2', 'Konfirmasi Password Baru', 'required|matches[pass1]', ['matches' => 'Konfirmasi Password Tidak Sama','required' => '{field} tidak boleh kosong']);
		$this->form_validation->set_rules('pass3', 'Password Lama', 'required|callback_cekPass', ['required' => '{field} tidak boleh kosong', 'cekPass' => 'Password yang anda masukan salah']);

		if ($this->form_validation->run() == FALSE) {
			getViews($data, 'v_admin/v_setting_password');
		}else{
			//update password peserta
			$newPass = password_hash($this->input->post('pass2'), PASSWORD_DEFAULT);

			$this->db->set('password', $newPass);
			$this->db->where('nip', $nisn);
			$updatePass = $this->db->update('tenaga_kependidikan');

			if ($updatePass) {
				$this->session->set_flashdata('msg_success', 'Selamat, Password berhasil diperbarui');
                redirect('front/auth/logout');
			}else{
				$this->session->set_flashdata('msg_failed', 'Maaf, Password gagal diperbarui');
                redirect('pegawai/setting/password');
			}
		}
	}


	public function cekPass($str){
		//get password lama
		$passUser = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();

		 if (password_verify($str, $passUser['password'])) {
		 	return TRUE;
		 }else{
		 	return FALSE;
		 }
    }
    
    public function CekNIP($nip)
    {
        $dataNIP = $this->db->get_where('tenaga_kependidikan', ['nip' => $nip])->row_array();

        if($dataNIP['nip'] !== $nip){
            if (!empty($dataNIP['nip']) && $this->db->get_where('tenaga_kependidikan', ['nip' => $nip])->num_rows() > 0) {
                return false;
            } else {
                return true;
            }
        }else{
            return true;
        }
        
    }

	public function cekEmail($str){
		$cekmail = $this->db->get_where('admin', ['email' => $str])->row_array();
		if ($this->db->get_where('admin', ['email' => $str])->num_rows() > 0) {
			if ($cekmail['email'] == $this->input->post('email')) {
				return true;
			}else{
				return false;
			}
		}else{
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

 ?>