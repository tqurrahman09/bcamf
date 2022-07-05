<?php
defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////
// Author Dede Juniawan Suri //
///////////////////////////////

class Company extends CI_Controller {

/**
 * [$module description]
 * @var [type]
 */
public $module;

/**
 * [$table description]
 * @var [type]
 */
public $table;

/**
 * [$self_company description]
 * @var [type]
 */
public $self_company;

/**
 * [$company_selected description]
 * @var [type]
 */
public $company_selected;

/**
 * [$authority_view description]
 * @var [type]
 */
public $authority_view;

/**
 * [__construct description]
 */
public function __construct()
{
	parent::__construct();
	//Do your magic here
	$this->auth->restrict();
	$this->load->library('grocery_CRUD');
    $this->self_company = $this->authority->__self_company();
    $this->company_selected = $this->session->userdata($this->config->item('company'));
    $this->authority_view = $this->authority->__authority_view();
}

/**
 * [company description]
 * @return [type] [description]
 */
public function index(){
    $this->module = 'company';
    $this->table = 'master_company';
    $this->authority->__restrict_view($this->module);
    $authority = $this->authority->__authority_crud($this->module);
    $crud = new Grocery_CRUD();
    $crud->set_subject('Master Company');
    $crud->set_table('master_company');
    $crud->order_by('id');
    $crud->required_fields('company_id', 'description');
    $crud->add_fields('company_id', 'description', 'insert_by');
    $crud->edit_fields('description', 'modify_date', 'modify_by');
    $crud->callback_before_insert(array($this,'master_insertcallback'));
    $crud->callback_before_update(array($this,'master_updatecallback'));
    $crud->callback_before_delete(array($this,'master_deletecallback'));
    $crud->unset_columns('insert_date','modify_date','insert_by', 'modify_by');
    $crud->change_field_type('insert_date','invisible');
    $crud->change_field_type('modify_date','invisible');
    $crud->change_field_type('insert_by','invisible');
    $crud->change_field_type('modify_by','invisible');
    /**
     * Set Authority
     */
    if (!$this->authority->__is_super_admin()) {
        if (!$authority->insert) {
            $crud->unset_add();
        }
        if (!$authority->update) {
                $crud->unset_edit();   
        }
        if (!$authority->delete) {
                $crud->unset_delete();   
        }
        if (!$authority->export_excel) {
                $crud->unset_export();   
        }
        if (!$authority->print) {
                $crud->unset_print();  
        }
    }
    $output = $crud->render();

    $data['module'] = $this->module;
    $data['title'] = 'Master Company';
    $data['breadcrumb'] = 'Master - Costing - '.$this->module;
    $data['authority_view'] = $this->authority->__authority_view();
    $data['info'] = 'Form untuk menambah, mengubah, dan menghapus data '. $this->module.'. Mohon pastikan data telah benar sebelum disimpan'; //set null if not display info to user
    $data['output'] = $output;
    $this->load->view('grocery_template/template',$data);
}

/**
 * [master_insertcallback description]
 * @param  [type] $post_array [description]
 * @return [type]             [description]
 */
public function master_insertcallback($post_array) {
    $post_array['insert_by'] = $this->session->userdata($this->config->item('user_id'));
     
    return $post_array;
}

/**
 * [master_updatecallback description]
 * @param  [type] $post_array  [description]
 * @param  [type] $primary_key [description]
 * @return [type]              [description]
 */
public function master_updatecallback($post_array, $primary_key) {
    $post_array['modify_date'] = date('Y-m-d H:i:s');
    $post_array['modify_by'] = $this->session->userdata($this->config->item('user_id'));
    $this->_set_logupdatemaster($post_array, $primary_key);

    return $post_array;
}

/**
 * [master_insertcallback_other description]
 * @param  [type] $post_array [description]
 * @return [type]             [description]
 */
public function master_insertcallback_other($post_array) {
    $post_array['create_by'] = $this->session->userdata($this->config->item('user_id'));
    $post_array['create_date'] = date('Y-m-d');
    return $post_array;
}

/**
 * [master_updatecallback_other description]
 * @param  [type] $post_array  [description]
 * @param  [type] $primary_key [description]
 * @return [type]              [description]
 */
public function master_updatecallback_other($post_array, $primary_key) {
    $post_array['update_date'] = date('Y-m-d');
    $post_array['update_by'] = $this->session->userdata($this->config->item('user_id'));
    $this->_set_logupdatemaster($post_array, $primary_key);

    return $post_array;
}

/**
 * [master_companycallback description]
 * @param  [type] $value [description]
 * @param  [type] $row   [description]
 * @return [type]        [description]
 */
public function master_companycallback($value, $row){
    $this->load->model('mod_master');
    $company_name = $this->mod_master->get_companyname($value)->row();
    return ucwords($company_name->description);
}

/**
 * [master_deletecallback description]
 * @param  [type] $primary_key [description]
 * @return [type]              [description]
 */
public function master_deletecallback($primary_key){
    $this->load->model('mod_master');
    $this->db->trans_start();
    $old_data = $this->mod_master->_get_byidinarray($this->table, $primary_key);
    $this->mal_log->delete($this->module, $this->table, $old_data, $primary_key);
    $this->db->trans_complete();
    if ($this->db->trans_status() === FALSE)
    {
        return false;
    }else{
        return true;
    }
}

/**
 * [_set_logupdatemaster description]
 * @param [type] $post_array  [description]
 * @param [type] $primary_key [description]
 */
public function _set_logupdatemaster($post_array, $primary_key){
    $this->load->model('mod_master');
    $this->db->trans_start();
    $old_data = $this->mod_master->_get_byidinarray($this->table, $primary_key);
    $this->mal_log->update($this->module, $this->table, $post_array, $old_data, $primary_key);
    $this->db->trans_complete();
    if ($this->db->trans_status() === FALSE)
    {
        return false;
    }else{
        return true;
    }
}

}

/* End of file Master.php */
/* Location: ./application/controllers/Master.php */