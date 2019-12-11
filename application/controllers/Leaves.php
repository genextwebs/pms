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
		/*$id=base64_decode($_POST['id']);
		echo($id);die;*/
		/*whereArr=array('id'=>$id);
			$data['allleavesdata']=$this->common_model->getData('tbl_leaves',$whereArr);
			
		*/
	
		$data['leavecategory']=$this->common_model->getData('tbl_leavetype');
		
		//print_r($data['allleavesdata']) ;die;
			$data['employee']=$this->common_model->getData('tbl_employee'); 
		$this->load->view('common/header');
		$this->load->view('leaves/leaves',$data);
		$this->load->view('common/footer');
	} 

	public function addleaves(){
		
		$data['employee']=$this->common_model->getData('tbl_employee');
		$data['leavecategory']=$this->common_model->getData('tbl_leavetype');
	
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
			
			if(!empty(trim($_GET['sSearch']))){
				$searchTerm = trim($_GET['sSearch']);
				$sWhere.= ' AND (tbl_employee.employeename like "%'.$searchTerm.'%")';
			}
				
			
			$startdate=!empty($_POST['sdate']) ? $_POST['sdate'] : '';

			$enddate=!empty($_POST['edate']) ? $_POST['edate'] : '';
			$empname=!empty($_POST['ename']) ? $_POST['ename'] : '';
		//   echo($startdate);die;	
			if(!empty($startdate)){						
				$sWhere.=' AND date>="'.$startdate.'"';
			}
			if(!empty($enddate)){						
				$sWhere.=' AND date<="'.$enddate.'"';
			}
			if(!empty($empname)){						
				$sWhere.=' AND tbl_employee.employeename='.$empname;
			}
		}
		$query = "SELECT tbl_leaves.id,empid,tbl_leaves.date,status,leavetypeid,tbl_employee.employeename as empname from tbl_leaves inner join tbl_employee on tbl_leaves.empid = tbl_employee.id".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
		$LeavesArr = $this->common_model->coreQueryObject($query);
		
		$projectArr = $this->common_model->coreQueryObject($query);
		$querysearch = "SELECT tbl_leaves.date,tbl_employee.employeename as empname from tbl_leaves inner join tbl_employee on tbl_leaves.empid = tbl_employee.id".
		$sWhere;
	//	echo $this->db->last_query();die;

