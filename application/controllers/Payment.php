<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('common_model');
		ini_set('display_errors',0);
		//error_reporting(E_ALL);
		$this->login = $this->session->userdata('login');
		$this->user_type = $this->login->user_type;
		$this->user_id = $this->login->id;	
		func_check_login();
	}

	public function index(){
		$whereArr = array('is_deleted'=>0);
		$data['project']=$this->common_model->getData('tbl_project_info',$whereArr);
		$this->load->view('common/header');
		$this->load->view('Payment/payment',$data);
		$this->load->view('common/footer');
	}

	public function razorPaySuccess(){
        $razorpay_payment_id = $this->input->post('razorpay_payment_id');
        $project = $this->input->post('project');
        $paidon = $this->input->post('paidon');
        $currency = $this->input->post('currency');
        $amount = $this->input->post('amount');
        $remark = $this->input->post('remark');
      // $mobileNo = $this->input->post('mobileNo');
        $userid = $this->input->post('userid');
        $invoiceid = $this->input->post('invoiceid');
        $insArr = array('user_id' => $userid , 'project' => $project , 'paidon' => $paidon , 'currency' => $currency , 'amount' => $amount , 'remark' => $remark , 'successkey' => $razorpay_payment_id);
       // print_r($insArr);
        $this->common_model->insertData('tbl_payment', $insArr);
        $arr = array('msg' => 'Payment Successfully Credited');
        $userarray = array();
        $userarray['userId'] = base64_encode($userid);
        $userarray['invoiceid'] = base64_encode($invoiceid);

        echo json_encode($userarray);exit();
        echo  json_encode($arr);exit(); 
    }

    public function response($page = null)
    {
        $invoiceid = base64_decode($this->uri->segment(3));

        $whereArrI = array('id'=>$invoiceid);
        $updateArrI = array('payment_done'=>1,'status'=>1);
        $this->common_model->updateData('tbl_invoice',$updateArrI,$whereArrI);
        $whereArr = array('id'=>$this->user_id);
        $updateArr = array('payment_verify'=>1);
        $this->common_model->updateData('tbl_user',$updateArr,$whereArr);
        $this->load->view('common/header');
        $this->load->view('Payment/response');
        $this->load->view('common/footer');
    }  
}
?>