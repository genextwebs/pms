<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller 
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
		//echo $this->user_id;
		//echo $this->user_type;
		$whereArr = array('user_type'=>1,'is_deleted'=>0);
		$userclientData = $this->common_model->getData('tbl_user',$whereArr);
		$totalUser = count($userclientData);
		$totalClientData = array();
		for($i=0;$i<=$totalUser-1;$i++)
		{
			$whereArrC = array('user_id'=>$userclientData[$i]->id,'is_deleted'=>0);
			$clientData = $this->common_model->getData('tbl_clients',$whereArrC);
			if(!empty($clientData)){
				array_push($totalClientData,$clientData[0]);
			}
		}
		
		$data['totalClient'] = count($totalClientData);

		$whereArr = array('user_type'=>2,'is_deleted'=>0);
		$userempData = $this->common_model->getData('tbl_user',$whereArr);
		$totaluserEmp = count($userempData);
		$totalEmptData = array();
		for($i=0;$i<=$totaluserEmp-1;$i++)
		{
			$whereArrE = array('user_id'=>$userempData[$i]->id,'is_deleted'=>0);
			$empData = $this->common_model->getData('tbl_employee',$whereArrE);
			if(!empty($empData)){
			array_push($totalEmptData,$empData[0]);
			}
		}
		//print_r($empData);die;
		$data['totalEmployee'] = count($totalEmptData);

		//total projects
		$whereArr = array('is_deleted'=>0);
		$projectData = $this->common_model->getData('tbl_project_info',$whereArr);
		$data['totalproject'] = count($projectData);
		
		//print_r($empData);die;
		$data['totalEmployee'] = count($totalEmptData);

		$whereArrPT = array('status' != 3);
		$data['taskData'] = $this->common_model->getData('tbl_task',$whereArrPT);
		$data['totalTaskPending'] = count($data['taskData']);


		$whereArrCT = array('status'=>3);
		$data['taskData'] = $this->common_model->getData('tbl_task',$whereArrCT);

		$data['totalTaskComplete'] = count($data['taskData']);
		$whereArrTp = array('status'=>2);

		$data['ticketPending'] = $this->common_model->getData('tbl_ticket',$whereArrTp);
		$data['totalticketPending'] = count($data['ticketPending']);

		$whereArrTr = array('status'=>3);
		$data['ticketResolved'] = $this->common_model->getData('tbl_ticket',$whereArrTr);

		
		$data['ticketNew'] = $this->common_model->getData('tbl_ticket');

		$data['totalticketResolved'] = count($data['ticketResolved']);


		$data['getEarning'] = $this->common_model->getData('tbl_project_info');
		$temp = array();
		foreach($data['getEarning'] as $earning){
			$string = $earning->projectbudget;
			if(array_key_exists($earning->startdate,$temp)){
				$temp[$earning->startdate]['totalEarning']=$string+$temp[$earning->startdate]['totalEarning'];
			}else{
				$temp[$earning->startdate]['totalEarning']=$string;
			}
		}
		$data['finalTempArr']=	$temp;
		$this->load->view('common/header');
		$this->load->view('dashboard/dashboard',$data);
		$this->load->view('common/footer');
	}
	
}