<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Holiday extends CI_Controller 
{
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model');
	}

	public function index(){

		$janQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '01' order BY DAY(date) ASC");
		$janTempArr = $janQuery->result_array();
		$finalJanArr = array();
		if(!empty($janTempArr)){
			foreach ($janTempArr as $key => $value) {
				$finalJanArr[$value['date']] = $value['occasion'];
			}
		}
		$data['janArr'] = $finalJanArr;
		/*$febQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '01'");
		$data['janArr'] = $febQuery->result_array();
		$marQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '01'");
		$data['janArr'] = $janQuery->result_array();
		$aprQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '01'");
		$data['janArr'] = $janQuery->result_array();
		$mayQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '01'");
		$data['janArr'] = $janQuery->result_array();
		$junQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '01'");
		$data['janArr'] = $janQuery->result_array();
		$julQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '01'");
		$data['janArr'] = $janQuery->result_array();
		$augQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '01'");
		$data['janArr'] = $janQuery->result_array();*/
		

		$this->load->view('common/header');
		$this->load->view('holiday/holiday',$data);
		$this->load->view('common/footer');
	}

	public function insert_data(){
		$message = '';
		if(!empty($_POST)){
			$holidat_arr = $_POST['holiday'];
			$occasion_arr = $_POST['occasion'];
			for($i=0;$i<=count($holidat_arr)-1;$i++){
				if(!empty($holidat_arr[$i]) && !empty($occasion_arr[$i])){
					$inserDate = date('Y-m-d', strtotime($holidat_arr[$i]));
					$insArr = array('date'=>$inserDate,'occasion'=>$occasion_arr[$i]);
					$dateDay = date('l', strtotime($inserDate));
					$whereArr = array('date' => $inserDate);
					$data = $this->common_model->getData("tbl_holiday",$whereArr);
					if(count($data) == 1 && $dateDay == 'Sunday'){
						$message = 1;
						
					}
					else{
						
						$message = 2;
					$this->common_model->insertData('tbl_holiday',$insArr);
					}
					//SELECT * FROM `tbl_holiday` where MONTH(date) = '01'
				}
			}
		}
		echo $message;exit;
	}
}

?>