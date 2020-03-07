<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {

	public function __construct(){
		parent::__construct();
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$this->load->model('common_model');
		$this->login = $this->session->userdata('login');
		$this->user_type = $this->login->user_type;
		func_check_login();
	}

	public function index(){
		$data['s_date']=date('Y-m-d',strtotime('-1 month'));
		$data['e_date']=date('Y-m-d');
		$data['tickettype']=$this->common_model->getData('tbl_ticket_type');
		$data['ticketchannel']=$this->common_model->getData('tbl_ticket_channel');
		$this->load->view('common/header');
		$this->load->view('ticket/ticket',$data);
		$this->load->view('common/footer');
	}

	public function addticket(){
		$data['tickettype']=$this->common_model->getData('tbl_ticket_type');
		$data['ticketchannel']=$this->common_model->getData('tbl_ticket_channel');
		 $data['getemployee']=$this->common_model->getData('tbl_employee');
		$this->load->view('common/header');
		$this->load->view('ticket/addticket',$data);
		$this->load->view('common/footer');
	}

	public function insertticket(){
		if(!empty($_POST)){

			$t_subject = $this->input->post('ticket_subject'); 
			$t_editor  = $this->input->post('editor2');
			$status   = $this->input->post('status');
			$t_requestname = $this->input->post('requestername');
			$t_agentname = $this->input->post('agentname');
			$t_question = $this->input->post('question');
			$t_priority = $this->input->post('priority');
			$t_channel = $this->input->post('channel');
			$t_tags =  $this->input->post('tags');

			$file = $_FILES['ticket_Image']['name'];
			$file_loc = $_FILES['ticket_Image']['tmp_name'];
			$file_size = $_FILES['ticket_Image']['size'];
			$file_type = $_FILES['ticket_Image']['type'];
			$folder="uploads/";
			move_uploaded_file($file_loc,$folder.$file);
			$insArr  = array('ticketsubject'=>$t_subject,'ticketdescription'=>$t_editor,'status'=>$status, 'ticketimage'=>$file,'requestername'=>$t_requestname,'agent'=>$t_agentname,'type'=>$t_question,'priority'=>$t_priority,'channelname'=>$t_channel,'tags'=>$t_tags);
			$query  =  $this->common_model->insertData('tbl_ticket',$insArr);
			$this->session->set_flashdata('message_name','Ticket Inserted Successfully...');
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
			$aColumns = array( 'id', 'ticketsubject', 'ticketdescription', 'ticketimage', 'requestername' ,'agent' , 'type' , 'priority' ,'status','channelname' , 'tags');
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
				$sWhere.= ' AND (ticketsubject like "%'.$searchTerm.'%")';
			}

		/*	if(!empty(trim($_POST['s_date']))){
				$startdate=!empty($_POST['s_date']) ? $_POST['s_date'] : '';
			}else{
				$startdate=date('Y-m-d',strtotime('-1 month'));
			}
			if(!empty(trim($_POST['e_date']))){ 
				$enddate=!empty($_POST['e_date']) ? $_POST['e_date'] : '';
			}else{
				$enddate=date('Y-m-d');
			}*/
			$sdate=!empty($_POST['s_date'])?$_POST['s_date']:'';
			$enddate=!empty($_POST['e_date'])?$_POST['e_date']:'';
		
	        $status=!empty($_POST['status1'])? $_POST['status1'] : '';
			$priority=!empty($_POST['priority']) ? $_POST['priority'] : '';
			$cname=!empty($_POST['channelname']) ? $_POST['channelname'] : '';
			$type=!empty($_POST['tickettype']) ? $_POST['tickettype'] : '';
			if(!empty($sdate)){
				$sWhere.= 'AND created_at >="'.$sdate.'"';
			}
			if(!empty($enddate)){
				$sWhere.= 'AND created_at<="'.$enddate.'"';
			}

			if($status =='all'){
				}
			else if(!empty($status)){						
				$sWhere.=' AND tbl_ticket.status='.$status;
			}
			if($priority =='all'){
				}
			else if(!empty($priority)){						
				$sWhere.=' AND tbl_ticket.priority='.$priority;
			}
			if($cname =='all'){
				}
			else if(!empty($cname)){						
				$sWhere.=' AND tbl_ticket.channelname='.$cname;
			}
			if($type =='all'){
				}
			else if(!empty($type)){					
				$sWhere.=' AND tbl_ticket.type='.$type;
			    }
			$sWhere = " WHERE 1 ".$sWhere;
		}
		if($this->user_type == 0){
			
			$query = "SELECT tbl_ticket.* FROM tbl_ticket".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
			$TicketArr = $this->common_model->coreQueryObject($query);

			$query = "SELECT tbl_ticket.*,tbl_ticket_channel.name as channel,tbl_ticket_type.name as type FROM tbl_ticket inner join tbl_ticket_channel on tbl_ticket.channelname=tbl_ticket_channel.id inner join tbl_ticket_type on tbl_ticket.type=tbl_ticket_type.id".$sWhere;

		}else if($this->user_type == 1){
			$query = "SELECT tbl_ticket.* FROM tbl_ticket".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
			$TicketArr = $this->common_model->coreQueryObject($query);

			$query = "SELECT tbl_ticket.*,tbl_ticket_channel.name as channel,tbl_ticket_type.name as type FROM tbl_ticket inner join tbl_ticket_channel on tbl_ticket.channelname=tbl_ticket_channel.id inner join tbl_ticket_type on tbl_ticket.type=tbl_ticket_type.id".$sWhere;

		}else if($this->user_type == 2){
			$query = "SELECT tbl_ticket.* FROM tbl_ticket".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
			$TicketArr = $this->common_model->coreQueryObject($query);

			$query = "SELECT tbl_ticket.*,tbl_ticket_channel.name as channel,tbl_ticket_type.name as type FROM tbl_ticket inner join tbl_ticket_channel on tbl_ticket.channelname=tbl_ticket_channel.id inner join tbl_ticket_type on tbl_ticket.type=tbl_ticket_type.id".$sWhere;	
		}
		
		//echo $this->db->last_query();die;
		
		$TicketFilterArr = $this->common_model->coreQueryObject($query);
		//echo $this->db->last_query();die;
		$iFilteredTotal = count($TicketFilterArr);
		$TicketAllArr = $this->common_model->getData('tbl_ticket');
		$iTotal = count($TicketAllArr);
		
		/** Output */
		$datarow = array();
		$i = 1;
		foreach($TicketArr as $row) {
			$rowid = $row->id;
			//echo($rowid);die;
			if($this->user_type == 0){
			$actionstring = '<div class="dropdown action m-r-10">
				                <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">Action  <span class="caret"></span></button>
				                		<div class="dropdown-menu">
						                    <a  class="dropdown-item" href="'.base_url().'ticket/editticket/'.base64_encode($row->id).'";><i class="fa fa-edit"></i> Edit</a>

						                    <a  href="javascript:void();" onclick="deleteticket(\''.base64_encode($row->id).'\');" class="dropdown-item" href="javascript:void()"><i class="fa fa-trash" ></i> Delete</a>
						                    
				               			 </div>
							</div>';
			}else if($this->user_type == 1){
				$actionstring ='<p>view</p>';

			}else if($this->user_type == 2){
				$actionstring ='<p>view</p>';
			}
			//For Priority
			if($row->priority=='1'){
				$priority=$row->priority='Low';
				$showStatus = '<label class="label label-success">'.$priority.'</label>';
			}
			else if($row->priority=='2'){
				$priority=$row->priority='High';
				$showStatus = '<label class="label label-warning">'.$priority.'</label>';
			}
			else if($row->priority=='3'){
				$prioritypriority=$row->priority='Medium';
				$showStatus = '<label class="label label-warning">'.$priority.'</label>';
			}
			else if($row->priority=='4'){
				$priority=$row->priority='Urgent';
				$showStatus = '<label class="label label-warning">'.$priority.'</label>';
			}

			//For Status
			if($row->status=='1'){
				$status=$row->status='Open';
				$showStatus = '<label class="label label-success">'.$status.'</label>';
			}
			else if($row->status=='2'){
				$status=$row->status='Pending';
				$showStatus = '<label class="label label-success">'.$status.'</label>';
			}
			else if($row->status=='3'){
				$status=$row->status='Resolved';
				$showStatus = '<label class="label label-success">'.$status.'</label>';
			}

			else if($row->status=='4'){
				$status=$row->status='Close';
				$showStatus = '<label class="label label-success">'.$status.'</label>';
			}
		

			$datarow[] = array(
				$id = $i,
				$row->ticketsubject,
				$row->requestername,
				$row->created_at,
			   
			    '<b>Agent:</b>'.$row->agent.
			    	'<br/> <b>Staus:</b> <label class="label label-success">'.$row->status.'</label><br/>
			        <label><b>Priority:</b></label>'.$row->priority,
				$actionstring
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

	public function editticket(){
		$id=base64_decode($this->uri->segment(3));
		$whereArr=array('id'=>$id);
		$data['editticketId']=$id;
	    $data['ticketinfo']=$this->common_model->getData('tbl_ticket',$whereArr);
	    $data['tickettype']=$this->common_model->getData('tbl_ticket_type');
	   $data['getemployee']=$this->common_model->getData('tbl_employee');
		$data['ticketchannel']=$this->common_model->getData('tbl_ticket_channel');
		
		//$data['ticketcomment']=$this->common_model->getData('tbl_ticket_comment');
		/*
		$query ="SELECT tbl_ticket.*,tbl_ticket_comment.comment,tbl_employee.id,tbl_user.profileimg FROM `tbl_ticket` inner join tbl_employee on tbl_ticket.requestername = tbl_employee.id inner join tbl_user on tbl_employee.user_id=tbl_user.id inner join tbl_ticket_comment on tbl_ticket.requestername =tbl_ticket_comment.ticketemployeeid";*/
	//echo($query);die;
		/*$query= "Select comment from tbl_ticket_comment inner join tbl_employee on tbl_ticket_comment.ticketemployeeid= tbl_employee.id inner join tbl_user on tbl_employee.id=tbl_ticket_comment.ticketemployeeid";*/	
		/*$query = "Select comment,tbl_employee.user_id from tbl_ticket_comment inner join tbl_employee on tbl_ticket_comment.ticketemployeeid= tbl_employee.id";*/
		$query= "Select tbl_ticket_comment.*,tbl_employee.user_id,profileimg from tbl_ticket_comment inner join tbl_employee on tbl_ticket_comment.ticketemployeeid= tbl_employee.id inner join tbl_user on tbl_employee.user_id=tbl_user.id";

		$data['ticketcommenttest'] = $this->common_model->coreQueryObject($query);
		$this->load->view('common/header');
		$this->load->view('ticket/editticket',$data);
		$this->load->view('common/footer');

	  
	}

	public function deleteticket(){

		$id = base64_decode($_POST['id']);
		$whereArr = array('id' => $id);
		$this->common_model->deleteData('tbl_ticket',$whereArr);
		$this->session->set_flashdata('message','Delete Succesfully....');
		redirect('ticket/index');
	}

	public function insert_t_type(){

		if(!empty($_POST)){
			$tname = $this->input->post('name');
			$insArr = array('name'=>$tname);
			$typeid=$this->common_model->insertData('tbl_ticket_type',$insArr);
			$catArray = $this->common_model->getData('tbl_ticket_type');
			$str = '';
			foreach($catArray as $row){
				$str.='<option value="'.$row->id.'">'.$row->name.'</option>'; 
			}
			$totaldata = count($catArray);
			$catArr = array();
			$catArr['count'] = $totaldata;
			$catArr['ticketdata'] = $str;
			$catArr['typeid']= $typeid;
			echo json_encode($catArr);exit; 
		}
	}

	public function check_t_type(){
		$status = 0;
		if(!empty($_POST['ticket'])){
			$where = array('name'=>$_POST['ticket']);
			$checkData = $this->common_model->getData('tbl_ticket_type',$where);
			if(!empty($checkData)){
				$status = 1;
			}
		}
		echo $status;exit();
	}

	public function insert_t_channel(){
		//echo('ds');die;
		if(!empty($_POST)){
			$cname = $this->input->post('name');
			$insArr = array('name'=>$cname);
			$this->common_model->insertData('tbl_ticket_channel',$insArr);
			$catArray = $this->common_model->getData('tbl_ticket_channel');
			
			//echo $image;die;
			$str = '';
			foreach($catArray as $row){
				$str.='<option value="'.$row->id.'">'.$row->name.'</option>'; 
			}
			$channelArr = array();
			$channelArr['ticketcdata'] = $str;
			echo json_encode($channelArr);exit; 
		}
	}

	public function check_t_channel(){
		$status = 0;
		if(!empty($_POST['channel'])){
			$where = array('name'=>$_POST['channel']);
			$checkData = $this->common_model->getData('tbl_ticket_channel',$where);
			if(!empty($checkData)){
				$status = 1;
			}
		}
		echo $status;exit();
	}

	public function insert_comment(){
		
		if(!empty($_POST)){
			$comment = $this->input->post('name');
			$status = $this->input->post('status');
			$empid = $this->input->post('t_empid');
			$insArr = array('comment' => $comment,'cpmmentstatusid'=> $status,'ticketemployeeid'=>$empid );
			$ticketArr =$this->common_model->insertData('tbl_ticket_comment',$insArr);
			$tArray = $this->common_model->getData('tbl_ticket_comment');

			$query= "Select tbl_ticket_comment.*,tbl_employee.user_id,tbl_user.profileimg from tbl_ticket_comment inner join tbl_employee on tbl_ticket_comment.ticketemployeeid= tbl_employee.id inner join tbl_user on tbl_employee.user_id=tbl_user.id";

			$img_corequery= $this->common_model->coreQueryObject($query);
			$image=$img_corequery[0]->profileimg;
			$created = $tArray[0]->created_at;
			$replay =  $comment;
			$totaldata = count($tArray);
			$commentArr = array();
			$commentArr['count'] = $totaldata;
			$commentArr['create'] = $created;
			$commentArr['replay'] = $replay;
		    $commentArr['profileimg'] = $image;
			$commentArr['insCommentData'] = $ticketArr;
				
			echo json_encode($commentArr);exit; 
		}
	}

	public function deletecomment(){

		$id=$_POST['id'];
		$whereArr=array('id'=>$id);
		$this->common_model->deleteData('tbl_ticket_comment',$whereArr);
		//echo $this->db->last_query();die;
		$this->session->set_flashdata('message','Delete Succesfully....');
		redirect('ticket/index');
	}
	
}