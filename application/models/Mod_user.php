<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Mod_user extends Mod_datatables {
	/**
	 * [$table description]
	 * @var [type]
	 */
	private $table = 'master_user';
	/**
	 * [$column_order description]
	 * @var array
	 */
	private $column_order = array(
								null,
								'master_user.username',
								'_group.group_name'
							);
	/**
	 * [$column_search description]
	 * @var array
	 */
	private $column_search = array(
								'master_user.username',
								'_group.group_name',
								// 'master_farm.description',
								// 'master_company.description'
							);
	/**
	 * [$order description]
	 * @var array
	 */
	private $order = array('_user.id');

	/**
	 * [__construct description]
	 */
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		parent::setTable($this->table);
		parent::setColumnOrder($this->column_order);
		parent::setColumnSearch($this->column_search);
		parent::setOrder($this->order);
	}

	/**
	 * [_get_datatables_query description]
	 * @return [type] [description]
	 */
	public function _get_datatables_query(){
		$this->db->select('
				master_user.id as id,
				master_user.username as username,
				master_department.dept_name as dept_name,
				master_area.area_name as area_name,
				_group.group_name as group_name,
				master_user.worker_code as worker_code,
				master_worker.description as description,
				master_user.division as division,
				master_customer.customer_name as customer_name,
				master_customer.customer_group as customer_group,
				master_wh.description as wh,
				master_user.position as position,
				master_user.rek_no as rek_no,
				master_user.veh_no as veh_no,
				master_user.image as image
			')
			->from($this->table)
			->join('master_department', 'master_department.dept_code = master_user.dept_code')
			->join('master_area', 'master_area.area_code = master_user.area_code')
			->join('master_customer', 'master_customer.customer_id = master_user.customer_id')
			->join('master_wh', 'master_wh.wh_code = master_user.wh_code')
			->join('_group', '_group.id = master_user.group_id')
			->join('master_worker', 'master_worker.worker_code = master_user.worker_code')
			->where('_group.id !=', 1)
			->group_by('master_user.id');

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	/**
	 * [save_user description]
	 * @param  [type] $data_user        [description]
	 * @param  [type] $data_usercompany [description]
	 * @param  [type] $data_userfarm    [description]
	 * @return [type]                   [description]
	 */
	public function save_user($data_user){
		$this->db->insert($this->table, $data_user);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * [update_user description]
	 * @param  [type] $data_user        [description]
	 * @param  [type] $data_usercompany [description]
	 * @param  [type] $data_userfarm    [description]
	 * @param  [type] $user_id          [description]
	 * @return [type]                   [description]
	 */
	public function update_user($data_user, $user_id){
		$this->db->update($this->table, $data_user, array('id' => $user_id));
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * [ajax_getgroup description]
	 * @return [type] [description]
	 */
	public function get_group(){
		$this->db->select('id, group_name');
		$this->db->from('_group');
		$this->db->where('id !=', 1);
		return $this->db->get()->result();
	}

	/**
	 * [get_department description]
	 * @return [type] [description]
	 */
	public function get_department(){
		$this->db->from('master_department');

		return $this->db->get()->result();
	}

	/**
	 * [get_area description]
	 * @return [type] [description]
	 */
	public function get_area(){
		$this->db->from('master_area');

		return $this->db->get()->result();
	}

	/**
	 * [get_rek description]
	 * @return [type] [description]
	 */
	public function get_rek(){
		$this->db->from('master_rekening_bank');

		return $this->db->get()->result();
	}

	/**
	 * [get_vehicle description]
	 * @return [type] [description]
	 */
	public function get_vehicle(){
		$this->db->from('master_vehicle');

		return $this->db->get()->result();
	}

	/**
	 * [get_worker description]
	 * @return [type] [description]
	 */
	public function get_worker(){
		$this->db->from('master_worker');

		return $this->db->get()->result();
	}

	/**
	 * [get_customer description]
	 * @return [type] [description]
	 */
	public function get_customer(){
		$this->db->from('master_customer');

		return $this->db->get()->result();
	}

	/**
	 * [get_costcenter description]
	 * @return [type] [description]
	 */
	public function get_costcenter(){
		$this->db->from('master_cost_center');

		return $this->db->get()->result();
	}

	/**
	 * [get_wh description]
	 * @return [type] [description]
	 */
	public function get_wh(){
		$this->db->from('master_wh');

		return $this->db->get()->result();
	}

	/**
	 * [check_usernameadd description]
	 * @param  [type] $username [description]
	 * @return [type]           [description]
	 */
	public function check_usernameadd($username){
		$this->db->from($this->table);
		$this->db->where('username', $username);
		$data = ($this->db->get()->num_rows() == 1) ? false : true;

		return $data;
	}

	/**
	 * [check_usernameedit description]
	 * @param  [type] $id       [description]
	 * @param  [type] $username [description]
	 * @return [type]           [description]
	 */
	public function check_usernameedit($id, $username){
		$this->db->from($this->table);
		$this->db->where('username', $username);
		$this->db->where('id !=', $id);
		$data = ($this->db->get()->num_rows() == 1) ? false : true;

		return $data;
	}

}
/* End of file Mod_user.php */
/* Location: ./application/models/Mod_user.php */