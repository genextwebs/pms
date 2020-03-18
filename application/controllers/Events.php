<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Events extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model');
		ini_set('display_errors',1);
		error_reporting(E_ALL);
		$this->load->library('SendMail');
		$this->login = $this->session->userdata('login');
		$this->user_type = $this->login->user_type;
		//$this->load->helper('common_helper');
	}

	public function index(){
		//echo "fdf";die;
		$this->load->view('common/header');
		$this->load->view('Event/event');
		$this->load->view('common/footer');
	}
}
?>