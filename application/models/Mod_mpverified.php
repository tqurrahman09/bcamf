<?php
defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////
// Author Dede Juniawan Suri //
///////////////////////////////

class Mod_mpverified extends Mod_datatables {

	/**
	 * [$table description]
	 * @var [type]
	 */
	private $table = 'memo_payment';

	/**
	 * [$column_order description]
	 * @var array
	 */
	private $column_order = array(
								'mp.no_ref',
								'master_user.username',
								'mp.date',
								'mp.to_dept',
								'mp.subject',
								'mp.supp_code',
								'mp.amount',
								'mp.pay_date',
								'mp.pay_desc',
								'mp.total_amount',
								'mp.post',
								'mp.import',
								'mp.journal_num_ax'
							);
	/**
	 * [$column_search description]
	 * @var array
	 */
	private $column_search = array(
								'mp.no_ref',
								'master_user.username',
								'mp.date',
								'mp.to_dept',
								'mp.subject',
								'mp.supp_code',
								'mp.amount',
								'mp.pay_date',
								'mp.pay_desc',
								'mp.total_amount',
								'mp.post',
								'mp.import',
								'mp.journal_num_ax'
							);
	/**
	 * [$order description]
	 * @var array
	 */
	private $order = array('mp.no_ref');

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
					mp.no_ref as no_ref,
					master_user.username as username,
					mp.date as date,
					mp.to_dept as to_dept,
					mp.subject as subject,
					mp.supp_code as supp_code,
					mp.amount as amount,
					mp.pay_date as pay_date,
					mp.pay_desc as pay_desc,
					mp.total_amount as total_amount,
					mp.post as post,
					mp.import as import,
					mp.journal_num_ax as journal_num_ax,
					mp.verified as verified
			');
		$this->db->from($this->table.' mp');
		$this->db->join('master_user', 'master_user.id = mp.user_id');
		$this->db->where('mp.verified', 0);

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
	 * [save_attachment description]
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public function save_attachment($data){
		$this->db->insert('memo_payment_file', $data);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * [delete_attachment description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function delete_attachment($id){
		$this->db->where('no_ref', $id);
		$this->db->delete('memo_payment_file');

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function verified($no_ref){
		$this->db->set('verified', '1');
		$this->db->where('no_ref', $no_ref);
		$this->db->update($this->table);
		return $this->db->affected_rows();	
	}

}

/* End of file Mod_monthlyexpense.php */
/* Location: ./application/models/Mod_monthlyexpense.php */