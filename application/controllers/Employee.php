<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller 
{
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model');
	}
	
	public function index(){
		$this->load->view('common/header');
		$this->load->view('employees/employees');
		$this->load->view('common/footer');
	}

	public function addemployee(){
		$this->load->view('common/header');
		$data['designation'] = $this->common_model->getData('tbl_designation');
		$data['department'] = $this->common_model->getData('tbl_department');
		$this->load->view('employees/addemployee',$data);
		$this->load->view('common/footer');
	}

	public function insertemployee(){
		if(!empty($_POST)){
			$employee_name = $this->input->post('employee_name');
			$employee_email = $this->input->post('employee_email');
			$password = $this->input->post('password');
			$grp = $this->input->post('generate-random-pass');
			$mobile = $this->input->post('mobile');
			$username = $this->input->post('username');
			$joiningdate = $this->input->post('joining-date');
			$lastdate = $this->input->post('last-date');
			$gender = $this->input->post('gender');
			$address = $this->input->post('address');
			$skills = $this->input->post('skills');
			$jobtitle = $this->input->post('job-title');
			$hourlyrate = $this->input->post('hourly-rate');
			$login = $this->input->post('login');
			$profilepicture = $this->input->post('imagename');
			$insArr=array('employeename'=>$employee_name,'employeeemail'=>$employee_email,'password'=>$password,'genereterandompassword'=>$grp,'mobile'=>$mobile,'slackusername'=>$username,'joingdate'=>$joiningdate,'lastdate'=>$lastdate,'gender'=>$gender,'address'=>$address,'skills'=>$skills,'jobtitle'=>$jobtitle,'hourlyrate'=>$hourlyrate,'status'=>'0','login'=>$login,'profilepicture'=>$profilepicture);
			echo "<PRE>";print_r($insArr);die;
			$this->common_model->insertData('tbl_employee',$insArr);
		}			
	}

	public function insert_designation(){
		if(!empty($_POST)){
			$name = $this->input->post('name');
			$insArr = array('name'=>$name);
			$this->common_model->insertData('tbl_designation',$insArr);
			$designationArray = $this->common_model->getData('tbl_designation');
			$str = '';
			foreach($designationArray as $row){
				$str.='<option value="'.$row->id.'">'.$row->name.'</option>'; 
			}
			$txtArr = array();
			$txtArr['taxdata'] = $str;
			echo  json_encode($txtArr);exit; 
		}
	}

	public function insert_department(){
		if(!empty($_POST)){
			$name = $this->input->post('name');
			$insArr = array('name'=>$name);
			$this->common_model->insertData('tbl_department',$insArr);
			$designationArray = $this->common_model->getData('tbl_department');
			$str = '';
			foreach($designationArray as $row){
				$str.='<option value="'.$row->id.'">'.$row->name.'</option>'; 
			}
			$txtArr = array();
			$txtArr['taxdata'] = $str;
			echo  json_encode($txtArr);exit; 
		}
	}

// image upload through ajax
	public function do_upload()
	{
		if(!empty($_FILES))
		{
			$config['upload_path']= './uploads/';
			$config['allowed_types']='gif|jpg|png';
			$config['encrypt_name'] = TRUE;
			 
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
				if(!$this->upload->do_upload('profilepicture'))  
				{  
					$data['error']= $this->upload->display_errors();  
				}
				else
				{
					$data['error']='';
					$image= array('upload_data' => $this->upload->data());
					$data['image']= $image['upload_data']['file_name']; 
				}
		}
		else
		{
			$data['error']='Not select photo';
		}
        echo json_encode($data);
    }

}
?>