<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Finance extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('common_model');
		ini_set('display_errors',1);
		error_reporting(E_ALL);
	}
	public function index(){
		$this->load->view('common/header');
		$this->load->view('Estimates/estimate');
		$this->load->view('common/footer');
	}
	
	public function addestimates(){
		//$data['sessData'] = $this->session->flashdata('data');
		$data['client']=$this->common_model->getData('tbl_clients');
		$this->load->view('common/header');
		$this->load->view('Estimates/addestimate',$data);
		$this->load->view('common/footer');
	}
	
}
?>