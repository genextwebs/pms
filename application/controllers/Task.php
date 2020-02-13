<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

	public function __construct(){
		parent::__construct();
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$this->load->model('common_model');
		$this->login = $this->session->userdata('login');
		$this->user_type = $this->login->user_type;
		$this->user_id = $this->login->id;	
		func_check_login();
	}

	public function index(){	
		$data['employee'] = $this->common_model->getData('tbl_employee	'); 
		$data['project'] = $this->common_model->getData('tbl_project_info');
		$data['taskCat'] = $this->common_model->getData('tbl_task_category');
		$data['clientData'] = $this->common_model->getData('tbl_clients');
		$this->load->view('common/header');
		$this->load->view('task/task',$data);
		$this->load->view('common/footer');
	}

	public function addTask(){
		$data['employee'] = $this->common_model->getData('tbl_employee	'); 
		$data['project'] = $this->common_model->getData('tbl_project_info');
		$data['taskCat'] = $this->common_model->getData('tbl_task_category');
		$this->load->view('common/header');
		$this->load->view('task/addtask',$data);
		$this->load->view('common/footer');
	}

	public function edittask(){
		$id = base64_decode($this->uri->segment(3));
		$where = array('id' => $id);
		$data['employee'] = $this->common_model->getData('tbl_employee'); 
		$data['project'] = $this->common_model->getData('tbl_project_info');
		$data['taskCat'] = $this->common_model->getData('tbl_task_category');
		$data['taskData'] = $this->common_model->getData('tbl_task',$where);
		$this->load->view('common/header');
		$this->load->view('task/edittask',$data);
		$this->load->view('common/footer');
		if($this->user_type == 0){
			if(!empty($_POST)){
				$title = $this->input->post('title_task');
				$projectid = $this->input->post('projectid');
				$description = $this->input->post('editor1');
				//echo $description;die;
				$startdate = $this->input->post('startdate');
				$duedate = $this->input->post('due_date');
				$assignemp = $this->input->post('assignemp');
				$taskcategory = $this->input->post('task-category');
				$priority = $this->input->post('radio-stacked');
				$status = $this->input->post('status');
				$updateArr = array('projectid' => $projectid, 'title' => $title , 'description' => $description , 'startdate' => $startdate , 'duedate' => $duedate , 'assignedto' => $assignemp , 'taskcategory' => $taskcategory , 'status' => $status, 'priority' => $priority);
				$this->common_model->updateData('tbl_task',$updateArr,$where);
				$this->session->set_flashdata('message_name', 'Task Updated sucessfully');
				redirect('task');
			}
		}else if($this->user_type == 2) {
			if(!empty($_POST)){
				
				$status = $this->input->post('status');
				$updateArr = array('status' => $status);
				$this->common_model->updateData('tbl_task',$updateArr,$where);
				$this->session->set_flashdata('message_name', 'Task Updated sucessfully');
				redirect('task');
			}
		}
	}
}