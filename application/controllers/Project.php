<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

	public function __construct(){
		parent::__construct();
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$this->load->model('common_model');
		func_check_login();
	}
			
	public function index(){
		$data['category']=$this->common_model->getData('tbl_project_category');
		$data['client']=$this->common_model->getData('tbl_clients');
		
		$this->load->view('common/header');
		$this->load->view('project/project',$data);
		$this->load->view('common/footer');
	}
			
	public function addproject(){
		$data['sessData'] = $this->session->flashdata('data');
		$data['client']=$this->common_model->getData('tbl_clients');
		$data['category']=$this->common_model->getData('tbl_project_category');
		$this->load->view('common/header');
		$this->load->view('project/addproject',$data);
		$this->load->view('common/footer');
	}
			
	public function insertproject(){
		if(!empty($_POST))
		{	
			if($this->input->post('manual_timelog')=='on'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$timelog=$chk_value;
			
			if($this->input->post('project_member')=='on'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$member=$chk_value;
			
			if($this->input->post('client-view-tasks')=='on'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$view=$chk_value;
			
			if($this->input->post('tasks-notification')=='on'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$tasks=$chk_value;
			
			$name=$this->input->post('project_name');
			$cat=$this->input->post('project-category');
			$date=$this->input->post('start_date');
			$deadline=$this->input->post('deadline');
			$without=$this->input->post('without_deadline');
			$editor1=$this->input->post('editor1');
			$notes=$this->input->post('notes');
			$client=$this->input->post('select_client');
			$budget=$this->input->post('project_budget');
			$currency=$this->input->post('currency-id');
			$hours=$this->input->post('hours_allocated');	
			
			$whereArr=array('projectname'=>$name);	
			$query=$this->common_model->getData('tbl_project_info',$whereArr);
			if(count($query)==1)
			{
				$this->session->set_flashdata('message_name', 'Projectname is already exists..');
				$this->session->set_flashdata("data",$_POST);
				redirect('Project/addproject');
			}
			else{
				$store=array('projectname'=>$name,'projectcategoryid'=>$cat,'startdate'=>$date,'manualtimelog'=>$timelog,
				'projectmember'=>$member,'deadline'=>$deadline,'clientid'=>$client,'viewtask'=>$view,
				'tasknotification'=>$tasks,'status'=>0,'projectsummary'=>$editor1,'note'=>$notes,
				'projectbudget'=>$budget,'currency'=>$currency,'hoursallocated'=>$hours,'archive'=>0);
				$this->common_model->insertData('tbl_project_info',$store);
				$this->session->set_flashdata('message_name', 'Project Insert sucessfully');
				redirect('Project/index');
			}	
		}
	}
			
	public function projectlist(){
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';
			$aColumns = array( 'id', 'projectname', 'deadline', 'clientid', 'status');
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
				}
			/*$sWhere.=' AND tbl_project_info.archive=0';	
			if(!empty($sWhere)){
				$sWhere = " WHERE 1 ".$sWhere;
			}*/
			/** Filtering End */
		}
		$query = "SELECT tbl_project_info.*,tbl_clients.clientname as clientname from tbl_project_info inner join tbl_clients on tbl_project_info.clientid = tbl_clients.id".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
		//echo($query);echo '<br/>';
		$projectArr = $this->common_model->coreQueryObject($query);
		$query = "SELECT tbl_project_info.*,tbl_clients.clientname as clientname from tbl_project_info inner join tbl_clients on tbl_project_info.clientid = tbl_clients.id".$sWhere;
		//echo($query);die;
		$ProjectFilterArr = $this->common_model->coreQueryObject($query);
		$iFilteredTotal = count($ProjectFilterArr);
		//$whereArr=array('archive'=>0);
		$ProjectAllArr = $this->common_model->getData('tbl_project_info');
		$iTotal = count($ProjectAllArr);
		
		/** Output */
		$datarow = array();

		$i = 1;
		foreach($projectArr as $row) {
			$rowid = $row->id;
			$whereArr = array('project_id' => $rowid);
			$p_member = $this->common_model->getData('tbl_project_member',$whereArr);
			$emp_str = '';
			foreach($p_member as $pm){
				$emp_id = $pm->emp_id;
				$whereArrEmp = array('id' => $emp_id);
				$emp_arr = $this->common_model->getData('tbl_employee',$whereArrEmp);
				$emp_name = substr($emp_arr[0]->employeename,0,1);
				$emp_str.= ucfirst($emp_name);
				
			}
		if($row->status=='1'){
			$status=$row->status='Complete';
			$showStatus = '<label class="label label-success">'.$status.'</label>';
		}
		else if($row->status=='0'){
			$status=$row->status='InComplete';
			$showStatus = '<label class="label label-warning">'.$status.'</label>';
		}
		else if($row->status=='2'){
			$status=$row->status='InProgress';
			$showStatus = '<label class="label label-inprogress">'.$status.'</label>';
		}
		else if($row->status=='3'){
			$status=$row->status='OnHold';
			$showStatus = '<label class="label label-onhold">'.$status.'</label>';
		}
		else{
			$status=$row->status='Canceled';
			$showStatus = '<label class="label label-danger">'.$status.'</label>';
		}
			$archive=$row->archive;
			$st = '';
			$string = '';
			if($archive == '1')
			{
				$st = 'Archive';
				$string = '<label class="label label-archieve">'.ucfirst($st).'</label>';
				$showStatus='';
			}
			
			if($archive == '1'){
				$actionstring = '<a href="javascript:void();" onclick="archivetoproject(\''.base64_encode($rowid).'\');" class="btn btn-info btn-circle revert" data-toggle="tooltip" data-user-id="14" data-original-title="Restore"><i class="fa fa-undo" aria-hidden="true"></i></a>
								 <a href="javascript:void();" onclick="deleteproject(\''.base64_encode($rowid).'\');"  class="btn btn-danger btn-circle sa-params" data-toggle="tooltip"  data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>';
			
			}
			else{
				$actionstring = '<a href='.base_url().'Project/editproject/'.base64_encode($row->id). ' class="btn btn-info btn-circle" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
								 <a href='.base_url().'Project/searchproject/'.base64_encode($row->id). ' class="btn btn-success btn-circle" data-toggle="tooltip" data-original-title="View Project Details"><i class="fa fa-search" aria-hidden="true"></i></a>
								 <a href="javascript:void();" onclick="archivedata(\''.base64_encode($rowid).'\');" class="btn btn-warning  btn-circle archive" data-toggle="tooltip" data-user-id="14" data-original-title="Archive"><i class="fa fa-archive" aria-hidden="true"></i></a>
								 <a href="javascript:void();" onclick="deleteproject(\''.base64_encode($rowid).'\');"  class="btn btn-danger btn-circle sa-params" data-toggle="tooltip"  data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>';
							}
		$datarow[] = array(
			$id = $i,
			$row->projectname.'<br/>'.$string.'<br/>'.$showStatus,
			"<a href='".base_url()."Project/searchproject/".base64_encode($rowid)."'> Add Project  Members</a>"
			.'<br/>'.$emp_str,
			$row->deadline,
			$row->clientname,
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
				
	public function deleteproject(){
		$id=base64_decode($_POST['id']);
		//echo($id);die;
		$whereArr=array('id'=>$id);
		$this->common_model->deleteData('tbl_project_info',$whereArr);
		//echo $this->db->last_query();die;
		$this->session->set_flashdata('message','Delete Succesfully....');
		redirect('project/index');
	}
	
	public function searchproject(){
		$data['id'] = base64_decode($this->uri->segment(3));
		$sql = "SELECT tbl_project_member.id as memberid , tbl_project_member.emp_id , tbl_employee.id ,tbl_employee.employeename from tbl_project_member inner join tbl_employee on tbl_project_member.emp_id = tbl_employee.id where project_id =".$data['id'];
		$data['member'] = $this->common_model->coreQueryObject($sql);
		$data['emp_count'] = count($data['member']);
		$data['employee'] = $this->common_model->getData('tbl_employee');
		$this->load->view('common/header');
		$this->load->view('project/searchproject',$data);
		$this->load->view('common/footer');
	}
			
	public function deletetemplate(){
		$id=base64_decode($_POST['id']);
		$whereArr=array('id'=>$id);
		$this->common_model->deleteData('tbl_project_template',$whereArr);
		$this->session->set_flashdata('message','Delete Succesfully....');
		redirect('project/projecttemplate');
	}
			
	public function archivedata(){
		$id=base64_decode($_POST['id']);
		$updateArr = array('archive'=>1);
		$whereArr=array('id'=>$id);
		$data['query']=$this->common_model->updateData('tbl_project_info',$updateArr,$whereArr);
		$this->session->set_flashdata('message_name', 'Archive Sucessfully');
		redirect('project/index');
	}
			
  
			
	/*public function viewarchiev(){
		$data['client']=$this->common_model->getData('tbl_clients');
		$this->load->view('common/header');
		$this->load->view('project/viewarchiev',$data);
		$this->load->view('common/footer');	
    }*/
	
	
	public function viewarchiev(){
		$id=base64_decode($_POST['id']);
		$updateArr = array('archive'=>1);
		$whereArr=array('id'=>$id);
		$data['query']=$this->common_model->updateData('tbl_project_info',$updateArr,$whereArr);
		//echo $this->db->last_query();die;
		redirect('project/index');
    }
			
	/*public function archivelist(){
		//echo('ytgvbhjn');die;
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';
			$aColumns = array( 'id', 'projectname', 'deadline', 'clientid', 'status');
			//'ahrefs_dr', 
			$totalColumns = count($aColumns);

			/** Paging Start 
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
			/** Ordering Start 
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
				
			/** Filtering Start 
			
			if(!empty(trim($_GET['sSearch']))){
				$searchTerm = trim($_GET['sSearch']);
				$sWhere.= ' AND (tbl_project_info.projectname like "%'.$searchTerm.'%" OR tbl_project_info.note like "%'.$searchTerm.'%" OR tbl_project_info.clientid like "%'.$searchTerm.'%" OR tbl_project_info.projectsummary like "%'.$searchTerm.'%" OR clientname like "%'.$searchTerm.'%")';
			}
			$status=$_POST['status2'];				
			$client=!empty($_POST['clientname2']) ? $_POST['clientname2'] : '';		
			//$category=!empty($_POST['categoryname1']) ? $_POST['categoryname1'] : '';
			
			if(!empty($client)){
					$sWhere.=' AND tbl_project_info.clientid='.$client;
			}
		/*	if(!empty($category)){						
				$sWhere.=' AND projectcategoryid='.$category;
			}
			if($status=='all'){
				}else{
						$sWhere.=' AND tbl_project_info.status='.$status;
				}
			$sWhere.=' AND tbl_project_info.archive=1';	
			if(!empty($sWhere)){
				$sWhere = " WHERE 1 ".$sWhere;
			}
			/** Filtering End 
		}
		$query = "SELECT tbl_project_info.*,tbl_clients.clientname as clientname from tbl_project_info inner join tbl_clients on tbl_project_info.clientid = tbl_clients.id".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
		//echo($query);die;
		$projectArr = $this->common_model->coreQueryObject($query);
		$query = "SELECT tbl_project_info.*,tbl_clients.clientname as clientname from tbl_project_info inner join tbl_clients on tbl_project_info.clientid = tbl_clients.id".$sWhere;
		
		$ProjectFilterArr = $this->common_model->coreQueryObject($query);
		$iFilteredTotal = count($ProjectFilterArr);
		$whereArr=array('archive'=>1);
		$ProjectAllArr = $this->common_model->getData('tbl_project_info',$whereArr);
		$iTotal = count($ProjectAllArr);
		
		$datarow = array();
		$i = 1;
		foreach($projectArr as $row) {
			$rowid = $row->id;
			if($row->status=='1'){
						$status=$row->status='Complete';
						}
					else if($row->status=='0'){
						$status=$row->status='InComplete';
						}
					else if($row->status=='2'){
						$status=$row->status='InProgress';
						}
					else if($row->status=='3'){
						$status=$row->status='OnHold ';
						}
					else{
						$status=$row->status='Canceled';
						}
		$datarow[] = array(
			$id = $i,
			$row->projectname,
			"<a href='".base_url()."P/tesmplate_data/".$id."'> Add Template Members</a>",
			$row->deadline,
			$row->clientname,
			$status,
			'
			<a href="javascript:void();" onclick="archivetoproject(\''.base64_encode($rowid).'\');" class="btn btn-info btn-circle revert" data-toggle="tooltip" data-user-id="14" data-original-title="Restore"><i class="fa fa-undo" aria-hidden="true"></i></a>
			<a href="javascript:void();" onclick="deleteproject(\''.base64_encode($rowid).'\');"  class="btn btn-danger btn-circle sa-params" data-toggle="tooltip"  data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>'
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
	}*/
			
	public function editproject(){	
		$id=base64_decode($this->uri->segment(3));
		$whereArr=array('id'=>$id);
		$data['editId']=$id;
		$data['projectinfo']=$this->common_model->getData('tbl_project_info',$whereArr);
		$data['category']=$this->common_model->getData('tbl_project_category');
		$data['client']=$this->common_model->getData('tbl_clients');
		$this->load->view('common/header');
		$this->load->view('project/editproject',$data);
		$this->load->view('common/footer');
		if($this->input->post('manual_timelog')=='on'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$timelog=$chk_value;
			
			if($this->input->post('project_member')=='on'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$member=$chk_value;
			
			if($this->input->post('client-view-tasks')=='on'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$view=$chk_value;
			
			if($this->input->post('tasks-notification')=='on'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$tasks=$chk_value;
			if(!empty($_POST))
			{	
			$name=$this->input->post('project_name');
			$cat=$this->input->post('project-category');
			$date=$this->input->post('start_date');
			$deadline=$this->input->post('deadline');
			$without=$this->input->post('without_deadline');
			$editor1=$this->input->post('editor1');
			$notes=$this->input->post('notes');
			$client=$this->input->post('select-client');
			$budget=$this->input->post('project-budget');
			$currency=$this->input->post('currency-id');
			$hours=$this->input->post('hours-allocated');	
			$status=$this->input->post('status');
			$updateArr=array('projectname'=>$name,'projectcategoryid'=>$cat,'startdate'=>$date,'manualtimelog'=>$timelog,
			'projectmember'=>$member,'deadline'=>$deadline,'clientid'=>$client,'viewtask'=>$view,
			'tasknotification'=>$tasks,'status'=>$status,'projectsummary'=>$editor1,'note'=>$notes,
			'projectbudget'=>$budget,'currency'=>$currency,'hoursallocated'=>$hours,'archive'=>0);
			$whereArr=array('id'=>$id);
			$this->common_model->updateData('tbl_project_info',$updateArr,$whereArr);
			$this->session->set_flashdata('message_name', 'Projects Updated sucessfully');
			redirect('project/index');
		}			
	}
		
	public function edittemplate(){
		$id=base64_decode($this->uri->segment(3));
		$whereArr=array('id'=>$id);
		$data['editId']=$id;
		$data['templateinfo']=$this->common_model->getData('tbl_project_template',$whereArr);
		$data['category']=$this->common_model->getData('tbl_project_category');
		$this->load->view('common/header');
		$this->load->view('project/edittemplate',$data);
		$this->load->view('common/footer');
		if($this->input->post('manual_timelog')=='1'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$timelog=$chk_value;
			
			if($this->input->post('client-view-tasks')=='1'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$view=$chk_value;
			
			if($this->input->post('tasks-notification')=='on'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$tasks=$chk_value;
		
		if($this->input->post('btnupdate')){
			$name=$this->input->post('project_name');
			$cat=$this->input->post('project-category');
			$summary=$this->input->post('editor1');
			$note=$this->input->post('notes');
			$updateArr=array('projectname'=>$name,'projectcategory'=>$cat,'manualtimelog'=>$timelog,'viewtask'=>$view,'projectsummary'=>$summary,'note'=>$note,'tasknotification'=>$tasks);
			$whereArr=array('id'=>$id);
			//echo "<pre>";print_r($_POST);die;
			$this->common_model->updateData('tbl_project_template',$updateArr,$whereArr);
			//echo $this->db->last_query();die;
			redirect('project/projecttemplate');
		}
	}
			
	public function deletearchiev(){
		$id=base64_decode($this->uri->segment(3));
		$deleteArr=array('id'=>$id);
		$this->common_model->deleteData('tbl_project_info',$deleteArr);
		$this->session->set_flashdata('message','Delete Succesfully....');
		redirect('project/viewarchiev');
	}
	
	public function projecttemplate(){
			$this->load->view('common/header');
			$this->load->view('project/projecttemplate');
			$this->load->view('common/footer');	
	}
		
	public function addtemplate(){
			$data['category']=$this->common_model->getData('tbl_project_category');
			$this->load->view('common/header');
			$this->load->view('project/addtemplate',$data);
			$this->load->view('common/footer');	
	}
			
	public function inserttemplate(){
		if(!empty($_POST)){
			if($this->input->post('manual_timelog')=='on'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$timelog=$chk_value;
			
			if($this->input->post('client-view-tasks')=='on'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$view=$chk_value;
			
			if($this->input->post('tasks-notification')=='on'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$tasks=$chk_value;
			$name=$this->input->post('project_name');
			$cat=$this->input->post('project-category');
			$editor=$this->input->post('editor1');
			$note=$this->input->post('notes');
			$insertArr=array('projectname'=>$name,'projectcategory'=>$cat,'manualtimelog'=>$timelog,
			'viewtask'=>$view,'projectsummary'=>$editor,'note'=>$note,'tasknotification'=>$tasks);
			$this->common_model->insertData('tbl_project_template',$insertArr);
			$whereArr=array('id'=>$id);
			$this->session->set_flashdata('message','Template Inserted Succesfully....');
			redirect('Project/projecttemplate');				
		}
	}
			
	public function templatelist(){
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';
			$aColumns = array( 'id', 'projectname', 'projectmember' , 'projectcategory');
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
					//$sWhere .= ' AND (companyname like "%'.$searchTerm.'%" OR website like "%'.$searchTerm.'%" OR address like "%'.$searchTerm.'%" OR clientname like "%'.$searchTerm.'%" OR clientemail like "%'.$searchTerm.'%" OR note like "%'.$searchTerm.'%")';
					$sWhere.= ' AND (tbl_project_template.projectname like "%'.$searchTerm.'%" OR tbl_project_category.name like "%'.$searchTerm.'%")';
				}
				if(!empty($sWhere)){
					$sWhere = " WHERE 1 ".$sWhere;
				}
				/** Filtering End */
				}
			
				$query = "SELECT tbl_project_template.*,tbl_project_category.name from tbl_project_template INNER JOIN tbl_project_category on tbl_project_template.projectcategory = tbl_project_category.id".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
				$templateArr = $this->common_model->coreQueryObject($query);
				//echo($query);die;
				$query = "SELECT tbl_project_template.*,tbl_project_category.name from tbl_project_template INNER JOIN tbl_project_category on tbl_project_template.projectcategory = tbl_project_category.id".$sWhere;
				$TemplateFilterArr = $this->common_model->coreQueryObject($query);
				$iFilteredTotal = count($TemplateFilterArr);
				$TemplateAllArr = $this->common_model->getData('tbl_project_template');
				$iTotal = count($TemplateAllArr);
			
				/** Output */
				$datarow = array();
				$i = 1;
				foreach($templateArr as $row) {
					$rowid = $row->id;	
					$whereArr = array('template_id' => $rowid);
					$temp_member = $this->common_model->getData('tbl_template_member',$whereArr);
					$emp_str = '';
					foreach($temp_member as $temp){
						$emp_id = $temp->emp_id;
						$whereArrEmp = array('id' => $emp_id);
						$emp_arr = $this->common_model->getData('tbl_employee',$whereArrEmp);
						$emp_name = substr($emp_arr[0]->employeename,0,1);
						$emp_str.= ucfirst($emp_name);
					}
					$datarow[] = array(
						$id = $i,
						$row->projectname,
						"<a href='".base_url()."Project/searchtemplate/".base64_encode($rowid)."'> Add Template  Members</a>".'<br/>'.$emp_str,
						
						$row->name,
						'<a href='.base_url().'Project/edittemplate/'.base64_encode($row->id). ' class="btn btn-info btn-circle" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
						 <a href='.base_url().'Project/searchproject/'.base64_encode($row->id). ' class="btn btn-success btn-circle" data-toggle="tooltip" data-original-title="View Project Details"><i class="fa fa-search" aria-hidden="true"></i></a>
						 <a href="javascript:void();" onclick="deletetemplate(\''.base64_encode($rowid).'\');"  class="btn btn-danger btn-circle sa-params" data-toggle="tooltip"  data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>'
					);
					$i++;
					}
					$output = array(
							   "sEcho" => intval($_POST['sEcho']),
							   "iTotalRecords" => $iTotal,
							   "iTotalRecordsFormatted" => number_format($iTotal), //ShowLargeNumber($iTotal),
							   "iTotalDisplayRecords" => $iFilteredTotal,
							   "aaData" => $datarow
							);
		echo json_encode($output);
		exit();
	}

	public function searchtemplate(){
		$data['id'] = base64_decode($this->uri->segment(3));
		$sql = "SELECT tbl_template_member.id as memberid,tbl_template_member.emp_id, tbl_employee.id ,tbl_employee.employeename from tbl_template_member inner join tbl_employee on tbl_template_member.emp_id = tbl_employee.id where template_id =".$data['id'];
		$data['temp_member'] = $this->common_model->coreQueryObject($sql);
		$data['emp_count'] = count($data['temp_member']);
		$data['employee'] = $this->common_model->getData('tbl_employee');
		$this->load->view('common/header');
		$this->load->view('project/searchtemplate',$data);
		$this->load->view('common/footer');
	}

	public function insertcat(){
		if(!empty($_POST)){
			$catname = $this->input->post('name');
			$insArr = array('name'=>$catname);
			$lastinsertid=$this->common_model->insertData('tbl_project_category',$insArr);
			$catArray = $this->common_model->getData('tbl_project_category');
			$str = '';
			foreach($catArray as $row){
				$str.='<option value="'.$row->id.'">'.$row->name.'</option>'; 
			}
			$totaldata = count($catArray);
			$catArr = array();
			$catArr['count'] = $totaldata;
			$catArr['catdata'] = $str;
			$catArr['lastinsertid']= $lastinsertid;
			//print_r($catArr);die;
			echo json_encode($catArr);exit; 
		}
	}
			
	public function deletecat(){
		$status = 0;
		if(!empty($_POST['id'])){
			$id=$this->input->post('id');
			$deleteArr=array('id'=>$id);
			$this->common_model->deleteData('tbl_project_category',$deleteArr);
			$status = 1;
		}
		echo $status;exit();
	}	

	public function checkcategory(){
		$status = 0;
		if(!empty($_POST['category'])){
			$where = array('name'=>$_POST['category']);
			$checkData = $this->common_model->getData('tbl_project_category',$where);
			if(!empty($checkData)){
				$status = 1;
			}
		}
		echo $status;exit();
	}

	public function insertProjectMember(){
		if(!empty($_POST)){
			$data['employee'] = $this->input->post('choose_member');
			
			$emp_count = count($data['employee']);
			$project_id = $this->input->post('projectid');
			for($i=0 ; $i<$emp_count; $i++){
				$emp_id = $data['employee'][$i];
				$whereArr = array('emp_id' => $emp_id);
				$projectM = $this->common_model->getData('tbl_project_member', $whereArr);
				if(count($projectM) == 1){
					$this->session->set_flashdata('message_name', 'Alredy add this member');
					redirect('Project/searchproject/'.$this->uri->segment(3));
				}
				else{
					$insArr = array('project_id' => $project_id , 'emp_id' => $emp_id);
					$this->common_model->insertData('tbl_project_member',$insArr);
				}
			}
		}
		redirect('Project/searchproject/'.$this->uri->segment(3));
	}

	public function insertTemplateMember(){
		if(!empty($_POST)){
			$data['employee'] = $this->input->post('choose_member');
			$emp_count = count($data['employee']);
			$template_id = $this->input->post('templateid');
			for($i=0 ; $i<$emp_count; $i++){
				$emp_id = $data['employee'][$i];
				$whereArr = array('emp_id' => $emp_id);
				$projectM = $this->common_model->getData('tbl_template_member', $whereArr);
				if(count($projectM) == 1){
					$this->session->set_flashdata('message_name', 'Alredy add this member');
					redirect('Project/searchtemplate/'.$this->uri->segment(3));
				}
				else{
					$insArr = array('template_id' => $template_id , 'emp_id' => $emp_id);
					$this->common_model->insertData('tbl_template_member',$insArr);
				}
			}
		}
		redirect('Project/searchtemplate/'.$this->uri->segment(3));

	}

	public function deletetemplateM(){
		$id = base64_decode($_POST['id']);
		$whereArr = array('id' => $id);
		$this->common_model->deleteData('tbl_template_member',$whereArr);
	}
	
	public function deleteprojectM(){
		$id = base64_decode($_POST['id']);
		$whereArr = array('id' => $id);
		$this->common_model->deleteData('tbl_project_member',$whereArr);
	}
}		
