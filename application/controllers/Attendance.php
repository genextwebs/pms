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

	public function getdatayuy(){
		//echo "ghtgb";die;
			$year = $_POST['year'];
			$month = $_POST['month'];
			echo $year;
			echo $month;die;
			$query="SELECT * FROM tbl_attendance WHERE DATE_FORMAT(attendancedate,'%Y-%m') = '2019-12'";

			$attendance= $this->common_model->coreQueryObject($query);

			for($i=1;$i<=31;$i++){
           		 $date = date('Y-m-d', strtotime('2019'.'-12-'.$i));
           		 foreach($attendance as $row)
           		 {
           		 	$checkattendancedate=$row->attendancedate;
           		 	$checkattendance=$row->attendance;
           		 	if($checkattendancedate = $date)
           		 	{
           		 		if($checkattendance == '1')
           		 		{$str= "p";}
           		 		else if($checkattendance == '0')
           		 		{$str= "a";}
           		 		else 
           		 		{$str= "l";}
						echo json_encode($str);exit();

           		 	}

           		 }
        	}


			
	}
}