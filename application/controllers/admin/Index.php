<?php
require_once APPPATH . '/core/Base_Controller.php';

class Index extends Base_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('admin_model');		
		$this->load->model('position_model');		
		$this->load->model('building_model');
	}
	
	public function index() {
		$admin = $this->session->userdata('admin');
		if ($admin == null) {
			redirect(base_url('login'));
		}
		$data = array();
		$data['parent_id'] = 1;
		$data['sub_id'] = 10;
		$data['content'] = $this->load->view('admin/dashboard', array(), true);
		$this->load->view('admin_main_layout', $data);
	}
	
	public function login() {
		$admin = $this->session->userdata('admin');
		if ($admin != null) {
			redirect(base_url('dashboard'));
		}

		$cmd = $this->input->post("cmd");
		if ($cmd != '') {
			$email = $this->input->post("email");
			$password = $this->input->post("password");
			$account = $this->admin_model->checkAccount($email, $password);
			if ($account != null) {
				$this->session->set_userdata('admin', array('email'=>$account['email'], 'group_id'=>$account['group_id']));
				$this->redirect('dashboard');
			} else {
				$this->load->view('admin/login', array('error'=>'Sai thông tin đăng nhập'));
			}
		} else {
			$this->load->view('admin/login');
		}
	}
	
	public function logout() {
		$this->session->unset_userdata('admin');
		$this->session->unset_userdata('lockdata');
		redirect(base_url('login'));
	}

	public function register() {
		$data['positions'] = $this->position_model->getAll();
		$cmd = $this->input->post("cmd");
		if ($cmd != '') {
			$params['full_name'] = $this->input->post('name');
			$params['email'] = $this->input->post('email');
			$params['password'] = md5($this->input->post('password')); 
			$params['position_id'] = $this->input->post('position_id');
			$this->load->model('file_model');
			$image = isset($_FILES['image']) ? $_FILES['image'] : null;
			if ($image != null && $image['error'] == 0) {
				$path = $this->file_model->createFileName($image, 'media/avatar/', 'avatar');
				$this->file_model->saveFile($image, $path);
				$params['avatar'] = $path;
			}
			$params['group_id'] = $this->admin_model->getGroupByPosition($params['position_id']);
			if($params['group_id'] == 1) {
				$params['status'] = 1;
			}else {
				$params['status'] = 0;
			}
			$params['created'] = time();

			$account = $this->admin_model->checkAccountRegister($params['email'], $params['password']);
			if ($account != null) {
				$this->session->set_flashdata('error', 'Account already exists.'); 
				redirect('register');
			}else {
				$this->admin_model->register($params);
				$this->load->view('admin/login', array('success' => 'Register successful.'));
			}
		} 
		$this->load->view('admin/register', $data);
		
	}

	public function getManagersList() {
		$managers = $this->admin_model->getManagers();
		$managerOthers = $this->admin_model->getManagerOthers();
		$buildings = $this->building_model->getAll();
		$cmd = $this->input->post('cmd');
		if($cmd != '') {
			$params['admin_id'] = $this->input->post('manager_id');
			$params['building_id'] = $this->input->post('building_id');
			$checkAssigned = $this->admin_model->checkAssigned($params['admin_id']);
			if ($checkAssigned == null) {
				$this->admin_model->assignManager($params);
				$param['assigned'] = 1;
				$this->admin_model->updateAssigned($params['admin_id'], $param);
				redirect('manager');
			}else {
				$this->session->set_flashdata('error', 'ERROR. Manager already assigns.');
				redirect('manager');
			}
		}
		$layoutParams = array(
			'managers' => $managers,
			'managerOthers' => $managerOthers,
			'buildings' => $buildings
		);
		$content = $this->load->view('admin/manager_list', $layoutParams, true);

		$data = array();
		$data['customCss'] = array('assets/css/settings.css');
		$data['customJs'] = array('assets/js/settings.js', 'assets/app/search.js');
		$data['parent_id'] = 4;
		$data['sub_id'] = 10;
		$data['content'] = $content;
		$this->load->view('admin_main_layout', $data);
	}

}