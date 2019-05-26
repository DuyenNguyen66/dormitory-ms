<?php
require_once APPPATH . '/core/Base_Controller.php';

class Index extends Base_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('admin_model');		
		$this->load->model('position_model');		
		$this->load->model('building_model');
		$this->load->model('term_model');
	}
	
//admin controller
	public function index() {
		$admin = $this->session->userdata('admin');
		if ($admin == null) {
			redirect(base_url('login'));
		}
		$this->getTerm();
		$params = array(

		);
		$content = $this->load->view('admin/dashboard', $params, true);

		$data = array();
		$data['customCss'] = array('assets/css/settings.css', 'assets/css/fullcalendar.css', 'assets/css/fullcalendar.print.css');
		$data['customJs'] = array('assets/js/jquery-ui.custom.min.js', 'assets/js/fullcalendar.js', 'assets/js/student.js');
		$data['parent_id'] = 1;
		$data['sub_id'] = 0;
		$data['group'] = 1;
		$data['content'] = $content;
		$this->load->view('admin_main_layout', $data);
	}

	public function getTerm() {
		$currentDate = date('d/n/Y');
		$arr = explode('/', $currentDate);
		$date = $arr[0];
		$month = $arr[1];
		$year = $arr[2]; 
		if($date == 1 && ($month == 2 || $month == 9)) {
			if($month >= 9 && $month <= 12 || $month == 1)
			{
				$term = implode('', array($arr[2], 1));
			}else
			{
				$term = implode('', array($arr[2] - 1 , 2));
			}
			$check = $this->term_model->checkTerm($term);
			if($check == null)
			{
				$params['name'] = $term;
				$this->term_model->add($params);
			}
		}
	}
	
	public function login() {
		$admin = $this->session->userdata('admin');
		if ($admin != null) {
			redirect(base_url('dashboard-a'));
		}

		$cmd = $this->input->post("cmd");
		if ($cmd != '') {
			$email = $this->input->post("email");
			$password = md5($this->input->post("password"));
			$account = $this->admin_model->checkAccount($email, $password);
			if ($account != null) {
				if($account['position_id'] == 1 || $account['position_id'] == 2) { //admin 
					$this->session->set_userdata('admin', array('email'=>$account['email'], 'group_id'=>$account['group_id']));
					$this->redirect('dashboard-a');
				} else if ($account['position_id'] == 3 || $account['position_id'] == 4) { //manager
					$this->session->set_userdata('admin', array('email'=>$account['email'], 'group_id'=>$account['group_id']));
					redirect('dashboard-m');
				} else { //technical
					$this->session->set_userdata('admin', array('email'=>$account['email'], 'group_id'=>$account['group_id']));
					$this->redirect('dashboard-m');
				}
			} else {
				$this->load->view('admin/login', array('error'=>'Account does not exist.'));
			}
		} else {
			$this->load->view('admin/login');
		}
	}
	
	public function logout() {
		$this->session->unset_userdata('admin');
		redirect(base_url('login'));
	}

	public function register() {
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
				$this->session->set_flashdata('success', 'Register successful.');
				redirect('login');
			}
		} 
		$this->load->view('admin/register');
		
	}

	public function getManagersList() {
		$managers = $this->admin_model->getManagers();
		$managerOthers = $this->admin_model->getManagerOthers();
		$buildings = $this->building_model->getAll();
		$positions = $this->admin_model->getPosition();
		$cmd = $this->input->post('cmd');
		if($cmd != '') {
			$params['admin_id'] = $this->input->post('manager_id');
			$params['building_id'] = $this->input->post('building_id');
			$checkAssigned = $this->admin_model->checkAssigned($params['admin_id']);
			if ($checkAssigned == null) {
				$this->admin_model->assignManager($params);
				$position_id = $this->input->post('position_id');
				$dataUpdate = array(
					'position_id' => $position_id,
					'assigned' => 1
				);
				$this->admin_model->updateAssigned($params['admin_id'], $dataUpdate);
				redirect('manager');
			}else {
				$this->session->set_flashdata('error', 'ERROR. Manager already assigns.');
				redirect('manager');
			}
		}
		$layoutParams = array(
			'managers' => $managers,
			'managerOthers' => $managerOthers,
			'buildings' => $buildings,
			'positions' => $positions
		);
		$content = $this->load->view('admin/manager_list', $layoutParams, true);

		$data = array();
		$data['customCss'] = array('assets/css/settings.css');
		$data['customJs'] = array('assets/js/settings.js', 'assets/app/search.js');
		$data['parent_id'] = 4;
		$data['sub_id'] = 0;
		$data['group'] = 1;
		$data['content'] = $content;
		$this->load->view('admin_main_layout', $data);
	}

	public function edit($admin_id) {
		$admin = $this->admin_model->getInfo($admin_id);
		$buildings = $this->building_model->getAll();
		$positions = $this->admin_model->getPosition();
		$cmd = $this->input->post('cmd');
		if($cmd != null) {
			$admin_id = $this->input->post('manager_id');
			$param1['position_id'] = $this->input->post('position_id');
			$this->admin_model->updateAssigned($admin_id, $param1);
			$param2['building_id'] = $this->input->post('building_id');
			$this->admin_model->updateBuild($admin_id, $param2);
			redirect('manager');
		}		
		$layoutParams = array(
			'admin' => $admin,
			'buildings' => $buildings,
			'positions' => $positions
		);
		$content = $this->load->view('admin/manager_edit', $layoutParams, true);

		$data = array();
		$data['customCss'] = array('assets/css/settings.css');
		$data['customJs'] = array('assets/js/settings.js', 'assets/app/search.js');
		$data['parent_id'] = 4;
		$data['sub_id'] = 0;
		$data['group'] = 1;
		$data['content'] = $content;
		$this->load->view('admin_main_layout', $data);
	}

	public function enable($admin_id) {
		$params = array(
			'status' => 1
		);
		$this->admin_model->enableManager($admin_id, $params);
		redirect('manager');
	}

	public function disable($admin_id) {
		$params = array(
			'status' => 0
		);
		$this->admin_model->disableManager($admin_id, $params);
		redirect('manager');
	}

	public function delete($admin_id) {
		$this->admin_model->deleteManager($admin_id);
		redirect('manager');
	}


//managers controller
	public function indexManager() {
		$admin = $this->session->userdata('admin');
		if ($admin == null) {
			redirect(base_url('login'));
		}
		$this->getTerm();
		$data = array();
		$data['parent_id'] = 7;
		$data['sub_id'] = 0;
		$data['group'] = 2;
		$data['content'] = $this->load->view('admin/dashboard_manager', array(), true);
		$this->load->view('admin_main_layout', $data);
	}


}