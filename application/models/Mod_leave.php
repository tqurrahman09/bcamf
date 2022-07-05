<?php
defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////
// Author Dede Juniawan Suri //
///////////////////////////////

class Mod_leave extends Mod_datatables {

	/**
	 * [$table description]
	 * @var [type]
	 */
	private $table = 'leave';

	/**
	 * [$column_order description]
	 * @var array
	 */
	private $column_order = array(
								'master_employee.employee_id',
								'master_employee.employee_name',
								'master_department.department_name',
								'leave_detail.date',
								'leave.id',
								'leave.status'
							);
	/**
	 * [$column_search description]
	 * @var array
	 */
	private $column_search = array(
								'master_employee.employee_id',
								'master_employee.employee_name',
								'master_department.department_name',
								'leave_detail.date',
								'leave.id',
								'leave.status'
							);
	/**
	 * [$order description]
	 * @var array
	 */
	private $order = array('leave.id');

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
					leave.id as id,
					master_employee.employee_id as employee_id,
					master_employee.employee_name as employee_name,
					master_department.department_name as department_name,
					GROUP_CONCAT(DATE_FORMAT(leave_detail.date, "%d-%m-%Y") SEPARATOR ", ") as leave_dates,
					COUNT(leave.id) as number_of_days,
					leave.status as status
			');
		$this->db->from($this->table);
		$this->db->join('leave_detail', 'leave_detail.leave_id = leave.id');
		$this->db->join('master_employee', 'master_employee.id = leave.employee_id');
		$this->db->join('master_department', 'master_department.id = master_employee.department_id');
		$this->db->where('master_employee.id', $this->session->userdata($this->config->item('user_id')));
		$this->db->group_by('leave.id');

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
	 * [save_leave description]
	 * @param  [type] $master [description]
	 * @param  [type] $detail [description]
	 * @return [type]         [description]
	 */
	public function save_leave($master, $detail){
		$dates = explode(',', $detail);
		$temp = array();
		$this->db->trans_begin();
		$this->db->insert($this->table, $master);
		$master_id = $this->db->insert_id();
		foreach ($dates as $value) {
			$temp[] = array(
						'leave_id' => $master_id,
						'date' => date('Y-m-d', strtotime($value))
					);
		}
		$this->db->insert_batch('leave_detail', $temp);
		if ($this->db->trans_status() === FALSE){
	        $this->db->trans_rollback();
	        return false;
		} else {
	        $this->db->trans_commit();
	        return true;
		}
	}

	/**
	 * [update_leave description]
	 * @param  [type] $master [description]
	 * @param  [type] $detail [description]
	 * @return [type]         [description]
	 */
	public function update_leave($id, $master, $detail){
		$master_id = $this->encrypt->decode(str_replace(" ", "+", $id));
		$dates     = explode(',', $detail);
		$temp      = array();
		$this->db->trans_begin();
		$this->db->update($this->table, $master, array('id' => $master_id));
		$this->db->where('leave_id', $master_id)->delete('leave_detail');
		foreach ($dates as $value) {
			$temp[] = array(
						'leave_id' => $master_id,
						'date' => date('Y-m-d', strtotime($value))
					);
		}
		$this->db->insert_batch('leave_detail', $temp);
		if ($this->db->trans_status() === FALSE){
	        $this->db->trans_rollback();
	        return false;
		} else {
	        $this->db->trans_commit();
	        return true;
		}
	}

	/**
	 * [get_head description]
	 * @return [type] [description]
	 */
	public function get_head(){
		$this->db->select('head.employee_name as head_name');
		$this->db->from('master_employee self');
		$this->db->join('master_employee head', 'head.id = self.head', 'left');
		$this->db->where('self.id', $this->session->userdata($this->config->item('user_id')));

		return $this->db->get();
	}

	/**
	 * [get_by_id description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function get_by_id($id){
		$this->db->select('
					head.employee_name as head,
					leave.job as job,
					leave.job_delegation as job_delegation,
					leave.purpose as purpose,
					leave.type as type
			');
		$this->db->from('master_employee self');
		$this->db->join('master_employee head', 'head.id = self.head', 'left');
		$this->db->join('leave', 'leave.employee_id = self.id');
		$this->db->where('leave.id', $id);

		return $this->db->get();
	}

	/**
	 * [get_child description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function get_child($id){
		$this->db->select('GROUP_CONCAT(DATE_FORMAT(date, "%d-%m-%Y") SEPARATOR ", ") as dates');
		$this->db->from('leave_detail');
		$this->db->where('leave_id', $id);
		$this->db->group_by('leave_id', $id);
		
		return $this->db->get();
	}

	/**
	 * [get_detail description]
	 * @return [type] [description]
	 */
	public function get_detail($id){
		$this->db->select('
					self.employee_name as employee_name,
					head.employee_name as head_name,
					GROUP_CONCAT(DATE_FORMAT(leave_detail.date, "%d-%m-%Y") SEPARATOR ", ") as leave_dates,
					leave.purpose as purpose,
					leave.job as job,
					leave.job_delegation as job_delegation,
					leave.type as type,
					leave.status as status,
					leave.submit_date as submit_date,
					leave.head_decided_by as head_decided_by,
					leave.head_decided_date as head_decided_date,
					leave.hrd_decided_by as hrd_decided_by,
					leave.hrd_decided_date as hrd_decided_date,
					leave.note as note,
				');
		$this->db->from($this->table);
		$this->db->join('leave_detail', 'leave_detail.leave_id = leave.id');
		$this->db->join('master_employee self', 'self.id = leave.employee_id');
		$this->db->join('master_employee head', 'head.id = self.head', 'left');
		$this->db->where('leave.id', $id);
		$this->db->group_by('leave.id');

		return $this->db->get();
	}

}

/* End of file Mod_leave.php */
/* Location: ./application/models/Mod_leave.php */