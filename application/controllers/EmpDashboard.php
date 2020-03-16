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
			$whereArr= array('user_id'=>$this->user_id,'is_deleted'=>0);
			$data['empData']=$this->common_model->getData('tbl_employee',$whereArr);
			if(!empty($data['empData'])){
				$empid=$data['empData']['0']->id;
				$WhereArr1=array('emp_id'=>$empid);
				$data['projectData']=$this->common_model->getData('tbl_project_member',$WhereArr1);
				$data['totalProject']=count($data['projectData']);

				$project = array();
				for($i=0; $i<=count($data['projectData'])-1;$i++){
					if(!empty($whereArr3)){
						$whereArr3 = array('id'=>$data['projectData'][$i]->project_id);
						$project1 =$this->common_model->getData('tbl_project_info',$whereArr3);
						array_push($project,$project1[0]);
					}
				}
				
			}
			$whereArrUser = array('user_id'=>$this->user_id);
			$userData = $this->common_model->getData('tbl_employee',$whereArrUser);

			$whereArrPT = array('status!='=>3,'assignedto'=>$userData[0]->id);
			$data['taskData1'] = $this->common_model->getData('tbl_task',$whereArrPT);
			$data['totalTaskPending'] = count($data['taskData1']);

			$whereArrCT = array('status'=>3,'assignedto'=>$userData[0]->id);
			$data['taskData'] = $this->common_model->getData('tbl_task',$whereArrCT);
			$data['totalTaskComplete'] = count($data['taskData']);

		}
		/*elseif($this->user_type == 0) {
			$data='';
		}*/
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
		$data['ticketNew'] = $this->common_model->getData('tbl_ticket');
		$this->load->view('common/header');
		$this->load->view('empdashboard/edashboard',$data);
		$this->load->view('common/footer');
	}
	
}