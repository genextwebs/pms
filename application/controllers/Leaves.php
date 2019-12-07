<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leaves extends CI_Controller {

	public function __construct(){
		parent::__construct();
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$this->load->model('common_model');
		func_check_login();
	}

	public function index(){
		$this->load->view('common/header');
		$this->load->view('leaves/leaves');
		$this->load->view('common/footer');
	}

	public function addleaves(){
		$data['leavecategory']=$this->common_model->getData('tbl_leavetype');
		$data['employee']=$this->common_model->getData('tbl_employee');

		$this->load->view('common/header');
		$this->load->view('leaves/addleaves',$data);
		$this->load->view('common/footer');
	}

	public function insertleaves(){

		if(!empty($_POST))
		{	
			$mem = $this->input->post('choose_mem');
	
			$type  = $this->input->post('leave_type');
			$radio = $this->input->post('duration_radio');
			$date = $this->input->post('date');
			$abs  = $this->input->post('absence');
				//echo($date);die;
			$status = $this->input->post('status');
			$whereArr = array('empid'=>$mem,'leavetypeid'=>$type,'duration'=>$radio,'date'=>$date,'reasonforabsence'=>$abs,'status'=>$status);
		echo'<pre>';
		print_r($whereArr);die;
			$this->common_model->insertData('tbl_leaves',$whereArr);
			echo $this->db->last_query();die;
			//print_r($hh);die;
		}
}
	public function checkleave(){
		$status = 0;
		if(!empty($_POST['leavecategory'])){
			$where = array('name'=>$_POST['leavecategory']);
			$checkData = $this->common_model->getData('tbl_leavetype',$where);
			if(!empty($checkData)){
				$status = 1;
			}
		}
		echo $status;exit();
	}

	public function insertleavestype(){
		alert('dfs');
		if(!empty($_POST)){
			$name = $this->input->post('leavename');
			$insArr = array('name'=>$name);
			$lastinsertid=$this->common_model->insertData('tbl_leavetype',$insArr);
			$leaArray = $this->common_model->getData('tbl_leavetype');
			$str = '';
			foreach($leaArray as $row){
				$str.='<option value="'.$row->id.'">'.$row->name.'</option>'; 
			}
			$totaldata = count($leaArray);
			$leaArr = array();
			$leaArr['count'] = $totaldata;
			$leaArr['catdata'] = $str;
			$leaArr['lastinsertid']= $lastinsertid;
			//print_r($catArr);die;
			echo json_encode($leaArr);exit; 
		}
	}


		public function deleteleave(){
		$status = 0;
		if(!empty($_POST['id'])){
			$id=$this->input->post('id');
			$deleteArr=array('id'=>$id);
			$this->common_model->deleteData('tbl_project_category',$deleteArr);
			$status = 1;
		}
		echo $status;exit();
	}	

}
