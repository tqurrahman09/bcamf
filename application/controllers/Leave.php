<?php
defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////
// Author Dede Juniawan Suri //
///////////////////////////////

class Leave extends CI_Controller {
	/**
	 * [$module description]
	 * @var string
	 */
	public $module = 'leave';

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
	public $in_js;

	/**
	 * [$ex_js description]
	 * @var [type]
	 */
	public $ex_js;

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
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('mod_leave');
		$this->auth->restrict();
	}

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index(){
		$this->authority_view = $this->authority->__authority_view();
		$this->module = $this->module;
        $this->title = 'Leave';
        $this->module_title = 'Leave';
        $this->breadcrumb = 'Leave - list';
        $this->table_title = 'Leave List';
        $this->content = 'leave';
        $this->in_js = false;
        $this->ex_js = true;
        $this->info = 'Form untuk input data '.$this->module.'. Mohon pastikan data telah benar sebelum disimpan'; //set null if not display info to user

        $data['data'] = '';
        $this->load->view('template/template',$data);
	}

	/**
	 * [ajax_list description]
	 * @return [type] [description]
	 */
	public function ajax_list(){
		$datas = $this->mod_leave->get_datatables();
		$list = array();
		$no = $_POST['start'];
		foreach ($datas as $data) {
			$no++;
			$row = array();
			$row[] = $data->employee_id;
			$row[] = $data->employee_name;
			$row[] = $data->department_name;
			$row[] = $data->leave_dates;
			$row[] = $data->number_of_days;
			$row[] = $data->status;
			$row[] = (true) ?
					'<div class="btn-group m-btn-group m-btn-group--pill m-btn-group--air" role="group" aria-label="...">
					<a href="'.site_url("leave/edit?q=".$this->encrypt->encode($data->id)).'" class="btn btn-success m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" title="Edit"><i class="la la-edit"></i></a>
					<a href="javascript:void(0)" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" title="Delete" onclick="delete_(\''.$this->encrypt->encode($data->id).'\')"><i class="la la-trash"></i></a>
					<a href="javascript:void(0)" class="btn btn-info m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" title="View" onclick="detail_(\''.$this->encrypt->encode($data->id).'\')"><i class="la la-search"></i></a>
					</div>' 
					: '<div class="btn-group m-btn-group m-btn-group--pill m-btn-group--air" role="group" aria-label="...">'.$this->authority->__is_update($this->authority_crud->update, $data->id).$this->authority->__is_delete($this->authority_crud->delete, $data->id).$this->authority->__is_detail($this->authority_crud->detail, $data->id).'</div>';
			$list[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->mod_leave->count_all(),
						"recordsFiltered" => $this->mod_leave->count_filtered(),
						"data" => $list,
				);
		//output to json format
		echo json_encode($output, JSON_PRETTY_PRINT);
	}

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function request(){
		$this->authority_view = $this->authority->__authority_view();
		$this->module = $this->module;
        $this->title = 'Leave';
        $this->module_title = 'Leave';
        $this->breadcrumb = 'Leave - request';
        $this->table_title = 'Leave Request';
        $this->content = 'a_form';
        $this->in_js = false;
        $this->ex_js = true;
        $this->info = 'Form untuk input data '.$this->module.'. Mohon pastikan data telah benar sebelum disimpan'; //set null if not display info to user

        $data['data'] = array(
        				'head' => $this->mod_leave->get_head()
        			);
        $this->load->view('template/template',$data);
	}

	/**
	 * [ajax_add description]
	 * @return [type] [description]
	 */
	public function add(){
		if (true) {
			$config = array(
			        array(
			                'field' => 'date',
			                'label' => 'Date',
			                'rules' => 'required|trim'
			        ),
			        array(
			                'field' => 'purpose',
			                'label' => 'Purpose',
			                'rules' => 'required|trim'
			        ),
			        array(
			                'field' => 'job',
			                'label' => 'Job',
			                'rules' => 'required|trim'
			        ),
			        array(
			                'field' => 'job_delegation',
			                'label' => 'Job Delegation',
			                'rules' => 'required|trim'
			        ),
			        array(
			                'field' => 'type',
			                'label' => 'Type',
			                'rules' => 'required|trim'
			        )
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message', validation_errors());
				redirect('leave/request','refresh');
			} else {
				$data['purpose']        = $this->input->post('purpose');
				$data['job']            = $this->input->post('job');
				$data['job_delegation'] = $this->input->post('job_delegation');
				$data['type']           = $this->input->post('type');
				$data['employee_id']    = $this->session->userdata($this->config->item('user_id'));
				$data['insert_by']      = $this->session->userdata($this->config->item('user_id'));
				if ($this->input->post('submit')) {
					$data['status'] = 'Pending';
				}
				$insert = $this->mod_leave->save_leave($data, $this->input->post('date'));
				if ($insert) {
					$this->session->set_flashdata('message', 'Successfuly');
					redirect('leave','refresh');
				} else {
					$this->session->set_flashdata('message', 'Failed save your leave data.');
					redirect('leave/request','refresh');
				}
			}
		} else {
			redirect('denied','refresh');
		}
	}

	/**
	 * [edit_buffer description]
	 * @return [type] [description]
	 */
	public function edit_buffer(){
		if (true) {
			$this->session->set_flashdata('temp_id', $this->input->get('q'));
			redirect('leave/edit','refresh');
		} else {
			$callback = array(
				'status' => false,
				'message' => 'Anda tidak memiliki akses untuk update data.'
			);
			echo json_encode($callback);
		}
	}

	/**
	 * [edit description]
	 * @return [type] [description]
	 */
	public function edit(){
		if (true) {
			$this->authority_view = $this->authority->__authority_view();
			$this->module = $this->module;
	        $this->title = 'Leave';
	        $this->module_title = 'Leave';
	        $this->breadcrumb = 'Leave - request';
	        $this->table_title = 'Leave Request';
	        $this->content = 'e_form';
	        $this->in_js = false;
	        $this->ex_js = true;
	        $this->info = 'Form untuk input data '.$this->module.'. Mohon pastikan data telah benar sebelum disimpan'; //set null if not display info to user
	        
			$id = $this->encrypt->decode(str_replace(" ", "+", $this->input->get('q')));
			$data['data'] = array(
						'leave'        => $this->mod_leave->get_by_id($id),
						'leave_detail' => $this->mod_leave->get_child($id)
					);
			$this->load->view('template/template', $data);
			// print_r($this->mod_leave->get_by_id($id)->row());
		} else {
			redirect('denied','refresh');
		}
	}

	/**
	 * [ajax_edit description]
	 * @return [type] [description]
	 */
	public function editsubmit(){
		if (true) {
			$config = array(
					array(
			                'field' => 'id',
			                'label' => 'ID',
			                'rules' => 'required|trim'
			        ),
			        array(
			                'field' => 'date',
			                'label' => 'Date',
			                'rules' => 'required|trim'
			        ),
			        array(
			                'field' => 'purpose',
			                'label' => 'Purpose',
			                'rules' => 'required|trim'
			        ),
			        array(
			                'field' => 'job',
			                'label' => 'Job',
			                'rules' => 'required|trim'
			        ),
			        array(
			                'field' => 'job_delegation',
			                'label' => 'Job Delegation',
			                'rules' => 'required|trim'
			        ),
			        array(
			                'field' => 'type',
			                'label' => 'Type',
			                'rules' => 'required|trim'
			        )
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message', validation_errors());
				redirect('leave/request','refresh');
			} else {
				$data['purpose']        = $this->input->post('purpose');
				$data['job']            = $this->input->post('job');
				$data['job_delegation'] = $this->input->post('job_delegation');
				$data['type']           = $this->input->post('type');
				$data['employee_id']    = $this->session->userdata($this->config->item('user_id'));
				$data['insert_by']      = $this->session->userdata($this->config->item('user_id'));
				if ($this->input->post('submit')) {
					$data['status'] = 'Pending';
				}
				$updated = $this->mod_leave->update_leave($this->input->post('id'), $data, $this->input->post('date'));
				if ($updated) {
					$this->session->set_flashdata('message', 'Successfuly');
					redirect('leave','refresh');
				} else {
					$this->session->set_flashdata('message', 'Failed save your leave data.');
					redirect('leave/request','refresh');
				}
			}
		} else {
			$callback = array(
				'status' => false,
				'message' => 'Anda tidak memiliki akses untuk update data.'
			);
		}
		echo json_encode($callback);
	}

	/**
	 * [ajax_delete description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function ajax_delete(){
		if (true) {	
			$delete = $this->mod_leave->delete_by_id($this->encrypt->decode($this->input->post('data')));
			if ($delete) {
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

	/**
	 * [ajax_detail description]
	 * @return [type] [description]
	 */
	public function ajax_detail(){
		if (true) {
			$temp = $this->mod_leave->get_detail($this->encrypt->decode($this->input->post('data')))->row();
			$data = array(
				'employee_name'     => $temp->employee_name,
				'head_name'         => $temp->head_name,
				'leave_dates'       => $temp->leave_dates,
				'purpose'           => $temp->purpose,
				'job'               => $temp->job,
				'job_delegation'    => $temp->job_delegation,
				'type'              => $temp->type,
				'status'            => $temp->status,
				'submit_date'       => $temp->submit_date,
				'head_decided_by'   => $temp->head_decided_by,
				'head_decided_date' => $temp->head_decided_date,
				'hrd_decided_by'    => $temp->hrd_decided_by,
				'hrd_decided_date'  => $temp->hrd_decided_date,
				'note'              => $temp->note
			);
			echo json_encode($data);
		} else {
			$callback = array(
					'status' => false,
					'message' => 'Anda tidak memiliki akses view detail.'
				);
			echo json_encode($callback);
		}
	}
}

/* End of file Chickin.php */
/* Location: ./application/controllers/Chickin.php */