<?php
defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////
// Author Dede Juniawan Suri //
///////////////////////////////

class Mod_budget extends Mod_datatables {

	/**
	 * [$table description]
	 * @var [type]
	 */
	private $table = 'master_budget';

	/**
	 * [$column_order description]
	 * @var array
	 */
	private $column_order = array(
								'master_budget.user_id',
								'master_budget.budget_bbm',
								'master_budget.budget_pulsa',
								'master_budget.budget_hotel',
							);
	/**
	 * [$column_search description]
	 * @var array
	 */
	private $column_search = array(
								'master_budget.user_id',
								'master_budget.budget_bbm',
								'master_budget.budget_pulsa',
								'master_budget.budget_hotel',
							);
	/**
	 * [$order description]
	 * @var array
	 */
	private $order = array('master_budget.user_id');

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
					master_budget.user_id,
					master_worker.description,
					master_budget.budget_bbm,
					master_budget.budget_pulsa,
					master_budget.budget_hotel,
			');
		$this->db->from($this->table);
		$this->db->join('master_user', 'master_user.id = master_budget.user_id');
		$this->db->join('master_worker', 'master_user.worker_code = master_worker.worker_code');
		if(!$this->authority->__is_super_admin() && !$this->session->userdata($this->config->item('is_accounting')))
			$this->db->where('master_budget.user_id', $this->session->userdata($this->config->item('user_id')));

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
	 * [save_multiple description]
	 * @param  [type] $data    [description]
	 * @param  [type] $details [description]
	 * @return [type]          [description]
	 */
	public function save_multiple($data){
		$this->db->trans_start();
		$this->db->insert($this->table, $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			return false;
		}
		return true;
	}

	/**
	 * [update_multiple description]
	 * @param  [type] $data    [description]
	 * @param  [type] $id      [description]
	 * @return [type]          [description]
	 */
	public function update_multiple($data, $id){
		$this->db->trans_start();
		$this->db->update($this->table, $data, array('user_id' => $id));
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			return false;
		}
		return true;
	}

	/**
	 * [get_me description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function get_pc($id){
		$this->db->select("
				master_budget.user_id,
				master_worker.description,
				master_budget.budget_bbm,
				master_budget.budget_pulsa,
				master_budget.budget_hotel,
			");
		//end by ronix
		$this->db->from($this->table);
		$this->db->join('master_user', 'master_user.id = master_budget.user_id');
		$this->db->join('master_worker', 'master_user.worker_code = master_worker.worker_code');
		$this->db->where('master_budget.user_id', $id);

		return $this->db->get();
	}

	public function get_user(){
		$this->db->select("
			master_user.id as user_id,
			master_worker.worker_code as worker_code,
			master_worker.description as username
			");
		$this->db->from('master_user');
		$this->db->join('master_worker', 'master_user.worker_code = master_worker.worker_code');
		$this->db->group_by('master_worker.worker_code');

		return $this->db->get()->result();
	}

	/**
	 * [delete_by_id description]
	 * @param  [type] $pc_no [description]
	 * @return [type]        [description]
	 */
	public function delete_by_id($user_id){
		$this->db->where('user_id', $user_id);
		$this->db->delete($this->table);
		return $this->db->affected_rows();
	}


}

/* End of file Mod_monthlyexpense.php */
/* Location: ./application/models/Mod_monthlyexpense.php */