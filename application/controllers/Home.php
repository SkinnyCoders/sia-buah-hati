<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Home extends CI_controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_auth');
    }

    public function login()
    {
        $this->form_validation->set_rules('username', 'Email Atau Username', 'required|trim', ['required' => 'Maaf, Email belum diisi!']);
        $this->form_validation->set_rules('password', 'Password', 'required', ['required' => 'Maaf, Password belum diisi!']);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('v_siswa/v_login');
        } else {
            //cek data for admin
            $user = $this->m_auth->cekUserSiswa($this->input->post('username', TRUE));
            
            if (!empty($user)) {
                if (password_verify($this->input->post('password'), $user['password'])) {
					$data = [
						'is_login' => 'punten',
						'nama' => $user['nama_siswa'],
						'username' => $user['username'],
						'nama_role' => 'siswa',
						'foto' => $user['foto'],
						'nisn' => $user['nisn'],
						'role' => 5
					];

					$this->session->set_userdata($data);
					$this->session->set_flashdata('msg_success', 'Selamat, Anda berhasil login');
					redirect('siswa/dashboard');

                } else {
                    $this->session->set_flashdata('msg_failed', 'Ups!, Password anda salah!');
                    redirect('/');
                }
            } else {
                $this->session->set_flashdata('msg_failed', 'Ups!, Akun anda belum terdaftar!');
                redirect('/');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('is_login');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('foto');
        $this->session->unset_userdata('nama_role');
        $this->session->unset_userdata('nisn');
        $this->session->set_flashdata('msg_success', 'Selamat, Anda berhasil logut');
        redirect('/');
    }

    public function logout_peserta()
    {

        //update login status
            $this->session->unset_userdata('is_login');
            $this->session->unset_userdata('nama');
            $this->session->set_flashdata('msg_success', 'Selamat, Anda berhasil logut');
            redirect('?p=login');
    }
}
