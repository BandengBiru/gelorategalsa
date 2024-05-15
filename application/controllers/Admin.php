<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = [
			'title' => 'Dashboard',
			'page'  => 'admin/dashboard'
		];

		$this->load->view('index', $data);
	}
}

/* End of file Admin.php */