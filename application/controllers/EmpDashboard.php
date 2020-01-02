<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmpDashboard extends CI_Controller 
{
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model');
		$this->login = $this->session->userdata('login');
		$this->user_id = $this->login->id;
		func_check_login();
	}
	
	public function index(){
		$whereArr= array('user_id'=>$this->user_id);
		$data['empData']=$this->common_model->getData('tbl_employee',$whereArr);	
		$empid=$data['empData']['0']->id;
		$WhereArr1=array('emp_id'=>$empid);
		$data['projectData']=$this->common_model->getData('tbl_project_member',$WhereArr1);	
		$data['totalProject']=count($data['projectData']);
		$this->load->view('common/header');
		$this->load->view('empdashboard/edashboard',$data);
		$this->load->view('common/footer');
	}
	
}