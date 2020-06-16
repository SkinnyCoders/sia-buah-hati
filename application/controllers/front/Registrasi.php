<?php 

/**
 * 
 */
class Registrasi extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('cektahun');
	}

	public function index(){
		$data = [
			'title' => 'Pendaftaran Siswa baru'
		];

		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', ['required' => '{field} tidak boleh kosong']);
		$this->form_validation->set_rules('nisn', 'NISN', 'required|trim|numeric', ['required' => '{field} tidak boleh kosong', 'numeric' => '{field} hanya berupa angka']);
		$this->form_validation->set_rules('agama', 'Agama', 'required|trim', ['required' => '{field} tidak boleh kosong']);
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim', ['required' => '{field} tidak boleh kosong']);
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', ['required' => '{field} tidak boleh kosong']);
		$this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required|trim', ['required' => '{field} tidak boleh kosong']);
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => '{field} tidak boleh kosong']);
		$this->form_validation->set_rules('nama_ortu', 'Nama Orang Tua', 'required|trim', ['required' => '{field} tidak boleh kosong']);
		$this->form_validation->set_rules('telepon_ortu', 'Telepon Ortu', 'required|trim', ['required' => '{field} tidak boleh kosong']);
		$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required|trim', ['required' => '{field} tidak boleh kosong']);
		$this->form_validation->set_rules('penghasilan', 'Penghasilan Ortu', 'required|trim', ['required' => '{field} tidak boleh kosong']);
		$this->form_validation->set_rules('alamat_ortu', 'Alamat Orang Ortu', 'required|trim', ['required' => '{field} tidak boleh kosong']);
		$this->form_validation->set_rules('agree','agreements', 'required',['required' => 'anda belum menyetujui']);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('v_home/v_registrasi', $data);
		}else{
			//tentukan kelas
			$kelas = $this->db->query("SELECT id_kelas FROM `kelas` WHERE `nama_kelas` = 'kelas 1' OR `nama_kelas` = 'Kelas1' OR `nama_kelas` = 'Kelas 1'")->row_array();
			//get tahun ajaran
			$tahun_now = date('Y');
			$tahun_ajaran = $this->db->get_where('tahun_ajaran', ['tahun_mulai' => getTahun()])->row_array();
			$id_tahun_ajaran = $tahun_ajaran['id_tahun_ajaran'];

			$tgl_lahir = DateTime::createFromFormat('m/d/Y', $this->input->post('tgl_lahir'))->format('Y-m-d');

			//no pendaftaran
			$lastNo = $this->db->query('SELECT `kode_pendaftaran` FROM `pendaftaran` ORDER BY `id_pendaftaran` DESC LIMIT 1')->row_array();
			if(!empty($lastNo['kode_pendaftaran'])){
				$lastNo = $lastNo['kode_pendaftaran'];
				$lastNo = explode('/', $lastNo);
				$lastNo = end($lastNo);
			}else{
				$lastNo = 0;
			}

			$no_daftar = $lastNo + 1;

			if ($no_daftar > 10) {
				$no_pendaftaran_last  = '00'.$no_daftar;
			}elseif ($lastNo > 100) {
				$no_pendaftaran_last  = '0'.$no_daftar;
			}else{
				$no_pendaftaran_last  = '000'.$no_daftar;
			}

			$tahun_now = substr($tahun_now, 2);

			$no_pendaftaran = $tahun_now.'/'.$no_pendaftaran_last;

			$data = [
				'kode_pendaftaran' => $no_pendaftaran,
				'nisn' => $this->input->post('nisn', true),
				'id_tahun_ajaran' => $id_tahun_ajaran
			];

			$data_diri = [
				'nisn' => $this->input->post('nisn', true),
				'nama_siswa' => $this->input->post('nama', true),
				'jenis_kelamin' => $this->input->post('gender'),
				'id_kelas' => $kelas['id_kelas'],
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tanggal_lahir' => $tgl_lahir,
				'agama' => $this->input->post('agama'),
				'alamat' => $this->input->post('alamat', true),
				'nama_ortu' => $this->input->post('nama_ortu', true),
				'telepon_ortu' => $this->input->post('telepon_ortu', true),
				'alamat_ortu' => $this->input->post('alamat_ortu', true),
				'pekerjaan_ortu' => $this->input->post('pekerjaan'),
				'penghasilan_ortu' => $this->input->post('penghasilan')
			];

			
			//insert data diri
			$insertdatadiri = $this->db->insert('siswa', $data_diri);
			if ($insertdatadiri) {

				//insert data diri
				$insertPendaftaran = $this->db->insert('pendaftaran', $data);

				if ($insertPendaftaran) {

					$this->session->set_flashdata('msg_success', 'Selamat, Pendaftaran berhasil');
					redirect('registrasi');
				}else{
					$this->session->set_flashdata('msg_failed', 'Maaf, Pendaftaran Gagal');
					redirect('registrasi');
				}
			}else{
				$this->session->set_flashdata('msg_failed', 'Maaf, Pendaftaran Gagal');
                redirect('registrasi');
			}
		}
		
	}

	public function cekEmail($str){
		$cek = $this->db->get_where('peserta', ['email_peserta' => $str])->num_rows();

		if ($cek > 0) {
			return false;
		}else{
			return true;
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

	public function getJalur(){
		$id_prodi = $_POST['id_prodi'];

		$jalur = $this->m_pendaftaran->jalurProdi($id_prodi);

		echo json_encode($jalur);
	}
}
 ?>