/*	echo $this->db->last_query();
		$query = "SELECT tbl_project_info.*,tbl_clients.clientname as clientname from tbl_project_info inner join tbl_clients on tbl_project_info.clientid = tbl_clients.id".$sWhere;*/
		$LeavesFilterArr = $this->common_model->coreQueryObject($querysearch);
	
		$iFilteredTotal = count($LeavesFilterArr);
		$ProjectAllArr = $this->common_model->getData('tbl_leaves');
		$iTotal = count($ProjectAllArr);
		
		/** Output */
		$datarow = array();
		$i = 1;
		foreach($LeavesArr as $row) {
		/*foreach($LeavesArr as $row) 
		$mystatus=$row->status;{*/
			$rowid = $row->id;
			$mystatus=$row->status;

			if($row->status=='1'){
						$status=$row->status='Approved';
						$showStatus = '<label class="label label-success">'.$status.'</label>';
						}
				
					else{
						$status=$row->status='Pending';
						$showStatus = '<label class="label label-danger">'.$status.'</label>';
						}
						
					//echo($mystatus);die;
			if($mystatus=='1'){
			//echo($row->status);die;
		
						 $actionstring= '<a href='.base_url().'Leaves/searchproject/'.base64_encode($row->id). ' class="btn btn-success btn-circle" data-toggle="tooltip" data-original-title="View Project Details"><i class="fa fa-search" aria-hidden="true"></i></a>';
		  		;		 
								 
			}
			else{

				$actionstring= '
					<a href='.base_url().'Leaves/approveleaves/'.base64_encode($row->id). ' class="btn btn-success btn-circle" data-toggle="tooltip" data-original-title="View Project Details"><i class="fa fa-check" aria-hidden="true"></i></a>

					<a href="javascript:void();" onclick="deleteleaves(\''.base64_encode($rowid).'\');"  class="btn btn-danger btn-circle sa-params" data-toggle="tooltip"  data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>

					<a href="javascript:;" onclick="searchleaves(\''.base64_encode($rowid).'\');"  class="btn btn-success btn-circle" data-toggle="modal" data-target="#leaves-popup" data-original-title="View Project Details"><i class="fa fa-search" aria-hidden="true"></i></a>'
					  		;
								
					
			}
		$datarow[] = array(
			$id = $i,
			$row->empname,
			$row->date,
			$showStatus,
			$row->leavetypeid,
			
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
				//   "iTotalDisplayRecords" => $iFilteredTotal,
				   "aaData" => $datarow
		);
		echo json_encode($output);
		exit();

	}

	public function searchleaves(){
		$id=base64_decode($_POST['id']);
		$whereArr=array('id'=>$id);
		$data =$this->common_model->getData('tbl_leaves',$whereArr);
		$id= $data[0]->id;
		$str = '';
		$str.= '<p>Date</p>';
		$str.= '<p>'.$data[0]->date.'</p>';
		$str.= '<p>Reason for absence</p>';
		$str.= '<p>'.$data[0]->reasonforabsence.'</p>';
		$str.= '<p>Status</p>'; 
		$str.= '<p>'.$data[0]->status.'</p>';
		$str.= '<p><a href="javascript:void();" >Close</a></p>';
		$str.= '<p><button onclick="editleaves(\''.base64_encode($id).'\')" class="fa fa-edit" value="Edit"></button></p>';
		/*$str.= '<p><a href="javascript:void();" class="fa fa-times" >Delete</a></p>';*/
		/*$str.= '<p>	<a href="javascript:void();" onclick="deleteleaves(\''.base64_encode($rowid).'\');"  class="btn btn-danger btn-circle sa-params" data-toggle="tooltip"  data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a></p>'; 
	/*	$str.= '<p></p>';
		$str.='<p></p>';*/

		echo json_encode($str);exit;

	}

	public function editleaves(){
		$id=base64_decode($_POST['id']);
		$whereArr=array('id'=>$id);
		$leaves =$this->common_model->getData('tbl_leaves',$whereArr);
		$emp['employee'] =$this->common_model->getData('tbl_employee',$whereArr);
		//print_r($leaves);die;
		$id= $leaves[0]->id;
		 //$leaves[0]->empid;
		//$date=$leaves[0]->date;
		//echo($date);die;
		$string = '';
					$empid='';
					if(	!empty($leaves[0]->empid)){
						$date = $leaves[0]->empid;
					}
		$string.= '<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">Choose Member</label>
									<select class="custom-select br-0" id="choose_mem" name="choose_mem">';
									foreach($emp['employee'] as $emp){
										$str='';
											if($emp->id==$leaves[0]->empid){
												$str='selected';
												}
											
									$string.= '<option value="'.$emp->id.''.$str.'">'. 
										$emp->employeename.'</option>';
													}
														
									$string.= '</select>

										</div>
								</div>
							</div>';
		$string.= '	<div class="row">
									<div class="col-md-12">
										<div class="form-group project-category">
											<label class="control-label" for="leave_type">
											Leave Type
											<a class="btn btn-sm btn-outline-success ml-1" href="javascript:;" data-toggle="modal" data-target="#leave_type1"><i class="fa fa-plus"></i> Add Leave Type</a></label>
											
											<select class="custom-select br-0" id="leave_type" name="leave_type">
											
												
																							
											</select>
										</div>
									</div>
								</div>';
								$date='';
								if(	!empty($leaves[0]->date)){
									$date = $leaves[0]->date;
								}
		$string.=   '<div class="row">'
						.'<div class="col-md-4" id="deadlineBox">'
							.'<div class="form-group">'
								.'<label class="control-label">Date</label>'
									.'<input type="text" name="date" id="date" autocomplete="off" class="form-control" value="'.$date.'">'
								.'</div>'
							.'</div>'
				   .'</div>';
				   if(	!empty($leaves[0]->reasonforabsence)){
									$reasonforabsence = $leaves[0]->reasonforabsence;
								}
		$string.= '	<div class="row">'
						.'<div class="col-md-6">'
							.'<div class="form-group">'
								.'<label class="control-label">Reason for absence</label>'
										.'<textarea id="absence" class="form-control" name="absence" rows="5">'.$reasonforabsence.'</textarea>'
							.'</div>'
						.'</div>';
		$string.=    '<div class="col-md-6">'
							.'<div class="form-group">'
								.'<label class="control-label">Status</label>'
									.'<select id="" class="form-control" name="status">'
										.'<option></option>'

											
									.'</select>'
								.'</div>'
							.'</div>'
						.'</div>';
		$string.= '<div class="form-actions">
									<button type="submit" name="btnupdate" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> Update</button>
									
									<input type="button" class="btn btn-default" value="Close">
								</div>';
		/*$str.= '<td><button onclick="editleaves(\''.base64_encode($id).'\')" class="fa fa-edit" value="Edit"></button></td></tr>';*/
		echo json_encode($string);exit;
		
/*		if(!empty($_POST))
		{	
			$mem = $this->input->post('choose_mem');
			$type  = $this->input->post('leave_type');
			$date = $this->input->post('date');
			$abs  = $this->input->post('absence');
			$status = $this->input->post('status');
		
			//echo($date);die;
		
			$updateArr = array('empid'=>$mem,'leavetypeid'=>$type,'date'=>$date,'reasonforabsence'=>$abs,'status'=>$status);
			$this->common_model->updateData('tbl_project_info',$updateArr,$whereArr);
		     echo'<pre>';
		     echo $this->db->last_query();die;
		 }*/
	}

	public function approveleaves(){
		$id = base64_decode($this->uri->segment(3));
		$whereArr = array('id'=>$id);
		$updateArr= array('status'=>1);
		$this->common_model->updateData('tbl_leaves',$updateArr,$whereArr);
		redirect('Leaves/index');
		
	}

	public function deleteleaves(){
		$id=base64_decode($_POST['id']);
		//echo($id);die;
		$whereArr=array('id'=>$id);
		$this->common_model->deleteData('tbl_leaves',$whereArr);
		$this->session->set_flashdata('message','Delete Succesfully....');
		redirect('Leaves/index');
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




}
