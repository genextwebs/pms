<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller 
{
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model');
	}
	
	public function index(){
		$this->load->view('common/header');
		$this->load->view('project/project');
		$this->load->view('common/footer');
	}
	
	public function addproject(){
		$this->load->view('common/header');
		$this->load->view('project/addproject');
		$this->load->view('common/footer');
	}
	
	
}