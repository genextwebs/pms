<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileSetting extends CI_Controller 
{
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model');
		$this->login = $this->session->userdata('login');

		$this->user_id = $this->login->id;
		func_check_login();
	}


	/*public function editprofile(){	
		$whereArr=array('id'=>$this->user_id);
		$data['profile']=$this->common_model->getData('tbl_user',$whereArr);
		//print_r($data['profile']);die;
		$this->load->view('common/header');
		$this->load->view('profile/profilesetting',$data);
		$this->load->view('common/footer');
		
				if(!empty($_POST)){
					$name=$this->input->post('profile_name');
					$email=$this->input->post('email_id');
					$pass=$this->input->post('password');
					$mobile=$this->input->post('mobile_no');
					$config = array(
									'upload_path' => './upload/',
									'allowed_types' => 'gif|jpg|png|jpeg',
									'max_size' =>'1000',
									'max_width'=>'1024',
									'max_height' => '768'
									);
					$this->load->library('upload',$config);
					$this->upload->initialize($config);
					$profilepicture = '';

					if($this->upload->do_upload('image_file')){
						$profilepicture = array('upload_data'=>$this->upload->data());
						$updateArr=array('name'=>$name,'emailid'=>$email,'password'=>$pass,'mobile'=>$mobile,'profileimg'=>$profilepicture['upload_data']['file_name']
						);
						//print_r($updateArr);die;
					$this->common_model->updateData('tbl_user',$updateArr,$whereArr);
					$this->session->set_flashdata('message_name', 'Projects Updated sucessfully');
					}
					else{
						$error = array('error' => $this->upload->display_errors());
					
					}
			}
	}*/
	public function editprofile(){	
		$whereArr=array('id'=>$this->user_id);
		$data['profile']=$this->common_model->getData('tbl_user',$whereArr);
		
	//	print_r($data['profile']);die;
		$this->load->view('common/header');
		$this->load->view('profile/profilesetting',$data);
		$this->load->view('common/footer');
		if(empty($_FILES)){
		if(!empty($_POST)){
			$name=$this->input->post('profile_name');
			$email=$this->input->post('email_id');
			$pass=$this->input->post('password');
			$mobile=$this->input->post('mobile_no');
			
				
			$config = array(
							'upload_path' => './upload/',
							'allowed_types' => 'gif|jpg|png|jpeg',
							'max_size' =>'1000',
							'max_width'=>'1024',
							'max_height' => '768'
							);
		
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			$profilepicture = '';
				
			

					if($this->upload->do_upload('image_file')){
						$profilepicture = array('upload_data'=>$this->upload->data());
						$updateArr=array('name'=>$name,'emailid'=>$email,'password'=>$pass,'mobile'=>$mobile,'profileimg'=>$profilepicture['upload_data']['file_name']
						);
						//print_r($updateArr);die;
					$this->common_model->updateData('tbl_user',$updateArr,$whereArr);
					$this->session->set_flashdata('message_name', 'Projects Updated sucessfully');
					}
					else{
						$error = array('error' => $this->upload->display_errors());
					
					}
			}
			else{
				$existimg=$this->input->post('image_name');
				$updateArr=array('name'=>$name,'emailid'=>$email,'password'=>$pass,'mobile'=>$mobile,'profileimg'=>$existimg
						);
				$this->common_model->updateData('tbl_user',$updateArr,$whereArr);
			}
		}
	}
}
