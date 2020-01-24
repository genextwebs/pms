<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AttandanceReport extends CI_Controller {

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
		$this->load->view('report/attandancereport',$data);
		$this->load->view('common/footer');
	}


	public function attandancelistreport(){
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';
			$aColumns = array( 'id', 'employee', 'attendance');
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
			/*if(!empty(trim($_GET['sSearch']))){
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
		$query = "SELECT tbl_employee.employeename,tbl_attendance.* FROM `tbl_attendance` inner join tbl_employee on tbl_attendance.employee=tbl_employee.id Group by employeename".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
		//	echo $this->db->last_query();
		$AttendanceArr = $this->common_model->coreQueryObject($query);
		/*$query = "SELECT tbl_employee.employeename,tbl_attendance.* FROM `tbl_attendance` inner join tbl_employee on tbl_attendance.employee=tbl_employee.id Group by employeename".$sWhere;*/
		

		$AttendanceFilterArr = $this->common_model->coreQueryObject($query);
		$iFilteredTotal = count($AttendanceFilterArr);
		$AttendanceAllArr = $this->common_model->getData('tbl_attendance');
		$iTotal = count($AttendanceAllArr);
		
		/** Output */
		$datarow = array();
		$i = 1;
		foreach($AttendanceArr as $row) {
			$rowid = $row->id;
			$myattandance=$row->attendance;

			$sql="SELECT tbl_employee.employeename,tbl_attendance.* FROM `tbl_attendance` inner join tbl_employee on tbl_attendance.employee=tbl_employee.id Group by employeename where tbl_attendance.employee = ".$row->id." AND tbl_attendance.attendance = 1";

			$sql1="SELECT tbl_employee.employeename,tbl_attendance.* FROM `tbl_attendance` inner join tbl_employee on tbl_attendance.employee=tbl_employee.id Group by employeename where tbl_attendance.employee = ".$row->id." AND tbl_attendance.attendance = 2";

			$getCountPresent = $this->common_model->coreQueryObject($sql);
			$getCountAbsent = $this->common_model->coreQueryObject($sql1);

			$presentStatus=$absStatus="";
			if($row->attendance=='1'){
					$attendance=$row->attendance='Present';
					$presentStatus = '<label class="label label-success">'.$attendance.'</label>';
			}else if($row->attendance=='3'){ 
					$attendance=$row->attendance='Absent';
					$absStatus = '<label class="label label-danger">'.$attendance.'</label>';
			}
			
			
			$datarow[] = array(
				$id = $i,
				$row->employeename,
				$presentStatus.'<p class="btn btn-info btn-circle">'.count($getCountPresent).'</p>',
				$absStatus.'<p class="btn btn-info btn-circle">'.count($getCountAbsent).'</p>'
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