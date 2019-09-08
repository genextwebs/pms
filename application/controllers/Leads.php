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
		$this->load->view('common/header');
		$this->load->view('leads/addleads');
		$this->load->view('common/footer');
	}

	public function insertleads(){
		if($this->input->post('btnsave'))
		{
			$companyname = $this->input->post('company_name');
			$website = $this->input->post('website');
			$address = $this->input->post('address');
			$clientname = $this->input->post('client_name');
			$clientemail = $this->input->post('client_email');
			$mobile = $this->input->post('mobile');
			$nextfollowup = $this->input->post('follow_up');
			$note = $this->input->post('note');
			$insArr = array('clientid'=>0,'companyname'=>$companyname,'website'=>$website,'address'=>$address,'clientname'=>$clientname,'clientemail'=>$clientemail,'mobile'=>$mobile,'nextfollowup'=>$nextfollowup,'status'=>'Pending','note'=>$note);
			$this->common_model->insertData('tbl_leads',$insArr);
			$this->session->set_flashdata('message_name', 'Lead Insert sucessfully');
			redirect('Leads/index');
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
		$query = "SELECT id,clientid,clientname,companyname,website,address,clientname,clientemail,note,created_at,nextfollowup,status from tbl_leads".$whereStr;
		//echo $query;die;
		$data['leads'] = $this->common_model->coreQueryObject($query);
		$datarow = array();
		foreach($data['leads'] as $row) {
				if($row->nextfollowup == '0')
				{
					$next= $row->nextfollowup='Yes';
				}
				else
				{
					$next = $row->nextfollowup='No';
				}
				$clientid = $row->clientid;
			if($row->status == 'Pending')
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
			                    <a  class="dropdown-item" href='.base_url().'college_management/editDivision/'.base64_encode($id).'><i class="fa fa-search"></i> View</a>
			                    <a  class="dropdown-item" href='.base_url().'leads/editleads/'.base64_encode($id).'><i class="fa fa-edit"></i> Edit</a>
			                    <a  class="dropdown-item" href='.base_url().'leads/deleteleads/'.base64_encode($id).' onclick="javascript:return confirm(\'Are u Sure want to delete?\');"><i class="fa fa-trash "></i> Delete</a>
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
			                    <a  class="dropdown-item" href="#"><i class="fa fa-search"></i> View</a>
			                    <a  class="dropdown-item" href="#"><i class="fa fa-edit"></i> Edit</a>
			                    <a  class="dropdown-item" href="#"><i class="fa fa-trash "></i> Delete</a>
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
		if($this->input->post('btnupdate'))
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
		$id = base64_decode($this->uri->segment(3));
		$whereArr = array('id'=>$id);
		$this->common_model->deleteData('tbl_leads',$whereArr);
		$this->session->set_flashdata('message_name', 'Lead Delete sucessfully');
		redirect('Leads/index');
	} 

	public function changeleadtoclient(){
		$id = base64_decode($this->uri->segment(3));
		$whereArr=array('id'=>$id);
		$data['leads'] = $this->common_model->getData('tbl_leads',$whereArr);
		$this->load->view('common/header');
		$this->load->view('leads/leadstoclient',$data);
		$this->load->view('common/footer');
		if($this->input->post('btnsave'))
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
			$insArr=array('companyname' => $companyname,'website' => $website,'address' => $address,'clientname' => $clientname,'clientemail' => $clientemail,'password' => $password, 'generaterandompassword' => $grp, 'mobile' => $mobile,'skype' => $skype,'linkedin' => $linkedin,'twitter' => $twitter,'facebook' => $facebook,'gstnumber' => $gstnumber,'note' => $note,'login' =>$login );
				//print_r($insArr);die;
				$this->common_model->insertData('tbl_clients',$insArr);
				$last_inserted = $this->db->insert_id();
				$updateArr = array('status'=>'Confirmed','clientid'=>$last_inserted);
				$whereArr = array('id'=>$id1);
				$this->common_model->updateData('tbl_leads',$updateArr,$whereArr);
				//echo $this->db->last_query();die;
				$this->session->set_flashdata('message_name', "Lead Change Succeessfully");
				redirect('Leads/index');
		}
	}
}