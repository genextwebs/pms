<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LeaveReport extends CI_Controller {

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
		$data['employee'] = $this->common_model->getData('tbl_employee');
		$this->load->view('common/header');
		$this->load->view('report/leavereport',$data);
		$this->load->view('common/footer');
	}
	

	public function leavelistreport(){
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';
			$aColumns = array( 'id', 'status');
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
	/*		if(!empty(trim($_GET['sSearch']))){
				$searchTerm = trim($_GET['sSearch']);
				$sWhere.= ' AND (tbl_employee.employeename like "%'.$searchTerm.'%" OR  tbl_leavetype.name like "%'.$searchTerm.'%")';
			}
			$startdate=!empty($_POST['startdate']) ? $_POST['startdate'] : '';
			$enddate=!empty($_POST['enddate']) ? $_POST['enddate'] : '';
			$empname=!empty($_POST['ename']) ? $_POST['ename'] : '';

			if(!empty($startdate)){						
				$sWhere.=' AND date>="'.$startdate.'"';
			}
			if(!empty($enddate)){						
				$sWhere.=' AND date<="'.$enddate.'"';
			}
			if(!empty($empname)){						
				$sWhere.=' AND tbl_leaves.empid='.$empname;
			}
			if(!empty($sWhere)){
				$sWhere = " WHERE 1 ".$sWhere;
			}*/
		}
		
		$query = "SELECT *,tbl_employee.employeename from tbl_leaves inner join tbl_employee on tbl_leaves.empid =tbl_employee.id ".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
		//	echo $this->db->last_query();
		$LeavesArr = $this->common_model->coreQueryObject($query);
		/*$query = "SELECT tbl_leaves.*,tbl_employee.employeename as empname,tbl_leavetype.name as leavetype from tbl_leaves INNER JOIN tbl_employee on tbl_leaves.empid = tbl_employee.id INNER JOIN tbl_leavetype ON tbl_leavetype.id = tbl_leaves.leavetypeid".$sWhere;*/
	

		$LeavesFilterArr = $this->common_model->coreQueryObject($query);
		$iFilteredTotal = count($LeavesFilterArr);
		$leaveAllArr = $this->common_model->getData('tbl_leaves');
		$iTotal = count($leaveAllArr);
		
		/** Output */
		$datarow = array();
		$i = 1;
		foreach($LeavesArr as $row) {
			$rowid = $row->id;

			$mystatus=$row->status;
		
			if($row->status=='1'){
					$status=$row->status='Approved';
					$showStatus = '<label class="label label-success">'.$status.'</label>';
			}
			else{
					$status=$row->status='Pending';
					$showStatus= '<label class="label label-danger">'.$status.'</label>';
				}
			
			$datarow[] = array(
				$id = $i,
				$row->employeename,
				$showStatus,
				$showStatus

			);
				$i++;
			}
			
			 
			$output = array
			(
			   	"sEcho" => intval($_GET['sEcho']),
		        "iTotalRecords" => $iTotal,
		        "iTotalRecordsFormatted" => number_format($iTotal), //ShowLargeNumber($iTotal),
		        "iTotalDisplayRecords" => $iFilteredTotal,
		        "aaData" => $datarow
			);
		  	echo json_encode($output);
	      	exit();
	}
}