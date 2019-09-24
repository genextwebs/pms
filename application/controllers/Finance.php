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
				//echo $total;die;
				$note=$this->input->post('note');
				$insertArr=array('client' => $client,'currency' => $currency,'validtill' => $valid_till,'note' => $note,'status'=>'0','total'=>$total);
				$this->common_model->insertData('tbl_estimates',$insertArr);
				$estimateid=$this->db->insert_id();
					
				$item_name=$this->input->post('item_name');
				$quantity=$this->input->post('quantity');
				$cost_per_item=$this->input->post('cost_per_item');
				$taxes=$this->input->post('taxes');
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
            	$sWhere .= ' AND (clientname like "%'.$searchTerm.'%" OR companyname like "%'.$searchTerm.'%" OR website like "%'.$searchTerm.'%" OR address like "%'.$searchTerm.'%" OR clientemail like "%'.$searchTerm.'%" OR facebook like "%'.$searchTerm.'%" OR note like "%'.$searchTerm.'%")';
            }
				$startdate=!empty($_POST['startdate']) ? $_POST['startdate'] : '';
				$enddate=!empty($_POST['enddate']) ? $_POST['enddate'] : '';
				$status=$_POST['status'];
		
					
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
				
		
	    $query = "SELECT * from tbl_estimates ".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
		$estimatesArr = $this->common_model->coreQueryObject($query);

		$query = "SELECT * from tbl_estimates ".$sWhere;
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
			
				$actionStr = "<abbr title=\"Edit\"><a class=\"btn btn-info btn-circle\" data-toggle=\"tooltip\" data-original-title=\"Edit\" href='".base_url()."Clients/editclients/".base64_encode($id)."'><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a></abbr>
				<abbr title=\"View Client Details\"><a class=\"btn btn-success btn-circle\" data-toggle=\"tooltip\" data-original-title=\"View Client Details\" href='".base_url()."Clients/viewclientdetail/".base64_encode($id)."'><i class=\"fa fa-search\" aria-hidden=\"true\" ></i></a></abbr>
				<abbr title=\"Delete\"><a  class=\"btn btn-danger btn-circle sa-params\" data-toggle=\"tooltip\"  data-original-title=\"Delete\" href=\"javascript:void();\" onclick=\"deleteclients('".base64_encode($id)."');\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></a></abbr>";	
           
			
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
	
}
?>