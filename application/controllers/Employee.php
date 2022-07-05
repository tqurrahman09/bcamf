<?php
defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////
// Author Dede Juniawan Suri //
///////////////////////////////

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Employee extends CI_Controller {
	/**
	 * [$module description]
	 * @var string
	 */
	public $module = 'employee';

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
		$this->auth->restrict();
		$this->authority->__restrict_view($this->module);
		$this->authority_crud = $this->authority->__authority_crud($this->module);
		$this->self_company = $this->authority->__self_company();
	}

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index()
	{
		$this->authority_view = $this->authority->__authority_view();
		$this->module = $this->module;
        $this->title = 'Master Employee';
        $this->module_title = 'Master Employee';
        $this->breadcrumb = 'Employee';
        $this->table_title = 'Employee List';
        $this->content = $this->module;
        $this->in_js = false;
        $this->ex_js = true;
        $this->info = 'Form untuk input data '.$this->module.'. Mohon pastikan data telah benar sebelum disimpan'; //set null if not display info to user

        $data['data'] = array(
        				'head' => $this->mod_employee->get_head(),
        				'department' => $this->mod_employee->get_department(),
        				'company' => $this->mod_employee->get_company(),
        				'area' => $this->mod_employee->get_area(),
        				'level' => $this->mod_employee->get_level()
        			);
        $this->load->view('template/template',$data);
	}

	/**
	 * [ajax_list description]
	 * @return [type] [description]
	 */
	public function ajax_list(){
		$datas = $this->mod_employee->get_datatables();
		$list = array();
		$no = $_POST['start'];
		foreach ($datas as $data) {
			$no++;
			$row = array();
			$row[] = $data->employee_id;
			$row[] = $data->name;
			$row[] = $data->email;
			$row[] = $data->department;
			$row[] = $data->head;
			$row[] = ($this->authority->__is_super_admin()) ?
					'<div class="btn-group m-btn-group m-btn-group--pill m-btn-group--air" role="group" aria-label="...">
					<a href="javascript:void(0)" class="btn btn-success m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" title="Edit" onclick="edit_(\''.$this->encrypt->encode($data->id).'\')"><i class="la la-edit"></i></a>
					<a href="javascript:void(0)" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" title="Delete" onclick="delete_(\''.$this->encrypt->encode($data->id).'\')"><i class="la la-trash"></i></a>
					<a href="javascript:void(0)" class="btn btn-info m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" title="View" onclick="detail_(\''.$this->encrypt->encode($data->id).'\')"><i class="la la-search"></i></a>
					</div>' 
					: '<div class="btn-group m-btn-group m-btn-group--pill m-btn-group--air" role="group" aria-label="...">'.$this->authority->__is_update($this->authority_crud->update, $data->id).$this->authority->__is_delete($this->authority_crud->delete, $data->id).$this->authority->__is_detail($this->authority_crud->detail, $data->id).'</div>';
			$list[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->mod_employee->count_all(),
						"recordsFiltered" => $this->mod_employee->count_filtered(),
						"data" => $list,
				);
		//output to json format
		echo json_encode($output, JSON_PRETTY_PRINT);
	}

	/**
	 * [ajax_add description]
	 * @return [type] [description]
	 */
	public function ajax_add(){
		if ($this->authority->__is_super_admin() || $this->authority_crud->insert) {
			$config = array(
			        array(
			                'field' => 'a_employee_id',
			                'label' => 'Employee ID',
			                'rules' => 'required|trim|is_unique[master_employee.employee_id]'
			        ),
			        array(
			                'field' => 'a_employee_name',
			                'label' => 'Employee Name',
			                'rules' => 'required|trim'
			        ),
			        array(
			                'field' => 'a_head_name',
			                'label' => 'Head',
			                'rules' => 'required|trim'
			        ),
			        array(
			                'field' => 'a_department',
			                'label' => 'Department',
			                'rules' => 'required|trim'
			        ),
			        array(
			                'field' => 'a_join_date',
			                'label' => 'Join Date',
			                'rules' => 'required|trim'
			        ),
			        array(
			                'field' => 'a_level',
			                'label' => 'Level',
			                'rules' => 'required|trim'
			        ),
			        array(
			                'field' => 'a_area',
			                'label' => 'Area',
			                'rules' => 'required|trim'
			        ),
			        array(
			                'field' => 'a_email',
			                'label' => 'Email',
			                'rules' => 'required|trim'
			        )
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$callback = array(
					'status' => false,
					'message' => validation_errors()
				);
			} else {
				$data = array(
					'employee_id'   => $this->input->post('a_employee_id'),
					'employee_name' => $this->input->post('a_employee_name'),
					'head'          => $this->input->post('a_head_name'),
					'department_id' => $this->input->post('a_department'),
					'join_date'     => date('d-m-Y', strtotime($this->input->post('a_join_date'))),
					'level_id'      => $this->input->post('a_level'),
					'area_id'       => $this->input->post('a_area'),
					'email'         => $this->input->post('a_email'),
					'password'		=> $this->bcrypt->hash_password("1234"),
					'insert_by'     => $this->session->userdata($this->config->item('user_id'))
				);
				$insert = $this->mod_employee->save($data);
				if ($insert) {
					$callback = array(
						'status' => true,
						'message' => 'Data berhasil disimpan'
					);
				} else {
					$callback = array(
						'status' => false,
						'message' => 'Gagal menyimpan data'
					);
				}
			}
		} else {
			$callback = array(
					'status' => false,
					'message' => 'Anda tidak memiliki akses untuk menambah data.'
				);
		}
		echo json_encode($callback);
	}

	/**
	 * [ajax_edit description]
	 * @return [type] [description]
	 */
	public function ajax_edit(){
		if ($this->authority->__is_super_admin() || $this->authority_crud->update) {
			$temp = $this->mod_employee->get_by_id($this->encrypt->decode($this->input->post('data')))->row();
			$data = array(
				'employee_id'   => $temp->employee_id,
				'employee_name' => $temp->employee_name,
				'email'         => $temp->email,
				'head'          => $temp->head,
				'department_id' => $temp->department_id,
				'join_date'     => $temp->join_date,
				'level'         => $temp->level_id,
				'status'        => $temp->status,
				'area'          => $temp->area_id,
				'resign_date'   => $temp->resign_date,
			);		
			echo json_encode($data, JSON_PRETTY_PRINT);
		} else {
			$callback = array(
				'status' => false,
				'message' => 'Anda tidak memiliki akses untuk update data.'
			);
			echo json_encode($callback);
		}
	}

	/**
	 * [ajax_edit description]
	 * @return [type] [description]
	 */
	public function ajax_editsubmit(){
		if ($this->authority->__is_super_admin() || $this->authority_crud->update) {
			$config = array(
			        array(
			                'field' => 'e_employee_id',
			                'label' => 'Employee ID',
			                'rules' => 'required|trim'
			        ),
			        array(
			                'field' => 'e_employee_name',
			                'label' => 'Employee Name',
			                'rules' => 'required|trim'
			        ),
			        array(
			                'field' => 'e_head_name',
			                'label' => 'Head',
			                'rules' => 'required|trim'
			        ),
			        array(
			                'field' => 'e_department',
			                'label' => 'Department',
			                'rules' => 'required|trim'
			        ),
			        array(
			                'field' => 'e_join_date',
			                'label' => 'Join Date',
			                'rules' => 'required|trim'
			        ),
			        array(
			                'field' => 'e_level',
			                'label' => 'Level',
			                'rules' => 'required|trim'
			        ),
			        array(
			                'field' => 'e_status',
			                'label' => 'Status',
			                'rules' => 'required|trim'
			        ),
			        array(
			                'field' => 'e_email',
			                'label' => 'Email',
			                'rules' => 'required|trim'
			        )
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$callback = array(
					'status' => false,
					'message' => validation_errors()
				);
			} else {
				$data['employee_id']   = $this->input->post('e_employee_id');
				$data['employee_name'] = $this->input->post('e_employee_name');
				$data['email']         = $this->input->post('e_email');
				$data['password']	   = $this->bcrypt->hash_password("1234");
				$data['head']          = $this->input->post('e_head_name');
				$data['department_id'] = $this->input->post('e_department');
				$data['join_date']     = date('Y-m-d', strtotime($this->input->post('e_join_date')));
				$data['level_id']         = $this->input->post('e_level');
				$data['status']        = $this->input->post('e_status');
				if ($this->input->post('e_resign_date'))
					$data['resign_date']     = date('Y-m-d', strtotime($this->input->post('e_resign_date')));
				$data['modify_date']   = date('Y-m-d h:i:s');
				$data['modify_by']     = $this->session->userdata($this->config->item('user_id'));
				$update = $this->mod_employee->update_withlog(array('id' => $this->encrypt->decode($this->input->post('e_id'))), $data, $this->module);
				if ($update) {
					$callback = array(
						'status' => true,
						'message' => 'Data berhasil di-edit'
					);
				} else {
					$callback = array(
						'status' => false,
						'message' => 'Oops, tidak ada perubahan data.'
					);
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
		if ($this->authority->__is_super_admin() || $this->authority_crud->delete) {	
			$delete = $this->mod_employee->delete_withlog($this->module, $this->encrypt->decode($this->input->post('data')));
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
	 * [upload description]
	 * @return [type] [description]
	 */
    public function ajax_import() {
    	$data = array();
	    $this->form_validation->set_rules('file', 'Upload File', 'callback_checkFileValidation');
	    if($this->form_validation->run() == false) {
	        $callback = array(
	        				'status' => false,
	        				'message' => 'File couldnt be upload.'
	        			);
	    } else {
	        if(!empty($_FILES['file']['name'])) { 
	        	// get file extension
	        	$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
	        	if($extension == 'csv'){
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
				} elseif($extension == 'xlsx') {
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				} else {
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
				}

				// file path
				$spreadsheet = $reader->load($_FILES['file']['tmp_name']);
				$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
			
				// array Count
				$arrayCount   = count($allDataInSheet);
				$flag         = false;
				$createArray  = array(
									'employee_id',
									'employee_payroll_id',
									'department_id',
									'area_id',
									'employee_name',
									'head',
									'email',
									'join_date',
									'level_id'
								);
				$makeArray    = array(
									'employee_id'         => 'employee_id',
									'employee_payroll_id' => 'employee_payroll_id',
									'department_id'       => 'department_id',
									'area_id'             => 'area_id',
									'employee_name'       => 'employee_name',
									'head'                => 'head',
									'email'               => 'email',
									'join_date'           => 'join_date',
									'level_id'            => 'level_id'
								);
				$SheetDataKey = array();
	            foreach ($allDataInSheet as $dataInSheet) {
	                foreach ($dataInSheet as $key => $value) {
	                    if (in_array(trim($value), $createArray)) {
	                        $value = preg_replace('/\s+/', '', $value);
	                        $SheetDataKey[trim($value)] = $key;
	                    } 
	                }
	            }
	            $dataDiff = array_diff_key($makeArray, $SheetDataKey);
	            if (empty($dataDiff)) {
	            	$flag = true;
	        	}

	        	// match excel sheet column
	            if ($flag) {
	                for ($i = 2; $i <= $arrayCount; $i++) {
						$employee_id         = $SheetDataKey['employee_id'];
						$employee_payroll_id = $SheetDataKey['employee_payroll_id'];
						$department_id       = $SheetDataKey['department_id'];
						$area_id             = $SheetDataKey['area_id'];
						$employee_name       = $SheetDataKey['employee_name'];
						$head                = $SheetDataKey['head'];
						$email               = $SheetDataKey['email'];
						$join_date           = $SheetDataKey['join_date'];
						$level_id            = $SheetDataKey['level_id'];

						$employee_id         = filter_var(trim($allDataInSheet[$i][$employee_id]));
						$employee_payroll_id = filter_var(trim($allDataInSheet[$i][$employee_payroll_id]));
						$department_id       = filter_var(trim($allDataInSheet[$i][$department_id]));
						$area_id             = filter_var(trim($allDataInSheet[$i][$area_id]));
						$employee_name       = filter_var(trim($allDataInSheet[$i][$employee_name]));
						$head                = filter_var(trim($allDataInSheet[$i][$head]));
						$email               = filter_var(trim($allDataInSheet[$i][$email]));
						$join_date           = filter_var(trim($allDataInSheet[$i][$join_date]));
						$level_id            = filter_var(trim($allDataInSheet[$i][$level_id]));

	                    $fetchData[] = array(
										'employee_id'         => $employee_id,
										'employee_payroll_id' => $employee_payroll_id,
										'department_id'       => $department_id,
										'area_id'             => $area_id,
										'employee_name'       => $employee_name,
										'head'                => $head,
										'email'               => $email,
										'join_date'           => date('Y-m-d', strtotime($join_date)),
										'level_id'            => $level_id,
										'password'            => $this->bcrypt->hash_password("1234"),
										'insert_by'           => $this->session->userdata($this->config->item('user_id'))
	                    			);
	                }   
	                $saved = $this->mod_employee->import($fetchData);
	                if ($saved) {
	                	$callback = array(
			        				'status' => true,
			        				'message' => 'Import data successfuly.'
			        			);
	                } else {
	                	$callback = array(
			        				'status' => false,
			        				'message' => 'Import failed when insert to database.'
			        			);
	                }
	            } else {
	            	$callback = array(
			        				'status' => false,
			        				'message' => 'Please import correct file, did not match excel sheet column.'
			        			);
	            }
	            // echo json_encode($fetchData);
	    	}
		}
	   	echo json_encode($callback);              
	}

	/**
	 * [checkFileValidation description]
	 * @param  [type] $string [description]
	 * @return [type]         [description]
	 */
     function checkFileValidation($string) {
      $file_mimes = array('text/x-comma-separated-values', 
      	'text/comma-separated-values', 
      	'application/octet-stream', 
      	'application/vnd.ms-excel', 
      	'application/x-csv', 
      	'text/x-csv', 
      	'text/csv', 
      	'application/csv', 
      	'application/excel', 
      	'application/vnd.msexcel', 
      	'text/plain', 
      	'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
      );
      if(isset($_FILES['file']['name'])) {
			$arr_file = explode('.', $_FILES['file']['name']);
			$extension = end($arr_file);
            if(($extension == 'xlsx' || $extension == 'xls' || $extension == 'csv') && in_array($_FILES['file']['type'], $file_mimes)){
                return true;
            }else{
                $this->form_validation->set_message('checkFileValidation', 'Please choose correct file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('checkFileValidation', 'Please choose a file.');
            return false;
        }
    }

	/**
	 * [ajax_detail description]
	 * @return [type] [description]
	 */
	public function ajax_detail(){
		if ($this->authority->__is_super_admin() || $this->authority_crud->detail) {
			$temp = $this->mod_employee->get_detail($this->encrypt->decode($this->input->post('data')))->row();
			$data = array(
				'employee_id'         => $temp->employee_id,
				'employee_payroll_id' => $temp->employee_payroll_id,
				'department'          => $temp->department,
				'company'             => $temp->company,
				'area'                => $temp->area,
				'employee_name'       => $temp->employee_name,
				'head'                => $temp->head,
				'email'               => $temp->email,
				'join_date'           => date('d-m-Y', strtotime($temp->join_date)),
				'level'               => $temp->level,
				'status'              => ($temp->status) ? 'Active' : 'Resign',
				'resign_date'         => (!is_null($temp->resign_date)) ? date('d-m-Y', strtotime($temp->resign_date)): '-'
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

	/**
	 * [ajax_getemployee description]
	 * @return [type] [description]
	 */
	public function ajax_getemployee(){
		$data = $this->mod_employee->get_employeebyname($this->input->get('data'))->result();
		echo json_encode($data);
	}
}

/* End of file Chickin.php */
/* Location: ./application/controllers/Chickin.php */