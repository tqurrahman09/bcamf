<?php
defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////
// Author Dede Juniawan Suri //
///////////////////////////////

class Mod_supplier extends Mod_datatables {

	/**
	 * [$table description]
	 * @var [type]
	 */
	private $table = 'master_supplier';

	/**
	 * [$column_order description]
	 * @var array
	 */
	private $column_order = array(
								'master_supplier.supp_code',
								'master_supplier.supp_name',
								'master_supplier.rek_no',
								'master_supplier.rek_type',
								'master_supplier.bank_name',
								'master_supplier.akun_name'
							);
	/**
	 * [$column_search description]
	 * @var array
	 */
	private $column_search = array(
								'master_supplier.supp_code',
								'master_supplier.supp_name',
								'master_supplier.rek_no',
								'master_supplier.rek_type',
								'master_supplier.bank_name',
								'master_supplier.akun_name'
							);
	/**
	 * [$order description]
	 * @var array
	 */
	private $order = array('master_supplier.supp_code');

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
					master_supplier.supp_code,
					master_supplier.supp_name,
					master_supplier.rek_no,
					master_supplier.rek_type,
					master_supplier.bank_name,
					master_supplier.akun_name
			');
		$this->db->from($this->table);
		// if(!$this->authority->__is_super_admin() && !$this->session->userdata($this->config->item('is_accounting')))
		// 	$this->db->where('pc.user_id', $this->session->userdata($this->config->item('user_id')));

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

