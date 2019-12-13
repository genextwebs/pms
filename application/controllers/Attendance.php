<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Attendance extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('common_model');
		ini_set('display_errors',1);
		error_reporting(E_ALL);
		if(!$this->session->userdata('year_data')){          
			$this->year =date('Y');
			$this->department = $this->session->userdata('department_data');
            $this->employee = $this->session->userdata('employee_data');
		}
		else{
            $this->year = $this->session->userdata('year_data');
            $this->department = $this->session->userdata('department_data');
            $this->employee = $this->session->userdata('employee_data');
		}
		if(!$this->session->userdata('month_data')){
          	$this->month =date('m');
          	$this->department = $this->session->userdata('department_data');
            $this->employee = $this->session->userdata('employee_data');
		}
		else{
            $this->month = $this->session->userdata('month_data');
            $this->department = $this->session->userdata('department_data');
            $this->employee = $this->session->userdata('employee_data');
		}
      
		func_check_login();
	}
	
	public function index(){
		$data['selMonth'] =  $this->month;
		$data['selYear'] =  $this->year;
		$data['selDepartment'] =  $this->department;
		$data['selEmployee'] =  $this->employee;
		$data['employee'] =$this->common_model->getData('tbl_employee');
		if(!empty($data['selDepartment'])){
			$checkdept=$data['selDepartment'];
			//echo $checkdept;die;
			$whereArr=array('department'=>$checkdept);
			$data['selEmployeeArr'] =$this->common_model->getData('tbl_employee',$whereArr);
			//print_r($data['selEmployeeArr'] );die;

		}
		elseif(!empty($data['selEmployee'])){
			$checkempid=$data['selEmployee'];
			$whereArr=array('id'=>$checkempid);
			$data['selEmployeeArr'] =$this->common_model->getData('tbl_employee',$whereArr);
		}
		else{
			$data['selEmployeeArr'] =$this->common_model->getData('tbl_employee');
		}
		$data['department'] =$this->common_model->getData('tbl_department');

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
			$year = $_POST['year'];
			$department = $_POST['department'];
			$employee = $_POST['employee'];
			if($department != 'all'){
				$this->session->set_userdata('department_data',$department);
			}
			else{
				$this->session->set_userdata('department_data', '');
			}
			if($employee != 'all'){
				$this->session->set_userdata('employee_data',$employee);
			}
			else{
				$this->session->set_userdata('employee_data', '');
			}

			//echo $month;die;
			$this->session->set_userdata('month_data',$month);
			$this->session->set_userdata('year_data',$year);
			
		}
	}
}