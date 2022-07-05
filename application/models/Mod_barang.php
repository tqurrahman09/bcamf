<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_barang extends Mod_datatables {
	/**
	 * [$table description]
	 * @var [type]
	 */
	private $table = 'transaction';
	/**
	 * [$column_order description]
	 * @var array
	 */
	private $column_order = array(
								null,
								'transaction.id',
								'transaction.namaBarang'
							);
	/**
	 * [$column_search description]
	 * @var array
	 */
	private $column_search = array(
								'transaction.namaBarang',
								'transaction.stok'
							);

	private $order = array('transaction.id');

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

	public function _get_datatables_query(){
		$this->db->select('
				transaction.id as id,
				transaction.fotoBarang as fotoBarang,
				transaction.namaBarang as namaBarang,
				transaction.hargaBeli as hargaBeli,
				transaction.hargaJual as hargaJual,
				transaction.stok as stok
			')
			->from($this->table);

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

	public function save_user($data_user){
		$this->db->insert($this->table, $data_user);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function update_user($data_user, $id){
		$this->db->update($this->table, $data_user, array('id' => $id));
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function get_by_id($id){
		$this->db->from($this->table);
		$this->db->where('transaction.id', $id);

		return $this->db->get();
	}

	public function delete_by_id($id){
			$this->db->where('id', $id);
			$this->db->delete($this->table);
			return $this->db->affected_rows();
	}


	public function checknameadd($namaBarang){
		$this->db->from($this->table);
		$this->db->where('namaBarang', $namaBarang);
		$data = ($this->db->get()->num_rows() == 1) ? false : true;

		return $data;
	}

	public function checknameedit($id, $namaBarang){
		$this->db->from($this->table);
		$this->db->where('namaBarang', $namaBarang);
		$this->db->where('id !=', $id);
		$data = ($this->db->get()->num_rows() == 1) ? false : true;

		return $data;
	}

}