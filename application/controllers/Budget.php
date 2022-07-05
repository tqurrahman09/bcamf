<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Budget extends CI_Controller {

	/**
	 * [$module description]
	 * @var string
	 */
	public $module = 'budget';

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
		$this->load->model('mod_budget');
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
		$this->title          = 'Master Budget';
		$this->module_title   = 'Master Budget';
		$this->breadcrumb     = 'Master Budget - list';
		$this->table_title    = 'Master Budget';
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
		$datas = $this->mod_budget->get_datatables();
		$list = array();
		$no = $_POST['start'];
		foreach ($datas as $data) {
			$no++;
			$row = array();
			$row[] = "<div style='text-align:center'>" .($data->user_id)."</div>";
			$row[] = $data->description;
			$row[] = "<div style='text-align:right'>" .number_format($data->budget_bbm,0,",",".")."</div>"; 
			$row[] = "<div style='text-align:right'>" .number_format($data->budget_pulsa,0,",",".")."</div>";
			$row[] = "<div style='text-align:right'>" .number_format($data->budget_hotel,0,",",".")."</div>";
			$row[] = ($this->authority->__is_super_admin()) ?
					'<div class="btn-group m-btn-group m-btn-group--pill m-btn-group--air" role="group" aria-label="...">
					<a href="'.site_url('budget/edit?q='.$this->encryption->encrypt($data->user_id)).'" class="btn btn-success m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" title="Edit"><i class="la la-edit"></i></a>
					<a href="javascript:void(0)" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" title="Delete" onclick="delete_(\''.$this->encryption->encrypt($data->user_id).'\')"><i class="la la-trash"></i></a>
					</div>' 
					: '<div class="btn-group m-btn-group m-btn-group--pill m-btn-group--air" role="group" aria-label="...">'.$this->authority->__is_updatedirectly($this->authority_crud->update, site_url('budget/edit?q='.$this->encryption->encrypt($data->user_id))).$this->authority->__is_delete($this->authority_crud->delete, $data->user_id).$this->authority->__is_attachdirectly($this->authority_crud->attachment, site_url('budget/attachment?q='.$this->encryption->encrypt($data->user_id))).'</div>';
			$list[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->mod_budget->count_all(),
						"recordsFiltered" => $this->mod_budget->count_filtered(),
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
			$this->title          = 'Master Budget';
			$this->module_title   = 'Master Budget';
			$this->breadcrumb     = 'Master Budget - add';
			$this->table_title    = 'Master Budget add';
			$this->content        = 'a_form';
			$this->in_js          = true;
			$this->js_sources	  = array('a_js');
			$this->info           = 'Form untuk input data Master Budget. Mohon pastikan data telah benar sebelum disimpan'; //set null if not display info to user

	        $data['data'] = array(
				'user'      => $this->mod_budget->get_user(),
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
					'user_id'   	=> $this->input->post('user_id'),
					'budget_bbm'    => str_replace(',', '',$this->input->post('budget_bbm')),
					'budget_pulsa'  => str_replace(',', '',$this->input->post('budget_pulsa')),
					'budget_hotel'  => str_replace(',', '',$this->input->post('budget_hotel'))
				);
				// echo '<pre>';
				// print_r($data);
				// echo '</pre>';
				// die();
				$insert = $this->mod_budget->save_multiple($data);
				$this->session->set_flashdata('info', toast('success', 'Data saved.'));
				redirect('budget','refresh');
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
				$this->title          = 'Master Budget';
				$this->module_title   = 'Master Budget';
				$this->breadcrumb     = 'Master Budget - edit';
				$this->table_title    = 'Master Budget edit';
				$this->content        = 'e_form';
				$this->in_js          = true;
				$this->js_sources	  = array('e_js');
				$this->info           = 'Form untuk input data Master Budget. Mohon pastikan data telah benar sebelum disimpan'; //set null if not display info to user

		        $id = $this->encryption->decrypt(str_replace(" ", "+", $this->input->get('q')));
		        $data['data'] = array(
					'user'       => $this->mod_budget->get_user(),
					'budget'     => $this->mod_budget->get_pc($id)->row()
		        );

		        $this->load->view('template/template',$data);
		    } else {
		    	$this->session->set_flashdata('info', toast('error', 'Unknown method.'));
				redirect('budget','refresh');
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
					'user_id'   	=> $this->input->post('user_id'),
					'budget_bbm'    => str_replace(',', '',$this->input->post('budget_bbm')),
					'budget_pulsa'  => str_replace(',', '',$this->input->post('budget_pulsa')),
					'budget_hotel'  => str_replace(',', '',$this->input->post('budget_hotel'))
				);
				// echo '<pre>';
				// print_r($data);
				// echo '</pre>';
				// die();
				$update = $this->mod_budget->update_multiple($data, $this->encryption->decrypt($id));
				$this->session->set_flashdata('info', toast('success', 'Data Updated.'));
				redirect('budget','refresh');
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
			$delete = $this->mod_budget->delete_by_id($this->encryption->decrypt($this->input->post('data')));
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

/* End of file mod_budget.php */
/* Location: ./application/controllers/mod_budget.php */