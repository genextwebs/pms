<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Clients extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('common_model');
		ini_set('display_errors',1);
		error_reporting(E_ALL);
	}
	
	public function index(){
		$data['clients']=$this->common_model->getData('tbl_clients');
		$this->load->view('common/header');
		$this->load->view('clients/client',$data);
		$this->load->view('common/footer');
	}
	
	public function addclients(){
		$data['sessData'] = $this->session->flashdata('data');
		$this->load->view('common/header');
		$this->load->view('clients/addclient',$data);
		$this->load->view('common/footer');
	}
	
	public function insertclients(){
		if(!empty($_POST))
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
			$whereArr = array('clientemail' => $clientemail);
			$data = $this->common_model->getData('tbl_clients',$whereArr);
			if(count($data)==1){
				$this->session->set_flashdata('message_name','Email already exits');
				$this->session->set_flashdata("data",$_POST);
				redirect('Clients/addclients');
			}
			else{
				$insertArr=array('companyname' => $companyname,'website' => $website,'address' => $address,'clientname' => $clientname,'clientemail' => $clientemail,'password' => md5($password), 'generaterandompassword' => $grp, 'mobile' => $mobile,'status'=>'1','skype' => $skype,'linkedin' => $linkedin,'twitter' => $twitter,'facebook' => $facebook,'gstnumber' => $gstnumber,'note' => $note,'login' =>$login );
				$this->common_model->insertdata('tbl_clients',$insertArr);
				$this->session->set_flashdata('message_name', "Data Inserted Succeessfully");
				redirect('Clients/index');
			}
		}
	}
	
	public function client_list(){
	if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';	
			$aColumns = array( 'id', 'clientname', 'companyname', 'clientemail', 'status','createdat');
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
            	$sWhere .= ' AND (clientname like "%'.$searchTerm.'%" OR companyname like "%'.$searchTerm.'%" OR website like "%'.$searchTerm.'%" OR address like "%'.$searchTerm.'%" OR clientemail like "%'.$searchTerm.'%" OR facebook like "%'.$searchTerm.'%" OR note like "%'.$searchTerm.'%")';
            }
				$startdate=!empty($_POST['startdate']) ? $_POST['startdate'] : '';
				$enddate=!empty($_POST['enddate']) ? $_POST['enddate'] : '';
				$clientname=!empty($_POST['clientname']) ? $_POST['clientname'] : '';
				$status=$_POST['status'];
		
					if(!empty($clientname)){
							$sWhere.=' AND  clientname="'.$clientname.'"';

					}
					
					if($status=='all'){
						}else{
								$sWhere.=' AND status='.$status;
						}
					if(!empty($startdate)){						
						$sWhere.=' AND createdat>="'.$startdate.'"';
					}
					if(!empty($enddate)){						
						$sWhere.=' AND createdat<="'.$enddate.'"';
					}
					
					if(!empty($sWhere)){
						$sWhere = " WHERE 1 ".$sWhere;
					}
					/** Filtering End */
				}
				
		
	    $query = "SELECT * from tbl_clients ".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
		$clientsArr = $this->common_model->coreQueryObject($query);

		$query = "SELECT * from tbl_clients ".$sWhere;
		$clientsFilterArr = $this->common_model->coreQueryObject($query);
		$iFilteredTotal = count($clientsFilterArr);

		$clientsAllArr = $this->common_model->getData('tbl_clients');
		$iTotal = count($clientsAllArr);

		/** Output */
		$datarow = array();
		$i = 1;
		foreach($clientsArr as $row) {
			$id = $row->id;
			if($row->status == '0'){
				$status = $row->status = 'Deactive';
				$sta='<lable class="label label-danger">'.$status.'</label>';

			}
			else if($row->status == '1'){
				$status = $row->status = 'Active';
				$sta='<lable class="label label-success">'.$status.'</label>';

			}
			//$clientid = $row->clientid;
			$create_date = date('d-m-Y', strtotime($row->createdat));
			
				$actionStr = "<abbr title=\"Edit\"><a class=\"btn btn-info btn-circle\" data-toggle=\"tooltip\" data-original-title=\"Edit\" href='".base_url()."Clients/editclients/".base64_encode($id)."'><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a></abbr>
				<abbr title=\"View Client Details\"><a class=\"btn btn-success btn-circle\" data-toggle=\"tooltip\" data-original-title=\"View Client Details\" href='".base_url()."Clients/viewclientdetail/".base64_encode($id)."'><i class=\"fa fa-search\" aria-hidden=\"true\" ></i></a></abbr>
				<abbr title=\"Delete\"><a  class=\"btn btn-danger btn-circle sa-params\" data-toggle=\"tooltip\"  data-original-title=\"Delete\" href=\"javascript:void();\" onclick=\"deleteclients('".base64_encode($id)."');\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></a></abbr>";	
           
			
			$datarow[] = array(
				$id = $i,
                $row->clientname,
                $row->companyname,
	            $row->clientemail,
                $sta,	
				$create_date,
				$actionStr
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
	
	public function editclients(){
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
			if($this->input->post('password')!=''){
					$updateArr['password']=md5($this->input->post('password'));
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
				$this->session->set_flashdata('messagename', "Data Update Succeessfully");
				redirect('Clients/index');
		}
	}
	
	public function deleteclient(){
		$clientid=base64_decode($_POST['clientid']);
		$whereArr=array('id'=>$clientid);
		$this->common_model->deleteData('tbl_clients',$whereArr);
		redirect('Clients/index');
	}
	
	public function viewclientdetail(){
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