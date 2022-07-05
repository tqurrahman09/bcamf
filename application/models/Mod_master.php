 <?php 
defined('BASEPATH') OR exit('No direct script access allowed');

////////////////////////////////
// @author Dede Juniawan Suri //
////////////////////////////////

class Mod_master extends Grocery_crud_model  {
 	
 	/**
 	 * [get_relation_array description]
 	 * @param  [type] $field_name          [description]
 	 * @param  [type] $related_table       [description]
 	 * @param  [type] $related_field_title [description]
 	 * @param  [type] $where_clause        [description]
 	 * @param  [type] $order_by            [description]
 	 * @param  [type] $limit               [description]
 	 * @param  [type] $search_like         [description]
 	 * @return [type]                      [description]
 	 */
 	function get_relation_array($field_name , $related_table , $related_field_title, $where_clause, $order_by, $limit = null, $search_like = null)
    {
    	$relation_array = array();
    	$field_name_hash = $this->_unique_field_name($field_name);

    	$related_primary_key = $this->get_primary_key($related_table);

    	$select = "$related_table.$related_primary_key, ";

    	if(strstr($related_field_title,'{'))
    	{
    		$related_field_title = str_replace(" ", "&nbsp;", $related_field_title);
    		$select .= "CONCAT('".str_replace(array('{','}'),array("', COALESCE(",", ''),'"),str_replace("'","\\'",$related_field_title))."') as $field_name_hash";
    	}
    	else
    	{
	    	$select .= "$related_table.$related_field_title as $field_name_hash";
    	}

    	$this->db->select($select,false);
    	if($where_clause === null){
            if (!$this->authority->__is_super_admin()) {
                if ($related_table === 'master_company') {
                    $this->db->join('_user_company', '_user_company.company_id = master_company.id');
                    $this->db->where('_user_company.user_id', $this->session->userdata($this->config->item('user_id')));
                }elseif($related_table === 'master_farm'){
                    $this->db->join('_user_farm', '_user_farm.farm_id = master_farm.id');
                    $this->db->where('_user_farm.user_id', $this->session->userdata($this->config->item('user_id')));
                }
            }
    	}else{
    		$this->db->where($where_clause);
    	}

    	if($limit !== null)
    		$this->db->limit($limit);

    	if($search_like !== null)
    		$this->db->having("$field_name_hash LIKE '%".$this->db->escape_like_str($search_like)."%'");

    	$order_by !== null
    		? $this->db->order_by($order_by)
    		: $this->db->order_by($field_name_hash);

    	$results = $this->db->get($related_table)->result();

    	foreach($results as $row)
    	{
    		$relation_array[$row->$related_primary_key] = $row->$field_name_hash;
    	}

    	return $relation_array;
    }

    /**
     * [get_byidinarray description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function _get_byidinarray($table, $id){
        $this->db->from($table);
        $this->db->where('id',$id);
        $query = $this->db->get();

        return $query->row_array();
    }

    /**
     * [get_companyname description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function get_companyname($id){
        $this->db->select('description');
        $this->db->from('master_company');
        $this->db->where('id', $id);

        return $this->db->get();
    }

    public function get_user(){
        $this->db->select('id,username');
        $this->db->from('master_user');
        return $this->db->get();
    }

}

/* End of file Mod_master.php */
/* Location: ./application/models/Mod_master.php */