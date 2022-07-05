<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Denied extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->auth->restrict();
	}
	public function index()
	{
		$this->load->view('error_page/error_403');
	}

}

/* End of file Denied.php */
/* Location: ./application/controllers/Denied.php */