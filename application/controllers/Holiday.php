<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Holiday extends CI_Controller 
{
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model');
		$this->login = $this->session->userdata('login');
		$this->user_id = $this->login->id;
		func_check_login();
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
		$febQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '02' order BY DAY(date) ASC");
		$febTempArr = $febQuery->result_array();
		$finalfebArr = array();
		if(!empty($febTempArr)){
			foreach ($febTempArr as $key => $value) {
				$finalfebArr[$value['date']] = $value['occasion'];
			}
		}
		$data['febArr'] = $finalfebArr;
		$marQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '03' order BY DAY(date) ASC");
		$marTempArr = $marQuery->result_array();
		$finalmarArr = array();
		if(!empty($marTempArr)){
			foreach ($marTempArr as $key => $value) {
				$finalmarArr[$value['date']] = $value['occasion'];
			}
		}
		$data['marArr'] = $finalmarArr;
		$aprQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '04' order BY DAY(date) ASC");
		$aprilTempArr = $aprQuery->result_array();
		$finalaprilArr = array();
		if(!empty($aprilTempArr)){
			foreach ($aprilTempArr as $key => $value) {
				$finalaprilArr[$value['date']] = $value['occasion'];
			}
		}
		$data['aprilArr'] = $finalaprilArr;
		$mayQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '05' order BY DAY(date) ASC");
		$mayTempArr = $mayQuery->result_array();
		$finalmayArr = array();
		if(!empty($mayTempArr)){
			foreach ($mayTempArr as $key => $value) {
				$finalmayArr[$value['date']] = $value['occasion'];
			}
		}
		$data['mayArr'] = $finalmayArr;
		$junQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '06' order BY DAY(date) ASC");
		$juneTempArr = $junQuery->result_array();
		$finaljuneArr = array();
		if(!empty($juneTempArr)){
			foreach ($juneTempArr as $key => $value) {
				$finaljuneArr[$value['date']] = $value['occasion'];
			}
		}
		$data['juneArr'] = $finaljuneArr;
		$julQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '07' order BY DAY(date) ASC");
		$julyTempArr = $julQuery->result_array();
		$finaljulyArr = array();
		if(!empty($julyTempArr)){
			foreach ($julyTempArr as $key => $value) {
				$finaljulyArr[$value['date']] = $value['occasion'];
			}
		}
		$data['julyArr'] = $finaljulyArr;
		$augQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '08' order BY DAY(date) ASC");
		$augTempArr = $augQuery->result_array();
		$finalaugArr = array();
		if(!empty($augTempArr)){
			foreach ($augTempArr as $key => $value) {
				$finalaugArr[$value['date']] = $value['occasion'];
			}
		}
		$data['augestArr'] = $finalaugArr;
		$sepQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '09' order BY DAY(date) ASC");
		$sepTempArr = $sepQuery->result_array();
		$finalsepArr = array();
		if(!empty($sepTempArr)){
			foreach ($sepTempArr as $key => $value) {
				$finalsepArr[$value['date']] = $value['occasion'];
			}
		}
		$data['sepArr'] = $finalsepArr;
		$octQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '10' order BY DAY(date) ASC");
		$octTempArr = $octQuery->result_array();
		$finaloctArr = array();
		if(!empty($octTempArr)){
			foreach ($octTempArr as $key => $value) {
				$finaloctArr[$value['date']] = $value['occasion'];
			}
		}
		$data['octArr'] = $finaloctArr;
		$novQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '11' order BY DAY(date) ASC");
		$novTempArr = $novQuery->result_array();
		$finalnovArr = array();
		if(!empty($novTempArr)){
			foreach ($novTempArr as $key => $value) {
				$finalnovArr[$value['date']] = $value['occasion'];
			}
		}
		$data['novArr'] = $finalnovArr;
		$decQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '12' order BY DAY(date) ASC");
		$decTempArr = $decQuery->result_array();
		$finaldecArr = array();
		if(!empty($decTempArr)){
			foreach ($decTempArr as $key => $value) {
				$finaldecArr[$value['date']] = $value['occasion'];
			}
		}
		$data['decArr'] = $finaldecArr;
		$this->load->view('common/header');
		$this->load->view('holiday/holiday',$data);
		$this->load->view('common/footer');
	}

	public function insert_data(){
		$message = '';
		if(!empty($_POST)){
			$holiday_arr = $_POST['holiday'];
			$occasion_arr = $_POST['occasion'];
			for($i=0;$i<=count($holiday_arr)-1;$i++){
				if(!empty($holiday_arr[$i]) && !empty($occasion_arr[$i])){
					$inserDate = date('Y-m-d', strtotime($holiday_arr[$i]));
					$insArr = array('date'=>$inserDate,'occasion'=>$occasion_arr[$i]);
					$dateDay = date('l', strtotime($inserDate));
					$whereArr = array('date' => $inserDate);
					$data = $this->common_model->getData("tbl_holiday",$whereArr);
					if(count($data) == 1){
						$message = 1;
						
					}
					else{
							$this->common_model->insertData('tbl_holiday',$insArr);
							$message = 2;
					}
					//SELECT * FROM `tbl_holiday` where MONTH(date) = '01'
				}
			}
		}
		echo $message;exit;
	}

	public function insert_defaultholiday(){
		if(!empty($_POST)){
			//print_r($_POST);exit;
			$saturday = $this->input->post('saturday');
			$sunday = $this->input->post('sunday');
			$insArr = array('saturday' =>$saturday,'sunday'=>$sunday,'user_id' =>$this->user_id);
			$data = $this->common_model->getData('tbl_holiday_settings');
			if(!empty($data[0]->user_id)){
				$updateArr = array('saturday' =>$saturday,'sunday'=>$sunday);
				$whereArr = array('user_id' => $data[0]->user_id);
				$this->common_model->updateData('tbl_holiday_settings',$updateArr,$whereArr);
			}
			else{
				$this->common_model->insertData('tbl_holiday_settings',$insArr);
			}
		}
	}
}

?>