<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

	/**
	 * [$module description]
	 * @var string
	 */
	public $module = 'supplier';

	/**
	 * [$authority_crud description]
	 * @var [type]
	 */
	public $authority_crud;

	/**
	 * [$authority_view description]
	 * @var [type]
	 */
	public $authority_view;

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
	public $in_js = false;

	/**
	 * [$ex_js description]
	 * @var [type]
	 */
	public $ex_js = false;

	/**
	 * [$in_jssources description]
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
		//Do your magic here
		$this->auth->restrict();
		$this->authority->__restrict_view($this->module);
		$this->authority_crud = $this->authority->__authority_crud($this->module);
		$this->load->model('mod_supplier');
	}

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index(){
		$js_packager = function(){
			if($this->authority->__is_super_admin() || $this->authority_crud->delete)
				return array('i_js', 'd_js');
			return array('i_js');
		};
		$this->authority_view = $this->authority->__authority_view();
		$this->module         = $this->module;
		$this->title          = 'Master Supplier';
		$this->module_title   = 'Master Supplier';
		$this->breadcrumb     = 'Master Supplier - list';
		$this->table_title    = 'Master Supplier';
		$this->content        = 'budget';
		$this->in_js          = true;
		$this->js_sources	  = $js_packager();
		$this->info           = 'Form untuk input data budget. Mohon pastikan data telah benar sebelum disimpan'; //set null if not display info to user
		
		$data['data']         = '';
        $this->load->view('template/template',$data);
	}

	/**
	 * [ajax_list description]
	 * @return [type] [description]
	 */
	public function ajax_list(){
		$datas = $this->mod_supplier->get_datatables();
		$list = array();
		$no = $_POST['start'];
		foreach ($datas as $data) {
			$no++;
			$row = array();
			$row[] = $data->supp_code;
			$row[] = $data->supp_name;
			$row[] = $data->rek_no;
			$row[] = $data->rek_type;
			$row[] = $data->bank_name;
			$row[] = $data->akun_name;
			$row[] = ($this->authority->__is_super_admin()) ?
					'<div class="btn-group m-btn-group m-btn-group--pill m-btn-group--air" role="group" aria-label="...">
					<a href="'.site_url('budget/edit?q='.$this->encryption->encrypt($data->supp_code)).'" class="btn btn-success m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" title="Edit"><i class="la la-edit"></i></a>
					<a href="javascript:void(0)" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" title="Delete" onclick="delete_(\''.$this->encryption->encrypt($data->supp_code).'\')"><i class="la la-trash"></i></a>
					</div>' 
					: '<div class="btn-group m-btn-group m-btn-group--pill m-btn-group--air" role="group" aria-label="...">'.$this->authority->__is_updatedirectly($this->authority_crud->update, site_url('budget/edit?q='.$this->encryption->encrypt($data->supp_code))).$this->authority->__is_delete($this->authority_crud->delete, $data->supp_code).$this->authority->__is_attachdirectly($this->authority_crud->attachment, site_url('budget/attachment?q='.$this->encryption->encrypt($data->supp_code))).'</div>';
			$list[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->mod_supplier->count_all(),
						"recordsFiltered" => $this->mod_supplier->count_filtered(),
						"data" => $list,
				);
		//output to json format
		echo json_encode($output, JSON_PRETTY_PRINT);
	}

	/**
	 * [add description]
	 */
	public function add(){
		if ($this->authority->__is_super_admin() || $this->authority_crud->insert){
			$this->authority_view = $this->authority->__authority_view();
			$this->module         = $this->module;
			$this->title          = 'Master Supplier';
			$this->module_title   = 'Master Supplier';
			$this->breadcrumb     = 'Master Supplier - add';
			$this->table_title    = 'Master Supplier add';
			$this->content        = 'a_form';
			$this->in_js          = true;
			$this->js_sources	  = array('a_js');
			$this->info           = 'Form untuk input data Master Supplier. Mohon pastikan data telah benar sebelum disimpan'; //set null if not display info to user

	        $data['data'] = array(
				'supplier'      => $this->mod_supplier->get_user(),
	        );
	        $this->load->view('template/template', $data);
		} else {
			redirect('denied','refresh');
		}
	}

	/**
	 * [add_submit description]
	 */
	public function add_submit(){
		if ($this->authority->__is_super_admin() || $this->authority_crud->insert) {
				$data = array(
					'supp_code' => $this->input->post('supp_code'),
					'supp_name' => $this->input->post('budget_bbm'),
					'rek_no'  	=> $this->input->post('rek_no'),
					'rek_type'  => $this->input->post('rek_type'),
					'bank_name' => $this->input->post('bank_name'),
					'akun_name' => $this->input->post('akun_name')
				);
				// echo '<pre>';
				// print_r($data);
				// echo '</pre>';
				// die();
				$insert = $this->mod_supplier->save_multiple($data);
				$this->session->set_flashdata('info', toast('success', 'Data saved.'));
				redirect('supplier','refresh');
		} else {
			redirect('denied','refresh');
		}
	}

	/**
	 * [edit description]
	 * @return [type] [description]
	 */
	public function edit(){
		if ($this->authority->__is_super_admin() || $this->authority_crud->update){
			if($this->input->get('q')){
				if ($this->encryption->decrypt(str_replace(" ", "+", $this->input->get('q'))) == '') {
					show_404();
				}
				$this->authority_view = $this->authority->__authority_view();
				$this->module         = $this->module;
				$this->title          = 'Master Supplier';
				$this->module_title   = 'Master Supplier';
				$this->breadcrumb     = 'Master Supplier - edit';
				$this->table_title    = 'Master Supplier edit';
				$this->content        = 'e_form';
				$this->in_js          = true;
				$this->js_sources	  = array('e_js');
				$this->info           = 'Form untuk input data Master Supplier. Mohon pastikan data telah benar sebelum disimpan'; //set null if not display info to user

		        $id = $this->encryption->decrypt(str_replace(" ", "+", $this->input->get('q')));
		        $data['data'] = array(
					'user'       => $this->mod_supplier->get_user(),
					'budget'     => $this->mod_supplier->get_pc($id)->row()
		        );

		        $this->load->view('template/template',$data);
		    } else {
		    	$this->session->set_flashdata('info', toast('error', 'Unknown method.'));
				redirect('supplier','refresh');
		    }
		} else {
			redirect('denied','refresh');
		}
	}

	/**
	 * [edit_submit description]
	 */
	public function edit_submit(){
		$id = $this->input->post('id');
		if ($this->authority->__is_super_admin() || $this->authority_crud->update) {
				$data = array(
					'supp_code' => $this->input->post('supp_code'),
					'supp_name' => $this->input->post('budget_bbm'),
					'rek_no'  	=> $this->input->post('rek_no'),
					'rek_type'  => $this->input->post('rek_type'),
					'bank_name' => $this->input->post('bank_name'),
					'akun_name' => $this->input->post('akun_name')
				);
				// echo '<pre>';
				// print_r($data);
				// echo '</pre>';
				// die();
				$update = $this->mod_supplier->update_multiple($data, $this->encryption->decrypt($id));
				$this->session->set_flashdata('info', toast('success', 'Data Updated.'));
				redirect('supplier','refresh');
		} else {
			redirect('denied','refresh');
		}
	}


	/**
	 * [ajax_delete description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function ajax_delete(){
		if ($this->authority->__is_super_admin() || $this->authority_crud->delete) {	
			$delete = $this->mod_supplier->delete_by_id($this->encryption->decrypt($this->input->post('data')));
			if ($delete > 0) {
				$callback = array(
					'status' => true,
					'message' => 'Data berhasih dihapus'
				);
			} else {
				$callback = array(
					'status' => false,
					'message' => 'Gagal menghapus data'
				);
			}
		} else {
			$callback = array(
				'status' => false,
				'message' => 'Anda tidak memiliki akses untuk hapus data.'
			);
		}
		echo json_encode($callback);
	}

}

/* End of file Supplier.php */
/* Location: ./application/controllers/Supplier.php */