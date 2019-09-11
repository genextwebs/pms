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
	public function index(){
		$this->load->view('common/header');
		$this->load->view('clients/client');
		$this->load->view('common/footer');
	}
	public function addclients(){
		$this->load->view('common/header');
		$this->load->view('clients/addclient');
		$this->load->view('common/footer');
	}
	
	public function insertclients()
	{
			if($this->input->post('btnsubmit'))
			{
				$companyname=$this->input->post('company_name');
				$website=$this->input->post('website');
				$address=$this->input->post('address');
				$clientname=$this->input->post('name');
				$clientemail=$this->input->post('email');
				$password=$this->input->post('password');
				if($this->input->post('randompassword')=='on')
				{$on='1';}
				else{ $on='0';}
				$grp=$on;
				$mobile=$this->input->post('mobile');
				$skype=$this->input->post('skype');
				$linkedin=$this->input->post('linkedin');
				$twitter=$this->input->post('twitter');
				$facebook=$this->input->post('facebook');
				$gstnumber=$this->input->post('gst_number');
				$note=$this->input->post('note');
				$login=$this->input->post('login');
				$insertArr=array('companyname' => $companyname,'website' => $website,'address' => $address,'clientname' => $clientname,'clientemail' => $clientemail,'password' => $password, 'generaterandompassword' => $grp, 'mobile' => $mobile,'status'=>'1','skype' => $skype,'linkedin' => $linkedin,'twitter' => $twitter,'facebook' => $facebook,'gstnumber' => $gstnumber,'note' => $note,'login' =>$login, );
				$this->common_model->insertdata('tbl_clients',$insertArr);
				//echo $this->db->last_query();die;
				$this->session->set_flashdata('messagename', "Data Inserted Succeessfully");
				redirect('Clients/index');
				
			}
	}
	public function client_list()
	{
		$iTotal = 200;
		$iFilteredTotal = 100;
		$limitCountQuery = 100;
		/*$whereArr=array();
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
		}	*/
		$query="SELECT id,clientname,companyname,clientemail,status,createdat from  tbl_clients";
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
				'<a class="btn btn-info btn-circle" data-toggle="tooltip" data-original-title="Edit" href='.base_url().'Clients/editclients/'.base64_encode($id).'><i class="fa fa-pencil" aria-hidden="true"></i></a>
				<a class="btn btn-success btn-circle" data-toggle="tooltip" data-original-title="View Client Details" href='.base_url().'Clients/viewclientdetail/'.base64_encode($id).'><i class="fa fa-search" aria-hidden="true" ></i></a>
				<a  class="btn btn-danger btn-circle sa-params" data-toggle="tooltip" data-user-id="3" data-original-title="Delete" href='.base_url().'leads/deleteclients/'.base64_encode($id).' onclick="javascript:return confirm(\'Are u Sure want to delete?\');"><i class="fa fa-times" aria-hidden="true"></i></a>'
								        
								     
				/*"<a href='".base_url()."Clients/editrecord/".base64_encode($id)."'>Edit</a>",
				"<a href='".base_url()."Clients/deleterecord/".base64_encode($id)." ' onClick='javascript:return confirm(\"Are you sure to Delete?\")'>DELETE</a>"*/          
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
	public function editclients()
	{
		$id=$this->uri->segment(3);
		$id1=base64_decode($id);
		$whereArr=array('id'=>$id1);
		$data['clients']=$this->common_model->getData('tbl_clients',$whereArr);
		$this->load->view('common/header');
		$this->load->view('clients/editclient',$data);
		$this->load->view('common/footer');

		if($this->input->post('btnupdate'))
		{
			$companyname=$this->input->post('company_name');
				$website=$this->input->post('website');
				$address=$this->input->post('address');
				$clientname=$this->input->post('name');
				$clientemail=$this->input->post('email');
				if($this->input->post('Password')!='')
				{
					$updateArr['password']=$this->input->post('Password');
				}	
				$mobile=$this->input->post('mobile');
				$status=$this->input->post('status');
				$skype=$this->input->post('skype');
				$linkedin=$this->input->post('linkedin');
				$twitter=$this->input->post('twitter');
				$facebook=$this->input->post('facebook');
				$gstnumber=$this->input->post('gst_number');
				$note=$this->input->post('note');
				$login=$this->input->post('login');
					
				$updateArr['companyname'] = $companyname;
				$updateArr['website'] = $website;
				$updateArr['address'] = $address;
				$updateArr['clientname'] = $clientname;
				$updateArr['clientemail'] = $clientemail;
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
				$data['query']=$this->common_model->updateData('tbl_clients',$updateArr,$whereArr);
				//echo $this->db->last_query();die;
				$this->session->set_flashdata('messagename', "Data Update Succeessfully");
				redirect('Clients/index');
			}
	}
	public function deleteclients()
	{
		$id=$this->uri->segment(3);
		$id1=base64_decode($id);
		$whereArr=array('id'=>$id1);
		$this->common_model->deleteData('tbl_clients',$whereArr);
		$this->session->set_flashdata('messagename', "Data Delete Succeessfully");
		redirect('Clients/index');
	}
	public function viewclientdetail()
	{
		$id=$this->uri->segment(3);
		$id1=base64_decode($id);
		$whereArr=array('id'=>$id1);
		$data['clients']=$this->common_model->getData('tbl_clients',$whereArr);
		$this->load->view('common/header');
		$this->load->view('clients/viewclientdetail',$data);
		$this->load->view('common/footer');
	}

}
?>