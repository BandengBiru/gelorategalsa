<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Atmin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// memanggil model dengan nama M_Atmin dan di rename menjadi atmin
		$this->load->model('M_Atmin', 'atmin');
	}

	public function index()
	{
		// echo 'Ini adalah halaman atmin';

		$atmin = $this->atmin->getAllAtmin();

		$data = [
			'title' => 'Halaman Atmin',
			'page'  => 'atmin/v_atmin',
			'atmin'  => $atmin
		];

		// memanggil view dengan nama v_atmin
		$this->load->view('index', $data);
	}

	public function add()
	{
		$data = [
			'title' => 'Tambah Atmin',
			'page'  => 'atmin/v_addAtmin'
		];

		$this->load->view('index', $data);
	}

	public function store()
	{
		// xss clean dengan menambahkan TRUE

		$this->form_validation->set_rules('username', 'Username', 'required', [
			'required' => 'Username tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('nama', 'Nama', 'required|alpha_numeric_spaces', [
			'required' => 'Nama tidak boleh kosong!',
			'alpha_numeric_spaces'    => 'Nama harus diisi dengan huruf'
		]);
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email', [
			'required' => 'Email tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('nohp', 'NoHP', 'required|min_length[11]|max_length[13]|numeric', [
			'required'   => 'Nomor tidak boleh kosong!',
			'min_length' => 'Nomor tidak boleh kurang dari 11 karakter',
			'max_length' => 'Tahun tidak boleh lebih dari 10 karakter',
			'numeric'    => 'Tahun harus diisi dengan angka'
		]);

		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'Tambah Atmin',
				'page'  => 'atmin/v_addAtmin'
			];

			$this->load->view('index', $data);
		} else {
			$username = $this->input->post('username');
			$nama     = $this->input->post('nama');
			$email    = $this->input->post('email');
			$nohp     = $this->input->post('nohp');

			$data = [
				'username' => $username,
				'password' => password_hash('12345678', PASSWORD_BCRYPT),
				'nama'     => $nama,
				'email'    => $email,
				'nohp'    => $nohp
			];

			$insert = $this->atmin->addAtmin($data);

			if ($insert) {
				$this->session->set_flashdata('sukses', 'Data berhasil disimpan');

				redirect('atmin', 'refresh');
			} else {
				$this->session->set_flashdata('error', 'Data gagal disimpan!');

				redirect('atmin', 'refresh');
			}
		}
	}

	public function edit($id)
	{
		$atmin = $this->atmin->getOneAtmin($id);

		$data = [
			'title' => 'Edit Atmin',
			'page'	=> 'atmin/v_editAtmin',
			'atmin'  => $atmin
		];

		$this->load->view('index', $data);
	}

	public function update()
	{
		$id = $this->input->post('id');

		$this->form_validation->set_rules('username', 'Username', 'required', [
			'required' => 'Username harus diisi!'
		]);
		$this->form_validation->set_rules('nama', 'Nama', 'required', [
			'required' => 'Nama harus diisi!'
		]);
		$this->form_validation->set_rules('email', 'Email', 'required', [
			'required' => 'Email harus diisi!'
		]);
		$this->form_validation->set_rules('nohp', 'NoHP', 'required|numeric|min_length[11]|max_length[13]', [
			'required' => 'NoHp harus diisi!',
			'numeric'  => 'NoHp hanya bisa diisi dengan angka'
		]);

		if ($this->form_validation->run() == false) {
			$atmin = $this->atmin->getOneAtmin($id);

			$data = [
				'title' => 'Edit Atmin',
				'page'  => 'atmin/v_editAtmin',
				'atmin'  => $atmin
			];

			$this->load->view('index', $data);
		} else {
			$username = $this->input->post('username');
			$nama     = $this->input->post('nama');
			$email    = $this->input->post('email');
			$nohp    = $this->input->post('nohp');

			$data = [
				'username' => $username,
				'nama'     => $nama,
				'email'    => $email,
				'nohp'    => $nohp
			];

			$update = $this->atmin->editAtmin($id, $data);

			if ($update) {
				$this->session->set_flashdata('sukses', 'Data berhasil diedit');

				redirect('atmin', 'refresh');
			} else {
				$this->session->set_flashdata('error', 'Data gagak diedit');

				redirect('atmin', 'refresh');
			}
		}
	}

	public function delete($id)
	{
		$delete = $this->atmin->delete($id);

		if ($delete) {
			$this->session->set_flashdata('sukses', 'Data berhasil dihapus');

			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		} else {
			$this->session->set_flashdata('error', 'Data gagal dihapus');

			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		}
	}
}
