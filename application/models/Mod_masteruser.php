<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_masteruser extends CI_Model {

	/**
	 * [__construct description]
	 */
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	/**
	 * [get description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function get($id){
		$this->db->select('
				id,
				dept_code,
				area_code,
				username,
				master_user.worker_code,
				cost_center_code,
				division,
				master_user.customer_id,
				customer_group,
				wh_code,
				position,
				rek_no,
				veh_no,
				master_worker.description
			');
		$this->db->from('master_user');
		$this->db->where('master_user.id', $id);
		$this->db->join('master_customer', 'master_customer.customer_id = master_user.customer_id');
		$this->db->join('master_worker', 'master_worker.worker_code = master_user.worker_code');
		return $this->db->get();
	}
}

/* End of file Mod_masteruser.php */
/* Location: ./application/models/Mod_masteruser.php */