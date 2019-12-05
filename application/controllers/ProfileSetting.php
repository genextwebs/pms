<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileSetting extends CI_Controller 
{
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model');
		$this->login = $this->session->userdata('login');

		$this->user_id = $this->login->id;
		/*print_r($this->user_id);die;*/
		func_check_login();
	}


	public function editprofile(){	
		$whereArr=array('id'=>$this->user_id);
		$data['profile']=$this->common_model->getData('tbl_user',$whereArr);
		$this->load->view('common/header');
		$this->load->view('profile/profilesetting',$data);
		$this->load->view('common/footer');
		if(!empty($_POST)){
			
			$name=$this->input->post('profile_name');
			$email=$this->input->post('email_id');
			$pass=$this->input->post('password');
			$mobile=$this->input->post('mobile_no');
			$updateArr=array('name'=>$name,'emailid'=>$email,'password'=>$pass,'mobile'=>$mobile,
			);
			$this->common_model->updateData('tbl_user',$updateArr,$whereArr);
			$this->session->set_flashdata('message_name', 'Projects Updated sucessfully');
		}
	}
	function do_upload()
	{
	    $config['upload_path'] = './uploads/';
	    $config['allowed_types'] = 'gif|jpg|png';
	    $config['max_size'] = '100';
	    $config['max_width']  = '1024';
	    $config['max_height']  = '768';
	    $config['overwrite'] = TRUE;
	    $config['encrypt_name'] = FALSE;
	    $config['remove_spaces'] = TRUE;
	    if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
	    $this->load->library('upload', $config);
	    if ( ! $this->upload->do_upload('userfile')) {
	        echo 'error';
	    } else {

	        return array('upload_data' => $this->upload->data());
	}
}
}