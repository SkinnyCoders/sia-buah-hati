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
			'data_admin' => $this->db->get_where('admin', ['username' => $username])->row_array()
		];

		$this->form_validation->set_rules('email', 'Email', 'required|trim|callback_cekEmail|valid_email', ['required' => '{field} tidak boleh kosong', 'cekEmail' => '{field} sudah digunakan']);

		if ($this->form_validation->run() == FALSE) {
			getViews($data, 'v_admin/v_setting_profil');
		}else{
			if (!empty($_FILES['foto']['name'])) {
				$gambar = uploadImage('foto', './assets/img/user/','');
			}else{
				$gambar = $data['data_admin']['foto'];
			}

			$data = [
				'foto' => $gambar,
				'email' => $this->input->post('email', true)
			];

			$update = $this->db->update('admin', $data, ['username' => $username]);

			if ($update) {
				$this->session->set_flashdata('msg_success', 'Selamat, Data berhasil diperbarui');
                redirect('admin/setting/profil');
			}else{
				$this->session->set_flashdata('msg_failed', 'Maaf, Data gagal diperbarui');
                redirect('admin/setting/profil');
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
			$this->db->where('username', $nisn);
			$updatePass = $this->db->update('admin');

			if ($updatePass) {
				$this->session->set_flashdata('msg_success', 'Selamat, Password berhasil diperbarui');
                redirect('admin/setting/password');
			}else{
				$this->session->set_flashdata('msg_failed', 'Maaf, Password gagal diperbarui');
                redirect('admin/setting/password');
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
}

 ?>