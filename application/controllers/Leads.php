<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leads extends CI_Controller 
{
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model');
	}
	
	public function index(){
		$this->load->view('common/header');
		$this->load->view('leads/leads');
		$this->load->view('common/footer');
	}

	public function addleads(){
		$data['errormess'] = $this->session->flashdata('data');
		$this->load->view('common/header');
		$this->load->view('leads/addleads',$data);
		$this->load->view('common/footer');
	}

	public function insertleads(){
		if(!empty($_POST)){
			$companyname = $this->input->post('company_name');
			$website = $this->input->post('website');
			$address = $this->input->post('address');
			$clientname = $this->input->post('client_name');
			$clientemail = $this->input->post('client_email');
			$mobile = $this->input->post('mobile');
			$nextfollowup = $this->input->post('follow_up');
			$note = $this->input->post('note');
			$whereArr = array('clientemail' => $clientemail);
			$data = $this->common_model->getData("tbl_leads",$whereArr);
			#echo "<pre>";print_r($data);die;
			if(count($data) == 1){
				#echo "hi";exit;
				$this->session->set_flashdata('message_name', 'Email is already exits');
				$this->session->set_flashdata("data",$_POST);
				redirect('leads/addleads');
			}
			else{
			$insArr = array('clientid'=>0,'companyname'=>$companyname,'website'=>$website,'address'=>$address,'clientname'=>$clientname,'clientemail'=>$clientemail,'mobile'=>$mobile,'nextfollowup'=>$nextfollowup,'status'=>'0','note'=>$note);
			$this->common_model->insertData('tbl_leads',$insArr);
			$this->session->set_flashdata('message_name', 'Lead Insert sucessfully');
			redirect('Leads/index');
			}
		}
	}

	public function lead_list(){
		$whereStr = '';
		$searchTerm = $_POST['sSearch'];
		if(!empty($searchTerm))
		{
			if(!empty($whereStr))
			{
				$tempStr =' AND ';
			}
			else
			{
				$tempStr =' where ';
			}
			$whereStr = $tempStr.' (companyname like "%'.$searchTerm.'%" OR website like "%'.$searchTerm.'%" OR address like "%'.$searchTerm.'%" OR clientname like "%'.$searchTerm.'%" OR clientemail like "%'.$searchTerm.'%" OR note like "%'.$searchTerm.'%")';
		}	
	    $sLimit = "";
	    $sOffset = "";
	    if ($_POST['iDisplayStart'] < 0) {
	        $_POST['iDisplayStart'] = 0;
	    }
	    if ($_POST['iDisplayLength'] < 0) {
	        $_POST['iDisplayLength'] = 10;
	    }
	    if (isset($_POST['iDisplayStart']) && $_POST['iDisplayLength'] != '-1') {
	        $sLimit = (int) substr($_POST['iDisplayLength'], 0, 6);
	        $sOffset = (int) $_POST['iDisplayStart'];
	    } else {
	        $sLimit = 10;
	        $sOffset = (int) $_POST['iDisplayStart'];
	    }
	    $query = "SELECT id,clientid,clientname,companyname,website,address,clientname,clientemail,note,created_at,nextfollowup,status from tbl_leads ".$whereStr.' limit '.$sOffset.', '.$sLimit;
		#echo $query;die;
		$data['leads'] = $this->common_model->coreQueryObject($query);
		$datarow = array();
		foreach($data['leads'] as $row) {
				if($row->nextfollowup == '0'){
					$next= $row->nextfollowup='Yes';
				}
				else{
					$next = $row->nextfollowup='No';
				}
				if($row->status == '0'){
					$status = $row->status = 'Pending';
				}
				else if($row->status == '1'){
					$status = $row->status = 'Overview';
				}
				else{
					$status = $row->status = 'Confirmed';
				}
				$clientid = $row->clientid;
			if($clientid == '0')
			{
				$datarow[] = array(
				
				$id = $row->id,
                $row->clientname,
                $row->companyname,
                $row->created_at,
				$next,
				$status,
				'<div class="dropdown action m-r-10">
	                <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">Action  <span class="caret"></span></button>
	                		<div class="dropdown-menu">
			                    <a  class="dropdown-item" href='.base_url().'leads/viewleadsdetail/'.base64_encode($id).'><i class="fa fa-search"></i> View</a>
			                    <a  class="dropdown-item" href='.base_url().'leads/editleads/'.base64_encode($id).'><i class="fa fa-edit"></i> Edit</a>
			                    <a  class="dropdown-item" href="javascript:void()" onclick="deleteLeadClient(\''.base64_encode($row->id).'\',\''.base64_encode($clientid).'\', \'lead\')"><i class="fa fa-trash "></i> Delete</a>
			                    <a  class="dropdown-item" href='.base_url().'leads/changeleadtoclient/'.base64_encode($id).'><i class="fa fa-user"></i> Change To Client</a>
			                    <a  class="dropdown-item" href="#"><i class="fa fa-thumbs-up"></i> Add Follow Up</a>
	               			 </div>
				</div>'
           );
			}
			else
			{
				$datarow[] = array(
				$id = $row->id,
                $row->clientname,
                $row->companyname,
                $row->created_at,
				$next,
				$row->status,
				'<div class="dropdown action m-r-10">
	                <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">Action  <span class="caret"></span></button>
	               		 <div class="dropdown-menu">
			                    <a  class="dropdown-item" href='.base_url().'leads/viewleadsdetail/'.base64_encode($id).'><i class="fa fa-search"></i> View</a>
			                    <a  class="dropdown-item" href='.base_url().'leads/editclients/'.base64_encode($clientid).'><i class="fa fa-edit"></i> Edit</a>
			                    <a  class="dropdown-item" href="javascript:void()" onclick="deleteLeadClient(\''.base64_encode($row->id).'\',\''.base64_encode($clientid).'\', \'client\')"><i class="fa fa-trash "></i> Delete</a>
	                	</div>
	            </div>'
				
				
           );
			}
      }
		/*$result = array(
               "draw" => $draw,
                 "recordsTotal" => count($data['leads']),
                 "recordsFiltered" => count($data['leads']),
                 "data" => $datarow
            );*/
        $data['alldata'] = $this->common_model->getData('tbl_leads');
        //print_r($data);die;
		$iTotal = count($data['alldata']);
		$output = array
		(
		   "sEcho" => intval($_POST['sEcho']),
		   "iTotalRecords" => $iTotal,
		   "iTotalRecordsFormatted" => number_format($iTotal), //ShowLargeNumber($iTotal),
		   "iTotalDisplayRecords" => count($data['leads']),
		   "aaData" => $datarow
		);
	  echo json_encode($output);
      exit();
	}

	public function editleads(){
		$id = base64_decode($this->uri->segment(3));
		$whereArr=array('id'=>$id);
		$data['leads'] = $this->common_model->getData('tbl_leads',$whereArr);
		$this->load->view('common/header');
		$this->load->view('leads/editleads',$data);
		$this->load->view('common/footer');
		if(!empty($_POST))
		{
			$companyname = $this->input->post('company_name');
			$website = $this->input->post('website');
			$address = $this->input->post('address');
			$clientname = $this->input->post('client_name');
			$clientemail = $this->input->post('client_email');
			$mobile = $this->input->post('mobile');
			$nextfollowup = $this->input->post('follow_up');
			$status = $this->input->post('status');
			$source = $this->input->post('source');
			$note = $this->input->post('note');
			$updateArr = array('clientid'=>0,'companyname'=>$companyname,'website'=>$website,'address'=>$address,'clientname'=>$clientname,'clientemail'=>$clientemail,'mobile'=>$mobile,'nextfollowup'=>$nextfollowup,'status'=>$status,'source'=>$source,'note'=>$note);
			$whereArr = array('id'=>$id);
			$this->common_model->updatedata('tbl_leads',$updateArr,$whereArr);
			$this->session->set_flashdata('message_name', 'Lead Insert sucessfully');
			redirect('Leads/index');
		}
	}

	public function deleteleads()
	{
		$leadId = base64_decode($_POST['leadId']);
		$clientId = base64_decode($_POST['clientId']);
		$type = $_POST['type'];
		$whereArr = array('id'=>$leadId);
		$this->common_model->deleteData('tbl_leads',$whereArr);
		if($type != 'lead'){
			$whereArr = array('id'=>$clientId);
			$this->common_model->deleteData('tbl_clients',$whereArr);	
		}
	} 

	public function changeleadtoclient(){
		$id = base64_decode($this->uri->segment(3));
		$whereArr = array('id'=>$id);
		$data['leads'] = $this->common_model->getData('tbl_leads',$whereArr);
		$data['editID'] = $id;
		$this->load->view('common/header');
		$this->load->view('leads/leadstoclient',$data);
		$this->load->view('common/footer');
		if(!empty($_POST))
		{
			$companyname = $this->input->post('company_name');
			$website = $this->input->post('website');
			$address = $this->input->post('address');
			$clientname = $this->input->post('name');
			$clientemail = $this->input->post('email');
			$password = $this->input->post('password');
			if($this->input->post('randompassword')=='on'){
				$randompassword='1';
			}
			else{ 
				$randompassword='0';
			}
			$grp = $randompassword;
			$mobile = $this->input->post('mobile');
			$skype = $this->input->post('skype');
			$linkedin = $this->input->post('linkedin');
			$twitter = $this->input->post('twitter');
			$facebook = $this->input->post('facebook');
			$gst_number = $this->input->post('gst_number');
			$note = $this->input->post('note');
			$login = $this->input->post('login');
			$insArr=array('companyname' => $companyname,'website' => $website,'address' => $address,'clientname' => $clientname,'clientemail' => $clientemail,'password' => md5($password), 'generaterandompassword' => $grp, 'mobile' => $mobile,'skype' => $skype,'linkedin' => $linkedin,'twitter' => $twitter,'facebook' => $facebook,'gstnumber' => $gst_number,'note' => $note,'login' =>$login );
			//print_r($insArr);die;
			$this->common_model->insertData('tbl_clients',$insArr);
			$last_inserted = $this->db->insert_id();
			$updateArr = array('clientid'=>$last_inserted);
			$whereArr = array('id'=>$id);
			$this->common_model->updateData('tbl_leads',$updateArr,$whereArr);
			$this->session->set_flashdata('message_name', "Lead Change Succeessfully");
			redirect('Leads/index');
		}
	}

	public function editclients(){
		$id = base64_decode($this->uri->segment(3));
		$whereArr = array('id'=>$id);
		$data['clients'] = $this->common_model->getData('tbl_clients',$whereArr);
		$this->load->view('common/header');
		$this->load->view('leads/editclients',$data);
		$this->load->view('common/footer');
		if(!empty($_POST))
		{
			$companyname = $this->input->post('company_name');
			$website = $this->input->post('website');
			$address = $this->input->post('address');
			$clientname = $this->input->post('name');
			$clientemail = $this->input->post('email');
			$password = $this->input->post('password');
			$updateArr=array();
			if($this->input->post('password') != '')
			{
				$updateArr['password'] = md5($this->input->post('password'));
			}
			if($this->input->post('randompassword')=='on'){
				$randompassword='1';
			}
			else{ 
				$randompassword='0';
			}
			$grp = $randompassword;
			$mobile = $this->input->post('mobile');
			$skype = $this->input->post('skype');
			$linkedin = $this->input->post('linkedin');
			$twitter = $this->input->post('twitter');
			$facebook = $this->input->post('facebook');
			$gst_number = $this->input->post('gst_number');
			$note = $this->input->post('note');
			$login = $this->input->post('login');
			$updateArr['companyname'] = $companyname;
			$updateArr['website'] = $website;
			$updateArr['address'] = $address;
			$updateArr['clientname'] = $clientname;
			$updateArr['clientemail'] = $clientemail;
			$updateArr['generaterandompassword'] = $grp;
			$updateArr['mobile'] = $mobile;
			$updateArr['skype'] = $skype;
			$updateArr['linkedin'] = $linkedin;
			$updateArr['twitter'] = $twitter;
			$updateArr['facebook'] = $facebook;
			$updateArr['gstnumber'] = $gst_number;
			$updateArr['note'] = $note;
			$updateArr['login'] = $login ;
			$whereArr = array('id'=>$id);
			$this->common_model->updatedata('tbl_clients',$updateArr,$whereArr);
			$this->session->set_flashdata('message_name', "Client Change Succeessfully");
			redirect('Leads/index');
		}
	} 

	public function viewleadsdetail(){
		$id = base64_decode($this->uri->segment(3));
		$whereArr=array('id'=>$id);
		$data['leads'] = $this->common_model->getData('tbl_leads',$whereArr);
		$this->load->view('common/header');
		$this->load->view('leads/viewlead',$data);
		$this->load->view('common/footer');
	}
}							