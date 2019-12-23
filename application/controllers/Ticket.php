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
		$data['tickettype']=$this->common_model->getData('tbl_ticket_type');
		$data['ticketchannel']=$this->common_model->getData('tbl_ticket_channel');
		$this->load->view('common/header');
		$this->load->view('ticket/ticket',$data);
		$this->load->view('common/footer');
	}

	public function addticket(){
		$data['tickettype']=$this->common_model->getData('tbl_ticket_type');
		$data['ticketchannel']=$this->common_model->getData('tbl_ticket_channel');
		$this->load->view('common/header');
		$this->load->view('ticket/addticket',$data);
		$this->load->view('common/footer');
	}

	public function insertticket(){
		if(!empty($_POST)){

			$t_subject = $this->input->post('ticket_subject'); 
			$t_editor  = $this->input->post('editor1');
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
			//	$agent=!empty($_POST['agent']) ? $_POST['agent'] : '';
	        $status=!empty($_POST['status1'])? $_POST['status1'] : '';
			$priority=!empty($_POST['priority']) ? $_POST['priority'] : '';
			$cname=!empty($_POST['channelname']) ? $_POST['channelname'] : '';
			$type=!empty($_POST['tickettype']) ? $_POST['tickettype'] : '';


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
		
		$query = "SELECT tbl_ticket.* FROM tbl_ticket".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
		$TicketArr = $this->common_model->coreQueryObject($query);

		$query = "SELECT tbl_ticket.*,tbl_ticket_channel.name as channel,tbl_ticket_type.name as type FROM tbl_ticket inner join tbl_ticket_channel on tbl_ticket.channelname=tbl_ticket_channel.id inner join tbl_ticket_type on tbl_ticket.type=tbl_ticket_type.id".$sWhere;
		
		$TicketFilterArr = $this->common_model->coreQueryObject($query);
		echo $this->db->last_query();die;
		$iFilteredTotal = count($TicketFilterArr);
		$TicketAllArr = $this->common_model->getData('tbl_ticket');
		$iTotal = count($TicketAllArr);
		
		/** Output */
		$datarow = array();
		$i = 1;
		foreach($TicketArr as $row) {
			$rowid = $row->id;
			//echo($rowid);die;
			$actionstring = '<div class="dropdown action m-r-10">
				                <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">Action  <span class="caret"></span></button>
				                		<div class="dropdown-menu">
						                    <a  class="dropdown-item" href="'.base_url().'ticket/editticket/'.base64_encode($row->id).'";><i class="fa fa-edit"></i> Edit</a>

						                    <a  href="javascript:void();" onclick="deleteticket(\''.base64_encode($row->id).'\');" class="dropdown-item" href="javascript:void()"><i class="fa fa-trash" ></i> Delete</a>
						                    
				               			 </div>
							</div>';
		//For Priority
		if($row->priority=='0'){
			$priority=$row->priority='Low';
			$showStatus = '<label class="label label-success">'.$priority.'</label>';
		}
		else if($row->priority=='1'){
			$priority=$row->priority='High';
			$showStatus = '<label class="label label-warning">'.$priority.'</label>';
		}
		else if($row->priority=='2'){
			$prioritypriority=$row->priority='Medium';
			$showStatus = '<label class="label label-warning">'.$priority.'</label>';
		}
		else if($row->priority=='3'){
			$priority=$row->priority='Urgent';
			$showStatus = '<label class="label label-warning">'.$priority.'</label>';
		}

		//For Status
		if($row->status=='0'){
			$status=$row->status='Open';
			$showStatus = '<label class="label label-success">'.$status.'</label>';
		}
		else if($row->status=='1'){
			$status=$row->status='Pending';
			$showStatus = '<label class="label label-success">'.$status.'</label>';
		}
		else if($row->status=='2'){
			$status=$row->status='Resolved';
			$showStatus = '<label class="label label-success">'.$status.'</label>';
		}

		else if($row->status=='3'){
			$status=$row->status='Close';
			$showStatus = '<label class="label label-success">'.$status.'</label>';
		}
		

			$datarow[] = array(
				$id = $i,
				$row->ticketsubject,
				$row->requestername,
				$row->created_at,
			   
			    '
			    	<b>Agent:</b>'.$row->agent.
			    	'<br/> <b>Staus:</b> <label class="label label-success">'.$row->status.'</label><br/>
			        <label><b>Priority:</b></label>'.$row->priority,
				/*$row->ticketimage,
				$row->requestername,
				$row->agent,
				$row->type,
				$row->priority,
				$row->channelname,
				$row->tags,*/
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

	public function editticket(){
		$id=base64_decode($this->uri->segment(3));
		$whereArr=array('id'=>$id);
		$data['editticketId']=$id;
	    $data['ticketinfo']=$this->common_model->getData('tbl_ticket',$whereArr);
	    $data['tickettype']=$this->common_model->getData('tbl_ticket_type');
		$data['ticketchannel']=$this->common_model->getData('tbl_ticket_channel');
		$this->load->view('common/header');
		$this->load->view('ticket/editticket',$data);
		$this->load->view('common/footer');

	    if(!empty($_POST))
		{
			$t_subject = $this->input->post('ticket_subject'); 
			$t_editor  = $this->input->post('editor1');
			$status   = $this->input->post('status');
			//$t_image   = $this->input->post('ticket_Image');
			$t_requestname = $this->input->post('requestername');
			$t_agentname = $this->input->post('agentname');
			$t_question = $this->input->post('question');
			$t_priority = $this->input->post('priority');
			$t_channel = $this->input->post('channel');
			$t_tags =  $this->input->post('tags');
			
			if(!empty($_FILES['ticket_Image']['name'])){

				$file = $_FILES['ticket_Image']['name'];
				$file_loc = $_FILES['ticket_Image']['tmp_name'];
				$file_size = $_FILES['ticket_Image']['size'];
				$file_type = $_FILES['ticket_Image']['type'];
				$folder="uploads/";
				move_uploaded_file($file_loc,$folder.$file);
				$updateArr['ticketimage']=$file;
			//	print_r($updateArr['ticketimage']);die;
				}
				else{
					$updateArr['ticketimage']=$this->input->post('hidden_img');
					echo($updateArr['ticketimage']);

				}
				$updateArr['ticketsubject'] = $t_subject;
				$updateArr['ticketdescription'] = $t_editor;
				$updateArr['status'] = $status;
				$updateArr['requestername'] = $t_requestname;
				$updateArr['agent'] = $t_agentname;
				$updateArr['type'] = $t_question;
				$updateArr['priority'] = $t_priority;
				$updateArr['channelname'] = $t_channel;
				$updateArr['tags'] = $t_tags;



			/*$updateArr  = array('ticketsubject'=>$t_subject,'ticketdescription'=>$t_editor,'requestername'=>$t_requestname,'agent'=>$t_agentname,'type'=>$t_question,'priority'=>$t_priority,'channelname'=>$t_channel,'tags'=>$t_tags);*/

			$this->common_model->updateData('tbl_ticket',$updateArr,$whereArr);
			//echo $this->db->last_query();die;
			$this->session->set_flashdata('message_name', 'Ticket Updated sucessfully....');
			redirect('ticket/index');
		}
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
			//print_r($catArr);die;
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
			$typeid=$this->common_model->insertData('tbl_ticket_channel',$insArr);
			//echo $this->db->last_query();die;
			$catArray = $this->common_model->getData('tbl_ticket_channel');
			$str = '';
			foreach($catArray as $row){
				$str.='<option value="'.$row->id.'">'.$row->name.'</option>'; 
			}
			$totaldata = count($catArray);
			$channelArr = array();
			$channelArr['count'] = $totaldata;
			$channelArr['ticketcdata'] = $str;
			$channelArr['typeid']= $typeid;
			//print_r($catArr);die;
			echo json_encode($channelArr);exit; 
		}
	}

	public function check_t_channel(){
		$status = 0;
		if(!empty($_POST['channel'])){
			$where = array('name'=>$_POST['channel']);
			$checkData = $this->common_model->getData('tbl_ticket_channel',$where);
			
			//echo $this->db->last_query();
			if(!empty($checkData)){
				$status = 1;
			}
		}
		echo $status;exit();
	}



	
}