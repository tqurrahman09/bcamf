<?php
defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////
// Author Dede Juniawan Suri //
///////////////////////////////

class mod_otoritas extends CI_Model {

	var $table = '_authority';
	var $column_order = array('_authority.group_id','_module.module_name'); //set column field database for datatable orderable
	var $column_search = array('_authority.group_id','_module.module_name'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('_group.group_name' => 'asc'); // default order

	var $column_order_group = array('id','group_name'); //set column field database for datatable orderable
	var $column_search_group = array('id','group_name'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order_group = array('group_name' => 'asc'); // default order  

	public function __construct(){
		parent::__construct();
	}

	private function _get_datatables_query($group_id){
		$this->db->select('_authority.group_id AS level, _authority.insert AS insert, _authority.update AS update, _authority.delete AS delete, _authority.view AS view, export_excel AS export_excel, print AS print, detail AS detail, post AS post, cancel AS cancel, attachment AS attachment, _authority.module_id AS module_id, _authority.group_id AS group_id, _module.alias AS module, _group.group_name AS name');
		$this->db->from($this->table);
		$this->db->join('_module','_module.id=_authority.module_id');
		$this->db->join('_group','_group.id=_authority.group_id');
		//$this->db->where('_authority.group_id !=', 1);
		$this->db->where('_group.id', $group_id);
		$this->db->order_by('_authority.module_id', 'desc');
		$this->db->order_by('_authority.group_id', 'desc');

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

	function get_datatables($group){
		$this->_get_datatables_query($group);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($group){
		$this->_get_datatables_query($group);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all($group){
		$this->_get_datatables_query($group);
		return $this->db->count_all_results();
	}

	public function _update_otoritas($data, $where){
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function _update_specialaccess($column, $value, $module_id, $group_id){
		$this->db->set($column, $value);
		$this->db->where('module_id', $module_id);
		$this->db->where('group_id', $group_id);
		$this->db->update($this->table);
		return $this->db->affected_rows();
	}

	private function _get_datatables_group_query(){
		$this->db->from('_group');
		$this->db->where('id !=', 1);

		$i = 0;
	
		foreach ($this->column_search_group as $item) // loop column 
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

				if(count($this->column_search_group) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order_group[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order_group))
		{
			$order = $this->order_group;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables_group(){
		$this->_get_datatables_group_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_by_id($id){
		$this->db->from('_group');
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	function count_filtered_group(){
		$this->_get_datatables_group_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_group(){
		$this->_get_datatables_group_query();
		return $this->db->count_all_results();
	}

	public function save_group($data_group, $data_authority){
		$this->db->insert('_group', $data_group);
		$id = $this->db->insert_id();

		if (isset($data_authority)) {
			foreach ($data_authority as $value) {
				$data = array(
					'group_id' => $id,
					'module_id' => $value
				);
				$this->db->insert('_authority', $data);
			}
		}
	}

	public function update_group($datas, $is_accounting, $group_id){
		$this->db->trans_start();
		$this->db->set('is_accounting', $is_accounting);
		$this->db->where('id', $group_id);
		$this->db->update('_group');
		if (isset($group_id)) {
			foreach ($datas as $value) {
				$this->db->from('_authority');
				$this->db->where('group_id',$group_id);
				$this->db->where('module_id',$value);
				$rows = $this->db->get()->num_rows();
				if($rows == 0) {
					$data = array(
						'group_id' => $group_id,
						'module_id' => $value
					);
					$this->db->insert('_authority', $data);
				}
				$this->db->where('group_id',$group_id);
				$this->db->where_not_in('module_id', $datas);
				$this->db->delete('_authority');
			}
		} else {
			$this->db->where('group_id', $group_id);
			$this->db->delete('_authority');
		}
		$this->db->trans_complete();
	}

	public function delete_by_group_id($group_id){
		$this->db->trans_start();
		$this->db->where('id', $group_id);
		$this->db->delete('_group');
		$this->db->where('group_id', $group_id);
		$this->db->delete('_authority');
		$this->db->trans_complete();
	}

	public function delete_otoritas($group_id, $module_id){
		$this->db->where('group_id', $group_id);
		$this->db->where('module_id', $module_id);
		$this->db->delete('_authority');
	}

	public function get_modules(){
		$this->db->from('_module');
		$this->db->where('module_name !=', 'user');
		$this->db->where('module_name !=', 'otoritas');
		return $this->db->get()->result();
	}

	public function get_otoritas($id){
		$this->db->select('_authority.module_id AS module_id');
		$this->db->from('_authority');
		$this->db->join('_module', '_authority.module_id = _module.id');
		$this->db->where('_authority.group_id',$id);
		
		$data = $this->db->get()->result();

		$area = array();
		foreach ($data as $i => $value) {
			$module[$i] = $value->module_id;
		}
		return $module;
	}

	public function get_function($module_id, $function_name){
		$this->db->from('_functional');
		$this->db->join('_module_functional', '_module_functional.functional_id = _functional.id');
		$this->db->join('_module', '_module.id = _module_functional.module_id');
		$this->db->where('_module.id', $module_id);
		$this->db->where('_functional.functional', $function_name);
		$is_function = $this->db->get()->num_rows();
		if ($is_function == 1) {
			return true;
		} else {
			return false;
		}
	}

}