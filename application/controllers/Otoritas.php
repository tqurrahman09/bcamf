<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Otoritas extends CI_Controller {

	/**
	 * [$module description]
	 * @var string
	 */
	public $module = 'otoritas';

	/**
	 * [$self_company description]
	 * @var [type]
	 */
	public $self_company;

	/**
	 * [$title description]
	 * @var [type]
	 */
	public $title;

	/**
	 * [$breadcrumb description]
	 * @var [type]
	 */
	public $breadcrumb;

	/**
	 * [$content description]
	 * @var [type]
	 */
	public $content;

	/**
	 * [$in_js description]
	 * @var [type]
	 */
	public $in_js;

	/**
	 * [$ex_js description]
	 * @var [type]
	 */
	public $ex_js;

	/**
	 * [$js_sources description]
	 * @var array
	 */
	public $js_sources = array();

	/**
	 * [$form_sources description]
	 * @var array
	 */
	public $form_sources = array();

	/**
	 * [$info description]
	 * @var null
	 */
	public $info = null;

	/**
	 * [$module_title description]
	 * @var [type]
	 */
	public $module_title;

	/**
	 * [$table_title description]
	 * @var [type]
	 */
	public $table_title;

	/**
	 * [__construct description]
	 */
	public function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->authority->__restrict_user();
		$this->load->library('encryption');
	}

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index(){
		$this->module       = $this->module;
		$this->title        = 'Authority';
		$this->module_title = 'Authority';
		$this->breadcrumb   = 'Authority';
		$this->table_title  = 'Authority Config';
		$this->content      = $this->module;
		$this->in_js        = false;
		$this->ex_js        = true;
		$this->js_sources   = array('init.js', 'add.js', 'edit.js', 'delete.js');
		$this->form_sources = array('a_form', 'e_form');
        $data['data'] = array(
        	'modules' => $this->mod_otoritas->get_modules()
        );
        $this->load->view('template/template',$data);
	}

	public function ajax_list(){
		$list = $this->mod_otoritas->get_datatables($this->input->post('groups'));
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $datas) {
			$no++;
			$row = array();
			$row[] = $datas->name;
			$row[] = ucwords($datas->module);
			$row[] = $this->_is_insert($datas->module_id, $datas->level, $datas->insert);
            $row[] = $this->_is_update($datas->module_id, $datas->level, $datas->update);
            $row[] = $this->_is_delete($datas->module_id, $datas->level, $datas->delete);
            $row[] = $this->_is_view($datas->module_id, $datas->level, $datas->view);
            $row[] = $this->_is_special_access($datas->module_id, 'detail', $datas->level, $datas->detail);
            $row[] = $this->_is_special_access($datas->module_id, 'export_excel', $datas->level, $datas->export_excel);
            $row[] = $this->_is_special_access($datas->module_id, 'print', $datas->level, $datas->print);
            $row[] = $this->_is_special_access($datas->module_id, 'post', $datas->level, $datas->post);
            $row[] = $this->_is_special_access($datas->module_id, 'cancel', $datas->level, $datas->cancel);
            $row[] = $this->_is_special_access($datas->module_id, 'attachment', $datas->level, $datas->attachment);

            $row[] = '<a href="javascript:void(0)" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" title="Delete" onclick="delete_otoritas(\''.$this->encryption->encrypt($datas->group_id).'\',\''.$this->encryption->encrypt($datas->module_id).'\')"><i class="la la-trash"></i></a>';
			
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->mod_otoritas->count_all($this->input->post('groups')),
						"recordsFiltered" => $this->mod_otoritas->count_filtered($this->input->post('groups')),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	Public function insert(){
		$data = array(
			'insert' => $this->input->post('insert')
		);
		$where = array(
			'module_id' => $this->input->post('module_id'),
			'group_id' => $this->input->post('level')
		);
		$this->mod_otoritas->_update_otoritas($data, $where);
	}

	Public function update(){
		$data = array(
			'update' => $this->input->post('update')
		);
		$where = array(
			'module_id' => $this->input->post('module_id'),
			'group_id' => $this->input->post('level')
		);
		$this->mod_otoritas->_update_otoritas($data, $where);
	}

	Public function delete(){
		$data = array(
			'delete' => $this->input->post('delete')
		);
		$where = array(
			'module_id' => $this->input->post('module_id'),
			'group_id' => $this->input->post('level')
		);
		$this->mod_otoritas->_update_otoritas($data, $where);
	}

	Public function view(){
		$data_post = array(
			'view' => $this->input->post('view'),
		);
		if(!$this->input->post('view')){
			$data = array_merge(
				$data_post,
				array(
					'delete'       => false,
					'update'       => false,
					'insert'       => false,
					'export_excel' => false,
					'print'        => false,
					'detail'       => false,
					'post'         => false,
					'cancel'       => false,
					'attachment'   => false,
				)
			);
		}else{
			$data = $data_post;
		}
		$where = array(
			'module_id' => $this->input->post('module_id'),
			'group_id' => $this->input->post('level')
		);
		$this->mod_otoritas->_update_otoritas($data, $where);
	}

	Public function special_access(){
		$this->mod_otoritas->_update_specialaccess(
			$this->input->post('function_'), 
			$this->input->post('value_'), 
			$this->input->post('module_id'), 
			$this->input->post('level')
		);
	}

	public function ajax_group_list(){
		$list = $this->mod_otoritas->get_datatables_group();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $datas) {
			$no++;
			$row = array();
			$row[] = '<input type="radio" name="group" value="'.$datas->id.'" id="select-group" onchange="selectGroup()">';
			$row[] = $datas->group_name;
			$row[] = '<a href="javascript:void(0)" class="btn btn-success m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" title="Edit" onclick="edit_(\''.$this->encryption->encrypt($datas->id).'\')"><i class="la la-edit"></i></a>
			<a href="javascript:void(0)" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" title="Delete" onclick="delete_group(\''.$this->encryption->encrypt($datas->id).'\')"><i class="la la-trash"></i></a>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->mod_otoritas->count_all_group(),
						"recordsFiltered" => $this->mod_otoritas->count_filtered_group(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_add_group(){
		$data = array(
				'group_name' => $this->input->post('group_name'),
				'is_accounting' => ($this->input->post('is_accounting')) ? $this->input->post('is_accounting') : 0
			);
		$insert = $this->mod_otoritas->save_group($data, $this->input->post('modules'));

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update_group(){
		$this->mod_otoritas->update_group(
			$this->input->post('e_modules'),
			$this->input->post('e_is_accounting'),
			$this->encryption->decrypt($this->input->post('e_id')) 
		);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete_group(){	
		$this->mod_otoritas->delete_by_group_id($this->encryption->decrypt($this->input->post('data')));
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete_otoritas(){	
		$this->mod_otoritas->delete_otoritas(
			$this->encryption->decrypt($this->input->post('group_id')),
			$this->encryption->decrypt($this->input->post('module_id'))
		);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit_group(){
		$data = $this->mod_otoritas->get_by_id($this->encryption->decrypt($this->input->post('data')));
		
		echo json_encode($data);
	}

	Public function ajax_get_otoritas(){
		$data = $this->mod_otoritas->get_otoritas($this->encryption->decrypt($this->input->post('data')));
		echo json_encode($data);
	}

	private function _is_insert($module_id, $level, $insert){
		$is_insert = $this->mod_otoritas->get_function($module_id, 'insert');
		if ($is_insert) {
			$function = '<div class="checkbox"><label><input type="checkbox"'.$this->is_checked($insert).' onclick="insert_('.$module_id.','. $level.','.$insert.')"></label></div>';
		} else {
			$function = '<i class="flaticon-circle"></i>';
		}
		return $function;
	}

	private function _is_update($module_id, $level, $update){
		$is_update = $this->mod_otoritas->get_function($module_id, 'update');
		if ($is_update) {
			$function = '<div class="checkbox"><label><input type="checkbox" '.$this->is_checked($update).' onclick="update_('.$module_id.','.$level.','.$update.')"></label></div>';;
		} else {
			$function = '<i class="flaticon-circle"></i>';
		}
		return $function;
	}

	private function _is_delete($module_id, $level, $delete){
		$is_delete = $this->mod_otoritas->get_function($module_id, 'delete');
		if ($is_delete) {
			$function = '<div class="checkbox"><label><input type="checkbox" '.$this->is_checked($delete).' onclick="delete_('.$module_id.','.$level.','.$delete.')"></label></div>';
		} else {
			$function = '<i class="flaticon-circle"></i>';
		}
		return $function;
	}

	private function _is_view($module_id, $level, $view){
		$is_view = $this->mod_otoritas->get_function($module_id, 'view');
		if ($is_view) {
			$function = '<div class="checkbox"><label><input type="checkbox" '.$this->is_checked($view).' onclick="view_('.$module_id.','.$level.','.$view.')"></label></div>';
		} else {
			$function = '<i class="flaticon-circle"></i>';
		}
		return $function;
	}

	private function _is_special_access($module_id, $function_name, $level, $value){
		$is_view = $this->mod_otoritas->get_function($module_id, $function_name);
		if ($is_view) {
			$function = '<div class="checkbox"><label><input type="checkbox" '.$this->is_checked($value).' onclick="sepecialAccess_('.$module_id.','.$level.','.$value.','."'".$function_name."'".')"></label></div>';
		} else {
			$function = '<i class="flaticon-circle"></i>';
		}
		return $function;
	}

	private function is_checked($is_checked){
		if ($is_checked) {
			$checked = "checked";
		} else {
			$checked = "";
		}
		return $checked;
	}
}
