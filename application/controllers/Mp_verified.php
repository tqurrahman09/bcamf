<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mp_verified extends CI_Controller {

	/**
	 * [$module description]
	 * @var string
	 */
	public $module = 'mp_verified';

	/**
	 * [$authority_crud description]
	 * @var [type]
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
		$this->load->model('mod_mpverified');
		$this->load->library('encryption');
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
		$this->title          = 'Memo payment verification';
		$this->module_title   = 'Memo payment verification';
		$this->breadcrumb     = 'Memo payment verification - list';
		$this->table_title    = 'Memo payment verification List';
		$this->content        = 'mp_verified';
		$this->in_js          = true;
		$this->js_sources	  = $js_packager();
		$this->info           = 'Form untuk input data Memo payment. Mohon pastikan data telah benar sebelum disimpan'; //set null if not display info to user
		
		$data['data']         = '';
        $this->load->view('template/template',$data);
	}

	/**
	 * [ajax_list description]
	 * @return [type] [description]
	 */
	public function ajax_list(){
		$datas = $this->mod_mpverified->get_datatables();
		$list = array();
		$no = $_POST['start'];
		foreach ($datas as $data) {
			$no++;
			$row = array();
			$row[] = $data->no_ref;
			$row[] = $data->username;
			$row[] = $data->date;
			$row[] = $data->journal_num_ax;
			if ($data->verified == 0) {
				$data->verified = '<span class="badge badge-secondary">Pending</span>';
			} else {
				$data->verified = '<span class="badge badge-success">Verified</span>';
			}
			
			$row[] = $data->verified;
			$row[] = ($this->authority->__is_super_admin()) ?
					'<div class="btn-group m-btn-group m-btn-group--pill m-btn-group--air" role="group" aria-label="...">
					<a href="'.site_url('mp-verified/attachment?q='.$this->encryption->encrypt($data->no_ref)).'" class="btn btn-info m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" title="Attach"><i class="flaticon-attachment"></i></a>
					<a href="javascript:void(0)" class="btn btn-success m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" title="Verified" onclick="delete_(\''.$this->encryption->encrypt($data->no_ref).'\')"><i class="la la-check-square"></i></a>
					</div>' 
					: '<div class="btn-group m-btn-group m-btn-group--pill m-btn-group--air" role="group" aria-label="...">'.$this->authority->__is_updatedirectly($this->authority_crud->update, site_url('monthly-expense/edit?q='.$this->encryption->encrypt($data->no_ref))).$this->authority->__is_delete($this->authority_crud->delete, $data->no_ref).$this->authority->__is_attachdirectly($this->authority_crud->attachment, site_url('mp-verified/verified?q='.$this->encryption->encrypt($data->no_ref))).'</div>';
			$list[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->mod_mpverified->count_all(),
						"recordsFiltered" => $this->mod_mpverified->count_filtered(),
						"data" => $list,
				);
		//output to json format
		echo json_encode($output, JSON_PRETTY_PRINT);
	}

	/**
	 * [attach description]
	 * @return [type] [description]
	 */
	public function attachment(){
		if ($this->authority->__is_super_admin() || $this->authority_crud->attachment) {
			$this->authority_view = $this->authority->__authority_view();
			$this->module         = $this->module;
			$this->title          = 'Memo payment verification';
			$this->module_title   = 'Memo payment verification';
			$this->breadcrumb     = 'Memo payment verification - attachment';
			$this->table_title    = 'Attachment';
			$this->content        = 'l_form';
			$this->in_js          = true;
			$this->js_sources	  = array('l_js');
			$this->info           = 'Form untuk input data Memo payment. Mohon pastikan data telah benar sebelum disimpan'; //set null if not display info to user

	        $id = $this->encryption->decrypt(str_replace(" ", "+", $this->input->get('q')));
	        $data['data'] = array(
				'file' => $this->mod_mpverified->get_fromtable('memo_payment_file', 'no_ref', $id)
	        );

	        $this->load->view('template/template',$data);
	    } else {
	    	redirect('denied','refresh');
	    }
	}

	/**
	 * [attach_submit description]
	 * @return [type] [description]
	 */
	public function attachment_submit(){
		if ($this->authority->__is_super_admin() || $this->authority_crud->attachment) {
			$id = $this->encryption->decrypt(str_replace(" ", "+", $this->input->post('id')));
			$folder = './uploads/mp-verified/'.md5($id).'/';
			if(!is_dir($folder))
			{
			   mkdir($folder,0777,true);
			}
	        $config['upload_path']          = $folder;
	        $config['file_name'] 			= md5(date("d-m-Y h:i:s"));
	        $config['allowed_types']        = 'pdf';
	        $config['overwrite']       		= true;
	        $config['max_size']             = 2048;

	        $this->upload->initialize($config);

	        if (!$this->upload->do_upload('attachment')){
	        	$this->session->set_flashdata('info', toast('error', 'Failed save file.'));
	            redirect('mp-verified/attachment?q='.$this->encryption->encrypt($id),'refresh');
	        } else {
	        	$init = $this->upload->data();
	        	$data = array(
					'no_ref' => $id,
					'file'  => $folder.$init['orig_name'],
		    	);
		    	$saved = $this->mod_mpverified->save_attachment($data);
		    	if ($saved) {
		    		$this->session->set_flashdata('info', toast('success', 'File saved.'));
		    		redirect('mp-verified/attachment?q='.$this->encryption->encrypt($id),'refresh');
		    	} else {
		    		$this->session->set_flashdata('info', toast('error', 'Failed save file.'));
	            	redirect('mp-verified/attachment?q='.$this->encryption->encrypt($id),'refresh');
		    	}
	        }
	    } else {
	    	redirect('denied','refresh');
	    }
	}

	/**
	 * [attachment_delete description]
	 * @return [type] [description]
	 */
	public function attachment_delete(){
		if ($this->authority->__is_super_admin() || $this->authority_crud->attachment) {
			$id = $this->encryption->decrypt(str_replace(" ", "+", $this->input->get('q')));
			$deleted = $this->mod_mpverified->delete_attachment($id);
			if ($deleted) {
				$this->session->set_flashdata('info', toast('success', 'File deleted.'));
		    	redirect('mp-verified/attachment?q='.$this->input->get('r'),'refresh');
			} else {
				$this->session->set_flashdata('info', toast('error', 'Delete failed.'));
		    	redirect('mp-verified/attachment?q='.$this->input->get('r'),'refresh');
			}
		} else {
			redirect('denied','refresh');
		}
	}

	public function ajax_delete(){
		if ($this->authority->__is_super_admin()) {	
			$verified = $this->mod_mpverified->verified($this->encryption->decrypt($this->input->post('data')));
			if ($verified > 0) {
				$callback = array(
					'status' => true,
					'message' => 'Data has been verified'
				);
			} else {
				$callback = array(
					'status' => false,
					'message' => 'Failed to verify data!'
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

/* End of file mod_mpverified.php */
/* Location: ./application/controllers/mod_mpverified.php */