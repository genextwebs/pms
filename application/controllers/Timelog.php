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
		$data['projectinfo']=$this->common_model->getData('tbl_project_info');
		$data['empinfo'] = $this->common_model->getData('tbl_employee');
		$this->load->view('common/header');
		$this->load->view('timelog/addtimelog',$data);
		$this->load->view('common/footer');
	
	}

	public function inserttimelog(){

			if(!empty($_POST)){
			$project = $this->input->post('projectname');
			$emp = $this->input->post('empname');
			$sdate = $this->input->post('start_date');
			$edate = $this->input->post('deadline');
			$stime = $this->input->post('starttime');
			$etime = $this->input->post('endtime');
			$hours = $this->input->post('hours');
			$memo = $this->input->post('memo');
			
			$insArr = array('timelogprojectid'=>$project ,'timelogemployeeid'=>$emp ,'timelogstartdate'=>$sdate , 'timelogenddate'=>$edate ,'timelogstarttime'=>$stime ,'timelogendtime'=>$etime,'totalhours'=>$hours,'timelogmemo'=>$memo);
			$this->common_model->insertData('tbl_timelog',$insArr);
			redirect('timelog/index');
		}
	}

	public function timeloglist(){
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';
			$aColumns = array( 'id', 'timelogprojectid','timelogstartdate', 'timelogenddate', 'timelogemployeeid', 'timelogstarttime' ,'timelogendtime' , 'totalhours' ,'timelogmemo');
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
			
			if(!empty(trim($_GET['sSearch']))){
				$searchTerm = trim($_GET['sSearch']);
				$sWhere.= ' AND (tbl_project_info.projectname like "%'.$searchTerm.'%" OR tbl_timelog.starttime like "%'.$searchTerm.'%" OR tbl_timelog.endtime "%'.$searchTerm.'%" OR tbl_project_info.earning like "%'.$searchTerm.'%" OR tbl_employee.employeename like "%'.$searchTerm.'%")';
			}
		/*	$status=$_POST['status1'];	
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
		$query = "SELECT projectbudget,tbl_timelog.* FROM `tbl_timelog` inner join tbl_project_info on tbl_timelog.timelogprojectid = tbl_project_info.id".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
		//echo($query);echo '<br/>';
		$timeArr = $this->common_model->coreQueryObject($query);
		$query = "SELECT projectbudget,tbl_timelog.* FROM `tbl_timelog` inner join tbl_project_info on tbl_timelog.timelogprojectid = tbl_project_info.id".$sWhere;
		//echo($query);die;
		//echo $query[0]->projectbudget;die;
		$TimeFilterArr = $this->common_model->coreQueryObject($query);
		$iFilteredTotal = count($TimeFilterArr);
		//$whereArr=array('archive'=>0);
		$TimeAllArr = $this->common_model->getData('tbl_timelog');
		$iTotal = count($TimeAllArr);
		
		/** Output */
		$datarow = array();

		$i = 1;
		foreach($timeArr as $row) {
			$rowid = $row->id;
			
				$actionstring = 
								'<a href="javascript:void()" onclick="edittimelog(\''.base64_encode($rowid).'\')" class="btn btn-info btn-circle" data-original-title="Edit" data-target="#timelog-popup" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a>

								 <a href="javascript:void();" onclick="deletetimelog(\''.base64_encode($rowid).'\');"  class="btn btn-danger btn-circle sa-params" data-toggle="tooltip"  data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>';
		
		$datarow[] = array(
			$id = $i,
			$row->timelogprojectid,
			$row->timelogemployeeid,
			$row->timelogstarttime,
			$row->timelogendtime,
			$row->totalhours,
			$row->projectbudget,
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

	public function deletetimelog(){
		$id = base64_decode($_POST['id']);
		$whereArr = array('id' => $id);
		$this->common_model->deleteData('tbl_timelog',$whereArr);
		$this->session->set_flashdata('message','Delete Succesfully....');
		redirect('timelog/index');
	}

	public function edittimelog(){
		$id=base64_decode($_POST['id']);
		$whereArr=array('id'=>$id);
		$data =$this->common_model->getData('tbl_timelog',$whereArr);
		$id= $data[0]->id;
		$str ='';
		$str.= '<div class="form-body">
								<h3 class="box-title">Timelog Info</h3><hr>
									<p id="succmsg" class="text-success"></p>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label">Select Project</label>
														<input id="projectname" class="form-control" type="text" name="projectname" value="">
												</div>
											</div>
										
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"> Start Date</label>
														<input type="text" class="start-date form-control br-0" id="start_date" name="start_date" value="" data-date-format=" yyyy-mm-dd">
												</div>
											</div>
										
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label">End Date</label>
														   <input type="text" class="end-date form-control br-0" id="deadline" name="deadline" value="" data-date-format="yyyy-mm-dd ">
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-4">
												<div class="form-group" id="timeonly">
													<label class="control-label">Start Time</label>
														<input type="text" class="form-control" name="starttime" id="starttime">
												</div>
											</div>
										
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"> End Time</label>
														<input type="text" class="form-control" name="endtime" id="endtime">
												</div>
											</div>
										
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label">Total Hours</label>
													<input type="text" name="hours" id="hours">
														<!--logic-->
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"> Employee Name</label>
														<input type="text" class="form-control" name="empname" id="empname">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"> Memo</label>
														<input type="text" class="form-control" name="memo" id="memo">
												</div>
											</div>
										</div>
										<div class="form-actions">
											<button type="submit" name="btnsavetime" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
										</div>


							</div>';
		echo json_encode($str);exit;
	}

	public function getEmployee(){
		$pname=$this->input->post('projectname');
		//$whereArr = array('project_id'=>$pname);
		$query ="select tbl_project_member.*,tbl_employee.employeename from tbl_project_member inner join tbl_employee on tbl_project_member.emp_id = tbl_employee.id where project_id=".$pname;
		//echo($query);die;
	  $getEmp=$this->common_model->coreQueryObject($query);
	    //print_r($getTimelog);die;
		$str = '';
			foreach($getEmp as $row){
				$str.='<option value="'.$row->id.'">'.$row->employeename.'</option>'; 
			}
			$timelogArr['empname'] = $str;
			//print_r($timelogArr['empname']);die;
			echo json_encode($timelogArr);exit;
	}

	 
}