<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Attendance extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('common_model');
		ini_set('display_errors',1);
		error_reporting(E_ALL);
		
		func_check_login();
	}
	public function index(){

		$data['employee'] =$this->common_model->getData('tbl_employee');
		//$data['countemp']=count($data['employee']); tbl_department
		$data['department'] =$this->common_model->getData('tbl_department');
		$data['attendance'] =$this->common_model->getData(' tbl_attendance');
		  		
		//print_r($data);die;
		$this->load->view('common/header');
		$this->load->view('Attendance/attendance',$data);
		$this->load->view('common/footer');
	}

	public function addattendance(){

		$data['employee'] =$this->common_model->getData('tbl_employee');
		$data['countemp']=count($data['employee']);
		$this->load->view('common/header');
		$this->load->view('Attendance/addattendance',$data);
		$this->load->view('common/footer');
	}
	public function insertattendance(){

		if(!empty($_POST)){
			$attendancedate = $_POST['attendancedate'];
			$employee = $_POST['employee'];
			$attendance = $_POST['attendance'];
			
			$insertArr=array('attendancedate'=>$attendancedate,'employee'=> $employee,'attendance'=>$attendance);
			$this->common_model->insertData('tbl_attendance',$insertArr);
			//$this->session->set_flashdata('message_name', "Data Updated Succeessfully");

		}
	}

	public function getfilterdata(){
		//echo "ggf";die;
		if(!empty($_POST)){
			$month = $_POST['month'];
			$this->session->set_userdata('month_data',$month);
		}
	}
       
}