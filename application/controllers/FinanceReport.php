<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FinanceReport extends CI_Controller {

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
		/*$project = $this->session->userdata('project');
		$client = $this->session->userdata('client');
		if (!empty($s_date) AND !empty($e_date)){
			$startdate=$this->session->userdata('sdate');
		    $enddate=$this->session->userdata('edate');
		}
		else{
		
			$startdate=date('Y-m-d',strtotime('-1 month'));
			$enddate=date('Y-m-d');
		}
		$data['dateRange']= $this->createDateRangeArray($startdate,$enddate);
		if(!empty($project)){
	 		$query = 'SELECT * from tbl_invoice where project='.$project.' AND (invoicedate between "'.$startdate.'" AND "'.$enddate.'") AND (clientname ='.$client.')';
	 	}else{
	 		$query = 'SELECT * from tbl_invoice where 1 AND (invoicedate between "'.$startdate.'" AND "'.$enddate.'")';
	 	}*/
	 	$query = "SELECT * from tbl_invoice";
	 	$data['getAmount'] = $this->common_model->coreQueryObject($query);
	 	$temp = array();
		$stri='';
		foreach($data['getAmount'] as $amount){
    			$string = $amount->total;

			if(array_key_exists($amount->invoicedate,$temp)){
				$temp[$amount->invoicedate]=$string+$temp[$amount->invoicedate];
			}
			else{
					$temp[$amount->invoicedate]=$string;
			}
		
		}
		//print_r($temp);die;
		$data['allProjectData'] = $this->common_model->getData('tbl_project_info');
	    $data['allClients'] = $this->common_model->getData('tbl_clients');
	   	//$data['sdate']=$startdate;
		//$data['edate']=$enddate;
		//$data['finalTempArr']=	$temp;
		$this->load->view('common/header');
		$this->load->view('report/financereport',$data);
		$this->load->view('common/footer');
	}

	public function Month($month){
	 			$sql = "select Month(month) as month from tbl_invoice";
	 			$month = $this->common_model->coreQueryObject($sql);
	 			return $month->month;
	 		}
	public function getPostData($post){
		if(!empty($post)){
			/*$sdate=$post['start_date'];
	    	$edate=$post['deadline'];
	    	$project=$post['project'];
	    	$client=$post['clientData'];
	    	//echo $client;die;
	    	$this->session->set_userdata('sdate',$sdate);
	    	$this->session->set_userdata('edate',$edate);
	    	$this->session->set_userdata('project',$project);
	    	$this->session->set_userdata('client',$client);
	    	//redirect('FinanceReport/index');
	    	$project = $this->session->userdata('project');
		    $client = $this->session->userdata('client');

			if (!empty($sdate) AND !empty($edate)){
				$startdate=$this->session->userdata('sdate');
			    $enddate=$this->session->userdata('edate');
			}
			else{
			
				$startdate=date('Y-m-d',strtotime('-1 month'));
				$enddate=date('Y-m-d');
			}
			$data['dateRange']= $this->createDateRangeArray($startdate,$enddate);
			if(!empty($project)){
	 			$query = 'SELECT * from tbl_invoice where project='.$project.' AND (invoicedate between "'.$startdate.'" AND "'.$enddate.'") AND (clientname ='.$client.')';
	 		}else{
	 			$query = 'SELECT * from tbl_invoice where 1 AND (invoicedate between "'.$startdate.'" AND "'.$enddate.'")';
	 		}*/
	 		$query = "SELECT total , SUM(total) as total , invoicedate, Month(invoicedate) as month from tbl_invoice group by Month(invoicedate)";
	 		$data['getAmount'] = $this->common_model->coreQueryObject($query);

	 		//echo $query;die;
	 		//print_r($data);die;
	 		$temp = array();
			foreach($data['getAmount'] as $amount){

    			$string = $amount->total;
    			if($amount->month == 1){
    				$month = 'January';
    			}
    			else if($amount->month == 2){
    				$month = 'February';
    			}
    			else if($amount->month == 3){
    				$month = 'March';
    			}
    			else if($amount->month == 4){
    				$month = 'April';
    			}
    			else if($amount->month == 5){
    				$month = 'May';
    			}
				//if(array_key_exists($amount->invoicedate,$temp)){
					$temp[$month] = $string;
				/*}
				else{
					$temp[$amount->invoicedate]=$string;
				}*/
			}
			//echo "<PRE>";print_r($temp);die;
			$str='';
			$str1='';
			foreach($temp as $key=>$value){
				$str.= '"'.$key.'"'.',';
				$str1.= $value.',';
			}
	    	return rtrim($str,",")."#$#".rtrim($str1,",");
		}
	}


	function createDateRangeArray($strDateFrom,$strDateTo)
	{
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

	public function fianancereportlist(){
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';
			$aColumns = array( 'id', 'project', 'invoice', 'total', 'invoicedate','status');
			$totalColumns = count($aColumns);

				/** Paging Start **/
            $sLimit = "";
            $sOffset = "";
            if ($_GET['iDisplayStart'] < 0) {
                $_GET['iDisplayStart'] = 0;
            }
            if ($_GET['iDisplayLength'] < 0) {
                $_GET['iDisplayLength'] = 10;
            }
            if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
                $sLimit = (int) substr($_GET['iDisplayLength'], 0, 6);
                $sOffset = (int) $_GET['iDisplayStart'];
            } else {
                $sLimit = 10;
                $sOffset = (int) $_GET['iDisplayStart'];
            }
            /** Paging End **/

			/** Ordering Start **/
			$noOrderColumns = array('other_do_ext');
			if (isset($_GET['iSortCol_0']) && !in_array($aColumns[intval($_GET['iSortCol_0'])], $noOrderColumns)) {
				$sOrder = " ";
				for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
					if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {

						if ($aColumns[intval($_GET['iSortCol_' . $i])] != '') {
							$sOrder .= $aColumns[intval($_GET['iSortCol_' . $i])] . " " . $_GET['sSortDir_' . $i] . ", ";
						} 
						else {
							$sOrder = $defaultOrderClause . " ";
						}

						$sortColumnName = intval($_GET['iSortCol_' . $i]).'|'.$_GET['sSortDir_' . $i];
					}
				}

				$sOrder = substr_replace($sOrder, "", -2);
				if ($sOrder == "ORDER BY") {
					$sOrder = "";
				}
			} else {
				$sOrder = $defaultOrderClause;
			}

			if(!empty($sOrder)){
				$sOrder = " ORDER BY ".$sOrder;
			}
			/** Ordering End **/

			/** Filtering Start */
			if(!empty(trim($_GET['sSearch']))){
				$searchTerm = trim($_GET['sSearch']);
				$sWhere.= ' AND (tbl_project_info.projectname like "%'.$searchTerm.'%")';
			}
			if(!empty(trim($_POST['start_date']))){
				$startdate=!empty($_POST['start_date']) ? $_POST['start_date'] : '';
			}else{
				$startdate=date('Y-m-d',strtotime('-1 month'));
			}
			if(!empty(trim($_POST['deadline']))){ 
				$enddate=!empty($_POST['deadline']) ? $_POST['deadline'] : '';
			}else{
				$enddate=date('Y-m-d');
			}
			/*$startdate=!empty($_POST['start_date']) ? $_POST['start_date'] : '';
			$enddate=!empty($_POST['deadline']) ? $_POST['deadline'] : '';*/
			$project=!empty($_POST['project']) ? $_POST['project'] : '';
			$client=!empty($_POST['clientData']) ? $_POST['clientData'] : '';
			//echo $startdate.''.$enddate;die;
			if(!empty($startdate)){						
				$sWhere.=' AND invoicedate>="'.$startdate.'"';
			}
			if(!empty($enddate)){						
				$sWhere.=' AND duedate<="'.$enddate.'"';
			}
			if(!empty($project)){						
				$sWhere.=' AND tbl_invoice.project='.$project;
			}
			if(!empty($client)){						
				$sWhere.=' AND tbl_invoice.clientname='.$client;
			}
			
				$sWhere = " WHERE tbl_invoice.status=1 ".$sWhere;
			
		}
		
		$query = "SELECT tbl_invoice.*,projectname FROM `tbl_invoice` inner join tbl_project_info on tbl_invoice.project= tbl_project_info.id".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
		$FinanceArr = $this->common_model->coreQueryObject($query);
		$query = "SELECT tbl_invoice.*,projectname FROM `tbl_invoice` inner join tbl_project_info on tbl_invoice.project= tbl_project_info.id".$sWhere;
		$FinanceFilterArr = $this->common_model->coreQueryObject($query);
		$iFilteredTotal = count($FinanceFilterArr);
		$FinanceAllArr = $this->common_model->getData('tbl_invoice');
		$iTotal = count($FinanceAllArr);
		
		/** Output */
		$datarow = array();
		$i = 1;
		foreach($FinanceArr as $row) {
			$rowid = $row->id;
			$mystatus=$row->status;
			//$showStatus;
			if($row->status==1){
					$status=$row->status='paid';
					$showStatus = '<label class="label label-success">'.$status.'</label>';
			}
			//echo($row->status);die;
		
			$datarow[] = array(
				$id = $i,
				$row->projectname,
				$row->invoice,
				$row->total,
				$row->invoicedate,
				$showStatus
			);
				$i++;
			}
			$dataGraph = $this->getPostData($_POST);
			//print_r($dataGraph);die;  
			$output = array
			(
			   	"sEcho" => intval($_GET['sEcho']),
		        "iTotalRecords" => $iTotal,
		        "iTotalRecordsFormatted" => number_format($iTotal), //ShowLargeNumber($iTotal),
		        "graphData"=>$dataGraph,
		        "iTotalDisplayRecords" => $iFilteredTotal,
		        "aaData" => $datarow
			);
		  	echo json_encode($output);
	      	exit();
	}

}
