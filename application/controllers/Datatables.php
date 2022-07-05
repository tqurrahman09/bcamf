<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datatables extends CI_Controller {

	/**
	 * [$module description]
	 * @var [type]
	 */
	protected $module;
	/**
	 * [$title description]
	 * @var [type]
	 */
	protected $title;
	/**
	 * [$breadcrumb description]
	 * @var [type]
	 */
	protected $breadcrumb;
	/**
	 * [$content description]
	 * @var [type]
	 */
	protected $content;
	/**
	 * [$in_js description]
	 * @var [type]
	 */
	protected $in_js;
	/**
	 * [$ex_js description]
	 * @var [type]
	 */
	protected $ex_js;
	/**
	 * [$info description]
	 * @var [type]
	 */
	protected $info;
	/**
	 * [$data description]
	 * @var array
	 */
	protected $data = [];
	/**
	 * [$authority_view description]
	 * @var [type]
	 */
	protected $authority_view;
	/**
	 * [$authority_crud description]
	 * @var [type]
	 */
	protected $authority_crud;

	/**
	 * [__construct description]
	 */
	public function __construct(){
		parent::__construct();
		$this->auth->restrict();
		// $this->authority->__restrict_view($this->module);
	}

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index(){		
		$data['module'] = $this->module;
        $data['title'] = $this->title;
        $data['breadcrumb'] = $this->title;
        $data['content'] = $this->module;
        $data['in_js'] = $this->in_js;
        $data['ex_js'] = $this->ex_js;
        $data['info'] = $this->info;
        $data['data'] = $this->data;
        $data['authority_view'] = $this->authority_view;
		$data['authority_crud'] = $this->authority_crud;
        $this->load->view('admin_template/template',$data);
	}

	/**
	 * [ajax_edit description]
	 * @return [type] [description]
	 */
	public function ajax_edit(){
		$data = $this->mod_datatables->get_by_id($this->encrypt->decode($this->input->post('data')));		
		echo json_encode($data);
	}

	/**
	 * [ajax_delete description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function ajax_delete(){	
		$delete = $this->mod_datatables->delete_by_id($this->encrypt->decode($this->input->post('data')));
		if ($delete > 0) {
			$callback = array(
				'status' => true,
				'message' => 'Data berhasih dihapus'
			);
		} else {
			$callback = array(
				'status' => false,
				'message' => 'Gagal menghapus data'
			);
		}
		echo json_encode($callback);
	}

	/**
	 * [change_company description]
	 * @return [type] [description]
	 */
	public function change_company(){
		$company = $this->input->post('self_company');
		$origin_url = $this->input->post('origin_url');
		$this->session->set_userdata($this->config->item('company'), $company);
		if ($this->session->userdata($this->config->item('company')) == $company) {
			redirect($origin_url,'refresh');
		}
	}

	public function quick_search(){
		$data = array(
			'data' => $this->mod_datatables->get_menus($this->input->post('query'))
		);
		$this->load->view('quick_search/quick_search', $data);
	}
}

/* End of file Datatables.php */
/* Location: ./application/controllers/Datatables.php */