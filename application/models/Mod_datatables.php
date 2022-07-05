<?php
defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////
// Author Dede Juniawan Suri //
///////////////////////////////

class Mod_datatables extends CI_Model {

	/**
	 * [$table description]
	 * @var [type]
	 */
	private $table;
	/**
	 * [$column_order set column field database for datatable orderable]
	 * @var array
	 */
	private $column_order = [];
	/**
	 * [$column_search set column field database for datatable searchable just firstname , lastname , address are searchable]
	 * @var array
	 */
	private $column_search = [];
	/**
	 * [$order default order]
	 * @var array
	 */
	private $order = [];
	/**
	 * [$company_selected description]
	 * @var [type]
	 */
	protected $company_selected;

	/**
	 * [__construct description]
	 */
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->company_selected = $this->session->userdata($this->config->item('company'));
	}

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param mixed $table
     *
     * @return self
     */
    public function setTable($table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getColumnOrder()
    {
        return $this->column_order;
    }

    /**
     * @param mixed $column_order
     *
     * @return self
     */
    public function setColumnOrder($column_order)
    {
        $this->column_order = $column_order;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getColumnSearch()
    {
        return $this->column_search;
    }

    /**
     * @param mixed $column_search
     *
     * @return self
     */
    public function setColumnSearch($column_search)
    {
        $this->column_search = $column_search;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     *
     * @return self
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * [_get_datatables_query description]
     * @return [type] [description]
     */
    public function _get_datatables_query(){
		$this->db->from($this->table);

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
	 * [get_datatables description]
	 * @return [type] [description]
	 */
	public function get_datatables(){
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	/**
	 * [count_filtered description]
	 * @return [type] [description]
	 */
	public function count_filtered(){
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	/**
	 * [count_all description]
	 * @return [type] [description]
	 */
	public function count_all(){
		$this->_get_datatables_query();
		return $this->db->count_all_results();
	}

	/**
	 * [get_by_id description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function get_by_id($id){
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	/**
	 * [save description]
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public function save($data){
		$this->db->insert($this->table, $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * [update description]
	 * @param  [type] $where [description]
	 * @param  [type] $data  [description]
	 * @return [type]        [description]
	 */
	public function update($where, $data){
		$this->db->update($this->table, $data, $where);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * [update_withlog description]
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public function update_withlog($where, $new_data, $module_name){
		$this->db->trans_start();
		$old_data = $this->_get_byidinarray($where['id']);
		$this->db->update($this->table, $new_data, $where);
		if ($this->db->affected_rows() > 0) {
			$this->mal_log->update($module_name, $this->table, $new_data, $old_data, $where['id']);
		}
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
		    return false;
		}else{
			return true;
		}
	}

	/**
	 * [get_byidinarray description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function _get_byidinarray($id){
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row_array();
	}

	/**
	 * [delete_by_id description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function delete_by_id($id){
		$this->db->where('id', $id);
		$this->db->delete($this->table);
		return $this->db->affected_rows();	
	}

	public function delete_withlog($module_name, $id){
		$this->db->trans_start();
		$old_data = $this->_get_byidinarray($id);
		$this->db->where('id', $id);
		$this->db->delete($this->table);
		if ($this->db->affected_rows() > 0) {
			$this->mal_log->delete($module_name, $this->table, $old_data, $id);
		}
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
		    return false;
		}else{
			return true;
		}
	}

	/**
	 * [get_selfcompany description]
	 * @return [type] [description]
	 */
	public function get_selfcompany(){
		$this->db->select('id, company_id, company_name as description');
		$this->db->from('master_company');
		$this->db->join('_user_company', '_user_company.user_id = _user.id', 'left');
		return $this->db->get();
	}

	/**
	 * [get_menus description]
	 * @param  [type] $key [description]
	 * @return [type]      [description]
	 */
	public function get_menus($key){
		$this->db->distinct();
		$this->db->select('_module.module_name as module_name, _module.alias as alias, _module.note as note');
		$this->db->from('_module');
		if(!$this->authority->__is_super_admin()){
			$this->db->join('_authority', '_authority.module_id = _module.id');
			$this->db->join('_group', '_group.id = _authority.group_id');
			$this->db->where('_group.id', $this->session->userdata($this->config->item('level')));
		}
		$this->db->like('module_name', $key, 'BOTH');
		$this->db->or_like('alias', $key, 'BOTH');
		$this->db->or_like('note', $key, 'BOTH');
		return $this->db->get();
	}

	/**
	 * [get_user description]
	 * @return [type] [description]
	 */
	public function get_user(){
		$this->db->select('
			master_user.username as username,
			master_department.dept_name as dept_name,
			master_area.area_name as area_name,
			master_user.position as position,
			master_user.rek_no as rek_no,
			master_user.veh_no as veh_no,
			master_company.company_name as company_name
		');
		$this->db->from('master_user');
		$this->db->join('master_area', 'master_area.area_code = master_user.area_code');
		$this->db->join('master_company', 'master_company.company_code = master_area.company_code');
		$this->db->join('master_department', 'master_department.dept_code = master_user.dept_code');
		$this->db->where('master_user.id', $this->session->userdata($this->config->item('user_id')));

		return $this->db->get();
	}

	/**
	 * [get_datatable description]
	 * @param  [type] $table            [description]
	 * @param  [type] $condition_column [description]
	 * @param  [type] $condition_value  [description]
	 * @return [type]                   [description]
	 */
	public function get_fromtable($table, $condition_column, $condition_value){
		$this->db->from($table);
		$this->db->where($condition_column, $condition_value);

		return $this->db->get();
	}
}

/* End of file Mod_datatables.php */
/* Location: ./application/models/Mod_datatables.php */