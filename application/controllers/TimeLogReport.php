<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TimeLogReport extends CI_Controller {

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
	
		$data['allProjectData'] = $this->common_model->getData('tbl_project_info');
		$this->load->view('common/header');
		$this->load->view('report/timelogreport',$data);
		$this->load->view('common/footer');
	}

	public function getBarchart(){
		if(!empty($_POST)){
			$startdate=!empty($_POST['startdate']) ? $_POST['startdate'] : '';
			$enddate=!empty($_POST['enddate']) ? $_POST['enddate'] : '';
		
		
			$sWhere = "";
			if(!empty($startdate)){						
				$sWhere.=' AND timelogstartdate>="'.$startdate.'"';
			}
			if(!empty($enddate)){						
				$sWhere.=' OR timelogenddate<="'.$enddate.'"';
			}
			if(!empty($sWhere)){
				$sWhere = " WHERE 1 ".$sWhere;
			}
			$query = "SELECT * from tbl_timelog".$sWhere;
			$dateRange= $this->createDateRangeArray($startdate,$enddate);
			//print_r($dateRange);die;
			$str='';
			$str1=$dateRange[0][''].''.''.'';
			echo $str1;die;
			//print_r ($dateRange);die;

			
			
		/*    $dateStr = $dateCount="";
		    $dateRange = $this->createDateRangeArray($startdate,$enddate);
		    foreach ($dateRange as $key => $value) {
		    	$sWhere = " WHERE ";
				$sWhere.="  timelogstartdate ='".$value."'";					
				$sWhere.=" OR timelogenddate ='".$value."'";
				$sql = "SELECT * FROM tbl_timelog ".$sWhere;
			
				$logArray = $this->common_model->coreQuery($sql);
		  	$dateStr.=$value." ,";
		    	if(!empty($logArray)){
		    		$dateCount.=$value;
		    	}else{
		    		$dateCount.="0,";
		    	}
		 }*/
		  //  $finalCountStr =trim($dateCount,","); 
		   // $finalDateStr = trim($dateStr,",");
		  //  $concateStr = $finalCountStr."$#$".$finalDateStr;
		//      $concateStr = $finalDateStr;
			echo json_encode($str);exit;		

		}
    }


    function createDateRangeArray($strDateFrom,$strDateTo)
	{
	    // takes two dates formatted as YYYY-MM-DD and creates an
	    // inclusive array of the dates between the from and to dates.

	    // could test validity of dates here but I'm already doing
	    // that in the main script

	    $aryRange=array();

	    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
	    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

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