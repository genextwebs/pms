<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {

	public function __construct(){
		parent::__construct();
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$this->load->model('common_model');
		func_check_login();
	}

	public function index(){
		$this->load->view('common/header');
		$this->load->view('ticket/ticket');
		$this->load->view('common/footer');
	}

	public function addticket(){
		$this->load->view('common/header');
		$this->load->view('ticket/addticket');
		$this->load->view('common/footer');
	}

	public function insertticket(){
		if(!empty($_POST)){

			$t_subject = $this->input->post('ticket_subject'); 
			$t_editor  = $this->input->post('editor1');
			$t_image   = $this->input->post('ticket_Image');
			$whereArr  = array('ticketsubject'=>$t_subject,'ticketdescription'=>$t_editor,
				          'ticketimage'=>$t_image);
			$query  =  $this->common_model->insertData('tbl_ticket',$whereArr);
			$this->session->set_flashdata('message_name','Inserted Successfully........');
			redirect('ticket/index');
		}
	}

	public function ticketlist(){
		//echo('fdg');die;
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';
			$aColumns = array( 'id', 'ticketsubject', 'ticketdescription', 'ticketimage');
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
				$sWhere.= ' WHERE (ticketsubject like "%'.$searchTerm.'%" )';
			}
			/*$startdate=!empty($_POST['startdate']) ? $_POST['startdate'] : '';
			$enddate=!empty($_POST['enddate']) ? $_POST['enddate'] : '';
			$empname=!empty($_POST['ename']) ? $_POST['ename'] : '';*/

			/*if(!empty($startdate)){						
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
		
		$query = "SELECT ticketsubject from tbl_ticket".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
		//echo $this->db->last_query();
		$TicketArr = $this->common_model->coreQueryObject($query);
		$query = "SELECT ticketsubject from tbl_ticket".$sWhere;
		//echo $this->db->last_query();
		$TicketFilterArr = $this->common_model->coreQueryObject($query);
		$iFilteredTotal = count($TicketFilterArr);
		$TicketAllArr = $this->common_model->getData('tbl_ticket');
		$iTotal = count($TicketAllArr);
		
		/** Output */
		$datarow = array();
		$i = 1;
		foreach($TicketArr as $row) {
		//	$rowid = $row->id;
			$actionstring= /*'<div class="dropdown action m-r-10">
				                <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">Action  <span class="caret"></span></button>
				                		<div class="dropdown-menu">
						                    <a href=""> Edit</a>
						                    <a href=""> Delete</a>
						                </div>
							</div>';*/
							'<div class="dropdown action m-r-10">
				                <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">Action  <span class="caret"></span></button>
				                		<div class="dropdown-menu">
						                   
						                    <a  class="dropdown-item" href=""><i class="fa fa-edit"></i> Edit</a>

						                    <a  class="dropdown-item" href="javascript:void()"><i class="fa fa-trash "></i> Delete</a>
						                    
				               			 </div>
							</div>';

			$datarow[] = array(
				$id = $i,
				$row->ticketsubject,
				/*
				$row->date,
				$showStatus,
				$row->leavetype,*/
				$actionstring
				);
				$i++;
			}
			
			$output = array
			(
				"sEcho" => intval($_POST['sEcho']),
					   "iTotalRecords" => $iTotal,
					   "iTotalRecordsFormatted" => number_format($iTotal),
					   "aaData" => $datarow
			);
			echo json_encode($output);
			exit();
	}
}