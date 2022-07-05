<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

////////////////////////////////
// Auth lib                   //
// Author: Dede Juniawan Suri //
////////////////////////////////

class Auth{
	/**
	 * [$CI description]
	 * @var null
	 */
	var $CI = NULL;
	/**
	 * [__construct description]
	 */
	function __construct()
	{
		// get CI's object
		$this->CI =& get_instance();
	}

	/**
	 * [do_login description]
	 * @param  [type] $username [description]
	 * @param  [type] $password [description]
	 * @return [type]           [description]
	 */
	function do_login($username, $password, $remember)
	{
		$this->CI->db->select('password');
		$this->CI->db->from('master_user');
		$this->CI->db->where('username', $username);
		$result = $this->CI->db->get();

		if ($result->num_rows() == 0) {
			return array(
				'status' => false,
				'message' => "Incorrect ID. <br>Please input correct ID."
			);
		} else {
			if ($this->CI->bcrypt->check_password($password, $result->row()->password)){
				$this->CI->db->select('
					master_user.id as id,
					master_user.username as username,
					master_user.dept_code as dept_code,
					master_user.area_code as area_code,
					master_user.group_id as group_id,
					master_user.worker_code as worker_code,
					master_user.division as division,
					master_user.customer_id as customer_id,
					master_user.wh_code as wh_code,
					master_user.position as position,
					master_user.rek_no as rek_no,
					master_user.veh_no as veh_no,
					master_user.image as image,
					master_area.company_code as company_code,
					_group.is_accounting as is_accounting
				');
				$this->CI->db->from('master_user');
				$this->CI->db->join('master_area', 'master_area.area_code = master_user.area_code');
				$this->CI->db->join('_group', '_group.id = master_user.group_id');
				$this->CI->db->where('master_user.username', $username);
				$userdata = $this->CI->db->get()->row();
				$session_data = array(
					$this->CI->config->item('user_id')       => $userdata->id,
					$this->CI->config->item('username')      => $userdata->username,
					$this->CI->config->item('dept_code')     => $userdata->dept_code,
					$this->CI->config->item('area_code')     => $userdata->area_code,
					$this->CI->config->item('level')         => $userdata->group_id,
					$this->CI->config->item('worker_code')   => $userdata->worker_code,
					$this->CI->config->item('division')      => $userdata->division,
					$this->CI->config->item('customer')      => $userdata->customer_id,
					$this->CI->config->item('wh')            => $userdata->wh_code,
					$this->CI->config->item('position')      => $userdata->position,
					$this->CI->config->item('rek_no')        => $userdata->rek_no,
					$this->CI->config->item('veh_no')        => $userdata->veh_no,
					$this->CI->config->item('image')         => $userdata->image,
					$this->CI->config->item('company_code')  => $userdata->company_code,
					$this->CI->config->item('is_accounting') => $userdata->is_accounting
				);
				$this->CI->session->set_userdata($session_data);
				if ($remember) {
					$this->set_mycookie();
				}
				return array(
					'status' => true,
					'message' => "Logged in."
				);
			} else {
				return array(
					'status' => false,
					'message' => "Incorrect password. <br>Please input correct password."
				);
			}
		}
	}

	/**
	 * [do_cookie description]
	 * @param  [type] $cookie [description]
	 * @return [type]         [description]
	 */
	function do_loginbycookie($cookie)
	{
		$this->CI->db->select('password');
		$this->CI->db->from('master_employee');
		$this->CI->db->where('cookie', $cookie);
		$result = $this->CI->db->get();

		if ($result->num_rows() == 0) {
			return false;
		} else {
			if ($this->CI->bcrypt->check_password($password, $result->row()->password)){
				$this->CI->db->select('
					master_employee.id as id, 
					master_employee.employee_name as name, 
					master_employee.image as image,
					master_employee.email as email,
					master_employee.area_id as area_id,
					master_department.company_id as company_id,
					_admin.group_id as group_id,
				');
				$this->CI->db->from('master_employee');
				$this->CI->db->join('_admin', '_admin.employee_id = master_employee.id');
				$this->CI->db->join('master_department', 'master_department.id = master_employee.department_id');
				$this->CI->db->where('cookie', $cookie);
				$result = $this->CI->db->get();
				if ($result->num_rows() == 0) {
					$this->CI->db->select('
						master_employee.id as id, 
						master_employee.employee_name as name, 
						master_employee.image as image,
						master_employee.email as email,
						master_employee.area_id as area_id,
						master_department.company_id as company_id,
						0 as group_id,
					');
					$this->CI->db->from('master_employee');
					$this->CI->db->join('master_department', 'master_department.id = master_employee.department_id');
					$this->CI->db->where('cookie', $cookie);
					$userdata = $this->CI->db->get()->row();
					$session_data = array(
						$this->CI->config->item('user_id')	=> $userdata->id,
						$this->CI->config->item('name')		=> $userdata->name,
						$this->CI->config->item('email')	=> $userdata->email,
						$this->CI->config->item('level')	=> $userdata->group_id,
						$this->CI->config->item('image')	=> $userdata->image,
						$this->CI->config->item('company')	=> $userdata->company_id
					);
				} else {
					$userdata = $result->row();
					$session_data = array(
						$this->CI->config->item('user_id')	=> $userdata->id,
						$this->CI->config->item('name')		=> $userdata->name,
						$this->CI->config->item('email')	=> $userdata->email,
						$this->CI->config->item('level')	=> $userdata->group_id,
						$this->CI->config->item('image')	=> $userdata->image,
						$this->CI->config->item('company')	=> $userdata->company_id
					);
				}
				$this->CI->session->set_userdata($session_data);
				if ($remember) {
					$this->set_mycookie();
				}
				return true;
			} else {
				return false;
			}
		}
	}

	/**
	 * [is_logged_in description]
	 * @return boolean [description]
	 */
	function is_logged_in()
	{
		if($this->CI->session->userdata($this->CI->config->item('user_id')) == NULL)
		{
			return false;
		} else {
			return true;
		}
	}

	/**
	 * [restrict description]
	 * @return [type] [description]
	 */
	function restrict()
	{
		if($this->is_logged_in() == false)
		{
			redirect('login');
		}
	}

	/**
	 * [do_logout description]
	 * @return [type] [description]
	 */
	function do_logout()
	{
		$this->CI->session->sess_destroy();
		delete_cookie($this->CI->config->item('cookie'));	
	}

	/**
	 * [set_cookie description]
	 * @param [type] $cookie [description]
	 * @param [type] $id     [description]
	 */
	function set_mycookie(){
        $cookie = random_string('alnum', 64);
        set_cookie($this->CI->config->item('cookie'), $cookie, 3600*24*5); // set expired 5 days
        $this->CI->db->set('cookie', $cookie);
		$this->CI->db->where('id', $this->CI->session->userdata($this->CI->config->item('user_id')));
		$this->CI->db->update('master_employee');
	}
}