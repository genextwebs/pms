<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Clients extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('common_model');
		ini_set('display_errors',1);
		error_reporting(E_ALL);
	}
	public function viewclient()
	{
		$this->load->view('Client/clients');
	}
	public function insertrecord()
	{
			if($this->input->post('btnsubmit'))
			{
				$companyname=$this->input->post('txtcompanyname');
				$website=$this->input->post('txtwebsite');
				$address=$this->input->post('txtaddress');
				$clientname=$this->input->post('txtclientname');
				$clientemail=$this->input->post('txtclientemail');
				$password=$this->input->post('txtpassword');
				if($this->input->post('txtgrp')=='on')
				{$on='1';}
				else{ $on='0';}
				$grp=$on;
				$mobile=$this->input->post('txtmobileno');
				$skype=$this->input->post('txtskype');
				$linkedin=$this->input->post('txtlinkedin');
				$twitter=$this->input->post('txttwitter');
				$facebook=$this->input->post('txtfacebook');
				$gstnumber=$this->input->post('txtgstnumber');
				$note=$this->input->post('txtnote');
				$login=$this->input->post('txtlogin');
				$insertArr=array('companyname' => $companyname,'website' => $website,'address' => $address,'clientname' => $clientname,'clientemail' => $clientemail,'password' => $password, 'generaterandompassword' => $grp, 'mobile' => $mobile,'status'=>'1','skype' => $skype,'linkedin' => $linkedin,'twitter' => $twitter,'facebook' => $facebook,'gstnumber' => $gstnumber,'note' => $note,'login' =>$login, );
				$data['res']=$this->common_model->insertdata('tbl_clients',$insertArr);
				$this->session->set_flashdata('messagename', "Data Inserted Succeessfully");
				redirect('Clients/viewclientpage');
				
			}
	}
	public function viewclientpage()
	{
		$data['client'] = $this->common_model->getData('tbl_clients');
		$this->load->view('Client/viewclients',$data);
	}
	public function viewclientsrecord()
	{
		$iTotal = 200;
		$iFilteredTotal = 100;
		$limitCountQuery = 100;
		$whereArr=array();
		$startdate=!empty($_POST['startdate']) ? $_POST['startdate'] : '';
		$enddate=!empty($_POST['enddate']) ? $_POST['enddate'] : '';
		$clientname=!empty($_POST['clientname']) ? $_POST['clientname'] : '';
		$status=$_POST['status'];
		$whereStr= '';
		if(!empty($whereStr))
		{
			$tempStr=' AND ';
		}
		else
		{
			$tempStr=' where ';
		}
		if(!empty($clientname))
		{
			$whereStr=$tempStr.' clientname="'.$clientname.'"';
		}
		if($status=='All')
		{
						
		}
		else
		{
			if(!empty($whereStr))
			{
				$tempStr=' AND ';
			}
			else
			{
				$tempStr=' where ';
			}
			$whereStr.=$tempStr.'status='.$status;
		}
		if(!empty($startdate))
		{
			if(!empty($whereStr))
			{
				$tempStr=' AND ';
			}
			else
			{
				$tempStr=' where ';
			}
			$whereStr.=$tempStr.'createdat>="'.$startdate.'"';
						
		}
			if(!empty($enddate))
		{
			if(!empty($whereStr))
			{
				$tempStr=' AND ';
			}
			else
			{
				$tempStr=' where ';
			}
			$whereStr.=$tempStr.'createdat<="'.$enddate.'"';
						
		}
		$searchTerm = $_POST['sSearch'];
		if(!empty($searchTerm))
		{
			if(!empty($whereStr))
			{
				$tempStr=' AND ';
			}
			else
			{
				$tempStr=' where ';
			}
			$whereStr.= $tempStr.'(companyname like "%'.$searchTerm.'%" OR clientname like "%'.$searchTerm.'%" OR clientemail like "%'.$searchTerm.'%" OR address like "%'.$searchTerm.'%")';
		}	
		$query="SELECT id,clientname,companyname,clientemail,status,createdat from  tbl_clients".$whereStr;
		//echo $query;die;
		$data['client'] = $this->common_model->coreQueryObject($query);
		
		$datarow=array();
		foreach($data['client']  as $row)
	  {
		if($row->status=='1')
		{
			$status=$row->status='Active';
		}
		else
		
		{
			$status=$row->status='Deactive';
		}
           $datarow[] = array(
                $id=$row->id,
				$row->clientname,
				$row->companyname,
				$row->clientemail,
				$status,
				$row->createdat,
				"<a href='".base_url()."Clients/editrecord/".base64_encode($id)."'>Edit</a>",
				"<a href='".base_url()."Clients/deleterecord/".base64_encode($id)." ' onClick='javascript:return confirm(\"Are you sure to Delete?\")'>DELETE</a>"          
           );
	   }
		$data['alldata']=$this->common_model->getData('tbl_clients');
		$iTotal=count($data['alldata']);
		$output = array(
		   "sEcho" => intval($_POST['sEcho']),
		   "iTotalRecords" => $iTotal,
		   "iTotalRecordsFormatted" => number_format($iTotal), //ShowLargeNumber($iTotal),
		   "iTotalDisplayRecords" => count($data['client']),
		   "aaData" => $datarow
		   //"limitCountQuery" => $limitCountQuery,
		);
		echo json_encode($output);exit;
	}
	public function editrecord()
	{
		$id=$this->uri->segment(3);
		$id1=base64_decode($id);
		$whereArr=array('id'=>$id1);
		$data['client']=$this->common_model->getData('tbl_clients',$whereArr);
		$this->load->view('Client/editclients',$data);

		if($this->input->post('btnupdate'))
		{
			$companyname=$this->input->post('txtcompanyname');
				$website=$this->input->post('txtwebsite');
				$address=$this->input->post('txtaddress');
				$clientname=$this->input->post('txtclientname');
				$clientemail=$this->input->post('txtclientemail');
				if($this->input->post('txtpassword')!='')
				{
					$updateArr['password']=$this->input->post('txtpassword');
				}
			
				if($this->input->post('txtgrp')=='on')
				{$on='1';}
				else{ $on='0';}
				$grp=$on;
				
				$mobile=$this->input->post('txtmobileno');
				$status=$this->input->post('txtstatus');
				$skype=$this->input->post('txtskype');
				$linkedin=$this->input->post('txtlinkedin');
				$twitter=$this->input->post('txttwitter');
				$facebook=$this->input->post('txtfacebook');
				$gstnumber=$this->input->post('txtgstnumber');
				$note=$this->input->post('txtnote');
				$login=$this->input->post('txtlogin');
					
				$updateArr['companyname'] = $companyname;
				$updateArr['website'] = $website;
				$updateArr['address'] = $address;
				$updateArr['clientname'] = $clientname;
				$updateArr['clientemail'] = $clientemail;
				$updateArr['generaterandompassword'] = $grp;
				$updateArr[	'mobile'] = $mobile;
				$updateArr['status']=$status;
				$updateArr['skype'] = $skype;
				$updateArr['linkedin'] = $linkedin;
				$updateArr['twitter'] = $twitter;
				$updateArr['facebook'] = $facebook;
				$updateArr['gstnumber'] = $gstnumber;
				$updateArr['note'] = $note;
				$updateArr['login'] =$login;
				
				$whereArr=array('id'=>base64_decode($id));
				$data['query']=$this->common_model->updateData('tbl_clients',$updateArr,$whereArr,'','');
				//echo $this->db->last_query();die;
				$this->session->set_flashdata('messagename', "Data Update Succeessfully");
				redirect('Clients/viewclientpage');
			}
	}
	public function deleterecord()
	{
		$id=$this->uri->segment(3);
		$id1=base64_decode($id);
		$whereArr=array('id'=>$id1);
		$this->common_model->deleteData('tbl_clients',$whereArr);
		$this->session->set_flashdata('messagename', "Data Delete Succeessfully");
		redirect('Clients/viewclientpage');
	}
}
?>