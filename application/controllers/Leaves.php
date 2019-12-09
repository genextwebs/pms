<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leaves extends CI_Controller {

	public function __construct(){
		parent::__construct();
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$this->load->model('common_model');
		func_check_login();
	}

	public function index(){
		$data['employee']=$this->common_model->getData('tbl_employee'); 

		$this->load->view('common/header');
		$this->load->view('leaves/leaves',$data);
		$this->load->view('common/footer');
	}

	public function addleaves(){
		$data['leavecategory']=$this->common_model->getData('tbl_leavetype');
		$data['employee']=$this->common_model->getData('tbl_employee');

		$this->load->view('common/header');
		$this->load->view('leaves/addleaves',$data);
		$this->load->view('common/footer');
	}

	public function insertleaves(){

		if(!empty($_POST))
		{	
			$mem = $this->input->post('choose_mem');
			$type  = $this->input->post('leave_type');
			$radio = $this->input->post('duration_radio');
			$date = $this->input->post('date');
			$abs  = $this->input->post('absence');
			//echo($date);die;
			$status = $this->input->post('status');
			$whereArr = array('empid'=>$mem,'leavetypeid'=>$type,'duration'=>$radio,'date'=>$date,'reasonforabsence'=>$abs,'status'=>$status);
		     echo'<pre>';
		//print_r($whereArr);die;
			$this->common_model->insertData('tbl_leaves',$whereArr);
			$this->session->set_flashdata('message_name', 'Project Insert sucessfully');
			redirect('Leaves/index');
			//echo $this->db->last_query();die;
			//print_r($hh);die;
		}
	}
		
	public function leavelist(){
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';
			$aColumns = array( 'id', 'empid', 'leaveid', 'duration', 'date','reasonforabsence','status');
			//'ahrefs_dr', 
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
			
		/*	if(!empty(trim($_GET['sSearch']))){
				$searchTerm = trim($_GET['sSearch']);
				$sWhere.= ' AND (tbl_project_info.projectname like "%'.$searchTerm.'%" OR tbl_project_info.note like "%'.$searchTerm.'%" OR tbl_project_info.clientid like "%'.$searchTerm.'%" OR tbl_project_info.projectsummary like "%'.$searchTerm.'%" OR clientname like "%'.$searchTerm.'%")';
			}
			$status=$_POST['status1'];	
			$client=!empty($_POST['clientname1']) ? $_POST['clientname1'] : '';		
			$category=!empty($_POST['categoryname1']) ? $_POST['categoryname1'] : '';
			
			if(!empty($client)){
					$sWhere.=' AND tbl_project_info.clientid='.$client;
			}
			if(!empty($category)){						
				$sWhere.=' AND projectcategoryid='.$category;
			}
			if($status=='all'){
				}else{
						$sWhere.=' AND tbl_project_info.status='.$status;
				}*/
			/*$sWhere.=' AND tbl_project_info.archive=0';	
			if(!empty($sWhere)){
				$sWhere = " WHERE 1 ".$sWhere;
			}*/
			/** Filtering End */
		}
		$query = "SELECT tbl_leaves.*,tbl_employee.employeename as empname,tbl_leavetype.id as leavestype from tbl_leaves inner join tbl_employee on tbl_leaves.empid = tbl_employee.id".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
		echo($query);echo '<br/>';
		$LeavesArr = $this->common_model->coreQueryObject($query);
		/*$query = "SELECT tbl_project_info.*,tbl_clients.clientname as clientname from tbl_project_info inner join tbl_clients on tbl_project_info.clientid = tbl_clients.id".$sWhere;*/
		//echo($query);die;
	/*	$ProjectFilterArr = $this->common_model->coreQueryObject($query);
		$iFilteredTotal = count($ProjectFilterArr);*/
		//$whereArr=array('archive'=>0);
		$ProjectAllArr = $this->common_model->getData('tbl_leaves');
		$iTotal = count($ProjectAllArr);
		
		/** Output */
		$datarow = array();
		$i = 1;
		foreach($LeavesArr as $row) {
			$rowid = $row->id;
	
		
		$datarow[] = array(
			$id = $i,
			$row->empid.'<br/>'.$string.'<br/>'.$showStatus,
			$row->leavetypeid,
			$row->duration,
			$row->date,
			$row->reasonforabsence,
			$row->status,
			//$status,
			$actionstring
			);
			$i++;
		}
		
		$output = array
		(
			"sEcho" => intval($_POST['sEcho']),
				   "iTotalRecords" => $iTotal,
				   "iTotalRecordsFormatted" => number_format($iTotal), //ShowLargeNumber($iTotal),
				   "iTotalDisplayRecords" => $iFilteredTotal,
				   "aaData" => $datarow
		);
		echo json_encode($output);
		exit();

	}

	public function checkleave(){
		$status = 0;
		if(!empty($_POST['leavecategory'])){
			$where = array('name'=>$_POST['leavecategory']);
			$checkData = $this->common_model->getData('tbl_leavetype',$where);
			if(!empty($checkData)){
				$status = 1;
			}
		}
		echo $status;exit();
	}

	public function insertleavestype(){
		if(!empty($_POST)){
			$name = $this->input->post('leavename');
			$insArr = array('name'=>$name);
			$lastinsertid=$this->common_model->insertData('tbl_leavetype',$insArr);
			$leaArray = $this->common_model->getData('tbl_leavetype');
			$str = '';
			foreach($leaArray as $row){
				$str.='<option value="'.$row->id.'">'.$row->name.'</option>'; 
			}
			$totaldata = count($leaArray);
			$leaArr = array();
			$leaArr['count'] = $totaldata;
			$leaArr['catdata'] = $str;
			$leaArr['lastinsertid']= $lastinsertid;
			//print_r($catArr);die;
			echo json_encode($leaArr);exit; 
		}
	}


	public function deleteleave(){
		$status = 0;
		if(!empty($_POST['id'])){
			$id=$this->input->post('id');
			$deleteArr=array('id'=>$id);
			$this->common_model->deleteData('tbl_project_category',$deleteArr);
			$status = 1;
		}
		echo $status;exit();
	}	

}
