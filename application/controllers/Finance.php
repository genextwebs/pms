<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Finance extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('common_model');
		ini_set('display_errors',1);
		error_reporting(E_ALL);
		func_check_login();
	}
	public function index(){
		$this->load->view('common/header');
		$this->load->view('Estimates/estimate');
		$this->load->view('common/footer');
	}
	
	public function addestimates(){
		//$data['sessData'] = $this->session->flashdata('data');
		$data['tax']=$this->common_model->getData('tbl_tax');
		
		$data['client']=$this->common_model->getData('tbl_clients');
		$this->load->view('common/header');
		$this->load->view('Estimates/addestimate',$data);
		$this->load->view('common/footer');
	}
	
	public function insertEstimates(){
			if($this->input->post('btnsubmit'))
			{
				$client=$this->input->post('client');
				$currency=$this->input->post('currency');
				$valid_till=$this->input->post('valid_till');				
				$total=$this->input->post('finaltotal');
				$note=$this->input->post('note');
				$insertArr=array('client' => $client,'currency' => $currency,'validtill' => $valid_till,'note' => $note,'status'=>'0','total'=>$total);
				$this->common_model->insertData('tbl_estimates',$insertArr);
				$estimateid=$this->db->insert_id();
					
				$item_name=$this->input->post('item_name');
				$quantity=$this->input->post('quantity');
				$cost_per_item=$this->input->post('cost_per_item');
				$taxes=$this->input->post('tax');
				$amount=$this->input->post('amount');
				$item_Description=$this->input->post('item_Description');
				
				$count=count($this->input->post('item_name'));

				for($i=0;$i<$count;$i++)
				{
					
					$insertArr1=array('estimateid'=>$estimateid,'item' => $item_name[$i],'qtyhrs' => $quantity[$i], 'unitprice' => $cost_per_item[$i], 'tax' => $taxes[$i],'amount'=>$amount[$i],'description' => $item_Description[$i]);
					$this->common_model->insertData('tbl_products',$insertArr1);
				}
				$this->session->set_flashdata('messagename', "Data Inserted Succeess");
				redirect('Finance');	
			}
	}
	
	public function estimate_list(){
	//echo "cbjkdjkcd";die;
	if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';	
			$aColumns = array( 'id', 'client', 'total', 'created_at','validtill', 'status');
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
            	$sWhere .= ' AND (client like "%'.$searchTerm.'%" OR note like "%'.$searchTerm.'%" OR item like "%'.$searchTerm.'%" OR description like "%'.$searchTerm.'%")';
            }
				$startdate=!empty($_POST['startdate']) ? $_POST['startdate'] : '';
				$enddate=!empty($_POST['enddate']) ? $_POST['enddate'] : '';
				$status=$_POST['status'];
		
					
					if($status=='all'){
						}else{
								$sWhere.=' AND status='.$status;
						}
					if(!empty($startdate)){						
						$sWhere.=' AND validtill>="'.$startdate.'"';
					}
					if(!empty($enddate)){						
						$sWhere.=' AND validtill<="'.$enddate.'"';
					}
					
					if(!empty($sWhere)){
						$sWhere = " WHERE 1 ".$sWhere;
					}
					/** Filtering End */
				}
				
		
	    $query = "select tbl_estimates.* , tbl_clients.clientname from tbl_estimates INNER JOIN tbl_clients ON tbl_clients.id=tbl_estimates.client".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
				//echo $query;die;

		$estimatesArr = $this->common_model->coreQueryObject($query);

		$query = "SELECT * from tbl_estimates ".$sWhere;
		//echo $query;die;
		$estimatesFilterArr = $this->common_model->coreQueryObject($query);
		$iFilteredTotal = count($estimatesFilterArr);

		$estimatesAllArr = $this->common_model->getData('tbl_estimates');
		$iTotal = count($estimatesAllArr);

		/** Output */
		$datarow = array();
		$i = 1;
		foreach($estimatesArr as $row) {
			$id = $row->id;
			if($row->status == '0'){
				$status = $row->status = 'Waiting';
				//$sta='<lable class="label label-warning">'.$status.'</label>';

			}
			else if($row->status == '1'){
				$status = $row->status = 'Accepted';
				//$sta='<lable class="label label-success">'.$status.'</label>';
			}
			else if($row->status == '2'){
				$status = $row->status = 'Declined';
				//$sta='<lable class="label label-success">'.$status.'</label>';
			}
			//$clientid = $row->clientid;
			$create_date = date('d-m-Y', strtotime($row->created_at));
			
				$actionStr = '<div class="dropdown action m-r-10">
				                <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">Action  <span class="caret"></span></button>
				                		<div class="dropdown-menu">
						                    <a  class="dropdown-item" href='.base_url().'Finance/editestimate/'.base64_encode($id).'><i class="fa fa-pencil"></i> Edit</a>
											<a  class="dropdown-item" href="javascript:void(0)" onclick="deleteestimates(\''.base64_encode($row->id).'\')"><i class="fa fa-trash "></i> Delete</a>
											<a  class="dropdown-item" href='.base_url().'Finance/createinvoice/'.base64_encode($id).'><i class="ti-receipt"></i>Create Invoice</a>
				               			 </div>
							</div>';
			
			
			$datarow[] = array(
				$id = $i,
                $row->clientname,
                $row->total,
				$create_date,
				$row->validtill,
                $status,	
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
	public function editestimate(){
		$id=$this->uri->segment(3);
		$id1=base64_decode($id);
		$whereArr=array('id'=>$id1);
		$whereArr1=array('estimateid'=>$id1);
		$data['client'] =$this->common_model->getData('tbl_clients');
		$data['tax'] =$this->common_model->getData('tbl_tax');
		$data['estimate']=$this->common_model->getData('tbl_estimates',$whereArr);
		$data['product']=$this->common_model->getData('tbl_products',$whereArr1);
		$this->load->view('common/header');
		$this->load->view('Estimates/editestimate',$data);
		$this->load->view('common/footer');

		if($this->input->post('btnupdate'))
		{
				$client=$this->input->post('client');
				$currency=$this->input->post('currency');
				$valid_till=$this->input->post('valid_till');
				$status=$this->input->post('status');
								//echo $status;die;

				$total=$this->input->post('finaltotal');
				$note=$this->input->post('note');
				$updateArr=array('client' => $client,'currency' => $currency,'validtill' => $valid_till,'note' => $note,'status'=>$status,'total'=>$total);
				//print_r($updateArr);die;
				$this->common_model->updateData('tbl_estimates',$updateArr,$whereArr);
				$this->common_model->deleteData('tbl_products',$whereArr1);
			
				$item_name=$this->input->post('item_name');
				$quantity=$this->input->post('quantity');
				$cost_per_item=$this->input->post('cost_per_item');
				$taxes=$this->input->post('tax');
				$amount=$this->input->post('amount');
				$item_Description=$this->input->post('item_Description');
				
				$count=count($this->input->post('item_name'));
				for($i=0;$i<$count;$i++)
				{
					$insertArr1=array('estimateid'=>$id1,'item' => $item_name[$i],'qtyhrs' => $quantity[$i], 'unitprice' => $cost_per_item[$i], 'tax' => $taxes[$i],'amount'=>$amount[$i],'description' => $item_Description[$i]);
					$this->common_model->insertData('tbl_products',$insertArr1);
				}
				$this->session->set_flashdata('messagename', "Data Update Succeessfully");
				redirect('Finance');
			}
	}
	public function deleteestimate(){
		$estimateid=base64_decode($_POST['estimateid']);
		$whereArr=array('id'=>$estimateid);
		$this->common_model->deleteData('tbl_estimates',$whereArr);
		redirect('Finance');
	}
	
	public function createinvoice()
	{
		$id=$this->uri->segment(3);
		$id1=base64_decode($id);
		$whereArr=array('id'=>$id1);
		$whereArr1=array('estimateid'=>$id1);
		$data['tax'] =$this->common_model->getData('tbl_tax');
		$data['project'] =$this->common_model->getData('tbl_project_info');
		$data['estimate']=$this->common_model->getData('tbl_estimates',$whereArr);
		$data['product']=$this->common_model->getData('tbl_products',$whereArr1);
		$sql='SELECT * FROM tbl_invoice ORDER BY tbl_invoice.id DESC LIMIT 1';
		 

		$data['invoice']=$this->common_model->coreQueryObject($sql);
		//print_r($data['invoice']);die;
		$this->load->view('common/header');
		$this->load->view('Invoices/createinvoice',$data);
		$this->load->view('common/footer');

		if($this->input->post('btnsubmit'))
		{
			$invoice=$this->input->post('invoice_number');
			$project=$this->input->post('project');
			$currency=$this->input->post('currency');
			$invoicedate=$this->input->post('invoice_date');
			$duedate=$this->input->post('due_date');
			$status=$this->input->post('status');
			$recuringpayment=$this->input->post('recurring_payment');
			$billingfrequency=$this->input->post('billing_frequency');
			$billinginterval=$this->input->post('billing_interval');
			$billingcycle=$this->input->post('billing_cycle');
			$total=$this->input->post('finaltotal');
			//$sql=select clientid form tbl_project_info 
			$sql="SELECT tbl_project_info.clientid,tbl_clients.clientname,tbl_clients.companyname FROM tbl_project_info INNER JOIN tbl_clients ON tbl_project_info.clientid = tbl_clients.id where tbl_project_info.id=".$project;			
			$data['invoicedata']=$this->common_model->coreQueryObject($sql);
			//echo "<pre>";print_r($data['invoicedata']);die;

			
			$insertArr=array('invoice' => $invoice,'project' => $project,'companyname'=>$data['invoicedata'][0]->companyname,'clientid'=>$data['invoicedata'][0]->clientid,
				'currency' => $currency,'invoicedate' => $invoicedate,'duedate'=>$duedate,'status'=>$status,'recuringpayment'=>$recuringpayment,'billingfrequency'=>$billingfrequency,'billinginterval'=>$billinginterval,'billingcycle'=>$billingcycle,'total'=>$total);
			//print_r($insertArr);die;
			$this->common_model->insertData('tbl_invoice',$insertArr);
			$invoiceid=$this->db->insert_id();
			
			$item=$this->input->post('item_name');
			$qtyhrs=$this->input->post('quantity');
			$unitprice=$this->input->post('cost_per_item');
			$tax=$this->input->post('tax');
			$amount=$this->input->post('amount');
			$description=$this->input->post('item_Description');
			$count=count($this->input->post('item_name'));
			for($i=0;$i<$count;$i++)
			{
				$insertArr1=array('invoiceid'=>$invoiceid,'item' => $item[$i],'qtyhrs' => $qtyhrs[$i], 'unitprice' => $unitprice[$i], 'tax' => $tax[$i],'amount'=>$amount[$i],'description' => $description[$i]);
				$this->common_model->insertData('tbl_invoiceproduct',$insertArr1);
			}
				$this->session->set_flashdata('messagename', "Data Inserted Succeess");
				redirect('Finance/invoice');


			}
	}
	
	public function invoice(){
		$this->load->view('common/header');
		$this->load->view('Invoices/invoice');
		$this->load->view('common/footer');
	}
	
	public function invoice_list(){
	if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';	
			$aColumns = array( 'id', 'invoice', 'project', 'clientid','total', 'invoicedate','status');
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
            	$sWhere .= ' AND (project like "%'.$searchTerm.'%" OR clientname like "%'.$searchTerm.'%" OR companyname like "%'.$searchTerm.'%" OR note like "%'.$searchTerm.'%")';
            }
				$startdate=!empty($_POST['startdate']) ? $_POST['startdate'] : '';
				$enddate=!empty($_POST['enddate']) ? $_POST['enddate'] : '';
				$projectname=!empty($_POST['projectname']) ? $_POST['projectname'] : '';
				$clientname=!empty($_POST['clientname']) ? $_POST['clientname'] : '';
				$status=$_POST['status'];
		
				if(!empty($projectname)){
							$sWhere.=' AND  project="'.$projectname.'"';

					}
					if(!empty($clientname)){
							$sWhere.=' AND  clientname="'.$clientname.'"';

					}
					
					if($status=='all'){
						}else{
								$sWhere.=' AND status='.$status;
						}
					if(!empty($startdate)){						
						$sWhere.=' AND duedate>="'.$startdate.'"';
					}
					if(!empty($enddate)){						
						$sWhere.=' AND duedate<="'.$enddate.'"';
					}
					
					if(!empty($sWhere)){
						$sWhere = " WHERE 1 ".$sWhere;
					}
					/** Filtering End */
				}
				
		
	    $query = "SELECT i.* , c.clientname ,p.projectname FROM tbl_invoice i INNER JOIN tbl_clients c ON c.id = i.clientid INNER JOIN tbl_project_info p ON p.id = i.project".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
		$invoicesArr = $this->common_model->coreQueryObject($query);

		$query = "SELECT * from tbl_invoice ".$sWhere;
		//echo $query;die;
		$invoicesFilterArr = $this->common_model->coreQueryObject($query);
		$iFilteredTotal = count($invoicesFilterArr);

		$invoicesAllArr = $this->common_model->getData('tbl_invoice');
		$iTotal = count($invoicesAllArr);

		/** Output */
		$datarow = array();
		$i = 1;
		foreach($invoicesArr as $row) {
			$id = $row->id;
			if($row->status == '0'){
				$status = $row->status = 'Unpaid';
				$sta='<lable class="label label-danger">'.$status.'</label>';

			}
			else if($row->status == '1'){
				$status = $row->status = 'Paid';
				$sta='<lable class="label label-success">'.$status.'</label>';
			}
			else if($row->status == '2'){
				$status = $row->status = 'Partially Paid';
				$sta='<lable class="label label-info">'.$status.'</label>';
			}
			//$clientid = $row->clientid;
			//$create_date = date('d-m-Y', strtotime($row->created_at));
			
				$actionStr = '<div class="dropdown action m-r-10">
				                <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">Action  <span class="caret"></span></button>
				                		<div class="dropdown-menu">
						       
											<a  class="dropdown-item" href="javascript:void(0);" onclick="deleteinvoices(\''.base64_encode($id).'\')"><i class="fa fa-trash "></i> Delete</a>
											
				               			 </div>
							</div>';
			
			
			$datarow[] = array(
				$id = $i,
                $row->invoice,
                $row->projectname,
                $row->clientname,
                $row->total,
             	$row->invoicedate,
                $sta,	
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

		public function deleteinvoice(){
		$invoiceid=base64_decode($_POST['id']);
		$whereArr=array('id'=>$invoiceid);
		$this->common_model->deleteData('tbl_invoice',$whereArr);
		//echo $this->db->last_query();die;
		redirect('Finance/invoice');
	}

	
	public function addexpenses(){
		
		//$data['sessData'] = $this->session->flashdata('data');
		$data['employee'] =$this->common_model->getData('tbl_employee');
		$data['project'] =$this->common_model->getData('tbl_project_info');
		$this->load->view('common/header');
		$this->load->view('Expenses/addexpense',$data);
		$this->load->view('common/footer');
	}

	public function insertexpense(){
		if($this->input->post('btnsubmit'))
			{
			$employee=$this->input->post('employee');
			$project=$this->input->post('project');
			$currency=$this->input->post('currency');
			$item=$this->input->post('itemname');
			$price=$this->input->post('price');
			$purchasedform=$this->input->post('purchasedfrom');
			$purchasedate=$this->input->post('purchasedate');
			
			$file = rand(1000,100000)."-".$_FILES['file']['name'];
			$file_loc = $_FILES['file']['tmp_name'];
			$file_size = $_FILES['file']['size'];
			$file_type = $_FILES['file']['type'];
			$folder="uploads/";
			move_uploaded_file($file_loc,$folder.$file);

			 //print_r($_FILES);die;

		
				$insertArr=array('employee'=>$employee,'project' => $project,'currency' => $currency,'item' => $item,'price' => $price,'purchasedform' => $purchasedform,'purchasedate' => $purchasedate,'invoicefile' => $file,'status' => '0');
					//print_r($insertArr);die;
				$this->common_model->insertdata('tbl_expense',$insertArr);
				$this->session->set_flashdata('message_name', "Data Inserted Succeessfully");
				redirect('Finance/expense');
			
				
			}
		}



	
		public function expense(){

			$data['employee'] =$this->common_model->getData('tbl_employee');
			$this->load->view('common/header');
			$this->load->view('Expenses/expense',$data);
			$this->load->view('common/footer');
		}
	
	public function expense_list(){
	if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';	
			$aColumns = array( 'id', 'item', 'price', 'purchasedform','employee', 'purchasedate','status');
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
            	$sWhere .= ' AND (item like "%'.$searchTerm.'%" OR price like "%'.$searchTerm.'%" OR purchasedform like "%'.$searchTerm.'%" OR employee like "%'.$searchTerm.'%"  OR purchasedate like "%'.$searchTerm.'%")';
            }
				$startdate=!empty($_POST['startdate']) ? $_POST['startdate'] : '';
				$enddate=!empty($_POST['enddate']) ? $_POST['enddate'] : '';
				$employee=!empty($_POST['employee']) ? $_POST['employee'] : '';
				$status=$_POST['status'];
		
				if(!empty($employee)){
							$sWhere.=' AND  employee="'.$employee.'"';

					}
					
					if($status=='all'){
						}else{
								$sWhere.=' AND status='.$status;
						}
					if(!empty($startdate)){						
						$sWhere.=' AND duedate>="'.$startdate.'"';
					}
					if(!empty($enddate)){						
						$sWhere.=' AND duedate<="'.$enddate.'"';
					}
					
					if(!empty($sWhere)){
						$sWhere = " WHERE 1 ".$sWhere;
					}
					/** Filtering End */
				}
				
		
	    $query = "select tbl_expense.* , tbl_employee.employeename from tbl_expense INNER JOIN tbl_employee ON tbl_employee.id=tbl_expense.employee".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
		$expensesArr = $this->common_model->coreQueryObject($query);

		$query = "SELECT * from tbl_expense ".$sWhere;
		//echo $query;die;
		$expensesFilterArr = $this->common_model->coreQueryObject($query);
		$iFilteredTotal = count($expensesFilterArr);

		$expensesAllArr = $this->common_model->getData('tbl_expense');
		$iTotal = count($expensesAllArr);

		/** Output */
		$datarow = array();
		$i = 1;
		foreach($expensesArr as $row) {
			$id = $row->id;
			if($row->status == '0'){
				$status = $row->status = 'Pending';
				$sta='<lable class="label label-danger">'.$status.'</label>';

			}
			else if($row->status == '1'){
				$status = $row->status = 'Approved';
				$sta='<lable class="label label-success">'.$status.'</label>';
			}
			else if($row->status == '2'){
				$status = $row->status = ' Rejected';
				$sta='<lable class="label label-info">'.$status.'</label>';
			} 
			//$clientid = $row->clientid;
			//$create_date = date('d-m-Y', strtotime($row->created_at));
			
				$actionStr = "<abbr title=\"Edit\"><a class=\"btn btn-info btn-circle\" data-toggle=\"tooltip\" data-original-title=\"Edit\" href='".base_url()."Finance/editexpenses/".base64_encode($id)."'><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a></abbr>

					<abbr title=\"Delete\"><a  class=\"btn btn-danger btn-circle sa-params\" data-toggle=\"tooltip\"  data-original-title=\"Delete\" href=\"javascript:void(0);\" onclick=\"deleteexpenses('".base64_encode($id)."');\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></a></abbr>";
			$datarow[] = array(
				$id = $i,
                $row->item,
                $row->price,
                $row->purchasedform,
                $row->employeename,
             	$row->purchasedate,
                $sta,	
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

	public function editexpenses(){
		$id=base64_decode($this->uri->segment(3));
		$whereArr=array('id'=>$id);
		$data['employee'] =$this->common_model->getData('tbl_employee');
		$data['project'] =$this->common_model->getData('tbl_project_info');
		$data['expense']=$this->common_model->getData('tbl_expense',$whereArr);
		$this->load->view('common/header');
		$this->load->view('Expenses/editexpense',$data);
		$this->load->view('common/footer');

		if($this->input->post('btnupdate')){
			$employee=$this->input->post('employee');
			$project=$this->input->post('project');
			$currency=$this->input->post('currency');
			$item=$this->input->post('itemname');
			$price=$this->input->post('price');
			$purchasedform=$this->input->post('purchasedfrom');
			$purchasedate=$this->input->post('purchasedate');
				if(!empty($_FILES))
				{
					$file = rand(1000,100000)."-".$_FILES['file']['name'];
					$file_loc = $_FILES['file']['tmp_name'];
					$file_size = $_FILES['file']['size'];
					$file_type = $_FILES['file']['type'];
					$folder="uploads/";
					move_uploaded_file($file_loc,$folder.$file);

					$updateArr['invoicefile']=$file;
				}
				else
				{
					$updateArr['invoicefile']=$this->input->post('image_name');
				}
			$status=$this->input->post('status');	

			$updateArr['employee'] = $employee;
			$updateArr['project'] = $project;
			$updateArr['currency'] = $currency;
			$updateArr['item'] = $item;
			$updateArr['price'] = $price;
			$updateArr['purchasedform'] = $purchasedform;
			$updateArr['purchasedate'] = $purchasedate;
			$updateArr['status'] = $status;
	
				$this->common_model->updateData('tbl_expense',$updateArr,$whereArr);
				$this->session->set_flashdata('message_name', "Data Updated Succeessfully");
				redirect('Finance/expense');
			


				
			}
	}

	public function deleteexpense(){
		$expenseid=base64_decode($_POST['id']);
		$whereArr=array('id'=>$expenseid);
		$this->common_model->deleteData('tbl_expense',$whereArr);
		//echo $this->db->last_query();die;
		redirect('Finance/expense');
	}
	
	
}
?>