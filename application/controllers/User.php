<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {

	/**
	 * [$module description]
	 * @var string
	 */
	public $module = 'user';

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
	public function __construct()
	{
		parent::__construct();
		// Do your magic here
		$this->auth->restrict();
		$this->authority->__restrict_user();
		$this->load->library('encryption');
		$this->load->model('mod_barang');
	}

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index()
	{
		$this->module       = $this->module;
		$this->title        = 'List Barang';
		$this->module_title = 'List Barang';
		$this->breadcrumb   = 'List Barang';
		$this->table_title  = 'List Barang';
		$this->content      = $this->module;
		$this->in_js        = false;
		$this->ex_js        = true;
		$this->js_sources   = array('init.js', 'add.js', 'edit.js', 'delete.js');
		$this->form_sources = array('a_form', 'e_form');
		$this->info         = 'Form untuk input data barang. Mohon pastikan data telah benar sebelum disimpan'; //set null if not display info to user
        $data['data'] = '';
        $this->load->view('template/template',$data);
	}
	/**
	 * [ajax_list description]
	 * @return [type] [description]
	 */
	public function ajax_list(){
		$datas = $this->mod_barang->get_datatables();
		$list = array();
		$no = $_POST['start'];
		foreach ($datas as $data) {
			$no++;
			$row = array();
			$row[] = "<img src=".$data->fotoBarang." width='70' height='40'>";
			$row[] = $data->namaBarang;
			$row[] = "<div style='text-align:right'>" .number_format($data->hargaBeli,0,",",".")."</div>";
			$row[] = "<div style='text-align:right'>" .number_format($data->hargaJual,0,",",".")."</div>";
			$row[] = "<div style='text-align:right'>" .number_format($data->stok)."</div>";
			$row[] = '<a href="javascript:void(0)" class="btn btn-success m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" title="Edit" onclick="edit_(\''.$this->encryption->encrypt($data->id).'\')"><i class="la la-edit"></i></a>
			<a href="javascript:void(0)" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" title="Delete" onclick="delete_(\''.$this->encryption->encrypt($data->id).'\')"><i class="la la-trash"></i></a>';
			$list[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->mod_barang->count_all(),
						"recordsFiltered" => $this->mod_barang->count_filtered(),
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
		if ($this->authority->__is_super_admin()) {
			$config = array(
				array(
					'field' => 'namaBarang',
					'label' => 'namaBarang',
					'rules' => 'required|trim'
				),
				array(
					'field' => 'hargaBeli',
					'label' => 'hargaBeli',
					'rules' => 'required|trim'
				),
				array(
					'field' => 'hargaJual',
					'label' => 'hargaJual',
					'rules' => 'required|trim'
				),
				array(
					'field' => 'stok',
					'label' => 'stok',
					'rules' => 'required|trim'
				)
			);
			$this->form_validation->set_rules($config);

			$id = $this->encryption->decrypt(str_replace(" ", "+", $this->input->post('id')));
			$folder = './uploads/user/'.md5($id).'/';
			if(!is_dir($folder))
			{
			   mkdir($folder,0777,true);
			}
	        $config['upload_path']          = $folder;
	        $config['file_name'] 			= md5(date("d-m-Y h:i:s"));
	        $config['allowed_types']        = 'jpg|png|jpeg';
	        $config['overwrite']       		= true;
	        $config['max_size']             = 2048;

	        $this->upload->initialize($config);
			if ($this->form_validation->run() == FALSE) {
				$callback = array(
					'status' => false,
					'message' => validation_errors()
				);
			} elseif (!$this->upload->do_upload('fotoBarang')){
				$data_user = array(
					'namaBarang'   => $this->input->post('namaBarang'),
					'hargaBeli'    => $this->input->post('hargaBeli'),
					'hargaJual'    => $this->input->post('hargaJual'),
					'stok'         => $this->input->post('stok'),
					'insert_by'    => $this->session->userdata($this->config->item('user_id'))
				);
				$insert = $this->mod_barang->save_user($data_user);
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
			} else {
				$this->upload->do_upload('fotoBarang');
	        	$init = $this->upload->data();
				$data_user = array(
					'fotoBarang'   => $folder.$init['file_name'],
					'namaBarang'   => $this->input->post('namaBarang'),
					'hargaBeli'    => $this->input->post('hargaBeli'),
					'hargaJual'    => $this->input->post('hargaJual'),
					'stok'         => $this->input->post('stok'),
					'insert_by'    => $this->session->userdata($this->config->item('user_id'))
				);
				$insert = $this->mod_barang->save_user($data_user);
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
		if ($this->authority->__is_super_admin()) {
			$data = $this->mod_barang->get_by_id($this->encryption->decrypt($this->input->post('data')))->row();		
			echo json_encode($data);
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
		if ($this->authority->__is_super_admin()) {
			$config = array(
				array(
					'field' => 'e_namaBarang',
					'label' => 'namaBarang',
					'rules' => 'required|trim'
				),
				array(
					'field' => 'e_hargaBeli',
					'label' => 'hargaBeli',
					'rules' => 'required|trim'
				),
				array(
					'field' => 'e_hargaJual',
					'label' => 'hargaJual',
					'rules' => 'required|trim'
				),
				array(
					'field' => 'e_stok',
					'label' => 'stok',
					'rules' => 'required|trim'
				)
			);
			$this->form_validation->set_rules($config);

			$id = $this->encryption->decrypt(str_replace(" ", "+", $this->input->post('id')));
			$folder = './uploads/user/'.md5($id).'/';
			if(!is_dir($folder))
			{
			   mkdir($folder,0777,true);
			}
	        $config['upload_path']          = $folder;
	        $config['file_name'] 			= md5(date("d-m-Y h:i:s"));
	        $config['allowed_types']        = 'jpg|png|jpeg';
	        $config['overwrite']       		= true;
	        $config['max_size']             = 2048;

	        $this->upload->initialize($config);
			if ($this->form_validation->run() == FALSE) {
				$callback = array(
					'status' => false,
					'message' => validation_errors()
				);
			} elseif (!$this->upload->do_upload('e_fotoBarang')){
				
				$data_user['namaBarang']        = $this->input->post('e_namaBarang');
				$data_user['hargaBeli']      	= $this->input->post('e_hargaBeli');
				$data_user['hargaJual'] 		= $this->input->post('e_hargaJual');
				$data_user['stok']          	= $this->input->post('e_stok');
				$data_user['modify_date']       = date('Y-m-d H:i:s');
				$data_user['modify_by']         = $this->session->userdata($this->config->item('user_id'));
				$update = $this->mod_barang->update_user($data_user, $this->encryption->decrypt($this->input->post('e_id')));
				if ($update) {
					$callback = array(
						'status' => true,
						'message' => 'Data berhasil di-edit'
					);
				} else {
					$callback = array(
						'status' => false,
						'message' => 'Gagal edit data'
					);
				}
			} else {
				$this->upload->do_upload('e_fotoBarang');
	        	$init = $this->upload->data();
				$data_user['namaBarang']        = $this->input->post('e_namaBarang');
				$data_user['hargaBeli']      	= $this->input->post('e_hargaBeli');
				$data_user['hargaJual'] 		= $this->input->post('e_hargaJual');
				$data_user['stok']          	= $this->input->post('e_stok');
				$data_user['fotoBarang']        = $folder.$init['file_name'];
				$data_user['modify_date']       = date('Y-m-d H:i:s');
				$data_user['modify_by']         = $this->session->userdata($this->config->item('user_id'));
				$update = $this->mod_barang->update_user($data_user, $this->encryption->decrypt($this->input->post('e_id')));
				if ($update) {
					$callback = array(
						'status' => true,
						'message' => 'Data berhasil di-edit'
					);
				} else {
					$callback = array(
						'status' => false,
						'message' => 'Gagal edit data'
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
		if ($this->authority->__is_super_admin() || $this->authority_crud->update) {	
			$delete = $this->mod_barang->delete_by_id($this->encryption->decrypt($this->input->post('data')));
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

	public function ajax_checknameadd(){
		$is_username = $this->mod_barang->checknameadd($this->input->post('namaBarang'));
		echo json_encode($is_username);
	}

	public function ajax_checknameedit(){
		$is_username = $this->mod_barang->checknameedit($this->encryption->decrypt($this->input->post('e_id')), $this->input->post('e_namaBarang'));
		echo json_encode($is_username);
	}

}