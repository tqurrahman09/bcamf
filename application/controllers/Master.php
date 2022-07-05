<?php
defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////
// Author Dede Juniawan Suri //
///////////////////////////////

class Master extends CI_Controller {

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
    $this->authority_view = $this->authority->__authority_view();
}

/**
 * [company description]
 * @return [type] [description]
 */
public function company(){
    $this->module = 'company';
    $this->table = 'master_company';
    $this->authority->__restrict_view($this->module);
    $authority = $this->authority->__authority_crud($this->module);
    $crud = new Grocery_CRUD();
    $crud->set_subject('Master Company');
    $crud->set_table('master_company');
    $crud->order_by('company_code');
    $crud->unique_fields(array('company_code'));
    $crud->required_fields('company_code', 'company_name');
    $crud->add_fields('company_code', 'company_name');
    $crud->edit_fields('company_name');
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
 * [department description]
 * @return [type] [description]
 */
public function department(){
    $this->module = 'department';
    $this->table = 'master_department';
    $this->authority->__restrict_view($this->module);
    $authority = $this->authority->__authority_crud($this->module);
    $crud = new Grocery_CRUD();
    $crud->set_subject('Master department');
    $crud->set_table('master_department');
    $crud->order_by('dept_code');
    $crud->unique_fields(array('dept_code'));
    $crud->required_fields('dept_code', 'dept_name', 'pc_limit');
    $crud->add_fields('dept_code', 'dept_name', 'pc_limit');
    $crud->edit_fields('dept_name', 'pc_limit');
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
    $data['title'] = 'Master Department';
    $data['breadcrumb'] = 'Master - '.$this->module;
    $data['authority_view'] = $this->authority->__authority_view();
    $data['info'] = 'Form untuk menambah, mengubah, dan menghapus data '. $this->module.'. Mohon pastikan data telah benar sebelum disimpan'; //set null if not display info to user
    $data['output'] = $output;
    $this->load->view('grocery_template/template',$data);
}

/**
 * [rekening description]
 * @return [type] [description]
 */
public function rekening(){
    $this->module = 'rekening';
    $this->table = 'master_rekening_bank';
    $this->authority->__restrict_view($this->module);
    $authority = $this->authority->__authority_crud($this->module);
    $crud = new Grocery_CRUD();
    $crud->set_subject('Master Rekening');
    $crud->set_table($this->table);
    $crud->order_by('rek_no');
    $crud->unique_fields(array('rek_no'));
    $crud->required_fields('rek_no', 'bank_name', 'rek_name');
    $crud->add_fields('rek_no', 'bank', 'rek_name');
    $crud->edit_fields('rek_no', 'bank', 'rek_name');
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
    $data['title'] = 'Master Rekening';
    $data['breadcrumb'] = 'Master - '.$this->module;
    $data['authority_view'] = $this->authority->__authority_view();
    $data['info'] = 'Form untuk menambah, mengubah, dan menghapus data '. $this->module.'. Mohon pastikan data telah benar sebelum disimpan'; //set null if not display info to user
    $data['output'] = $output;
    $this->load->view('grocery_template/template',$data);
}

/**
 * [vehicle description]
 * @return [type] [description]
 */
public function vehicle(){
    $this->module = 'vehicle';
    $this->table = 'master_vehicle';
    $this->authority->__restrict_view($this->module);
    $authority = $this->authority->__authority_crud($this->module);
    $crud = new Grocery_CRUD();
    $crud->set_subject('Master Vehicle');
    $crud->set_table($this->table);
    $crud->order_by('veh_no');
    $crud->unique_fields(array('veh_no'));
    $crud->required_fields('veh_no', 'jenis');
    $crud->add_fields('veh_no', 'jenis');
    $crud->edit_fields('veh_no', 'jenis');
    $crud->field_type('veh_no', 'string');
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
    $data['title'] = 'Master Vehicle';
    $data['breadcrumb'] = 'Master - '.$this->module;
    $data['authority_view'] = $this->authority->__authority_view();
    $data['info'] = 'Form untuk menambah, mengubah, dan menghapus data '. $this->module.'. Mohon pastikan data telah benar sebelum disimpan'; //set null if not display info to user
    $data['output'] = $output;
    $this->load->view('grocery_template/template',$data);
}

/**
 * Adding at 24-07-2019
 * Note: belum ditambahkan ke daftar module
 */

/**
 * [area description]
 * @return [type] [description]
 */
public function area(){
    $this->module = 'area';
    $this->table = 'master_area';
    $this->authority->__restrict_view($this->module);
    $authority = $this->authority->__authority_crud($this->module);
    $crud = new Grocery_CRUD();
    $crud->set_subject('Master Area');
    $crud->set_table($this->table);
    $crud->set_relation('company_code', 'master_company', 'company_name');
    $crud->order_by('area_code');
    $crud->unique_fields(array('area_code'));
    $crud->required_fields('area_code', 'company_code', 'area_name');
    $crud->add_fields('area_code', 'company_code', 'area_name');
    $crud->edit_fields('company_code', 'area_name');
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
    $data['title'] = 'Master Area';
    $data['breadcrumb'] = 'Master - '.$this->module;
    $data['authority_view'] = $this->authority->__authority_view();
    $data['info'] = 'Form untuk menambah, mengubah, dan menghapus data '. $this->module.'. Mohon pastikan data telah benar sebelum disimpan'; //set null if not display info to user
    $data['output'] = $output;
    $this->load->view('grocery_template/template',$data);
}

/**
 * [cost_center description]
 * @return [type] [description]
 */
public function cost_center(){
    $this->module = 'cost_center';
    $this->table = 'master_cost_center';
    $this->authority->__restrict_view($this->module);
    $authority = $this->authority->__authority_crud($this->module);
    $crud = new Grocery_CRUD();
    $crud->set_subject('Master Cost Center');
    $crud->set_table($this->table);
    $crud->order_by('cost_center_code');
    $crud->unique_fields(array('cost_center_code'));
    $crud->required_fields('cost_center_code', 'description');
    $crud->add_fields('cost_center_code', 'description');
    $crud->edit_fields('description');
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
    $data['title'] = 'Master Cost Center';
    $data['breadcrumb'] = 'Master - Cost Center';
    $data['authority_view'] = $this->authority->__authority_view();
    $data['info'] = 'Form untuk menambah, mengubah, dan menghapus data '. $this->module.'. Mohon pastikan data telah benar sebelum disimpan'; //set null if not display info to user
    $data['output'] = $output;
    $this->load->view('grocery_template/template',$data);
}

/**
 * [customer description]
 * @return [type] [description]
 */
public function customer(){
    $this->module = 'customer';
    $this->table = 'master_customer';
    $this->authority->__restrict_view($this->module);
    $authority = $this->authority->__authority_crud($this->module);
    $crud = new Grocery_CRUD();
    $crud->set_subject('Master Customer');
    $crud->set_table($this->table);
    $crud->order_by('customer_id');
    $crud->unique_fields(array('customer_id'));
    $crud->required_fields('customer_id', 'customer_name', 'customer_group');
    $crud->add_fields('customer_id', 'customer_name', 'customer_group');
    $crud->edit_fields('customer_name', 'customer_group');
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
    $data['title'] = 'Master Customer';
    $data['breadcrumb'] = 'Master - Customer';
    $data['authority_view'] = $this->authority->__authority_view();
    $data['info'] = 'Form untuk menambah, mengubah, dan menghapus data '. $this->module.'. Mohon pastikan data telah benar sebelum disimpan'; //set null if not display info to user
    $data['output'] = $output;
    $this->load->view('grocery_template/template',$data);
}

/**
 * [supplier description]
 * @return [type] [description]
 */
public function supplier(){
    $this->module = 'supplier';
    $this->table = 'master_supplier';
    $this->authority->__restrict_view($this->module);
    $authority = $this->authority->__authority_crud($this->module);
    $crud = new Grocery_CRUD();
    $crud->set_subject('Master Supplier');
    $crud->set_table($this->table);
    $crud->order_by('supp_code');
    $crud->unique_fields(array('supp_code'));
    // $crud->required_fields('supp_code', 'supp_name', 'rek_no', 'bank_name', 'akun_name');
    // $crud->add_fields('supp_code', 'supp_name', 'rek_no', 'bank_name', 'akun_name');
    // $crud->edit_fields('supp_name', 'rek_no', 'bank_name', 'akun_name');
    $crud->required_fields('supp_code', 'supp_name', 'rek_type', 'rek_no', 'bank_name', 'akun_name');
    $crud->add_fields('supp_code', 'supp_name', 'rek_type', 'rek_no', 'bank_name', 'akun_name');
    $crud->edit_fields('supp_name', 'rek_type','rek_no', 'bank_name', 'akun_name');
    $crud->field_type('rek_type','dropdown', array('Virtual Account' => 'Virtual Account', 'Rekening Biasa' => 'Rekening Biasa'));
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
    $data['title'] = 'Master Supplier';
    $data['breadcrumb'] = 'Master - Supplier';
    $data['authority_view'] = $this->authority->__authority_view();
    $data['info'] = 'Form untuk menambah, mengubah, dan menghapus data '. $this->module.'. Mohon pastikan data telah benar sebelum disimpan'; //set null if not display info to user
    $data['output'] = $output;
    $this->load->view('grocery_template/template',$data);
}

/**
 * [wh description]
 * @return [type] [description]
 */
public function wh(){
    $this->module = 'wh';
    $this->table = 'master_wh';
    $this->authority->__restrict_view($this->module);
    $authority = $this->authority->__authority_crud($this->module);
    $crud = new Grocery_CRUD();
    $crud->set_subject('Master Warehouse');
    $crud->set_table($this->table);
    $crud->order_by('wh_code');
    $crud->unique_fields(array('wh_code'));
    $crud->required_fields('wh_code', 'descriptione');
    $crud->add_fields('wh_code', 'description');
    $crud->edit_fields('description');
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
    $data['title'] = 'Master Warehouse';
    $data['breadcrumb'] = 'Master - Warehouse';
    $data['authority_view'] = $this->authority->__authority_view();
    $data['info'] = 'Form untuk menambah, mengubah, dan menghapus data '. $this->module.'. Mohon pastikan data telah benar sebelum disimpan'; //set null if not display info to user
    $data['output'] = $output;
    $this->load->view('grocery_template/template',$data);
}

/**
 * [worker description]
 * @return [type] [description]
 */
public function worker(){
    $this->module = 'worker';
    $this->table = 'master_worker';
    $this->authority->__restrict_view($this->module);
    $authority = $this->authority->__authority_crud($this->module);
    $crud = new Grocery_CRUD();
    $crud->set_subject('Master Worker');
    $crud->set_table($this->table);
    $crud->order_by('worker_code');
    $crud->unique_fields(array('worker_code'));
    $crud->required_fields('worker_code', 'descriptione');
    $crud->add_fields('worker_code', 'description');
    $crud->edit_fields('description');
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
    $data['title'] = 'Master Worker';
    $data['breadcrumb'] = 'Master - Worker';
    $data['authority_view'] = $this->authority->__authority_view();
    $data['info'] = 'Form untuk menambah, mengubah, dan menghapus data '. $this->module.'. Mohon pastikan data telah benar sebelum disimpan'; //set null if not display info to user
    $data['output'] = $output;
    $this->load->view('grocery_template/template',$data);
}

/**
 * [me_type description]
 * @return [type] [description]
 */
public function me_type(){
    $this->module = 'me_type';
    $this->table = 'master_me_type';
    $this->authority->__restrict_view($this->module);
    $authority = $this->authority->__authority_crud($this->module);
    $crud = new Grocery_CRUD();
    $crud->set_subject('Master Monthly Expense Type');
    $crud->set_table($this->table);
    $crud->order_by('me_code');
    $crud->unique_fields(array('me_code'));
    $crud->required_fields('me_code', 'me_name', 'me_criteria');
    $crud->add_fields('me_code', 'me_name', 'me_criteria');
    $crud->edit_fields('me_name', 'me_criteria');
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
    $data['title'] = 'Master Monthly Expense Type';
    $data['breadcrumb'] = 'Master - Monthly Expense Type';
    $data['authority_view'] = $this->authority->__authority_view();
    $data['info'] = 'Form untuk menambah, mengubah, dan menghapus data '. $this->module.'. Mohon pastikan data telah benar sebelum disimpan'; //set null if not display info to user
    $data['output'] = $output;
    $this->load->view('grocery_template/template',$data);
}

/**
 * [mp_type description]
 * @return [type] [description]
 */
public function mp_type(){
    $this->module = 'mp_type';
    $this->table = 'master_mp_type';
    $this->authority->__restrict_view($this->module);
    $authority = $this->authority->__authority_crud($this->module);
    $crud = new Grocery_CRUD();
    $crud->set_subject('Master Memo Payment Type');
    $crud->set_table($this->table);
    $crud->order_by('mp_code');
    $crud->unique_fields(array('mp_code'));
    $crud->required_fields('mp_code', 'mp_name');
    $crud->add_fields('mp_code', 'mp_name');
    $crud->edit_fields('mp_name');
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
    $data['title'] = 'Master Memo Payment Type';
    $data['breadcrumb'] = 'Master - Memo Payment Type';
    $data['authority_view'] = $this->authority->__authority_view();
    $data['info'] = 'Form untuk menambah, mengubah, dan menghapus data '. $this->module.'. Mohon pastikan data telah benar sebelum disimpan'; //set null if not display info to user
    $data['output'] = $output;
    $this->load->view('grocery_template/template',$data);
}

/**
 * [pc_type description]
 * @return [type] [description]
 */
public function pc_type(){
    $this->module = 'pc_type';
    $this->table = 'master_pc_type';
    $this->authority->__restrict_view($this->module);
    $authority = $this->authority->__authority_crud($this->module);
    $crud = new Grocery_CRUD();
    $crud->set_subject('Master Petty Cash Type');
    $crud->set_table($this->table);
    $crud->order_by('pc_code');
    $crud->unique_fields(array('pc_code'));
    $crud->required_fields('pc_code', 'pc_name', 'account_code');
    $crud->add_fields('pc_code', 'pc_name', 'account_code');
    $crud->edit_fields('pc_name', 'account_code');
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
    $data['title'] = 'Master Petty Cash Type';
    $data['breadcrumb'] = 'Master - Petty Cash Type';
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



public function user(){
    $this->module = 'master_user';
    $this->table = 'master_user';
    $this->authority->__restrict_view($this->module);
    $authority = $this->authority->__authority_crud($this->module);
    $crud = new Grocery_CRUD();
    $crud->set_subject('Master User');
    $crud->set_table($this->table);
    // $crud->set_relation('company_code', 'master_company', 'company_name');
    $crud->order_by('id');
    $crud->unique_fields(array('id'));
    $crud->required_fields('id', 'dept_code', 'area_code', 'cost_center_code','group_id', 'username', 'password', 'worker_code', 'division', 'customer_id', 'wh_code', 'position', 'rek_no', 'veh_no', 'cookie', 'status', 'image', 'insert_date', 'modify_date', 'insert_by', 'modify_by');
    $crud->add_fields('id', 'dept_code', 'area_code', 'cost_center_code','group_id', 'username', 'password', 'worker_code', 'division', 'customer_id', 'wh_code', 'position', 'rek_no', 'veh_no', 'cookie', 'status', 'image', 'insert_date', 'modify_date', 'insert_by', 'modify_by');
    $crud->edit_fields('id', 'dept_code', 'area_code', 'cost_center_code','group_id', 'username', 'password', 'worker_code', 'division', 'customer_id', 'wh_code', 'position', 'rek_no', 'veh_no', 'cookie', 'status', 'image', 'insert_date', 'modify_date', 'insert_by', 'modify_by');
    // $crud->field_type('user_id','dropdown', array('1' => 'Admin', '2' => 'Test User'));
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
    $data['title'] = 'Master Budget';
    $data['breadcrumb'] = 'Master - Budget';
    $data['authority_view'] = $this->authority->__authority_view();
    $data['info'] = 'Form untuk menambah, mengubah, dan menghapus data '. $this->module.'. Mohon pastikan data telah benar sebelum disimpan';
    $data['output'] = $output;
    $this->load->view('grocery_template/template',$data);
}
    /**
     * [budget description]
     * @return [type] [description]
     */
    public function budget(){
        $this->module = 'budget';
        $this->table = 'master_budget';
        $this->authority->__restrict_view($this->module);
        $authority = $this->authority->__authority_crud($this->module);
        $crud = new Grocery_CRUD();
        $crud->set_subject('Master Budget');
        $crud->set_table($this->table);
        $crud->set_relation('user_id', 'master_user', 'username');
        $crud->order_by('user_id');
        $crud->unique_fields(array('user_id'));
        $crud->required_fields('user_id', 'budget_pulsa', 'budget_bbm', 'budget_hotel');
        $crud->add_fields('user_id', 'budget_pulsa', 'budget_bbm', 'budget_hotel');
        $crud->edit_fields('user_id', 'budget_pulsa', 'budget_bbm', 'budget_hotel');
        // $crud->field_type('user_id','dropdown', array('1' => 'Admin', '2' => 'Test User'));
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
        $data['title'] = 'Master Budget';
        $data['breadcrumb'] = 'Master - Budget';
        $data['authority_view'] = $this->authority->__authority_view();
        $data['info'] = 'Form untuk menambah, mengubah, dan menghapus data '. $this->module.'. Mohon pastikan data telah benar sebelum disimpan';
        $data['output'] = $output;
        $this->load->view('grocery_template/template',$data);
    }
}

/* End of file Master.php */
/* Location: ./application/controllers/Master.php */