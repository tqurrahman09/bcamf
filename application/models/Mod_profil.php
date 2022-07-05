<?php
defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////
// Author Dede Juniawan Suri //
///////////////////////////////

class Mod_profil extends CI_Model {

	/**
	 * [$table description]
	 * @var string
	 */
	private $table = 'master_user';

	/**
	 * [__construct description]
	 */
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	/**
	 * [get_mycompany description]
	 * @return [type] [description]
	 */
	public function get_mycompany(){
		$this->db->select('master_company.company_name as company_name');
		$this->db->from('master_company');
		$this->db->join('_admin_company', '_admin_company.company_id = master_company.id');
		$this->db->join('_admin', '_admin.id = _admin_company.admin_id');
		$this->db->where('_admin.employee_id', $this->session->userdata($this->config->item('user_id')));

		return $this->db->get()->result();
	}

	/**
	 * [check_password description]
	 * @param  [type] $current_password [description]
	 * @return [type]                   [description]
	 */
	public function check_password(){
		$this->db->select('password');
		$this->db->from($this->table);
		$this->db->where('id', $this->session->userdata($this->config->item('user_id')));

		return $this->db->get();
	}

	/**
	 * [change_password description]
	 * @param  [type] $new_password [description]
	 * @return [type]               [description]
	 */
	public function change_password($new_password){
		$this->db->set('password', $new_password);
		$this->db->where('id', $this->session->userdata($this->config->item('user_id')));
		$this->db->update($this->table);
		$data = ($this->db->affected_rows() == 1) ? true : false;

		return $data;
	}

}

/* End of file Mod_profil.php */
/* Location: ./application/models/Mod_profil.php */