<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Administrator extends CI_controller
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
            $this->load->view('v_tatausaha/v_login2');
        } else {
            //cek data for admin
            $user = $this->m_auth->cekUserTatausaha($this->input->post('username', TRUE));
            
            if (!empty($user)) {
                if (password_verify($this->input->post('password'), $user['password'])) {

                    switch($user['hak_akses']){
                        case 'tatausaha' :
                            $data = [
                                'is_login' => 'punten',
                                'nama' => $user['nama'],
                                'username' => $user['username'],
                                'nama_role' => 'TU',
                                'foto' => $user['foto'],
                                'id_gtk' => $user['id_gtk'],
                                'role' => 1
                            ];

                            $this->session->set_userdata($data);
                            $this->session->set_flashdata('msg_success', 'Selamat, Anda berhasil login');
                            redirect('tatausaha/dashboard');
                        break;

                        case 'guru kelas' :
                            $data = [
                                'is_login' => 'punten',
                                'nama' => $user['nama'],
                                'username' => $user['username'],
                                'nama_role' => 'Guru Kelas',
                                'foto' => $user['foto'],
                                'id_gtk' => $user['id_gtk'],
                                'role' => 2
                            ];

                            $this->session->set_userdata($data);
                            $this->session->set_flashdata('msg_success', 'Selamat, Anda berhasil login');
                            redirect('guru_kelas/dashboard');
                        break;

                        case 'kepsek' :
                            $data = [
                                'is_login' => 'punten',
                                'nama' => $user['nama'],
                                'username' => $user['username'],
                                'nama_role' => 'Kepala Sekolah',
                                'foto' => $user['foto'],
                                'id_gtk' => $user['id_gtk'],
                                'role' => 3
                            ];

                            $this->session->set_userdata($data);
                            $this->session->set_flashdata('msg_success', 'Selamat, Anda berhasil login');
                            redirect('kepsek/dashboard');
                        break;
                    }

                    
                } else {
                    $this->session->set_flashdata('msg_failed', 'Ups!, Password anda salah!');
                    redirect('administrator');
                }
            } else {
                $this->session->set_flashdata('msg_failed', 'Ups!, Akun anda belum terdaftar!');
                redirect('administrator');
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
