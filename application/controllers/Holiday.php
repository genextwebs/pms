<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Holiday extends CI_Controller 
{
	public function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->load->model('common_model');
		$this->login = $this->session->userdata('login');
		$this->user_id = $this->login->id;
		$this->year = date('Y');
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
		$data['selYear'] = $this->year;
		$this->load->view('common/header');
		$this->load->view('holiday/holiday',$data);
		$this->load->view('common/footer');
	}

	public function displayData(){
		$wherArr = array('user_id' =>$this->user_id);
        $data = $this->common_model->getData('tbl_holiday_settings',$wherArr);
        $SaturdayChk = $data[0]->saturday;
        $SundayChk = $data[0]->sunday;
		$janQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '01' order BY DAY(date) ASC");
		$janTempArr = $janQuery->result_array();
		$finalJanArr = array();
		if(!empty($janTempArr)){
			foreach ($janTempArr as $key => $value) {
				$finalJanArr[$value['date']] = $value['occasion'];
			}
		}
		$janArr = $finalJanArr;

		$j = 1;
		$janStr = '';
        for($i=1;$i<=31;$i++){
            $date = date('Y-m-d', strtotime('2019-01-'.$i));
            $dateDay = date('l', strtotime($date));
            if(!empty($janArr[$date])){
                $janStr .= '<tr>';
                $janStr .= '<td>'.$j.'</td>';
                $janStr .= '<td>'.$date.'</td>';
                $janStr .= '<td>';
                if(($dateDay == 'Saturday' || $dateDay == 'Sunday') && ($SundayChk == 1 || $SaturdayChk == 1)){
            		$janStr .= $janArr[$date].','.$dateDay;
                }
                else{
                	$janStr .= $janArr[$date];
                } 
                $janStr .= '</td>';
                $janStr .= '<td>'.$dateDay.'</td>';
                $janStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
            	$janStr .= '</tr>';
                $j++; 
            }
            else if($dateDay == 'Saturday' && $SaturdayChk == 1){
                $janStr .= '<tr>';
                $janStr .= '<td>'.$j.'</td>';
                $janStr .= '<td>'.$date.'</td>';
                $janStr .= '<td>Saturday</td>';
                $janStr .= '<td>'.$dateDay.'</td>';
                $janStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
                $janStr .= '</tr>';
                $j++;
            }
            else if($dateDay == 'Sunday' && $SundayChk == 1){
                $janStr .= '<tr>';
                $janStr .= '<td>'.$j.'</td>';
                $janStr .= '<td>'.$date.'</td>';
                $janStr .= '<td>Sunday</td>';
                $janStr .= '<td>'.$dateDay.'</td>';
                $janStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
                $janStr .= '</tr>';
                $j++;
            }   
        }
        $febQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '02' order BY DAY(date) ASC");
		$febTempArr = $febQuery->result_array();
		$finalfebArr = array();
		if(!empty($febTempArr)){
			foreach ($febTempArr as $key => $value) {
				$finalfebArr[$value['date']] = $value['occasion'];
			}
		}
		$febArr = $finalfebArr;

		$j = 1;
		$febStr = '';
        for($i=1;$i<=31;$i++){
            $date = date('Y-m-d', strtotime('2019-02-'.$i));
            $dateDay = date('l', strtotime($date));
            if(!empty($febArr[$date])){
                $febStr .= '<tr>';
                $febStr .= '<td>'.$j.'</td>';
                $febStr .= '<td>'.$date.'</td>';
                $febStr .= '<td>';
                if(($dateDay == 'Saturday' || $dateDay == 'Sunday') && ($SundayChk == 1 || $SaturdayChk == 1)){
            		$febStr .= $febArr[$date].','.$dateDay;
                }
                else{
                	$febStr .= $febArr[$date];
                } 
                $febStr .= '</td>';
                $febStr .= '<td>'.$dateDay.'</td>';
                $febStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
            	$febStr .= '</tr>';
                $j++; 
            }
            else if($dateDay == 'Saturday' && $SaturdayChk == 1){
                $febStr .= '<tr>';
                $febStr .= '<td>'.$j.'</td>';
                $febStr .= '<td>'.$date.'</td>';
                $febStr .= '<td>Saturday</td>';
                $febStr .= '<td>'.$dateDay.'</td>';
                $febStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
                $febStr .= '</tr>';
                $j++;
            }
            else if($dateDay == 'Sunday' && $SundayChk == 1){
                $febStr .= '<tr>';
                $febStr .= '<td>'.$j.'</td>';
                $febStr .= '<td>'.$date.'</td>';
                $febStr .= '<td>Sunday</td>';
                $febStr .= '<td>'.$dateDay.'</td>';
                $febStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
                $febStr .= '</tr>';
                $j++;
            }   
        }

        $marQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '03' order BY DAY(date) ASC");
		$marTempArr = $marQuery->result_array();
		$finalmarArr = array();
		if(!empty($marTempArr)){
			foreach ($marTempArr as $key => $value) {
				$finalmarArr[$value['date']] = $value['occasion'];
			}
		}
		$marArr = $finalmarArr;

		$j = 1;
		$marStr = '';
        for($i=1;$i<=31;$i++){
            $date = date('Y-m-d', strtotime('2019-03-'.$i));
            $dateDay = date('l', strtotime($date));
            if(!empty($marArr[$date])){
                $marStr .= '<tr>';
                $marStr .= '<td>'.$j.'</td>';
                $marStr .= '<td>'.$date.'</td>';
                $marStr .= '<td>';
                if(($dateDay == 'Saturday' || $dateDay == 'Sunday') && ($SundayChk == 1 || $SaturdayChk == 1)){
            		$marStr .= $marArr[$date].','.$dateDay;
                }
                else{
                	$marStr .= $marArr[$date];
                } 
                $marStr .= '</td>';
                $marStr .= '<td>'.$dateDay.'</td>';
                $marStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
            	$marStr .= '</tr>';
                $j++; 
            }
            else if($dateDay == 'Saturday' && $SaturdayChk == 1){
                $marStr .= '<tr>';
                $marStr .= '<td>'.$j.'</td>';
                $marStr .= '<td>'.$date.'</td>';
                $marStr .= '<td>Saturday</td>';
                $marStr .= '<td>'.$dateDay.'</td>';
                $marStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
                $marStr .= '</tr>';
                $j++;
            }
            else if($dateDay == 'Sunday' && $SundayChk == 1){
                $marStr .= '<tr>';
                $marStr .= '<td>'.$j.'</td>';
                $marStr .= '<td>'.$date.'</td>';
                $marStr .= '<td>Sunday</td>';
                $marStr .= '<td>'.$dateDay.'</td>';
                $marStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
                $marStr .= '</tr>';
                $j++;
            }   
        }

        $aprQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '04' order BY DAY(date) ASC");
		$aprilTempArr = $aprQuery->result_array();
		$finalaprilArr = array();
		if(!empty($aprilTempArr)){
			foreach ($aprilTempArr as $key => $value) {
				$finalaprilArr[$value['date']] = $value['occasion'];
			}
		}
		$aprilArr = $finalaprilArr;

		$j = 1;
		$aprilStr = '';
        for($i=1;$i<=31;$i++){
            $date = date('Y-m-d', strtotime('2019-04-'.$i));
            $dateDay = date('l', strtotime($date));
            if(!empty($aprilArr[$date])){
                $aprilStr .= '<tr>';
                $aprilStr .= '<td>'.$j.'</td>';
                $aprilStr .= '<td>'.$date.'</td>';
                $aprilStr .= '<td>';
                if(($dateDay == 'Saturday' || $dateDay == 'Sunday') && ($SundayChk == 1 || $SaturdayChk == 1)){
            		$aprilStr .= $aprilArr[$date].','.$dateDay;
                }
                else{
                	$aprilStr .= $aprilArr[$date];
                } 
                $aprilStr .= '</td>';
                $aprilStr .= '<td>'.$dateDay.'</td>';
                $aprilStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
            	$aprilStr .= '</tr>';
                $j++; 
            }
            else if($dateDay == 'Saturday' && $SaturdayChk == 1){
                $aprilStr .= '<tr>';
                $aprilStr .= '<td>'.$j.'</td>';
                $aprilStr .= '<td>'.$date.'</td>';
                $aprilStr .= '<td>Saturday</td>';
                $aprilStr .= '<td>'.$dateDay.'</td>';
                $aprilStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
                $aprilStr .= '</tr>';
                $j++;
            }
            else if($dateDay == 'Sunday' && $SundayChk == 1){
                $aprilStr .= '<tr>';
                $aprilStr .= '<td>'.$j.'</td>';
                $aprilStr .= '<td>'.$date.'</td>';
                $aprilStr .= '<td>Sunday</td>';
                $aprilStr .= '<td>'.$dateDay.'</td>';
                $aprilStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
                $aprilStr .= '</tr>';
                $j++;
            }   
        }

        $mayQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '05' order BY DAY(date) ASC");
		$mayTempArr = $mayQuery->result_array();
		$finalmayArr = array();
		if(!empty($mayTempArr)){
			foreach ($mayTempArr as $key => $value) {
				$finalmayArr[$value['date']] = $value['occasion'];
			}
		}
		$mayArr = $finalmayArr;

		$j = 1;
		$mayStr = '';
        for($i=1;$i<=31;$i++){
            $date = date('Y-m-d', strtotime('2019-05-'.$i));
            $dateDay = date('l', strtotime($date));
            if(!empty($mayArr[$date])){
                $mayStr .= '<tr>';
                $mayStr .= '<td>'.$j.'</td>';
                $mayStr .= '<td>'.$date.'</td>';
                $mayStr .= '<td>';
                if(($dateDay == 'Saturday' || $dateDay == 'Sunday') && ($SundayChk == 1 || $SaturdayChk == 1)){
            		$mayStr .= $mayArr[$date].','.$dateDay;
                }
                else{
                	$mayStr .= $mayArr[$date];
                } 
                $mayStr .= '</td>';
                $mayStr .= '<td>'.$dateDay.'</td>';
                $mayStr .= '<td></td>';
            	$mayStr .= '</tr>';
                $j++; 
            }
            else if($dateDay == 'Saturday' && $SaturdayChk == 1){
                $mayStr .= '<tr>';
                $mayStr .= '<td>'.$j.'</td>';
                $mayStr .= '<td>'.$date.'</td>';
                $mayStr .= '<td>Saturday</td>';
                $mayStr .= '<td>'.$dateDay.'</td>';
                $mayStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
                $mayStr .= '</tr>';
                $j++;
            }
            else if($dateDay == 'Sunday' && $SundayChk == 1){
                $mayStr .= '<tr>';
                $mayStr .= '<td>'.$j.'</td>';
                $mayStr .= '<td>'.$date.'</td>';
                $mayStr .= '<td>Sunday</td>';
                $mayStr .= '<td>'.$dateDay.'</td>';
                $mayStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
                $mayStr .= '</tr>';
                $j++;
            }   
        }



		$junQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '06' order BY DAY(date) ASC");
		$juneTempArr = $junQuery->result_array();
		$finaljuneArr = array();
		if(!empty($juneTempArr)){
			foreach ($juneTempArr as $key => $value) {
				$finaljuneArr[$value['date']] = $value['occasion'];
			}
		}
		$juneArr = $finaljuneArr;

			$j = 1;
		$juneStr = '';
        for($i=1;$i<=31;$i++){
            $date = date('Y-m-d', strtotime('2019-06-'.$i));
            $dateDay = date('l', strtotime($date));
            if(!empty($juneArr[$date])){
                $juneStr .= '<tr>';
                $juneStr .= '<td>'.$j.'</td>';
                $juneStr .= '<td>'.$date.'</td>';
                $juneStr .= '<td>';
                if(($dateDay == 'Saturday' || $dateDay == 'Sunday') && ($SundayChk == 1 || $SaturdayChk == 1)){
            		$juneStr .= $juneArr[$date].','.$dateDay;
                }
                else{
                	$juneStr .= $juneArr[$date];
                } 
                $juneStr .= '</td>';
                $juneStr .= '<td>'.$dateDay.'</td>';
                $juneStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
            	$juneStr .= '</tr>';
                $j++; 
            }
            else if($dateDay == 'Saturday' && $SaturdayChk == 1){
                $juneStr .= '<tr>';
                $juneStr .= '<td>'.$j.'</td>';
                $juneStr .= '<td>'.$date.'</td>';
                $juneStr .= '<td>Saturday</td>';
                $juneStr .= '<td>'.$dateDay.'</td>';
                $juneStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
                $juneStr .= '</tr>';
                $j++;
            }
            else if($dateDay == 'Sunday' && $SundayChk == 1){
                $juneStr .= '<tr>';
                $juneStr .= '<td>'.$j.'</td>';
                $juneStr .= '<td>'.$date.'</td>';
                $juneStr .= '<td>Sunday</td>';
                $juneStr .= '<td>'.$dateDay.'</td>';
                $juneStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
                $juneStr .= '</tr>';
                $j++;
            }   
        }

		$julQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '07' order BY DAY(date) ASC");
		$julyTempArr = $julQuery->result_array();
		$finaljulyArr = array();
		if(!empty($julyTempArr)){
			foreach ($julyTempArr as $key => $value) {
				$finaljulyArr[$value['date']] = $value['occasion'];
			}
		}
		$julyArr = $finaljulyArr;

		$j = 1;
		$julyStr = '';
        for($i=1;$i<=31;$i++){
            $date = date('Y-m-d', strtotime('2019-07-'.$i));
            $dateDay = date('l', strtotime($date));
            if(!empty($julyArr[$date])){
                $julyStr .= '<tr>';
                $julyStr .= '<td>'.$j.'</td>';
                $julyStr .= '<td>'.$date.'</td>';
                $julyStr .= '<td>';
                if(($dateDay == 'Saturday' || $dateDay == 'Sunday') && ($SundayChk == 1 || $SaturdayChk == 1)){
            		$julyStr .= $julyArr[$date].','.$dateDay;
                }
                else{
                	$julyStr .= $julyArr[$date];
                } 
                $julyStr .= '</td>';
                $julyStr .= '<td>'.$dateDay.'</td>';
                $julyStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
            	$julyStr .= '</tr>';
                $j++; 
            }
            else if($dateDay == 'Saturday' && $SaturdayChk == 1){
                $julyStr .= '<tr>';
                $julyStr .= '<td>'.$j.'</td>';
                $julyStr .= '<td>'.$date.'</td>';
                $julyStr .= '<td>Saturday</td>';
                $julyStr .= '<td>'.$dateDay.'</td>';
                $julyStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
                $julyStr .= '</tr>';
                $j++;
            }
            else if($dateDay == 'Sunday' && $SundayChk == 1){
                $julyStr .= '<tr>';
                $julyStr .= '<td>'.$j.'</td>';
                $julyStr .= '<td>'.$date.'</td>';
                $julyStr .= '<td>Sunday</td>';
                $julyStr .= '<td>'.$dateDay.'</td>';
                $julyStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
                $julyStr .= '</tr>';
                $j++;
            }   
        }

		$augQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '08' order BY DAY(date) ASC");
		$augTempArr = $augQuery->result_array();
		$finalaugArr = array();
		if(!empty($augTempArr)){
			foreach ($augTempArr as $key => $value) {
				$finalaugArr[$value['date']] = $value['occasion'];
			}
		}
		$augestArr = $finalaugArr;

		$j = 1;
		$augStr = '';
        for($i=1;$i<=31;$i++){
            $date = date('Y-m-d', strtotime('2019-08-'.$i));
            $dateDay = date('l', strtotime($date));
            if(!empty($augestArr[$date])){
                $augStr .= '<tr>';
                $augStr .= '<td>'.$j.'</td>';
                $augStr .= '<td>'.$date.'</td>';
                $augStr .= '<td>';
                if(($dateDay == 'Saturday' || $dateDay == 'Sunday') && ($SundayChk == 1 || $SaturdayChk == 1)){
            		$augStr .= $augestArr[$date].','.$dateDay;
                }
                else{
                	$augStr .= $augestArr[$date];
                } 
                $augStr .= '</td>';
                $augStr .= '<td>'.$dateDay.'</td>';
                $augStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
            	$augStr .= '</tr>';
                $j++; 
            }
            else if($dateDay == 'Saturday' && $SaturdayChk == 1){
                $augStr .= '<tr>';
                $augStr .= '<td>'.$j.'</td>';
                $augStr .= '<td>'.$date.'</td>';
                $augStr .= '<td>Saturday</td>';
                $augStr .= '<td>'.$dateDay.'</td>';
                $augStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
                $augStr .= '</tr>';
                $j++;
            }
            else if($dateDay == 'Sunday' && $SundayChk == 1){
                $augStr .= '<tr>';
                $augStr .= '<td>'.$j.'</td>';
                $augStr .= '<td>'.$date.'</td>';
                $augStr .= '<td>Sunday</td>';
                $augStr .= '<td>'.$dateDay.'</td>';
                $augStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
                $augStr .= '</tr>';
                $j++;
            }   
        }

		$sepQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '09' order BY DAY(date) ASC");
		$sepTempArr = $sepQuery->result_array();
		$finalsepArr = array();
		if(!empty($sepTempArr)){
			foreach ($sepTempArr as $key => $value) {
				$finalsepArr[$value['date']] = $value['occasion'];
			}
		}
		$sepArr = $finalsepArr;

		$j = 1;
		$sepStr = '';
        for($i=1;$i<=31;$i++){
            $date = date('Y-m-d', strtotime('2019-09-'.$i));
            $dateDay = date('l', strtotime($date));
            if(!empty($sepArr[$date])){
                $sepStr .= '<tr>';
                $sepStr .= '<td>'.$j.'</td>';
                $sepStr .= '<td>'.$date.'</td>';
                $sepStr .= '<td>';
                if(($dateDay == 'Saturday' || $dateDay == 'Sunday') && ($SundayChk == 1 || $SaturdayChk == 1)){
            		$sepStr .= $sepArr[$date].','.$dateDay;
                }
                else{
                	$sepStr .= $sepArr[$date];
                } 
                $sepStr .= '</td>';
                $sepStr .= '<td>'.$dateDay.'</td>';
                $sepStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
            	$sepStr .= '</tr>';
                $j++; 
            }
            else if($dateDay == 'Saturday' && $SaturdayChk == 1){
                $sepStr .= '<tr>';
                $sepStr .= '<td>'.$j.'</td>';
                $sepStr .= '<td>'.$date.'</td>';
                $sepStr .= '<td>Saturday</td>';
                $sepStr .= '<td>'.$dateDay.'</td>';
                $sepStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
                $sepStr .= '</tr>';
                $j++;
            }
            else if($dateDay == 'Sunday' && $SundayChk == 1){
                $sepStr .= '<tr>';
                $sepStr .= '<td>'.$j.'</td>';
                $sepStr .= '<td>'.$date.'</td>';
                $sepStr .= 'sepStr<td>Sunday</td>';
                $sepStr .= '<td>'.$dateDay.'</td>';
                $sepStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
                $sepStr .= '</tr>';
                $j++;
            }   
        }

		$octQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '10' order BY DAY(date) ASC");
		$octTempArr = $octQuery->result_array();
		$finaloctArr = array();
		if(!empty($octTempArr)){
			foreach ($octTempArr as $key => $value) {
				$finaloctArr[$value['date']] = $value['occasion'];
			}
		}
		$octArr = $finaloctArr;

		$j = 1;
		$octStr = '';
        for($i=1;$i<=31;$i++){
            $date = date('Y-m-d', strtotime('2019-10-'.$i));
            $dateDay = date('l', strtotime($date));
            if(!empty($octArr[$date])){
                $octStr .= '<tr>';
                $octStr .= '<td>'.$j.'</td>';
                $octStr .= '<td>'.$date.'</td>';
                $octStr .= '<td>';
                if(($dateDay == 'Saturday' || $dateDay == 'Sunday') && ($SundayChk == 1 || $SaturdayChk == 1)){
            		$octStr .= $octArr[$date].','.$dateDay;
                }
                else{
                	$octStr .= $octArr[$date];
                } 
                $octStr .= '</td>';
                $octStr .= '<td>'.$dateDay.'</td>';
                $octStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
            	$octStr .= '</tr>';
                $j++; 
            }
            else if($dateDay == 'Saturday' && $SaturdayChk == 1){
                $octStr .= '<tr>';
                $octStr .= '<td>'.$j.'</td>';
                $octStr .= '<td>'.$date.'</td>';
                $octStr .= '<td>Saturday</td>';
                $octStr .= '<td>'.$dateDay.'</td>';
                $octStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
                $octStr .= '</tr>';
                $j++;
            }
            else if($dateDay == 'Sunday' && $SundayChk == 1){
                $octStr .= '<tr>';
                $octStr .= '<td>'.$j.'</td>';
                $octStr .= '<td>'.$date.'</td>';
                $octStr .= '<td>Sunday</td>';
                $octStr .= '<td>'.$dateDay.'</td>';
                $octStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
                $octStr .= '</tr>';
                $j++;
            }   
        }

		$novQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '11' order BY DAY(date) ASC");
		$novTempArr = $novQuery->result_array();
		$finalnovArr = array();
		if(!empty($novTempArr)){
			foreach ($novTempArr as $key => $value) {
				$finalnovArr[$value['date']] = $value['occasion'];
			}
		}
		$novArr = $finalnovArr;

		$j = 1;
		$novStr = '';
        for($i=1;$i<=31;$i++){
            $date = date('Y-m-d', strtotime('2019-11-'.$i));
            $dateDay = date('l', strtotime($date));
            if(!empty($novArr[$date])){
                $novStr .= '<tr>';
                $novStr .= '<td>'.$j.'</td>';
                $novStr .= '<td>'.$date.'</td>';
                $novStr .= '<td>';
                if(($dateDay == 'Saturday' || $dateDay == 'Sunday') && ($SundayChk == 1 || $SaturdayChk == 1)){
            		$novStr .= $novArr[$date].','.$dateDay;
                }
                else{
                	$novStr .= $novArr[$date];
                } 
                $novStr .= '</td>';
                $novStr .= '<td>'.$dateDay.'</td>';
                $novStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
            	$novStr .= '</tr>';
                $j++; 
            }
            else if($dateDay == 'Saturday' && $SaturdayChk == 1){
                $novStr .= '<tr>';
                $novStr .= '<td>'.$j.'</td>';
                $novStr .= '<td>'.$date.'</td>';
                $novStr .= '<td>Saturday</td>';
                $novStr .= '<td>'.$dateDay.'</td>';
                $novStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
                $novStr .= '</tr>';
                $j++;
            }
            else if($dateDay == 'Sunday' && $SundayChk == 1){
                $novStr .= '<tr>';
                $novStr .= '<td>'.$j.'</td>';
                $novStr .= '<td>'.$date.'</td>';
                $novStr .= '<td>Sunday</td>';
                $novStr .= '<td>'.$dateDay.'</td>';
                $novStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
                $novStr .= '</tr>';
                $j++;
            }   
        }
		$decQuery = $this->db->query("SELECT * FROM `tbl_holiday` where MONTH(date) = '12' order BY DAY(date) ASC");
		$decTempArr = $decQuery->result_array();
		$finaldecArr = array();
		if(!empty($decTempArr)){
			foreach ($decTempArr as $key => $value) {
				$finaldecArr[$value['date']] = $value['occasion'];
			}
		}
		$decArr = $finaldecArr;

		$j = 1;
		$decStr = '';
        for($i=1;$i<=31;$i++){
            $date = date('Y-m-d', strtotime('2019-12-'.$i));
            $dateDay = date('l', strtotime($date));
            if(!empty($decArr[$date])){
                $decStr .= '<tr>';
                $decStr .= '<td>'.$j.'</td>';
                $decStr .= '<td>'.$date.'</td>';
                $decStr .= '<td>';
                if(($dateDay == 'Saturday' || $dateDay == 'Sunday') && ($SundayChk == 1 || $SaturdayChk == 1)){
            		$decStr .= $decArr[$date].','.$dateDay;
                }
                else{
                	$decStr .= $decArr[$date];
                } 
                $decStr .= '</td>';
                $decStr .= '<td>'.$dateDay.'</td>';
                $decStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
            	$decStr .= '</tr>';
                $j++; 
            }
            else if($dateDay == 'Saturday' && $SaturdayChk == 1){
                $decStr .= '<tr>';
                $decStr .= '<td>'.$j.'</td>';
                $decStr .= '<td>'.$date.'</td>';
                $decStr .= '<td>Saturday</td>';
                $decStr .= '<td>'.$dateDay.'</td>';
                $decStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
                $decStr .= '</tr>';
                $j++;
            }
            else if($dateDay == 'Sunday' && $SundayChk == 1){
                $decStr .= '<tr>';
                $decStr .= '<td>'.$j.'</td>';
                $decStr .= '<td>'.$date.'</td>';
                $decStr .= '<td>Sunday</td>';
                $decStr .= '<td>'.$dateDay.'</td>';
                $decStr .= '<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>';
                $decStr .= '</tr>';
                $j++;
            }   
        }
        $data = array();
        $data['janStr'] = $janStr;
        $data['febStr'] = $febStr;
        $data['marStr'] = $marStr;
        $data['aprilStr'] = $aprilStr;
        $data['mayStr'] = $mayStr;
        $data['juneStr'] = $juneStr;
        $data['julyStr'] = $julyStr;
        $data['augStr'] = $augStr;
        $data['sepStr'] = $sepStr;
        $data['octStr'] = $octStr;
        $data['novStr'] = $novStr;
        $data['decStr'] = $decStr;
        echo json_encode($data);exit;
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

	public function deleteholiday(){
		if(empty($_POST['type'])){
			$date = $_POST['id'];
			$whereArr = array('date'=>$date);
			$this->common_model->deleteData('tbl_holiday',$whereArr);
		}
		else{ 
			$whereArr = array('user_id' => $this->user_id);
			$data = $this->common_model->getData('tbl_holiday_settings',$whereArr);
			if(empty($data[0]->extract)){
				$final_date = $_POST['id'];	
			}
			else{
				$date = $_POST['id'];
				$db_date = $data[0]->extract;
				$final_date = $db_date.','.$date;
			}
			$updateArr = array('extract' => $final_date);
			$this->common_model->updateData('tbl_holiday_settings',$updateArr,$whereArr);
		}

	}

	public function check_year(){
		if(empty($_POST['type'])){
			$year = $_POST['year'];
			echo $year;die;	
		}
	}
}

?>