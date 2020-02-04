<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmpDashboard extends CI_Controller 
{
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model');
		$this->login = $this->session->userdata('login');
		$this->user_id = $this->login->id;
		$this->user_type = $this->login->user_type;

		func_check_login();
	}
	public function index(){
		if($this->user_type == 2) {
			$whereArr= array('user_id'=>$this->user_id);
			$data['empData']=$this->common_model->getData('tbl_employee',$whereArr);	
		
			$empid=$data['empData']['0']->id;

			$WhereArr1=array('emp_id'=>$empid);
			$data['projectData']=$this->common_model->getData('tbl_project_member',$WhereArr1);
			//print_r($data['projectData']);	
			$data['totalProject']=count($data['projectData']);
			$project = array();
			for($i=0;$i<=count($data['projectData'])-1;$i++){
				$whereArr3 = array('id'=>$data['projectData'][$i]->project_id);
				$project1 =$this->common_model->getData('tbl_project_info',$whereArr3);
				array_push($project,$project1[0]);
			}
			$data['projectDetail'] = $project;
		}
		elseif($this->user_type == 0) {
			$data='';
		}
		$this->load->view('common/header');
		$this->load->view('empdashboard/edashboard',$data);
		$this->load->view('common/footer');
	}
	
}