	public function _get_report_query(){
		$this->db->select('
					petty_chash.pc_no as pc_no,
					master_user.username as username,
					petty_chash.date_from as date_from,
					petty_chash.date_to as date_to,
					petty_chash.amount as amount,
					petty_chash.post as post,
					petty_chash.import as import,
					petty_chash.journal_ax_num as journal_ax_num,
			');
		$this->db->from($this->table);
		$this->db->join('master_user', 'master_user.id = petty_chash.user_id');
		if(!$this->authority->__is_super_admin() && !$this->session->userdata($this->config->item('is_accounting')))
			$this->db->where('petty_chash.user_id', $this->session->userdata($this->config->item('user_id')));

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
	public function save_multiple($data, $details){
		$this->db->trans_start();
		$this->db->insert($this->table, $data);
		$master_id = $this->db->insert_id();
		if (!is_null($details)) {
			foreach ($details as $key => $value) {
				$detail = array(
					'pc_no'      => $data['pc_no'],
					'bkk_no'     => $value['bkk_no'],
					'remark'     => $value['remark'],
					'pc_code'    => $value['pc_code'],
					'amount'     => str_replace(',', '', $value['ammount']),
					'trans_date' => date('Y-m-d', strtotime($value['trans_date']))
				);
				$this->db->insert('petty_chash_detail', $detail);
			}
		}
		$this->db->set('id')->insert('seq_petty_cash');
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
	 * @param  [type] $details [description]
	 * @param  [type] $id      [description]
	 * @return [type]          [description]
	 */
	public function update_multiple($data, $details, $id){
		$this->db->trans_start();
		$this->db->update($this->table, $data, array('pc_no' => $id));
		$this->db->where('pc_no', $id)->delete('petty_chash_detail');
		if (!is_null($details)) {
			foreach ($details as $key => $value) {
				$detail= array(
					'pc_no'      => $data['pc_no'],
					'bkk_no'     => $value['bkk_no'],
					'remark'     => $value['remark'],
					'pc_code'    => $value['pc_code'],
					'amount'     => str_replace(',', '', $value['ammount']),
					'trans_date' => date('Y-m-d', strtotime($value['trans_date']))
				);
				$this->db->insert('petty_chash_detail', $detail);
			}
		}
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			return false;
		}
		return true;
	}

	/**
	 * [get_metype description]
	 * @return [type] [description]
	 */
	public function get_pctype(){
		return $this->db->from('master_pc_type')->get();
	}

	/**
	 * [get_me description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function get_pc($id){
		// $this->db->select('
		// 		self.pc_no as pc_no,
		// 		self.date_from as date_from,
		// 		self.date_to as date_to,
		// 		self.amount as amount,
		// 		self.post as post,
		// 		self.import as import,
		// 		self.cancel as cancel,
		// 		self.journal_ax_num as journal_ax_num,
		// 		master_user.username as username,
		// 		master_user.veh_no as veh_no,
		// 		master_department.dept_name as dept_name,
		// 		master_area.area_name as area_name,
		// 		master_user.rek_no as rek_no,
		// 		master_company.company_name as company_name,
		// 		self.pph as pph,
		// 		master_user.position as position,
		// 		self.pc_unpaid as pc_unpaid,
		// 		unpaid.amount as unpaid_amount,
		// 		master_rekening_bank.rek_name as rek_name,
		// 		master_rekening_bank.bank as bank,
		// 		master_worker.description as name
		// 	');

		// by ronix : 10-10-2019
		$this->db->select("
				self.pc_no as pc_no,
				self.date_from as date_from,
				self.date_to as date_to,
				date_format(self.date_from, '%d %M') as datefrom,
				date_format(self.date_to, '%d %M %Y') as dateto,
				self.amount as amount,
				self.post as post,
				self.import as import,
				self.cancel as cancel,
				self.journal_ax_num as journal_ax_num,
				master_user.username as username,
				master_user.veh_no as veh_no,
				master_department.dept_name as dept_name,
				master_area.area_name as area_name,
				master_user.rek_no as rek_no,
				master_company.company_name as company_name,
				self.pph as pph,
				master_user.position as position,
				self.pc_unpaid as pc_unpaid,
				unpaid.amount as unpaid_amount,
				self.unpaid_amt as unpaid_amt,
				master_rekening_bank.rek_name as rek_name,
				master_rekening_bank.bank as bank,
				master_worker.description as name,
				self.pending_amt as pending_amt,
				self.prepared_by as prepared_by
			");
		//end by ronix
		$this->db->from($this->table.' self');
		$this->db->join('master_user', 'master_user.id = self.user_id');
		$this->db->join('master_area', 'master_area.area_code = master_user.area_code');
		$this->db->join('master_worker', 'master_worker.worker_code = master_user.worker_code');
		$this->db->join('master_company', 'master_company.company_code = master_area.company_code');
		$this->db->join('master_department', 'master_department.dept_code = master_user.dept_code');
		$this->db->join('master_rekening_bank', 'master_rekening_bank.rek_no = master_user.rek_no');
		$this->db->join('petty_chash unpaid', 'unpaid.pc_no = self.pc_unpaid', 'left');
		$this->db->where('self.pc_no', $id);

		return $this->db->get();
	}

	/**
	 * [get_medetails description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function get_pcdetails($id){
		$this->db->from('petty_chash_detail');
		$this->db->join('master_pc_type', 'master_pc_type.pc_code = petty_chash_detail.pc_code');
		$this->db->where('pc_no', $id);

		return $this->db->get();
	}

	/**
	 * [save_attachment description]
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public function save_attachment($data){
		$this->db->insert('petty_chash_file', $data);

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
		$this->db->where('id', $id);
		$this->db->delete('petty_chash_file');

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	// /**
	//  * [delete_by_id description]
	//  * @param  [type] $pc_no [description]
	//  * @return [type]        [description]
	//  */
	// public function delete_by_id($pc_no){
	// 	$this->db->where('pc_no', $pc_no);
	// 	$this->db->delete($this->table);
		
	// 	return $this->db->affected_rows();
	// }

	//by ronix : 8-10-2019
    //cancel with status <> Post
	/**
	 * [delete_by_id description]
	 * @param  [type] $pc_no [description]
	 * @return [type]        [description]
	 */
	public function delete_by_id($pc_no){
		$this->db->where('pc_no', $pc_no);
		$this->db->where('post', 0);
		$this->db->delete($this->table);
		return $this->db->affected_rows();
	}

	/**
	 * [get_lastid description]
	 * @return [type] [description]
	 */
	public function get_lastid(){
		$this->db->select('id,sequence');
		$this->db->from('seq_petty_cash');
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);

		return $this->db->get();
	}



	/**
	 * [get_pcunpaidadd description]
	 * @return [type] [description]
	 */
	public function get_pcunpaidadd(){
		$this->db->select('pc_no');
		$this->db->from($this->table);
		$this->db->where('user_id', $this->session->userdata($this->config->item('user_id')));

		return $this->db->get();
	}

	/**
	 * [get_pcunpaidedit description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function get_pcunpaidedit($id){
		$this->db->select('user_id');
		$this->db->from($this->table);
		$this->db->where('pc_no', $id);
		$user_id = $this->db->get()->row()->user_id;

		$this->db->select('pc_no');
		$this->db->from($this->table);
		$this->db->where('user_id', $user_id);
		$this->db->where('pc_no !=', $id);

		return $this->db->get();
	}

	/**
	 * [get_pclimit description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function get_pclimit($id){
		$this->db->select('pc_limit');
		$this->db->from('master_department');
		$this->db->join('master_user', 'master_user.dept_code = master_department.dept_code');
		$this->db->join('petty_chash', 'petty_chash.user_id = master_user.id');
		$this->db->where('petty_chash.pc_no', $id);

		return $this->db->get();
	}



	//by ronix : 10-10-2019
	/**
	 * [get_pcunpaidedit description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function get_pcunpaidamt($id){
		$this->db->select('unpaid_amt');
		$this->db->from($this->table);
		$this->db->where('pc_no', $id);
	
		return $this->db->get();
	}
	//end by ronix
	//
	
	public function get_dept(){
		$this->db->select('dept_name');
		$this->db->from('master_department');
		$this->db->join('master_user', 'master_user.dept_code = master_department.dept_code');
		$this->db->where('master_user.id', $this->session->userdata($this->config->item('user_id')));
	
		return $this->db->get();
	}


}

/* End of file Mod_monthlyexpense.php */
/* Location: ./application/models/Mod_monthlyexpense.php */