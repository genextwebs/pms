<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TimeLogReport extends CI_Controller {

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
	
		$data['allProjectData'] = $this->common_model->getData('tbl_project_info');
		$this->load->view('common/header');
		$this->load->view('report/timelogreport',$data);
		$this->load->view('common/footer');
	}

	public function getBarchart(){
		if(!empty($_POST)){
			$sdate = $this->input->post('startdate');
			$edate = $this->input->post('enddate');
			$hour = $this->input->post('hours');
		/*		
			$this->session->set_userdata('start_date',$sdate);
			 $this->session->set_userdata('end_date',$edate);
			 $this->session->set_userdata('total_hour',$hour);*/
			/*
			$whereArr= array('timelogstartdate'=>$sdate,'timelogenddate'=>$edate,'totalhours'=>$hour);
		    $logArray['Timelogdata'] = $this->common_model->getData('tbl_timelog',$whereArr);*/

		    $logArray= array();
			
			$logArray['s_date'] = $sdate;
			$logArray['e_date'] = $edate;
			$logArray['total_hours'] = $hour;

			echo json_encode($logArray);exit;		

		}
    }



}