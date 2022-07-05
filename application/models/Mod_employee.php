<?php
defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////
// Author Dede Juniawan Suri //
///////////////////////////////

class Mod_employee extends Mod_datatables {

	/**
	 * [$table description]
	 * @var [type]
	 */
	private $table = 'master_employee';

	/**
	 * [$column_order description]
	 * @var array
	 */
	private $column_order = array(
								'self.employee_id',
								'self.employee_name',
								'self.email',
								'master_department.department_name',
								'head.employee_name'
							);
	/**
	 * [$column_search description]
	 * @var array
	 */
	private $column_search = array(
								'self.employee_id',
								'self.employee_name',
								'self.email',
								'master_department.department_name',
								'head.employee_name'
							);
	/**
	 * [$order description]
	 * @var array
	 */
	private $order = array('master_employee.id');

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
					self.id as id,
					self.employee_id as employee_id,
					self.employee_name as name,
					self.email as email,
					master_department.department_name as department,
					head.employee_name as head
			');
		$this->db->from($this->table.' self');
		$this->db->join('master_department', 'master_department.id = self.department_id');
		$this->db->join('master_employee head', 'head.id = self.head', 'left');

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
	 * [import description]
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public function import($datas){
		$this->db->trans_begin();
		foreach ($datas as $data) {
			$this->db->replace($this->table, $data);
		}
		if ($this->db->trans_status() === FALSE){
	        $this->db->trans_rollback();
	        return false;
		} else {
	        $this->db->trans_commit();
	        return true;
		}
	}

	/**
	 * [get_by_id description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function get_by_id($id){
		$this->db->from($this->table);
		$this->db->where('master_employee.id', $id);

		return $this->db->get();
	}

	/**
	 * [get_detail description]
	 * @return [type] [description]
	 */
	public function get_detail($id){
		$this->db->select('
					master_employee.employee_id,
					master_employee.employee_payroll_id,
					master_department.department_name as department,
					master_company.company_name as company,
					master_area.area_name as area,
					master_employee.employee_name,
					head.employee_name as head,
					master_employee.email,
					master_employee.join_date,
					master_level.level_name as level,
					master_employee.status,
					master_employee.resign_date,
				');
		$this->db->from($this->table);
		$this->db->join('master_employee head', 'head.id = master_employee.head', 'left');
		$this->db->join('master_level', 'master_level.id = master_employee.level_id');
		$this->db->join('master_area', 'master_area.id = master_employee.area_id');
		$this->db->join('master_department', 'master_department.id = master_employee.department_id');
		$this->db->join('master_company', 'master_company.id = master_department.company_id');
		$this->db->where('master_employee.id', $id);

		return $this->db->get();
	}

	/**
	 * [get_head description]
	 * @return [type] [description]
	 */
	public function get_head(){
		$this->db->from($this->table);

		return $this->db->get();
	}

	/**
	 * [get_area description]
	 * @return [type] [description]
	 */
	public function get_area(){
		$this->db->from('master_area');

		return $this->db->get();
	}

	/**
	 * [get_department description]
	 * @return [type] [description]
	 */
	public function get_department(){
		$this->db->from('master_department');

		return $this->db->get();
	}

	/**
	 * [get_company description]
	 * @return [type] [description]
	 */
	public function get_company(){
		$this->db->from('master_company');

		return $this->db->get();
	}

	/**
	 * [get_level description]
	 * @return [type] [description]
	 */
	public function get_level(){
		$this->db->from('master_level');

		return $this->db->get();
	}

	/**
	 * [get_employeebyid description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function get_employeebyname($name){
		$this->db->select('master_employee.id as id, employee_name as text');
		$this->db->from('master_employee');
		if ($name) {
			$this->db->like('master_employee.employee_name', $name, 'after');
		} else {
			$this->db->limit(10);
		}

		return $this->db->get();
	}

}

/* End of file Mod_chickin.php */
/* Location: ./application/models/Mod_chickin.php */