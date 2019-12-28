<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timelog extends CI_Controller {

	public function __construct(){
		parent::__construct();
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$this->load->model('common_model');
		func_check_login();
	}

	public function index(){
		$this->load->view('common/header');
		$this->load->view('timelog/timelog');
		$this->load->view('common/footer');
	}

	public function addtimelog(){
		$this->load->view('common/header');
		$this->load->view('timelog/addtimelog');
		$this->load->view('common/footer');
	}
}