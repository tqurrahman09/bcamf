<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

////////////////////////////////
// Malindo log                //
// Author: Dede Juniawan Suri //
////////////////////////////////

class Mal_Log
{
	private $CI;
	protected $table_name;
	protected $module_name;
	protected $module_id;
	protected $data_id;
	protected $new_data = array();
	protected $old_data = array();
	protected $log_data;
	/**
	 * Constant
	 */
	const ERROR_PARAM_NOTARRAY = 'Parameter data must be array type';
	const ERROR_TABLE_NOTFOUND = 'Table not found';
    /**
     * Constructor
     */
    public function __construct()
    {
        // get CI's object
		$this->CI =& get_instance();
		$this->CI->load->helper('array');
		$this->CI->load->config('log', FALSE, TRUE);
    }

    /**
     * [Log update]
     * @param  [type] $module_name [description]
     * @param  [type] $table_name  [description]
     * @param  array  $data        [description]
     * @param  [type] $id          [description]
     * @return [type]              [description]
     * How to use:
     * $this->load->library('log'); // or added to autoload config
     * $this->log($module_name, $table_name, $data, $id); // use TRASACTION if log is require
     */
    public function update($module_name, $table_name, $new_data, $old_data, $id){
    	if ($this->CI->db->table_exists($table_name)) {
    		if (is_array($new_data)) {
	    		$this->table_name = $table_name;
	    		$this->module_name = $module_name;
	    		$this->data_id = $id;
	    		$this->module_id = $this->_get_moduleid();
	    		$this->new_data = $new_data;
	    		$this->old_data = $old_data;
	    		$fields = $this->CI->db->list_fields($this->table_name);
	    		foreach ($fields as $field_name) {
                    if ($field_name != 'insert_date' && $field_name != 'modify_date' && $field_name != 'insert_by' && $field_name != 'modify_by') {
                        if (array_key_exists($field_name, $this->new_data)) {
                            if ($this->old_data[$field_name] != $this->new_data[$field_name]) {
                                $this->log_data = array(
                                    'module_id' => $this->module_id,
                                    'column_name' => $field_name,
                                    'value' => $this->new_data[$field_name],
                                    'last_value' => $this->old_data[$field_name],
                                    'user_id' => $this->CI->session->userdata($this->CI->config->item('user_id')),
                                    'note' => 'Data dengan ID: '.$this->data_id
                                );
                                $this->_update();
                            }
                        }
                    }
	    		}
	    	} else {
	    		throw new Exception("Library log Error: ".self::ERROR_PARAM_NOTARRAY);
	    	}
    	} else {
    		throw new Exception("Library log Error: ".self::ERROR_TABLE_NOTFOUND);
    	}
    }

    /**
     * [Log delete]
     * @param  [type] $module_name [description]
     * @param  [type] $table_name  [description]
     * @param  [type] $id          [description]
     * @return [type]              [description]
     */
    public function delete($module_name, $table_name, $old_data, $id){
    	if ($this->CI->db->table_exists($table_name)) {
    		$this->table_name = $table_name;
    		$this->module_name = $module_name;
    		$this->data_id = $id;
    		$this->module_id = $this->_get_moduleid();
    		$this->old_data = $old_data;
			$this->log_data = array(
				'module_id' => $this->module_id,
				'user_id' => $this->CI->session->userdata($this->CI->config->item('user_id')),
				'data' => json_encode($this->old_data),
				'note' => 'Data dengan ID: '.$this->data_id
			);
			$this->_delete();
    	} else {
    		throw new Exception("Library log Error: ".self::ERROR_TABLE_NOTFOUND);
    	}
    }

    /**
     * [_get_olddata description]
     * @return [type] [description]
     */
    protected function _get_olddata(){
    	return $this->CI->db->select('*')
    					->from($this->table_name)
    					->where('id', $this->data_id)
    					->get()
    					->row_array();
    }

    /**
     * [_update description]
     * @return [type] [description]
     */
    protected function _update(){
    	$this->CI->db->insert($this->CI->config->item('log_update_name'), $this->log_data);
    }

    /**
     * [_delete description]
     * @return [type] [description]
     */
    protected function _delete(){
    	$this->CI->db->insert($this->CI->config->item('log_delete_name'), $this->log_data);
    }

    /**
     * [_get_moduleid description]
     * @return [type] [description]
     */
    protected function _get_moduleid(){
    	return $this->CI->db->select('id')
    					->from('_module')
    					->where('module_name', $this->module_name)
    					->get()
    					->row()->id;
    }

    /**
     * [test description]
     * @return [type] [description]
     */
    public function test(){
    	echo $this->CI->config->item('log_update_name');
    }
}