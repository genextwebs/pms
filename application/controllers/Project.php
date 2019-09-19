<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

			public function __construct(){
				parent::__construct();
				$this->load->model('common_model');
			}
			
			public function index(){
				$data['category']=$this->common_model->getData('tbl_project_category');
				$data['client']=$this->common_model->getData('tbl_clients');
				
				$this->load->view('common/header');
				$this->load->view('project/project',$data);
				$this->load->view('common/footer');
			}
			
			public function addproject(){
				$data['client']=$this->common_model->getData('tbl_clients');
				$data['category']=$this->common_model->getData('tbl_project_category');
				$this->load->view('common/header');
				$this->load->view('project/addproject',$data);
				$this->load->view('common/footer');
			}
			
			public function insertproject(){
				if($this->input->post('btnsave'))
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
					$client=$this->input->post('select-client');
					$budget=$this->input->post('project-budget');
					$currency=$this->input->post('currency-id');
					$hours=$this->input->post('hours-allocated');	
					$store=array('projectname'=>$name,'projectcategoryid'=>$cat,'startdate'=>$date,'manualtimelog'=>$timelog,
					'projectmember'=>$member,'deadline'=>$deadline,'clientid'=>$client,'viewtask'=>$view,
					'tasknotification'=>$tasks,'status'=>0,'projectsummary'=>$editor1,'note'=>$notes,
					'projectbudget'=>$budget,'currency'=>$currency,'hoursallocated'=>$hours,'archive'=>0);
					$this->common_model->insertData('tbl_project_info',$store);
					$this->session->set_flashdata('message','Insert Succesfully....');
					redirect('Project/index');
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
						$sWhere.= ' AND (tbl_project_info.projectname like "%'.$searchTerm.'%" OR tbl_project_info.note like "%'.$searchTerm.'%" OR tbl_project_info.clientid like "%'.$searchTerm.'%" OR tbl_project_info.projectsummary like "%'.$searchTerm.'%" )';
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
					$sWhere.=' AND tbl_project_info.archive=0';	
					if(!empty($sWhere)){
						$sWhere = " WHERE 1 ".$sWhere;
					}
					/** Filtering End */
				}
				$query = "SELECT tbl_project_info.*,tbl_clients.clientname from tbl_project_info inner join tbl_clients on tbl_project_info.clientid = tbl_clients.id".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
				$projectArr = $this->common_model->coreQueryObject($query);
				$query = "SELECT * from tbl_project_info ".$sWhere;
				$ProjectFilterArr = $this->common_model->coreQueryObject($query);
				$iFilteredTotal = count($ProjectFilterArr);
				$ProjectAllArr = $this->common_model->getData('tbl_project_info');
				$iTotal = count($ProjectAllArr);

				/** Output */
				$datarow = array();
				$i = 1;
				foreach($projectArr as $row) {
					$id = $row->id;
					if($row->status=='1'){
								$status=$row->status='Complete';
								}
							else{
								$status=$row->status='InComplete';
								}
						$datarow[] = array(
					$id = $i,
					//$id=$row->id,
					$row->projectname,
					"<a href='".base_url()."P/template_data/".$id."'> Add Template Members</a>",
					$row->deadline,
					$row->clientname,
					//	 $clientArr[0]->clientname,
					$status,
					'<a href='.base_url().'Project/editproject/'.base64_encode($row->id). ' class="btn btn-info btn-circle" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
					<a href="project-details.html" class="btn btn-success btn-circle" data-toggle="tooltip" data-original-title="View Project Details"><i class="fa fa-search" aria-hidden="true"></i></a>
					<a href='.base_url().'Project/archivedata/'.base64_encode($row->id).' onclick="javascript:return confirm(\'Are u Sure want to Archive?\');"  class="btn btn-warning  btn-circle archive" data-toggle="tooltip" data-user-id="1" data-original-title=" Archive"><i class="fa fa-archive" aria-hidden="true"></i></a>
					<a href='.base_url().'Project/deleteproject/'.base64_encode($row->id).' onclick="javascript:return confirm(\'Are u Sure want to delete?\');" class="btn btn-danger btn-circle sa-params" data-toggle="tooltip" data-user-id="1" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>'							
							
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
				
			public function deleteproject(){//client->client_list->delete_client
				$id=base64_decode($this->uri->segment(3));
				$deleteArr=array('id'=>$id);
				$this->common_model->deleteData('tbl_project_info',$deleteArr);
				$this->session->set_flashdata('message','Delete Succesfully....');
				redirect('project/index');
			}
			
			public function archivedata(){
				$id=base64_decode($this->uri->segment(3));
				$updateArr = array('archive'=>1);
				$whereArr=array('id'=>$id);
				$data['query']=$this->common_model->updateData('tbl_project_info',$updateArr,$whereArr);
				redirect('project/index');
			}
			
		public function archivetoproject(){
				$id=base64_decode($this->uri->segment(3));
				$updateArr = array('archive'=>0);
				$whereArr=array('id'=>$id);
				$data['query']=$this->common_model->updateData('tbl_project_info',$updateArr,$whereArr);
				redirect('project/viewarchiev');
			}
			
			public function viewarchiev(){
					$data['client']=$this->common_model->getData('tbl_clients');
					$this->load->view('common/header');
					$this->load->view('project/viewarchiev',$data);
					$this->load->view('common/footer');	
			}
			
			public function archivelist(){
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
						$sWhere.= ' AND (tbl_project_info.projectname like "%'.$searchTerm.'%" OR tbl_project_info.note like "%'.$searchTerm.'%" OR tbl_project_info.clientid like "%'.$searchTerm.'%" OR tbl_project_info.projectsummary like "%'.$searchTerm.'%" )';
					}
					$status=$_POST['status2'];				
					$client=!empty($_POST['clientname2']) ? $_POST['clientname2'] : '';		
					//$category=!empty($_POST['categoryname1']) ? $_POST['categoryname1'] : '';
					
					if(!empty($client)){
							$sWhere.=' AND tbl_project_info.clientid='.$client;
					}
					if($status=='all'){
						}else{
								$sWhere.=' AND tbl_project_info.status='.$status;
						}
					$sWhere.=' AND tbl_project_info.archive=1';	
					if(!empty($sWhere)){
						$sWhere = " WHERE 1 ".$sWhere;
					}
					/** Filtering End */
				$query = "SELECT tbl_project_info.*,tbl_clients.clientname from tbl_project_info inner join tbl_clients on tbl_project_info.clientid = tbl_clients.id".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
					//echo($query);die;
				$projectArr = $this->common_model->coreQueryObject($query);
				$query = "SELECT * from tbl_project_info ".$sWhere;
				
				$ProjectFilterArr = $this->common_model->coreQueryObject($query);
				$iFilteredTotal = count($ProjectFilterArr);
				$ProjectAllArr = $this->common_model->getData('tbl_project_info');
				$iTotal = count($ProjectAllArr);
				/** Output */
				$datarow = array();
				$i = 1;
				foreach($projectArr as $row) {
					$id = $row->id;
					if($row->status=='1'){
								$status=$row->status='Complete';
								}
							else{
								$status=$row->status='InComplete';
								}
				$datarow[] = array(
				$id = $i,
				//$id=$row->id,
				$row->projectname,
				"<a href=''> Add Template Members</a>",
				$row->deadline,
				$row->clientname,
				//	 $clientArr[0]->clientname,
				$status,
				
				'<a href='.base_url().'Project/archivetoproject/'.base64_encode($row->id).' class="btn btn-info btn-circle revert" data-toggle="tooltip" data-user-id="17" data-original-title="Restore" aria-describedby="tooltip624748"><i class="fa fa-undo" aria-hidden="true"></i></a>
				<a href='.base_url().'Project/deletearchiev/'.base64_encode($row->id).' onclick="javascript:return confirm(\'Are u Sure want to delete?\');" class="btn btn-danger btn-circle sa-params" data-toggle="tooltip" data-user-id="1" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>'							);
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
			}
			
			public function editproject(){	
				$id=base64_decode($this->uri->segment(3));
					//echo '<pre>';print_r($id);die;
				$whereArr=array('id'=>$id);
				$data['editId']=$id;
				$data['projectinfo']=$this->common_model->getData('tbl_project_info',$whereArr);
				//echo $this->db->last_query();die;
				//echo "<pre>";print_r($data);die;
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
					if($this->input->post('btnedit'))
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
					$updateArr=array('projectname'=>$name,'projectcategoryid'=>$cat,'startdate'=>$date,'manualtimelog'=>$timelog,
					'projectmember'=>$member,'deadline'=>$deadline,'clientid'=>$client,'viewtask'=>$view,
					'tasknotification'=>$tasks,'status'=>0,'projectsummary'=>$editor1,'note'=>$notes,
					'projectbudget'=>$budget,'currency'=>$currency,'hoursallocated'=>$hours,'archive'=>0);
				/*	$updateArr=array('projectname'=>$name,'projectcategoryid'=>$cat,'startdate'=>$date,'deadline'=>$deadline,'clientid'=>$client,
					'status'=>0,'projectsummary'=>$editor1,'note'=>$notes,
					'projectbudget'=>$budget,'currency'=>$currency,'hoursallocated'=>$hours,'archive'=>0);*/
					$whereArr=array('id'=>$id);
					//echo '<pre>';print_r($whereArr);die;
					$this->common_model->updateData('tbl_project_info',$updateArr,$whereArr);
					//echo $this->db->last_query();die;
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
				if($this->input->post('btnupdate')){
					$name=$this->input->post('project_name');
					$cat=$this->input->post('project-category');
					$summary=$this->input->post('summary');
					$note=$this->input->post('notes');
					$updateArr=array('projectname'=>$name,'projectcategory'=>$cat,'projectsummary'=>$summary,'note'=>$note);
					$whereArr=array('id'=>$id);
					print_r($updateArr);
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
					$name=$this->input->post('project_name');
					$cat=$this->input->post('project-category');
					$editor=$this->input->post('editor1');
					$note=$this->input->post('notes');
					$insertArr=array('projectname'=>$name,'projectcategory'=>$cat,'projectsummary'=>$editor,'note'=>$note);
					$this->common_model->insertData('tbl_project_template',$insertArr);
					//echo $this->db->last_query();die;
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
							//$sWhere .= ' AND (companyname like "%'.$searchTerm.'%" OR website like "%'.$searchTerm.'%" OR address like "%'.$searchTerm.'%" OR clientname like "%'.$searchTerm.'%" OR clientemail like "%'.$searchTerm.'%" OR note like "%'.$searchTerm.'%")';
							$sWhere.= ' AND (tbl_project_template.projectname like "%'.$searchTerm.'%" OR tbl_project_category.name like "%'.$searchTerm.'%")';
						}
						if(!empty($sWhere)){
							$sWhere = " WHERE 1 ".$sWhere;
						}
						/** Filtering End */
						}
						//$query = "SELECT tbl_project_info.*,tbl_clients.clientname from tbl_project_info inner join tbl_clients on tbl_project_info.clientid = tbl_clients.id".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
						$query = "SELECT tbl_project_template.*,tbl_project_category.name from tbl_project_template INNER JOIN tbl_project_category on tbl_project_template.projectcategory = tbl_project_category.id".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
						$templateArr = $this->common_model->coreQueryObject($query);
						$query = "SELECT * from tbl_project_template ".$sWhere;
						$TemplateFilterArr = $this->common_model->coreQueryObject($query);
						$iFilteredTotal = count($TemplateFilterArr);
						$TemplateAllArr = $this->common_model->getData('tbl_project_template');
						$iTotal = count($TemplateAllArr);
					//	print_r($TemplateAllArr);die;
						/** Output */
						$datarow = array();
						$i = 1;
						foreach($templateArr as $row) {
							$id = $row->id;
							//$whereArr = array('id'=> $row->clientid);
							//$clientArr = $this->common_model->getData('tbl_clients', $whereArr);		
							$datarow[] = array(
								$id = $i,
								//$id=$project->id,
								$row->projectname,
								$row->name,
									
										'<a href='.base_url().'Project/edittemplate/'.base64_encode($row->id). ' class="btn btn-info btn-circle" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
										<a href="project-details.html" class="btn btn-success btn-circle" data-toggle="tooltip" data-original-title="View Project Details"><i class="fa fa-search" aria-hidden="true"></i></a>
										<a href='.base_url().'Project/archivedata/'.base64_encode($id).' onclick="javascript:return confirm(\'Are u Sure want to Archive?\');"  class="btn btn-warning  btn-circle archive" data-toggle="tooltip" data-user-id="1" data-original-title=" Archive"><i class="fa fa-archive" aria-hidden="true"></i></a>
										<a href='.base_url().'Project/deleteproject/'.base64_encode($id).' onclick="javascript:return confirm(\'Are u Sure want to delete?\');" class="btn btn-danger btn-circle sa-params" data-toggle="tooltip" data-user-id="1" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>'							
								
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

					
				
			
				
}		
