<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class NoticeBoard extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model');
		ini_set('display_errors',1);
		error_reporting(E_ALL);
		func_check_login();
		$this->login = $this->session->userdata('login');
		$this->user_type = $this->login->user_type;
	}

	public function index(){
		$data['department']=$this->common_model->getData('tbl_department');
		//$data['userData']=$this->common_model->getData('tbl_user');		
		$this->load->view('common/header');
		$this->load->view('Notice/addnotice',$data);
		$this->load->view('common/footer');
	}
}