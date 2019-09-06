<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model');
	}
	
	public function index(){
		$this->load->view('login/login');
	}
	
	public function checklogin(){
		if($this->input->post('btnlogin')){
			$email = $this->input->post('email');	
			$password = $this->input->post('password');	
			$whereArr = array('emailid' => $email, 'password' => $password);
			$data = $this->common_model->getData('tbl_user',$whereArr);
			if(count($data) == 1){
				redirect('dashboard/index');
			}
			else{
				redirect('login/index');
			}
		}
	}
	
	function logout(){
		$this->session->sess_destroy();
        redirect(base_url().'login/index');
	}
}