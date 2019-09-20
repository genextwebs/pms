<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller 
{
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model');
	}
	
	public function index(){
		$this->load->view('common/header');
		$this->load->view('products/products');
		$this->load->view('common/footer');
	}

	public function addproducts(){
		$data['tax'] = $this->common_model->getData('tbl_tax');
		$this->load->view('common/header');
		$this->load->view('products/addproducts',$data);
		$this->load->view('common/footer');
	}

	public function insertproducts(){
		if(!empty($_POST)){
			$name = $this->input->post('name');
			$price = $this->input->post('price');
			$tax = $this->input->post('tax');

			$price1=($price*$tax)/100;
			$total=$price+$price1;
			$description = $this->input->post('description');
			$insArr = array('name'=>$name,'price'=>$total,'tax'=>$tax,'description'=>$description);
			$this->common_model->insertData('tbl_product',$insArr);
			$this->session->set_flashdata('message_name', 'Product Insert sucessfully');
			redirect('Products');
		}
	}

	public function inserttax(){
		if(!empty($_POST)){
			$taxname = $this->input->post('taxname');
			$rate = $this->input->post('rate');
			$insArr = array('taxname'=>$taxname,'rate'=>$rate);
			$this->common_model->insertData('tbl_tax',$insArr);
			$taxArray = $this->common_model->getData('tbl_tax');
			$str = '';
			foreach($taxArray as $row){
				$str.='<option value="'.$row->rate.'">'.$row->taxname.'('.$row->rate.'%)</option>'; 
			}
			$totaldata = count($taxArray);
			$txtArr = array();
			$txtArr['count'] = $totaldata;
			$txtArr['taxdata'] = $str;
			echo  json_encode($txtArr);exit; 
			echo  $totaldata; exit;
		}
	}

	public function product_list(){
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';
			$aColumns = array( 'id', 'name', 'price');
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
            	$sWhere .= ' AND (name like "%'.$searchTerm.'%" OR price like "%'.$searchTerm.'%" OR tax like "%'.$searchTerm.'%" OR description like "%'.$searchTerm.'%")';
            }
            if(!empty($sWhere)){
            	$sWhere = " WHERE 1 ".$sWhere;
            }
            /** Filtering End */
		}
		
	    $query = "SELECT * from tbl_product ".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
		$productsArr = $this->common_model->coreQueryObject($query);

		$query = "SELECT * from tbl_product ".$sWhere;
		$productsFilterArr = $this->common_model->coreQueryObject($query);
		$iFilteredTotal = count($productsFilterArr);

		$productsAllArr = $this->common_model->getData('tbl_product');
		$iTotal = count($productsAllArr);

		/** Output */
		$datarow = array();
		$i = 1;
		foreach($productsArr as $row) {
			$id = $row->id;
			
				$actionStr = '<a href='.base_url().'Project/editproject/'.base64_encode($row->id). ' class="btn btn-info btn-circle" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
					<a href='.base_url().'Project/deleteproject/'.base64_encode($row->id).' onclick="javascript:return confirm(\'Are u Sure want to delete?\');" class="btn btn-danger btn-circle sa-params" data-toggle="tooltip" data-user-id="1" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>';
			
			$datarow[] = array(
				$id = $i,
                $row->name,
                $row->price,
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