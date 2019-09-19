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
			$price1=($price*$tax)/100;
			$total=$price+$price1;
			$calculatedTaxRate=(($total-$price)/$price)*100;
			$tax = $this->input->post('tax');
			$description = $this->input->post('description');
			$insArr = array('name'=>$name,'price'=>$calculatedTaxRate,'tax'=>$tax,'description'=>$description);
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
			//print_r($insArr);die;
			$this->common_model->insertData('tbl_tax',$insArr);
		}
	}
}
?>