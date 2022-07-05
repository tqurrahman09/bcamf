<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/////////////////////////////////////
// Authority functional system lib //
// Author: Dede Juniawan Suri      //
/////////////////////////////////////

class Authority{
	var $CI = NULL;
	function __construct()
	{
		// get CI's object
		$this->CI =& get_instance();
	}
	/**
	 * [__authority_view description]
	 * @param  [type] $level [description]
	 * @return [type]        [description]
	 */
	function __authority_view()
	{
		if (!$this->__is_super_admin()) {
			$init_menu = array(
						'company'         => 0,
						'department'      => 0,
						'rekening'        => 0,
						'vehicle'         => 0,
						'monthly_expense' => 0,
						'memo_payment'    => 0,
						'petty_chash'     => 0,
						'area'            => 0,
						'customer'        => 0,
						'supplier'        => 0,
						'wh'              => 0,
						'worker'          => 0,
						'me_verified'     => 0,
						'mp_verified'     => 0,
						'pc_verified'     => 0,
						'me_type'         => 0,
						'mp_type'         => 0,
						'pc_type'         => 0
					);
			$this->CI->db->select('
				_module.module_name as module,
				_authority.view as view
			');
			$this->CI->db->from('_group');
			$this->CI->db->join('_authority','_authority.group_id=_group.id');
			$this->CI->db->join('_module','_module.id=_authority.module_id');
			$this->CI->db->where('_group.id', $this->CI->session->userdata('level'));
			$is_view = $this->CI->db->get()->result();
			foreach ($is_view as $value) {
				switch ($value->module) {
					case 'company':
						// code...
						$init_menu['company'] = $value->view;
						break;
					case 'department':
						// code...
						$init_menu['department'] = $value->view;
						break;
					case 'rekening':
						// code...
						$init_menu['rekening'] = $value->view;
						break;
					case 'vehicle':
						// code...
						$init_menu['vehicle'] = $value->view;
						break;
					case 'monthly_expense':
						// code...
						$init_menu['monthly_expense'] = $value->view;
						break;
					case 'memo_payment':
						// code...
						$init_menu['memo_payment'] = $value->view;
						break;
					case 'petty_chash':
						// code...
						$init_menu['petty_chash'] = $value->view;
						break;
					case 'area':
						$init_menu['area'] = $value->view;
						break;
					case 'customer':
						$init_menu['customer'] = $value->view;
						break;
					case 'supplier':
						$init_menu['supplier'] = $value->view;
						break;
					case 'wh':
						$init_menu['wh'] = $value->view;
						break;
					case 'worker':
						$init_menu['worker'] = $value->view;
						break;
					case 'mp_verified':
						$init_menu['mp_verified'] = $value->view;
						break;
					case 'me_verified':
						$init_menu['me_verified'] = $value->view;
						break;
					case 'pc_verified':
						$init_menu['pc_verified'] = $value->view;
						break;
					case 'me_type':
						$init_menu['me_type'] = $value->view;
						break;
					case 'mp_type':
						$init_menu['mp_type'] = $value->view;
						break;
					case 'pc_type':
						$init_menu['pc_type'] = $value->view;
						break;
					default:
						break;
				}
			}
		}else{
			$init_menu = array(
						'company'         => 1,
						'department'      => 1,
						'rekening'        => 1,
						'vehicle'         => 1,
						'monthly_expense' => 1,
						'memo_payment'    => 1,
						'petty_chash'     => 1,
						'area'            => 1,
						'customer'        => 1,
						'supplier'        => 1,
						'wh'              => 1,
						'worker'          => 1,
						'mp_verified'     => 1,
						'me_verified'     => 1,
						'pc_verified'     => 1,
						'me_type'         => 1,
						'mp_type'         => 1,
						'pc_type'         => 1
					);
		}
		$init_menu = (object) $init_menu;
		return $init_menu;
	}
	/**
	 * [__authority_crud description]
	 * @param  [type] $level       [description]
	 * @param  [type] $module_name [description]
	 * @return [type]              [description]
	 */
	function __authority_crud($module_name)
	{
		$this->CI->db->select('_group.id AS level, _authority.insert AS insert, _authority.update AS update, _authority.delete AS delete, _authority.print AS print, _authority.detail AS detail, _authority.export_excel as export_excel, _authority.post as post, _authority.attachment as attachment');
		$this->CI->db->from('_group');
		$this->CI->db->join('_authority','_authority.group_id=_group.id');
		$this->CI->db->join('_module','_module.id=_authority.module_id');
		$this->CI->db->where('_group.id', $this->CI->session->userdata('level'));
		$this->CI->db->where('_module.module_name', $module_name);
		$data = $this->CI->db->get();

		return $data->row();
	}
	/**
	 * [__is_admin description]
	 * @param  [type] $module_name [description]
	 * @return [type]              [description]
	 */
	function __is_admin($module_name)
	{
		$this->CI->db->select('_functional.functional as functional');
		$this->CI->db->from('_functional');
		$this->CI->db->join('_module_functional','_module_functional.functional_id=_functional.id');
		$this->CI->db->join('_module','_module.id=_module_functional.modul_id');
		$this->CI->db->where('_module.module_name',$module_name);

		return $this->CI->db->get()->result();
	}
	/**
	 * [__is_super_admin description]
	 * @param  [type] $level [description]
	 * @return [type]        [description]
	 */
	function __is_super_admin(){
		if ($this->CI->session->userdata('level') == 1) {
			return true;
		}else{
			return false;
		}
	}
	/**
	 * [__is_employee_only description]
	 * @return [type] [description]
	 */
	function __is_employee_only(){
		if ($this->CI->session->userdata('level') == 0) {
			return true;
		}else{
			return false;
		}
	}
	/**
	 * [__restrict_view description]
	 * @param  [type] $module_name [description]
	 * @return [type]              [description]
	 */
	function __restrict_view($module_name){
		if ($this->CI->session->userdata('level') != 1) {
			$this->CI->db->select('_authority.view AS view');
			$this->CI->db->from('_group');
			$this->CI->db->join('_authority','_authority.group_id=_group.id');
			$this->CI->db->join('_module','_module.id=_authority.module_id');
			$this->CI->db->where('_group.id !=',1);
			$this->CI->db->where('_group.id', $this->CI->session->userdata('level'));
			$this->CI->db->where('_module.module_name',$module_name);

			$is_view = $this->CI->db->get()->row_array();
		} else {
			$is_view['view'] = true;
		}

		if (!$is_view['view']) {
			redirect('denied');
		}
	}
	/**
	 * [__restrict_user description]
	 * @return [type] [description]
	 */
	function __restrict_user(){
		if (!$this->__is_super_admin()) {
			$this->output->set_status_header(403);
		}
	}
	/**
	 * [__first_look description]
	 * @param  [type] $level [description]
	 * @return [type]        [description]
	 */
	function __first_look(){
		$this->CI->db->select('_module.module_name AS module');
		$this->CI->db->from('_group');
		$this->CI->db->join('_authority','_authority.group_id=_group.id');
		$this->CI->db->join('_module','_module.id=_authority.module_id');
		$this->CI->db->where('_group.id', $this->CI->session->userdata('level'));
		$this->CI->db->where('_authority.view',true);
		$this->CI->db->order_by('_module.id');
		$this->CI->db->limit(1);

		return $this->CI->db->get()->row();
	}
	/**
	 * [__self_company description]
	 * @return [type] [description]
	 */
	public function __self_company(){
		$this->CI->db->select('master_company.id as id, master_company.company_id as company_id, master_company.company_name as description');
		$this->CI->db->from('master_company');
		// if (!$this->__is_super_admin()) {
		// 	$this->CI->db->join('_user_company', '_user_company.company_id = master_company.id');
		// 	$this->CI->db->where('_user_company.user_id', $this->CI->session->userdata($this->CI->config->item('user_id')));
		// }
		$this->CI->db->order_by('master_company.id', 'asc');
		return $this->CI->db->get();
	}
	/**
	 * [__is_update description]
	 * @param  [type] $update [description]
	 * @param  [type] $id     [description]
	 * @return [type]         [description]
	 */
	function __is_update($update, $id){
		if($update || $this->__is_super_admin()){
			$is_update = '<a href="javascript:void(0)" class="btn btn-success m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" title="Edit" onclick="edit_(\''.$this->CI->encryption->encrypt($id).'\')"><i class="la la-edit"></i></a> ';
		}else{
			$is_update = '';
		}
		return $is_update;
	}
	/**
	 * [__is_delete description]
	 * @param  [type] $delete [description]
	 * @param  [type] $id     [description]
	 * @return [type]         [description]
	 */
	function __is_delete($delete, $id){
		if($delete || $this->__is_super_admin()){
			$is_delete = '<a href="javascript:void(0)" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" title="Delete" onclick="delete_(\''.$this->CI->encryption->encrypt($id).'\')"><i class="la la-trash"></i></a> ';
		}else{
			$is_delete = '';
		}
		return $is_delete;
	}

	/**
	 * [__is_setflock description]
	 * @param  [type] $delete [description]
	 * @param  [type] $id     [description]
	 * @return [type]         [description]
	 */
	function __is_approve($approve, $id, $is_disable){
		if($approve || $this->__is_super_admin()){
			$is_approve = '<button href="javascript:void(0)" class="m-btn btn btn-success m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" title="Approve" onclick="approve_(\''.$this->CI->encryption->encrypt($id).'\')" '.$is_disable.'><i class="la la-check-circle-o"></i></button> ';
		}else{
			$is_approve = '';
		}
		return $is_approve;
	}

	/**
	 * [__is_setflock description]
	 * @param  [type] $setflock [description]
	 * @param  [type] $id       [description]
	 * @return [type]           [description]
	 */
	function __is_reject($reject, $id, $is_disable){
		if($reject || $this->__is_super_admin()){
			$is_reject = '<button href="javascript:void(0)" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" title="Reject" onclick="reject_(\''.$this->CI->encryption->encrypt($id).'\')" '.$is_disable.'><i class="la la-times-circle-o"></i></button> ';
		}else{
			$is_reject = '';
		}
		return $is_reject;
	}

	/**
	 * [__is_detail description]
	 * @param  [type] $update [description]
	 * @param  [type] $id     [description]
	 * @return [type]         [description]
	 */
	function __is_detail($update, $id){
		if($update || $this->__is_super_admin()){
			$is_update = '<a href="javascript:void(0)" class="btn btn-info m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" title="View" onclick="detail_(\''.$this->CI->encryption->encrypt($id).'\')"><i class="la la-search"></i></a> ';
		}else{
			$is_update = '';
		}
		return $is_update;
	}

	/**
	 * [__is_exception_module description]
	 * @param  [type] $module_name [description]
	 * @return [type]              [description]
	 */
	function __is_exception_module($module_name){
		if($module_name == 'profil' || $module_name == 'leave' || $module_name == 'head_approval'){
			return true;
		} else {
			return false;
		}
	}

	/**
	 * [__is_updatedirectly description]
	 * @param  [type] $update [description]
	 * @param  [type] $id     [description]
	 * @return [type]         [description]
	 */
	function __is_updatedirectly($update, $url){
		if($update || $this->__is_super_admin()){
			$is_update = '<a href="'.$url.'" class="btn btn-success m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" title="Edit"><i class="la la-edit"></i></a> ';
		}else{
			$is_update = '';
		}
		return $is_update;
	}

	/**
	 * [__is_attachdirectly description]
	 * @param  [type] $attachment [description]
	 * @param  [type] $url        [description]
	 * @return [type]             [description]
	 */
	function __is_attachdirectly($attachment, $url){
		if($attachment || $this->__is_super_admin()){
			$is_attachment = '<a href="'.$url.'" class="btn btn-info m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" title="Attach"><i class="flaticon-attachment"></i></a> ';
		}else{
			$is_attachment = '';
		}
		return $is_attachment;
	}
}