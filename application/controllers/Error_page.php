<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error_page extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function error_404()
	{
		$this->output->set_status_header('404'); 
    	$this->load->view('error_page/error_404');
    }

    public function error_403()
	{
		$this->output->set_status_header('403'); 
    	$this->load->view('error_page/error_403');
    }
}

/* End of file Error.php */
/* Location: ./application/controllers/Error.php */