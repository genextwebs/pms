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
			
				$status=$_POST['status1'];	
	//echo($status1);die;				
				$client=!empty($_POST['clientname1']) ? $_POST['clientname1'] : '';		
				$category=!empty($_POST['categoryname1']) ? $_POST['categoryname1'] : '';
				$whereStr= '';
				if(!empty($whereStr)){
						$tempStr=' AND ';
				}
				else{
						$tempStr=' where ';
				}
				$whereStr=$tempStr.' tbl_project_info.archive=0';
				if(!empty($client)){
					if(!empty($whereStr)){
						$tempStr=' AND ';
					}
					else{
						$tempStr=' where ';
					}
					$whereStr.=$tempStr.'tbl_project_info.clientid='.$client;
				}
				if(!empty($category)){
					if(!empty($whereStr)){
						$tempStr=' AND ';
					}
					else{
						$tempStr=' where ';
					}
					$whereStr.=$tempStr.'projectcategoryid='.$category;
				}
				if($status=='all'){
					
				}
				else{
					if(!empty($whereStr)){
						$tempStr=' AND ';
					}
					else{
						$tempStr=' where ';
					}
					$whereStr.=$tempStr.'tbl_project_info.status='.$status;
				}
				$searchTerm = $_POST['sSearch'];
				if(!empty($searchTerm)){
					$whereStr.= ' AND (tbl_project_info.projectname like "%'.$searchTerm.'%" OR tbl_project_info.note like "%'.$searchTerm.'%" OR tbl_clients.clientname like "%'.$searchTerm.'%" OR tbl_project_info.projectsummary like "%'.$searchTerm.'%" )';
				}
				$query="SELECT tbl_project_info.id,deadline,tbl_project_info.clientid,projectname,projectsummary,tbl_project_info.status FROM tbl_project_info INNER JOIN  tbl_clients ON tbl_project_info.clientid =tbl_clients.id ". $whereStr;
				//echo($query);die;
				$data['result'] = $this->common_model->coreQueryObject($query);
				
				$datarow=array();
				foreach($data['result'] as $project)
				{
					if($project->status=='1'){
						$status=$project->status='Complete';
						}
					else{
						$status=$project->status='InComplete';
						}
					$whereArr = array('id'=> $project->clientid);
					$clientArr = $this->common_model->getData('tbl_clients', $whereArr);
					$datarow[] = array
					(
						$id=$project->id,
						$project->projectname,
						"<a href='".base_url()."P/template_data/".$id."'> Add Template Members</a>",
						$project->deadline,
						$clientArr[0]->clientname,
						$status,
						'<a href='.base_url().'Project/editproject/'.base64_encode($id). ' class="btn btn-info btn-circle" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
						<a href="project-details.html" class="btn btn-success btn-circle" data-toggle="tooltip" data-original-title="View Project Details"><i class="fa fa-search" aria-hidden="true"></i></a>
						<a href='.base_url().'Project/archivedata/'.base64_encode($id).' onclick="javascript:return confirm(\'Are u Sure want to Archive?\');"  class="btn btn-warning  btn-circle archive" data-toggle="tooltip" data-user-id="1" data-original-title=" Archive"><i class="fa fa-archive" aria-hidden="true"></i></a>
						<a href='.base_url().'Project/deleteproject/'.base64_encode($id).' onclick="javascript:return confirm(\'Are u Sure want to delete?\');" class="btn btn-danger btn-circle sa-params" data-toggle="tooltip" data-user-id="1" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>'							
					);	
				}			
				$data['alldata']=$this->common_model->getData('tbl_project_info');
				//echo '<pre>';print_r($data);die;
				$iTotal=count($data['alldata']);
				$output = array
				(
				   "sEcho" => intval($_POST['sEcho']),
				   "iTotalRecords" => $iTotal,
				   "iTotalRecordsFormatted" => number_format($iTotal), //ShowLargeNumber($iTotal),
				   "iTotalDisplayRecords" => count($data['alldata']),
				   "aaData" => $datarow
				);   
				echo json_encode($output);
				exit();
			}
			public function deleteproject(){
				$id=base64_decode($this->uri->segment(3));
				$deleteArr=array('id'=>$id);
				$this->common_model->deleteData('tbl_project_info',$deleteArr);
				$this->session->set_flashdata('message','Delete Succesfully....');
				redirect('Category/project');
			}
			public function editproject(){
				
				$id=base64_decode($this->uri->segment(3));
					//echo '<pre>';print_r($id);die;
				$whereArr=array('id'=>$id);
				$data['editId']=$id;
				$data['projectinfo']=$this->common_model->getData('tbl_project_info',$whereArr);
				$data['category']=$this->common_model->getData('tbl_project_category');
				$data['client']=$this->common_model->getData('tbl_clients');
				//echo "<pre>";print_r($data);die;
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
					
					$updateArr=array('projectname'=>$name,'projectcategoryid'=>$cat,'startdate'=>$date,'deadline'=>$deadline,'clientid'=>$client,
					'status'=>0,'projectsummary'=>$editor1,'note'=>$notes,
					'projectbudget'=>$budget,'currency'=>$currency,'hoursallocated'=>$hours,'archive'=>0);
					
					$whereArr=array('id'=>$id);
					//echo '<pre>';print_r($whereArr);die;
					$this->common_model->updateData('tbl_project_info',$updateArr,$whereArr);
					//echo $this->db->last_query();die;
				
					redirect('project/index');
				}			
			}
		
			public function projecttemplate(){
					$this->load->view('common/header');
					$this->load->view('project/projecttemplate');
					$this->load->view('common/footer');	
			}
			
			public function addtemplate(){
					//$data['category']=$this->common_model->getData('tbl_project_category');
					$this->load->view('common/header');
					$this->load->view('project/addtemplate');
					$this->load->view('common/footer');	
			}
			/*public function inserttemplate(){
				if($this->input->post('btnsave')){
					$name=$this->input->post('project_name');
					$cat=$this->input->post('project-category');
					$date=$this->input->post('editor1');
					$deadline=$this->input->post('notes');
					
				}
			}*/

			
				
			public function archivedata(){
				$id=base64_decode($this->uri->segment(3));
				$updateArr = array('archive'=>1);
				$whereArr=array('id'=>$id);
				$data['query']=$this->common_model->updateData('tbl_project_info',$updateArr,$whereArr);
				redirect('project/index');
			}
			
			public function viewarchiev(){
					$data['client']=$this->common_model->getData('tbl_clients');
					$this->load->view('common/header');
					$this->load->view('project/viewarchiev',$data);
					$this->load->view('common/footer');	
			}
			
			public function archivelist(){
					$status=$_POST['projectstatus'];	
					//echo($status);die;
					$client=!empty($_POST['clientname1']) ? $_POST['clientname1'] : '';	
					$whereStr='';
					if(!empty($whereStr)){
					$tempStr=' AND ';
					}
					else{
						$tempStr=' where ';
					}
					$whereStr=$tempStr.' tbl_project_info.archive=1';
	
					if(!empty($client)){
						if(!empty($whereStr)){
							$tempStr=' AND ';
						}
						else{
							$tempStr=' where ';
						}
						$whereStr.=$tempStr.' clientid='.$client;
					}
				if($status=='all'){ }
					else
					{
						if(!empty($whereStr)){
							$tempStr=' AND ';
						}
						else{
							$tempStr=' where ';
						}
						$whereStr.=$tempStr.'tbl_project_info.status='.$status;
					}
					$searchTerm = $_POST['sSearch'];
					if(!empty($searchTerm)){
						$whereStr.= ' AND (tbl_project_info.projectname like "%'.$searchTerm.'%" OR tbl_project_info.note like "%'.$searchTerm.'%" OR tbl_project_info.projectsummary like "%'.$searchTerm.'%" )';
					}	
					$query="SELECT tbl_project_info.id,deadline,tbl_project_info.clientid,projectname,projectsummary,tbl_project_info.status FROM tbl_project_info INNER JOIN  tbl_clients ON tbl_project_info.clientid =tbl_clients.id ". $whereStr;
					//echo $query;die;
					$data['result'] = $this->common_model->coreQueryObject($query);
					$whereArr = array('id'=> $project->clientid);
					$clientArr = $this->common_model->getData('tbl_clients', $whereArr);
					$datarow=array();
					foreach($data['result'] as $project){
						$datarow[] = array
					(
						$id=$project->id,
						$project->projectname,
						//s"<a href='".base_url()."P/template_data/".$id."'> Add Template Members</a>",
						$project->deadline,
						$clientArr[0]->clientname,
						$status,
						'<a href='.base_url().'Project/archivedata/'.base64_encode($id).' onclick="javascript:return confirm(\'Are u Sure want to delete?\');"  class="btn btn-warning  btn-circle archive" data-toggle="tooltip" data-user-id="1" data-original-title=" Archive"><i class="fa fa-archive" aria-hidden="true"></i></a>
						<a href='.base_url().'Project/deleteproject/'.base64_encode($id).' onclick="javascript:return confirm(\'Are u Sure want to delete?\');" class="btn btn-danger btn-circle sa-params" data-toggle="tooltip" data-user-id="1" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>'							
					);	
					}
					$data['alldata']=$this->common_model->getData('tbl_project_info');
					$iTotal=count($data['alldata']);
					$output = array
					(
					   "sEcho" => intval($_POST['sEcho']),
					   "iTotalRecords" => $iTotal,
					   "iTotalRecordsFormatted" => number_format($iTotal), //ShowLargeNumber($iTotal),
					   "iTotalDisplayRecords" => count($data['alldata']),
					   "aaData" => $datarow
					);   
					echo json_encode($output);
					exit();
				}
}