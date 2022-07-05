<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {

	/**
	 * [__construct description]
	 */
	public function __construct(){
		parent::__construct();
	}

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index(){
		// die("yudi");
		$cookie = get_cookie($this->config->item('cookie'));
		if($this->auth->is_logged_in()){
			if ($this->authority->__is_super_admin()) {
				$first_page = 'user';
			}else{
				$first_look = $this->authority->__first_look();
				$first_page = strtolower($first_look->module);
			}
			redirect($first_page);
		}elseif($cookie != NULL){
			$this->auth->do_loginbycookie($cookie);
			if ($this->authority->__is_super_admin()) {
				$first_page = 'user';
			}else{
				$first_look = $this->authority->__first_look();
				$first_page = strtolower($first_look->module);
			}
			redirect($first_page);
		}else{
			$this->load->view('login/login');
		}
		
	}

	/**
	 * [login description]
	 * @return [type] [description]
	 */
	public function login(){
		$username = $this->input->post('employee_id');
		$password = $this->input->post('password');
		$remember = $this->input->post('remember');

		$callback = $this->auth->do_login($username, $password, $remember);

		if($this->auth->is_logged_in()){
			if ($this->authority->__is_super_admin()) {
				$first_page = 'user';
			} elseif(!$this->authority->__is_employee_only()) {
				$first_look = $this->authority->__first_look();
				$first_page = strtolower($first_look->module);
			} else {
				$first_page = 'user';
			}

			$data = array(
				'error' => false,
				'page' => $first_page
			);			
		}else{
			$data = array(
				'error' => true,
				'message' => $callback['message']
			);
		}

		echo json_encode($data);
	}

	/**
	 * [logout description]
	 * @return [type] [description]
	 */
	public function logout(){
		$this->auth->do_logout();
		redirect('login');
	}

	/**
	 * [bcrypt_gen temporary only]
	 * @return [type] [description]
	 */
	public function bcrypt_gen(){
		echo $this->bcrypt->hash_password("@gunawan");
	}

}
