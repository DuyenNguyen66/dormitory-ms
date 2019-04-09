<?php

class Classes extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('class_model');
		$this->load->model('course_model');
		$this->load->model('major_model');
	}

	public function index() {
		$courses = $this->course_model->getAll();
		$majors = $this->major_model->getAll();
		$cmd = $this->input->post('cmd');
		if($cmd != null)
		{
			$params['major_id'] = $this->input->post('major_id');
			$params['course_id'] = $this->input->post('course_id');
			$params['name'] = $this->input->post('name');
			$this->class_model->add($params);
			redirect('classes');
		}
		$layoutParams = array(
			'courses' => $courses,
			'majors' => $majors
		);
		$content = $this->load->view('admin/class_list', $layoutParams, true);

		$data = array();
		$data['customCss'] = array('assets/css/settings.css');
		$data['customJs'] = array('assets/js/settings.js', 'assets/app/search.js');
		$data['parent_id'] = 3;
		$data['sub_id'] = 33;
		$data['content'] = $content;
		$this->load->view('admin_main_layout', $data);
	}

	public function getClass() {
		$major_id = $this->input->post('major_id');
		$course_id = $this->input->post('course_id');
		if($major_id == 0 && $course_id == 0) {
			$classes = $this->class_model->getAll();
		}else if ($major_id != 0 && $course_id == 0) {
			$classes = $this->class_model->getClassByMajor($major_id);
		}else if($major_id == 0 && $course_id != 0) {
			$classes = $this->class_model->getClassByCourse($course_id);
		}else {
			$classes = $this->class_model->getClassBy($major_id, $course_id);
		}
		$params = array(
			'classes' => $classes
		);
		echo $this->load->view('admin/class_table', $params, true);
	}

}