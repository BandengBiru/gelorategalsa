<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Film extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Film', 'film');
	}

	public function index()
	{
		$data = [
			'title'  => 'Film',
			'page'   => 'film/v_film',
			'film' => $this->film->getAllFilm()
		];

		$this->load->view('index', $data);
	}

	public function add()
	{
		$data = [
			'title' => 'Add Film',
			'page'  => 'film/v_addFilm'
		];

		$this->load->view('index', $data);
	}

	public function store()
	{
		$this->form_validation->set_rules('judul', 'Judul', 'required', [
			'required' => 'Judul Film tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('genre', 'Genre', 'required', [
			'required' => 'Genre Film tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('durasi', 'Durasi', 'required', [
			'required' => 'Durasi Film tidak boleh kosong!'
		]);

		if ($this->form_validation->run() == FALSE) {
			$this->add();
		} else {
			$judul	  = $this->input->post('judul');
			$genre     = $this->input->post('genre');
			$durasi    = $this->input->post('durasi');

			$data = [
				'judul'     => $judul,
				'genre'     => $genre,
				'durasi'    => $durasi
			];

			$insert = $this->film->addFilm($data);

			if ($insert) {
				$this->session->set_flashdata('sukses', 'Data berhasil disimpan');

				redirect('film', 'refresh');
			} else {
				$this->session->set_flashdata('error', 'Data gagal disimpan!');

				redirect('film', 'refresh');
			}
		}
	}

	public function edit($id)
	{
		$film = $this->film->getOneFilm($id);

		$data = [
			'title'  => 'Edit Film',
			'page'   => 'film/v_editFilm',
			'film'   => $film
		];

		$this->load->view('index', $data);
	}

	public function update()
	{
		$id = $this->input->post('id');

		$this->form_validation->set_rules('judul', 'Judul', 'required', [
			'required' => 'Judul Film harus diisi!'
		]);
		$this->form_validation->set_rules('genre', 'Genre', 'required', [
			'required' => 'Genre Film harus diisi!'
		]);
		$this->form_validation->set_rules('durasi', 'Durasi', 'required', [
			'required' => 'Durasi Film harus diisi!'
		]);

		if ($this->form_validation->run() == false) {
			$this->edit($id);
		} else {
			$judul = $this->input->post('judul');
			$genre = $this->input->post('genre');
			$durasi = $this->input->post('durasi');

			$data = [
				'judul' => $judul,
				'genre' => $genre,
				'durasi' => $durasi
			];

			$update = $this->film->editFilm($id, $data);

			if ($update) {
				$this->session->set_flashdata('sukses', 'Data berhasil diedit');

				redirect('film', 'refresh');
			} else {
				$this->session->set_flashdata('error', 'Data gagal diedit');

				redirect('film', 'refresh');
			}
		}
	}

	public function delete($id)
	{
		$delete = $this->film->delete($id);

		if ($delete) {
			$this->session->set_flashdata('sukses', 'Data berhasil dihapus');

			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		} else {
			$this->session->set_flashdata('error', 'Data gagal dihapus');

			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		}
	}
}