<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IncomeExpenseReport extends CI_Controller {

	public function __construct(){
		parent::__construct();
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$this->load->model('common_model');
		$this->login = $this->session->userdata('login');
		$this->user_type = $this->login->user_type;
		$this->user_id = $this->login->id;	
		func_check_login();
	}

	public function index(){

		if (!empty($this->session->userdata('sdate')) AND !empty($this->session->userdata('edate'))){
			$sdate=$this->session->userdata('sdate');
		    $edate=$this->session->userdata('edate');
		}
		else{ 
			$sdate = '2019-01-02';
			$edate = '2019-01-30';
		}
		$data['dateRange']= $this->createDateRangeArray($sdate,$edate);
	/*
		$query= 'SELECT purchasedate,price FROM tbl_expense where purchasedate between "'.$sdate.'" AND  "'.$edate.'"';*/
	//echo $query;die;

		$query= 'SELECT purchasedate,price,tbl_invoice.total FROM tbl_expense inner join tbl_invoice on tbl_expense.project = tbl_invoice.project where (purchasedate between "'.$sdate.'" AND "'.$edate.'")';

		$data['allprice'] = $this->common_model->coreQueryObject($query);
		//echo '<pre>';print_r($data['allprice']);die;
		$temp = array();
		$str='';
		foreach($data['allprice'] as $price){

				$find = ["$"];
    			$replace = [' '];
    			$string = str_replace($find,$replace,$price->price);
    			$string1 = $price->total;
			if(array_key_exists($price->purchasedate,$temp)){
				
				$temp[$price->purchasedate]['expense']=$string+$temp[$price->purchasedate]['expense'];
				$temp[$price->purchasedate]['income']=$string1+$temp[$price->purchasedate]['income'];
			}
			else{
					
					$temp[$price->purchasedate]['expense']=$string;
					$temp[$price->purchasedate]['income']=$string1;
			}
		}
		/*echo "<PRE>";
		print_r($temp);
		exit;*/
		$data['finalTempArr']=	$temp;

		$this->load->view('common/header');
		$this->load->view('report/incomeexpensereport',$data);
		$this->load->view('common/footer');
	}


	public function getPostData(){
		if(!empty($_POST))
		{
			$sdate=$this->input->post('start_date');
	    	$edate=$this->input->post('deadline');
	    	/*$project=$this->input->post('projectData');*/
	    
	    	$this->session->set_userdata('sdate',$sdate);
	    	$this->session->set_userdata('edate',$edate);
	    	/*$this->session->set_userdata('project',$project);*/
	    
	    	redirect('IncomeExpenseReport/index');

		}
	}


	function createDateRangeArray($strDateFrom,$strDateTo){

	    $aryRange=array();
	    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),  substr($strDateFrom,8,2),substr($strDateFrom,0,4));
	    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),  substr($strDateTo,8,2),substr($strDateTo,0,4));

	    if ($iDateTo>=$iDateFrom)
	    {
	        array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
	        while ($iDateFrom<$iDateTo)
	        {
	            $iDateFrom+=86400; // add 24 hours
	            array_push($aryRange,date('Y-m-d',$iDateFrom));
	        }
	    }
	    return $aryRange;
	}
}