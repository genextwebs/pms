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
				
		
	    $query = "SELECT * from tbl_estimates ".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
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
											<a  class="dropdown-item" href="javascript:void()" onclick="deleteestimates(\''.base64_encode($row->id).'\')"><i class="fa fa-trash "></i> Delete</a>
											<a  class="dropdown-item" href='.base_url().'Finance/createinvoice/'.base64_encode($id).'><i class="ti-receipt"></i>Create Invoice</a>
				               			 </div>
							</div>';
			
			
			$datarow[] = array(
				$id = $i,
                $row->client,
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
		$this->load->view('common/header');
		$this->load->view('Estimates/createinvoice',$data);
		$this->load->view('common/footer');

		if($this->input->post('btnsubmit'))
		{
			$invoice=$this->input->post('txtinvoice');
			$project=$this->input->post('txtproject');
			$currency=$this->input->post('txtcurrency');
			$invoicedate=$this->input->post('txtinvoicedate');
			$duedate=$this->input->post('txtduedate');
			$status=$this->input->post('txtstatus');
			$recuringpayment=$this->input->post('txtrp');
			$billingfrequency=$this->input->post('txtbf');
			$billinginterval=$this->input->post('txtbi');
			$billingcycle=$this->input->post('txtbc');
			$total=$this->input->post('txttotal');
			$insertArr=array('invoice' => $invoice,'project' => $project,'currency' => $currency,'invoicedate' => $invoicedate,'duedate'=>$duedate,'status'=>$status,'recuringpayment'=>$recuringpayment,'billingfrequency'=>$billingfrequency,'billinginterval'=>$billinginterval,'billingcycle'=>$billingcycle,'total'=>$total);
			$this->common_model->insertData('tbl_invoice',$insertArr);
			$invoiceid=$this->db->insert_id();
			
			$item=$this->input->post('txtitem');
			$qtyhrs=$this->input->post('txtqtyhrs');
			$unitprice=$this->input->post('txtunitprice');
			$tax=$this->input->post('txttax');
			$amount=$this->input->post('txtamount');
			$description=$this->input->post('txtdescription');
			$count=count($this->input->post('txtitem'));
			for($i=0;$i<$count;$i++)
			{
				$insertArr1=array('invoiceid'=>$invoiceid,'item' => $item[$i],'qtyhrs' => $qtyhrs[$i], 'unitprice' => $unitprice[$i], 'tax' => $tax[$i],'amount'=>$amount[$i],'description' => $description[$i]);
				$this->common_model->insertData('tbl_invoiceproduct',$insertArr1);
			}
				$this->session->set_flashdata('messagename', "Data Inserted Succeess");
				redirect('Estimates/viewinvoicepage');

			}
	}
}
?>