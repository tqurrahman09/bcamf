<?php
defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////
// Author Dede Juniawan Suri //
///////////////////////////////

class Profil extends CI_Controller {

	/**
	 * [$module description]
	 * @var string
	 */
	public $module = 'profil';

	/**
	 * [$self_company description]
	 * @var [type]
	 */
	public $self_company;

	/**
	 * [$title description]
	 * @var [type]
	 */
	public $title;

	/**
	 * [$breadcrumb description]
	 * @var [type]
	 */
	public $breadcrumb;

	/**
	 * [$content description]
	 * @var [type]
	 */
	public $content;

	/**
	 * [$in_js description]
	 * @var [type]
	 */
	public $in_js;

	/**
	 * [$ex_js description]
	 * @var [type]
	 */
	public $ex_js;

	/**
	 * [$js_sources description]
	 * @var array
	 */
	public $js_sources = array();

	/**
	 * [$form_sources description]
	 * @var array
	 */
	public $form_sources = array();

	/**
	 * [$info description]
	 * @var null
	 */
	public $info = null;

	/**
	 * [$module_title description]
	 * @var [type]
	 */
	public $module_title;

	/**
	 * [$table_title description]
	 * @var [type]
	 */
	public $table_title; 

	/**
	 * [__construct description]
	 */
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->auth->restrict();
		$this->authority_crud   = $this->authority->__authority_crud($this->module);
		$this->load->model('mod_profil');
	}

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index()
	{
		$this->module       = $this->module;
		$this->title        = 'Profil';
		$this->module_title = 'Profil';
		$this->breadcrumb   = 'Profil';
		$this->table_title  = 'Profil List';
		$this->content      = $this->module;
		$this->in_js        = false;
		$this->ex_js        = true;
		$this->js_sources   = array('init.js');
		$this->info         = 'Form untuk input data '.$this->module.'. Mohon pastikan data telah benar sebelum disimpan'; //set null if not display info to user
        $data['data'] = array(
        	// 'my_company' => $this->mod_profil->get_mycompany()
        );
        $data['authority_view'] = $this->authority->__authority_view();
		$data['authority_crud'] = $this->authority->__authority_crud($this->module);
        $this->load->view('template/template',$data);
	}

	/**
	 * [current_password description]
	 * @return [type] [description]
	 */
	public function current_password(){
		$data = $this->mod_profil->check_password();
		if ($this->bcrypt->check_password($this->input->post('cur_password'), $data->row()->password)) {
			echo json_encode(true);
		} else {
			echo json_encode(false);
		}
	}

	/**
	 * [change_password description]
	 * @return [type] [description]
	 */
	public function change_password(){
		$curr_pass  = $this->input->post('cur_password');
		$new_pass   = $this->input->post('new_password');
		$re_newpass = $this->input->post('re_newpassword');
		$is_pass    = $this->mod_profil->check_password();

		if ($this->bcrypt->check_password($curr_pass, $is_pass->row()->password)) {
			if ($new_pass == $re_newpass) {
				$updated = $this->mod_profil->change_password($this->bcrypt->hash_password($new_pass));
				if ($updated) {
					$data = array(
						'status' => true,
						'message' => 'Password berhasil di-update, gunakan password terbaru untuk login selanjutnya.'
					);
				} else {
					$data = array(
						'status' => false,
						'message' => 'Terjadi kesalahan pada server.'
					);
				}
			} else {
				$data = array(
					'status' => false,
					'message' => 'Update password gagal, field new password dan re-enter new password harus sama.'
				);
			}
		} else {
			$data = array(
				'status' => false,
				'message' => 'Update password gagal, password aktif yang Anda masukan salah.'
			);
		}

		echo json_encode($data);
	}
	
}

/* End of file Profil.php */
/* Location: ./application/controllers/Profil.php */