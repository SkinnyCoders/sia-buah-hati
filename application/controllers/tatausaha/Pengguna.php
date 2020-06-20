<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Pengguna extends CI_controller
{

    function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuthTatausaha();

        //load whatever you want bitch!!
        $this->load->model('m_users');
    }

    public function index()
    {
        $data['title'] = 'Pengguna';
        $data['users'] = $this->db->get('admin')->result_array();
 
        getViews($data, 'v_admin/v_users');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Pengguna';

        $this->form_validation->set_rules(
            'nama',
            'Nama',
            'required|trim',
            ['required' => '{field} tidak boleh kosong!']
        );
        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|trim|callback_CekUsername',
            ['required' => '{field} tidak boleh kosong', 'CekUsername' => 'Maaf, {field} sudah digunakan!']
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required',
            ['min_lenght' => '{field} terlalu pendek', 'required' => '{field} tidak boleh kosong']
        );
        $this->form_validation->set_rules(
            'password1',
            'Konfirm Password',
            'required|matches[password]',
            ['matches' => 'Password tidak sama', 'required' => '{field} tidak boleh kosong']
        );

        if ($this->form_validation->run() == FALSE) {
            getViews($data, 'v_admin/v_add_user');
        } else {
            $nama       = $this->input->post('nama', true);
            $username   = $this->input->post('username', true);
            $password   = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $foto       = $this->_uploadImage();

            $data = [
                'username' => $username,
                'nama' => $nama,
                'password' => $password,
                'foto' => $foto
            ];

            //proses insert data
            $insertUser = $this->m_users->addUser($data);
            if ($insertUser) {
                $this->session->set_flashdata('msg_success', 'Selamat, Pengguna berhasil digunakan');
                redirect('admin/pengguna');
            } else {
                $this->session->set_flashdata('msg_failed', 'Maaf, Pengguna gagal ditambahkan');
                redirect('admin/pengguna');
            }
        }
    }

    public function update($id)
    {
        $data['title']  = 'Ubah Pengguna';
        $data['user']   = $this->m_users->getUser($id);
        $username = $data['user'][0]['username'];


        $this->form_validation->set_rules(
            'nama',
            'Nama',
            'required|trim',
            ['required' => '{field} tidak boleh kosong!']
        );
        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|trim|callback_CekUsernameUpdate['.$username.']',
            ['required' => '{field} tidak boleh kosong', 'CekUsernameUpdate' => 'Maaf, {field} sudah digunakan!']
        );
        if(!empty($this->input->post('password'))){
            $this->form_validation->set_rules(
                'password',
                'Password',
                'required',
                ['min_lenght' => '{field} terlalu pendek', 'required' => '{field} tidak boleh kosong']
            );
            $this->form_validation->set_rules(
                'password1',
                'Konfirm Password',
                'required|matches[password]',
                ['matches' => 'Password tidak sama', 'required' => '{field} tidak boleh kosong']
            );
        }

        if (!empty($data['user'])) {
            if ($this->form_validation->run() == FALSE) {
                getViews($data, 'v_admin/v_edit_user');
            } else {
                $nama       = $this->input->post('nama', true);
                $username   = $this->input->post('username', true);

                if (!empty($_FILES['foto']['name'])) {
                    //do upload for new image
                    $foto = $this->_uploadImage();

                    //deleting old image
                    if ($foto && $data['user'][0]['foto'] !== 'default.png') {
                        unlink('assets/img/user/' . $data['user'][0]['foto']);
                    }
                } else {
                    $foto = $data['user'][0]['foto'];
                }

                if(!empty($this->input->post('password'))){
                    $password   = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
                    $data = [
                        'username' => $username,
                        'nama' => $nama,
                        'password' => $password,
                        'foto' => $foto
                    ];
                }else{
                    $data = [
                        'username' => $username,
                        'nama' => $nama,
                        'foto' => $foto
                    ];
                }

                //update user
                $update = $this->m_users->updateUser($data, $id);
                if ($update) {
                    $this->session->set_flashdata('msg_success', 'Selamat, Data pengguna berhasil diubah');
                    redirect('admin/pengguna');
                } else {
                    $this->session->set_flashdata('msg_failed', 'Maaf, Data pengguna gagal diubah');
                    redirect('admin/pengguna/ubah/' . $id);
                }
            }
        } else {
            $this->session->set_flashdata('msg_failed', 'Maaf, Data pengguna tidak ditemukan');
            redirect('admin/pengguna');
        }
    }

    public function delete($id)
    {
        if (!empty($id)) {
            //delete proses
            $delete = $this->db->delete('admin', ['username' => $id]);

            if ($delete) {

                $data['user']   = $this->m_users->getUser($id);
                if ($data['user'][0]['foto'] !== 'default.png') {
                    unlink('assets/img/user/' . $data['user'][0]['foto']);
                }
                $this->session->set_flashdata('msg_success', 'Selamat, Data pengguna berhasil dihapus');
                http_response_code(200);
            } else {
                $this->session->set_flashdata('msg_failed', 'Maaf, Data pengguna gagal dihapus');
                http_response_code(404);
            }
        }
    }

    public function CekUsername($str)
    {
        if ($this->m_users->cekUser($str) >= 1) {
            return false;
        } else {
            return true;
        }
    }

    public function CekUsernameUpdate($str, $username){
        if($str == $username){
            return true;
        }else{
            if ($this->m_users->cekUser($str) >= 1) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function CekEmailUpdate($str, $email){
    
        if($str == $email){
            return true;
        }else{
            if ($this->m_users->cekEmail($str) >= 1) {
                return false;
            } else {
                return true;
            }
        }
    }

    private function _uploadImage()
    {
        $config['upload_path']          = './assets/img/user/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['encrypt_name']         = TRUE;
        $config['overwrite']            = true;
        $config['max_size']             = 2048; //2mb

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            return $this->upload->display_errors();
        } else {
            return $this->upload->data('file_name');
        }
    }
}
