<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leads extends CI_Controller 
{
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model');
	}
	
	public function index(){
		$this->load->view('common/header');
		$this->load->view('leads/leads');
		$this->load->view('common/footer');
	}

	public function addleads(){
		$this->load->view('common/header');
		$this->load->view('leads/addleads');
		$this->load->view('common/footer');
	}
}